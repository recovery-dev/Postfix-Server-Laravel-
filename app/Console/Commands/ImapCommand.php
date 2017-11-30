<?php

namespace App\Console\Commands;

use DB;
use Illuminate\Console\Command;
use App\Models\ImapAccount;

class ImapCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch all of the Email contents with the given IMAP account';

    public $conn;
    private $inbox;
    private $msg_cnt;
    private $account_id;
    private $server;
    private $user;
    private $pass;
    private $port;

    private $message;


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        var_dump("CronJOb starting.....");
        $this->LoadConfigValues();
        $this->connect();
        $this->inbox(); 
    }

    public function connect()
    {
        $this->conn = imap_open($this->server, $this->user, $this->pass);
    }

    public function close()
    {
        $this->inbox = array();
        $this->msg_cnt = 0;
        imap_close($this->conn);
    }

    public function getdecodevalue($message,$parttype,$parentcoding) {
        switch($parttype) {
            case 0: // text, handle encoding
                switch ($parentcoding) {
                    case 3:
                        $message = base64_decode($message);
                        break;
                    case 4:
                        $message = quoted_printable_decode($message);
                        break;
                }
            case 1: // multipart
                $message = imap_8bit($message);
                break;
            case 2: //message
                $message = imap_binary($message);
                break;
            case 3: // application
            case 4: // audio
                $message = imap_qprint($message);
                break;
            case 5: //image
                $message=imap_base64($message);
                break;
            case 6: // video
            case 7: // other
        }
        return $message;
    }

    public function LoadConfigValues()
    {
        try{
            $this->account_id = 1;
            $config = ImapAccount::where('id', $this->account_id)->get();
            foreach($config as $val) {
                $this->user = $val['username'];
                $this->pass = $val['password'];
                $this->port = $val['port'];
                $this->fqdn = $val['fqdn'];
                $this->folderName = $val['folder_name'];
                $this->server = $this->fqdn . $this->folderName;
            }
            if (
                $this->user === null OR 
                $this->pass === null OR
                $this->port === null OR
                $this->server === null
            )
            {
                throw new Exception("Cannot read configuration values");
            }
        } catch (\Exception $ex) {
            return $ex;
        }
    }
    
    public function GetInboxCount()
    {
        return $this->msg_cnt;
    }

    public function GetMessage($msg_index=NULL)
    {	
        try {
            if (count($this->inbox) <= 0)
            {
                return array();
            }
            elseif ( isset($msg_index) && isset($this->inbox[$msg_index]) )
            {
                return $this->inbox[$msg_index];
            }
            return $this->inbox[0];
        } catch(\Exception $e) {
            return $e;
        }
    }

    public function initEmailType($message)
    {
        $message["attachment"]["type"][0] = "text";
        $message["attachment"]["type"][1] = "multipart";
        $message["attachment"]["type"][2] = "message";
        $message["attachment"]["type"][3] = "application";
        $message["attachment"]["type"][4] = "audio";
        $message["attachment"]["type"][5] = "image";
        $message["attachment"]["type"][6] = "video";
        $message["attachment"]["type"][7] = "other";
        return $message;
    }

    public function inbox()
    {	
        $this->msg_cnt = imap_num_msg($this->conn);
        $in = array();
        $message = array();
        $message = $this->initEmailType($message);
        $savedirpath = '.';
        $savedirpath = str_replace('\\', '/', $savedirpath);
        if (substr($savedirpath, strlen($savedirpath) - 1) != '/') {
            $savedirpath .= '/';
        }
        $check = imap_mailboxmsginfo($this->conn);
        if ($check) {
            echo "Date: "     . $check->Date    . "<br />\n" ;
            echo "Driver: "   . $check->Driver  . "<br />\n" ;
            echo "Mailbox: "  . $check->Mailbox . "<br />\n" ;
            echo "Messages: " . $check->Nmsgs   . "<br />\n" ;
            echo "Recent: "   . $check->Recent  . "<br />\n" ;
            echo "Unread: "   . $check->Unread  . "<br />\n" ;
            echo "Deleted: "  . $check->Deleted . "<br />\n" ;
            echo "Size: "     . $check->Size    . "<br />\n" ;
        } else {
            echo "imap_mailboxmsginfo() failed: " . imap_last_error() . "<br />\n";
        }

        // Get the email contents via IMAP
        for($i = 1; $i <= $this->msg_cnt; $i++)
        {
            $in[$i] = array(
                'index' =>$i,
                'header' => imap_headerinfo($this->conn, $i),
                'body_raw' => imap_body($this->conn, $i),
                'body_text' => imap_fetchbody($this->conn, $i, 1),
                'body_html' => imap_fetchbody($this->conn, $i, 2),
                'structure' => imap_fetchstructure($this->conn, $i)
            );
            // $setFlag = imap_setflag_full($this->conn, $i, "\\Seen \\Flagged");
            // $messageUid = imap_uid($this->conn, $i);
            // imap_clearflag_full($this->conn, $messageUid, '\\Seen \\Flagged', ST_UID);
            // $status = imap_status($this->conn, $this->fqdn . $this->folderName, SA_ALL);
            // if ($status) {
            //     echo "Messages:   " . $status->messages    . "<br />\n";
            //     echo "Recent:     " . $status->recent      . "<br />\n";
            //     echo "Unseen:     " . $status->unseen      . "<br />\n";
            //     echo "UIDnext:    " . $status->uidnext     . "<br />\n";
            //     echo "UIDvalidity:" . $status->uidvalidity . "<br />\n";
            // } else {
            //     echo "imap_status failed: " . imap_last_error() . "\n";
            // }
            if (isset($in[$i]['structure']->parts))
            {
                $parts = $in[$i]['structure']->parts;
                $fpos = 2;
                
                for($j = 0; $j < count($parts); $j++) 
                {
                    $message["pid"][$j] = ($j);
                    $part = $parts[$j];

                    if(isset($part->disposition) && $part->disposition === "attachment")
                    {
                        $exist = DB::table('email_contents')->where('receive_time', date('Y-m-d H:i:s', strtotime($in[$i]['header']->date)))->get();
                        
                        if (isset($exist) && count($exist) > 0)
                        {
                            var_dump("___________Already exist with that email contents____________");
                            return true;
                        }

                        $message["type"][$j] = $message["attachment"]["type"][$part->type] . "/" . strtolower($part->subtype);
                        $message["subtype"][$j] = strtolower($part->subtype);

                        $ext = isset($part->subtype)? $part->subtype : null;
                        $params = isset($part->dparameters)? $part->dparameters : null;
                        $filename = isset($part->dparameters[0]->value)? $part->dparameters[0]->value : null;
                        
                        $mege = ""; $data = "";
                        $mege = imap_fetchbody($this->conn, $i, $fpos);  
                        $filename = "$filename";
                        $fromaddress = $in[$i]['header']->from;
                        foreach ($fromaddress as $key => $obj)
                        {
                            if (isset($obj->personal)) {
                                $fromaddress = $obj->personal.$obj->mailbox;	
                            } else {
                                $fromaddress = $obj->mailbox;	
                            }
                        }
                        // Setting the directory to be saved attachments
                        $dir = './Attachments/'.$fromaddress;	
                        if (!file_exists($dir))
                        {
                            mkdir($dir, 0777, true);
                        }
                        $path = $savedirpath . $dir .'/'. date("Y_m_d_H_i_s"). "-" . $filename;

                        // Writing file
                        $fp = fopen($path, "w");
                        $data = $this->getdecodevalue($mege, $part->type, $part->encoding);	
                        fputs($fp,$data);
                        fclose($fp);
                        $fpos += 1;
                    }
                }
            }
        }
        $this->inbox = $in;

        // Save the email contents into the 'email_contents' table
        for($i = 1; $i <= $this->msg_cnt; $i++) {
            $data = $in[$i]['header']->date;
          
            $attach = false;
            $attach = ( isset($in[$i]['structure']->parts) && 
                        isset($in[$i]['structure']->parts->disposition) &&
                        $in[$i]['structure']->parts->disposition == "attachment") ? true : false; // there are some attachments
            $exist = DB::table('email_contents')->where('receive_time', date('Y-m-d H:i:s', strtotime($in[$i]['header']->date)))->get();
            if (count($exist) === 0)
            {
                // Start Task 
                $task_status = $this->taskCheck($in[$i]);
                $date = 
                DB::table('email_contents')->insert([
                    'account_id' => $this->account_id,
                    'sender' => $in[$i]['header']->fromaddress,
                    'receive_time' => date('Y-m-d H:i:s', strtotime($in[$i]['header']->date)),
                    'subject' => mb_decode_mimeheader ($in[$i]['header']->subject),
                    'body_text' => mb_convert_encoding($in[$i]['body_text'], "UTF-8", "auto"),
                    'body_html' => $in[$i]['body_html'],
                    'structure' => $attach,
                    'sequence' => $i,
                    'status' => $task_status
                ]);
            }
        }
        var_dump("Close IMAP functions");
        $this->close();
    }

    function taskCheck($mail)
    {
        $mail_date_time = date('Y-m-d H:i:s', strtotime($mail['header']->date));
        $mail_date_day = date('Y-m-d', strtotime($mail['header']->date));
        
        $tasks = DB::table('tasks')->where('status', '!=', 'finished')->get();

        var_dump($tasks);
        
        $from = $mail['header']->fromaddress;
        $subject = mb_decode_mimeheader ($mail['header']->subject);
        $recipient = mb_convert_encoding($mail['body_text'], "UTF-8", "auto");
        $body = $mail['body_html'];

        // Initialize the basic status of the schedule
        $status = 'green'; 

        if ($tasks && count($tasks) > 0) {
            foreach($tasks as $task)
            {
                $schedule_time = preg_split('/ - /', $task->reservation_time);
                $start_time = $schedule_time[0];
                $expire_time = $schedule_time[1];
                
                var_dump($start_time . $expire_time);
                $pattern = $task;
                if ($start_time <= $mail_date_time && $expire_time <= $schedule_time[1]) {
                    var_dump("Schedule detection");
                    
                    // if (isset($val) && $val != null) {
                    //     if (isset($pattern->from_equal)? $pattern->from_equal : $from === $from &&  // From 
                    //         preg_match($pattern->from_contains, $from) &&
                    //         preg_match($pattern->from_start, $from) &&
                    //         preg_match($pattern->from_end, $from) &&
                    //         preg_match($pattern->from_regex, $from) && 
                            
                    //         isset($pattern->subject_equal)? $pattern->subject_equal : $subject === $subject &&      // Subject
                    //         preg_match($pattern->subject_contains, $subject) && 
                    //         preg_match($pattern->subject_start, $subject) && 
                    //         preg_match($pattern->subject_end, $subject) && 
                    //         preg_match($pattern->subject_regex, $subject) && 
                            
                    //         isset($pattern['recipient_equal'])? $pattern->recipient_equal : $recipient === $recipient &&  // Recipient
                    //         preg_match($pattern->recipient_contains, $recipient) && 
                    //         preg_match($pattern->recipient_start, $recipient) && 
                    //         preg_match($pattern->recipient_end, $recipient) && 
                    //         preg_match($pattern->recipient_regex, $recipient) && 

                    //         isset($pattern['body_equal'])? $pattern->body_equal : $recipient === $body &&            // Body
                    //         preg_match($pattern->body_contains, $body) && 
                    //         preg_match($pattern->body_start, $body) && 
                    //         preg_match($pattern->body_end, $body) && 
                    //         preg_match($pattern->bdoy_regex, $body)
                    //     ) {
                    //         return $status = 'green'; // Everything is all right
                    //     } else {
                    //         return $status = 'red'; // Bad status detected
                    //     }
                    // }
                    
                    return 'orange';
                } else {

                    $status = 'orange'; // Unknown status detected
                }
            }
        } else {
            $status = 'orange';
        }
        return $status;
    }
}

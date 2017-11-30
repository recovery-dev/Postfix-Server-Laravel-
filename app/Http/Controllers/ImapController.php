<?php

namespace App\Http\Controllers;

use App\Models\ImapAccount;
use Illuminate\Exception;
use Illuminate\Http\Request;


class ImapController extends Controller
{
    public $conn;
    private $inbox;
    private $msg_cnt;
    private $server;
    private $user;
    private $pass;
    private $port;

    private $message;

    public function __construct()
    {
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
            $config = ImapAccount::where('id', 1)->get();
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
        } catch (\Exception $ex)
        {
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

    public function inbox()
    {	
        $this->msg_cnt = imap_num_msg($this->conn);
        $in = array();
        $message = array();
            
        $message["attachment"]["type"][0] = "text";
        $message["attachment"]["type"][1] = "multipart";
        $message["attachment"]["type"][2] = "message";
        $message["attachment"]["type"][3] = "application";
        $message["attachment"]["type"][4] = "audio";
        $message["attachment"]["type"][5] = "image";
        $message["attachment"]["type"][6] = "video";
        $message["attachment"]["type"][7] = "other";
        $savedirpath = '.';
        $savedirpath = str_replace('\\', '/', $savedirpath);
        if (substr($savedirpath, strlen($savedirpath) - 1) != '/') {
            $savedirpath .= '/';
        }

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
            if (isset($in[$i]['structure']->parts)) {
                $parts = $in[$i]['structure']->parts;
                $fpos = 2;

                for($j = 0; $j < count($parts); $j++) {
                    $message["pid"][$j] = ($j);
                    $part = $parts[$j];
                    if(isset($part->disposition) && $part->disposition == "attachment") {
                        $message["type"][$j] = $message["attachment"]["type"][$part->type] . "/" . strtolower($part->subtype);
                        $message["subtype"][$j] = strtolower($part->subtype);
                        $ext = $part->subtype;
                        $params = $part->dparameters;
                        $filename = $part->dparameters[0]->value;
                        
                        $mege = ""; $data = "";
                        $mege = imap_fetchbody($this->conn, $i, $fpos);  
                        $filename = "$filename";
                        $fromaddress = $in[$i]['header']->from;
                        foreach ($fromaddress as $key => $obj) {
                            if (isset($obj->personal)) {
                                $fromaddress = $obj->personal.$obj->mailbox;	
                            } else {
                                $fromaddress = $obj->mailbox;	
                            }
                        }

                        $dir = './Attachments/'.$fromaddress;	
                        if (!file_exists($dir)) {
                            mkdir($dir, 0777, true);
                        }
                        $path = $savedirpath . $dir .'/'. date("Y_m_d_H_i_s"). "-" . $filename;

                        // writing file
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
    }
}

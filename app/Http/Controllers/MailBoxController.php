<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\EmailContents as EmailContents;
use App\Http\Controllers\ImapController as EmailReader;

class MailBoxController extends Controller
{
    private $conn;

    public function index()
    {
        $contents = DB::table('email_contents')->get();
        return view('contents/contents', ['contents' => $contents]);
    }

    public function getCredentials($id)
    {
        if ($id) {
            return $imap = DB::table('imap_accounts')->where('id', $id)->get();
        } else {
            return $this->errHandler('Not found the IMAP informations');
        }
    }

    public function connect($id)
    {
        try {
            $imap = $this->getCredentials($id);
            $this->conn = imap_open($imap[0]->fqdn, $imap[0]->username, $imap[0]->password);
            return $imap[0]->fqdn . $imap[0]->folder_name;
        } catch (\Exception $e) {
            return $this->errHandler($e);
        }
    }

    public function disconnect()
    {
        imap_close($this->conn);
    }

    public function getEmailContentById($id)
    {
         try {
            $content = DB::table('email_contents')->where('id', $id)->get();

            // Setting the flag as seen

            return $content;
        } catch(\Exception $e) {
            return $this->errHandler($e);
        }
    }

    public function getListOfMailbox($accountId)
    {
        try {
            $imap = $this->getCredentials($accountId);
            $this->connect($accountId);
            $list = imap_list($this->conn, $imap[0]->fqdn, "*");
            if (is_array($list)) {
                return $list;
            } else {
                return $this->errHandler("imap_getmailboxes failed: " . imap_last_error() . "\n");
            }
        } catch (\Exception $e) {
            return $this->errHandler($e);
        }
    }

    public function getStatusOfMailbox($server)
    {
        $status = imap_status($this->conn, $server, SA_ALL);
        if ($status) {
            echo "Messages:   " . $status->messages    . "<br />\n";
            echo "Recent:     " . $status->recent      . "<br />\n";
            echo "Unseen:     " . $status->unseen      . "<br />\n";
            echo "UIDnext:    " . $status->uidnext     . "<br />\n";
            echo "UIDvalidity:" . $status->uidvalidity . "<br />\n";
        } else {
            echo "imap_status failed: " . imap_last_error() . "\n";
        }
    }

    public function createMailbox(Request $req)
    {
        try {
            $data = $req->all();
            $server = $this->connect($data['id']);
        
            if (imap_createmailbox($this->conn, imap_utf7_encode($server . '/' . $data['name']))) {
                $this->disconnect();
                return "Mailbox created successfully";
            } else {
                return $this->errHandler('Failed to create new mailbox. Check the credentials out.');
            }
        } catch(\Exception $e) {
            return $this->errHandler($e);
        }
    }

    public function deleteMailbox(Request $req)
    {
        try {   
            $data = $req->all();
            $this->connect($data['id']);
            if (imap_deletemailbox ($this->conn, $data['name'])) {
                $this->disconnect();
                return "Mailbox deleted successfully";
            } else {
                return $this->errHandler('Failed to delete a mailbox');
            }
        } catch(\Exception $e) {
            return $this->errHandler($e);
        }
    }

    public function moveTo(Request $req)
    {
        try {
            $data = $req->all();
            $this->connect($data['id']);
            if (imap_mail_move($this->conn, $data['sequence'], $data['name'])) {
                $this->disconnect();
                return 'success';
            } else {
                return $this->errHandler('failed to move email');
            }
        } catch(\Exception $e) {
            return $this->errHandler($e);
        }
    }

    public function markAsRead(Request $req)
    {
         try {   
            $data = $req->all();
            $this->connect($data['id']);
            (int)$data['sequence'] += 1;
            if (imap_setflag_full($this->conn, $data['sequence'], "\\Seen")) {
                $this->disconnect();
                return 'success';
            } else {
                $this->errHandler('failed to mark as seen');
            }
            return $data['sequence'];
        } catch(\Exception $e) {
            return $this->errHandler($e);
        }
    }

    public function markAsUnread(Request $req)
    {
         try {   
            $data = $req->all();
            $this->connect($data['id']);
            $messageUid = imap_uid($this->conn, $data['sequence']);
            if (imap_clearflag_full($this->conn, $messageUid, "\\Seen")) {
                $this->disconnect();
                return 'success';
            } else {
                return $this->errHandler('failed to mark as unseen');
            }
        } catch(\Exception $e) {
            return $this->errHandler($e);
        }
    }

    public function deleteEmail(Request $req)
    {
         try {   
            $data = $req->all();
            $this->connect($data['id']);
            if (imap_delete($this->conn, $data['sequence'])) {
                $this->disconnect();
                DB::table('email_contents')->where('sequence', $data['sequence'])->get()->delete();
                return 'success';
            } else {
                return $this->errHandler('failed to delete email');
            }
        } catch(\Exception $e) {
            return $this->errHandler($e);
        }
    }

    public function errHandler($e) {
        $this->disconnect();
        if (gettype($e) === 'object') {
            return Response::json(['error'=> $e->getMessage()], 400);
        } else {
            return Response::json(['error' => 'Something wrong!' . $e], 400);
        }
    }
}

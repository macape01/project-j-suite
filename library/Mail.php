<?php

namespace My;

use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\Exception as PHPMailerException;

class Mail {
    // PHPMailer
    private $_mailer;

    /**
     * Constructs mail
     * @param string $subject
     * @param string $body
     * @param bool $isHTML (optional)
     */
    public function __construct(string $subject, string $body, bool $isHTML = false)
    {
        // Setup SMTP server...
        $cnf = include(__DIR__ . "/../config/mail.php");
        $this->_mailer = new PHPMailer();
        $this->_mailer->IsSMTP();
        $this->_mailer->Mailer     = $cnf["server"]["protocol"];
        $this->_mailer->SMTPAuth   = TRUE;
        $this->_mailer->SMTPSecure = $cnf["server"]["security"];
        $this->_mailer->Port       = $cnf["server"]["port"];
        $this->_mailer->Host       = $cnf["server"]["host"];
        $this->_mailer->Username   = $cnf["server"]["username"];
        $this->_mailer->Password   = $cnf["server"]["password"];
        // Debug options
        $this->_mailer->SMTPDebug   = $cnf["server"]["debug"]["level"];
        $this->_mailer->Debugoutput = $cnf["server"]["debug"]["output"];
        // Configure mail contact: from and reply...
        if (isset($cnf["from"])) {
            $this->_mailer->SetFrom($cnf["from"]["mail"], $cnf["from"]["name"]);
        }
        if (isset($cnf["reply"])) {
            $this->_mailer->AddReplyTo($cnf["reply"]["mail"], $cnf["reply"]["name"]);
        }
        // Set subject and body (HTML or not)...
        $this->_mailer->Subject = $subject;
        if ($isHTML) {
            $this->_mailer->IsHTML(true);
            $this->_mailer->MsgHTML($body);    
        } else {
            $this->_mailer->IsHTML(false);
            $this->_mailer->Body = $body;         
        }
    }

    /**
     * Send mail to recipients
     * 
     * @param array $to
     * @param array $cc (optional)
     * @param array $bcc (optional)
     * 
     * @return bool
     */
    public function send(array $to, array $cc = [], array $bcc = []) 
    {
        // Add recipients...
        foreach ($to as $name => $mail) {
            $this->_mailer->AddAddress($mail, $name);
        }
        foreach ($cc as $name => $mail) {
            $this->_mailer->AddCC($mail, $name);
        }
        foreach ($bcc as $name => $mail) {
            $this->_mailer->AddBCC($mail, $name);
        }
        // Send mail...
        // Clear recipients...
        try {
            $result = $this->_mailer->Send();
            $this->_mailer->clearAllRecipients();
            return $result;
        } catch (PHPMailerException $e) {
            return false;
        }
    }
}
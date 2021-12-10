<?php
 
namespace My;
use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\Exception as PHPMailerException;
class Mail {
   // PHPMailer
   private $_mailer; 
 
   /**
    * Constructs mail
    *
    * @param string $subject
    * @param string $body
    * @param bool $isHTML (optional)
    */
   public function __construct(string $subject, string $body, bool $isHTML = false)
   {
        // Setup SMTP server...
        $config = include(__DIR__ . "/../config/mail.php");
        $this->_mailer = new PHPMailer();
        $this->_mailer->IsSMTP();
        $this->_mailer->Mailer = $config["server"]["protocol"];
        $this->_mailer->SMTPDebug  = $config["server"]["debug"]["level"];  
        $this->_mailer->SMTPAuth   = TRUE;
        $this->_mailer->SMTPSecure = $config["server"]["security"];
        $this->_mailer->Port       = $config["server"]["port"];
        // Configure mail host
        $this->_mailer->Host       = $config["server"]["host"];
        $this->_mailer->Username   = $config["server"]["username"];
        $this->_mailer->Password   = $config["server"]["password"];
        //Configure mail parameters
        $this->_mailer->SetFrom($config["from"]["mail"], $config["from"]["name"]);
        $this->_mailer->AddReplyTo($config["reply"]["mail"], $config["from"]["name"]);
        // Set subject and body (HTML or not)...
        $this->_mailer->IsHTML($isHTML);
        $this->_mailer->Subject = $subject;
        $this->_mailer->Body = $body;
   }
 
   /**
    * Send mail to recipients
    *
    * @param array $to
    * @param array $cc (optional)
    * @param array $bcc (optional)
    * @return bool
    */
   public function send(array $to, array $cc = [], array $bcc = [])
   {    

    foreach($to as $nom => $correu){
        $this->_mailer->addAddress($correu, $nom);
    }

    foreach($cc as $nom => $correu){
        $this->_mailer->addCC($correu, $nom);
    }

    foreach($bcc as $nom => $correu){
        $this->_mailer->addBCC($correu, $nom);
    }
    
        
    // Send mail...
    $okey=$this->_mailer->send();
    
    
    // Clear recipients...
    $this->_mailer->clearAllRecipients();
    return $okey;

   }
}



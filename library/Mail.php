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
        $this->config = require __DIR__ . "/../config/mail.php"; 
        // Setup SMTP server...
        $_mailer = new PHPMailer();
        $_mailer->IsSMTP();
        $_mailer->Mailer = "smtp";
       // Configure mail contact: from and reply...
        $_mailer->SMTPDebug  = 1;  
        $_mailer->SMTPAuth   = TRUE;
        $_mailer->SMTPSecure = "tls";
        $_mailer->Port       = 587;
        $_mailer->Host       = "smtp.gmail.com";
        $_mailer->Username   = "your-email@gmail.com";
        $_mailer->Password   = "your-gmail-password";
       // Set subject and body (HTML or not)...
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
        
        var_dump($config);
       // Add recipients...
       // Send mail...
       // Clear recipients...
   }
}

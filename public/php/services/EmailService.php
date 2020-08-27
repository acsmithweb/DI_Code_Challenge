<?php
class EmailService
{
  public $recipient;
  public $subject;
  public $message;

  public function __construct($recipient, $subject, $message){
    $this->recipient = $recipient;
    $this->subject = $subject;
    $this->message = wordwrap($message, 70);
  }

  public function send(){
    return mail($this->recipient, $this->subject, $this->message);
  }
}
?>

<?php
use PHPUnit\Framework\TestCase;
require_once dirname(dirname(__FILE__)) . "../../services/EmailService.php";

class EmailServiceTest extends TestCase
{
  //new should instantiate with given arguments
  public function testServiceInstantiation()
  {
    $recipient = 'aaronsmithweb@gmail.com';
    $subject = 'Testing stuff';
    $message = 'Cool Test message';

    $email_service = new EmailService($recipient, $subject, $message);

    $this->assertEquals($email_service->recipient,$recipient);
    $this->assertEquals($email_service->subject,$subject);
    $this->assertEquals($email_service->message,$message);
  }

  //send should return true with given arguments
  public function testServiceSend()
  {
    $recipient = 'aaronsmithweb@gmail.com';
    $subject = 'Testing stuff';
    $message = 'Cool Test message';

    $email_service = new EmailService($recipient, $subject, $message);

    $this->assertTrue($email_service->send());
  }
}
?>

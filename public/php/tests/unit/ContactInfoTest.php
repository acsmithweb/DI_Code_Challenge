<?php
use PHPUnit\Framework\TestCase;
require_once dirname(dirname(__FILE__)) . "../../models/ContactInfo.php";
require_once dirname(dirname(__FILE__)) . "../../models/DatabaseConnection.php";

class ContactInfoTest extends TestCase
{
  //should instantiate $info when required properties are present and add
    public function testContactInfoValidProperties()
    {
        $name = 'Aaron Smith';
        $email = 'aaronsmithweb@gmail.com';
        $message = 'cool message send me some cool info!';
        $phone = '1238675309';

        $info = new ContactInfo($name, $email, $message, $phone);

        $this->assertEquals($info->name,$name);
        $this->assertEquals($info->email,$email);
        $this->assertEquals($info->message,$message);
        $this->assertEquals($info->phone,$phone);
    }

    //should instantiate $info when phone property is NULL
    public function testContactInfoMissingPhone()
    {
        $name = 'Aaron Smith';
        $email = 'aaronsmithweb@gmail.com';
        $message = 'cool message send me some cool info!';
        $phone = NULL;

        $info = new ContactInfo($name, $email, $message, $phone);
        $this->assertEquals($info->name,$name);
        $this->assertEquals($info->email,$email);
        $this->assertEquals($info->message,$message);
        $this->assertEquals($info->phone,$phone);
    }

    //should save record to database
    public function testSaveValidContactInfo(){
      $name = 'Aaron Smith';
      $email = 'aaronsmithweb@gmail.com';
      $message = 'cool message send me some cool info!';
      $phone = '1238675309';

      $info = new ContactInfo($name, $email, $message, $phone);

      $this->assertTrue($info->save());
    }

    //should fail to save record to database
    public function testSaveInvalidContactInfo(){
      $name = 'Aaron Smith';
      $email = 'aaronsmithweb@gmail.com';
      $message = 'cool message send me some cool info!';
      $phone = '1238675309';

      $info = new ContactInfo($name, $email, $message, $phone);
      $info->name = null;

      $this->assertFalse($info->save());
    }

    //should throw InvalidArgumentException when name property is missing
    public function testContactInfoMissingName()
    {
        $name = NULL;
        $email = 'aaronsmithweb@gmail.com';
        $message = 'cool message send me some cool info!';
        $phone = '1238675309';

        $this->expectException(InvalidArgumentException::class);
        $info = new ContactInfo($name, $email, $message, $phone);
    }

    //should throw InvalidArgumentException when email property is missing
    public function testContactInfoMissingEmail()
    {
        $name = 'Aaron Smith';
        $email = NULL;
        $message = 'cool message send me some cool info!';
        $phone = '1238675309';

        $this->expectException(InvalidArgumentException::class);
        $info = new ContactInfo($name, $email, $message, $phone);
    }

    //should throw InvalidArgumentException when message property is missing
    public function testContactInfoMissingMessage()
    {
        $name = 'Aaron Smith';
        $email = 'aaronsmithweb@gmail.com';
        $message = NULL;
        $phone = '1238675309';

        $this->expectException(InvalidArgumentException::class);
        $info = new ContactInfo($name, $email, $message, $phone);
    }
}
?>

<?php
require_once dirname(dirname(__FILE__)) . "../models/ContactInfo.php";
require_once dirname(dirname(__FILE__)) . "../services/EmailService.php";

class ContactInfoApi
{
  private $result = null;

  public function call_api(){
    switch ($_SERVER['REQUEST_METHOD']){
      case "POST":
        $this->create();
        break;
      default:
        http_response_code(404);
      }
  }

  public function create(){
    try {
      $new_contact = $this->build_contact_info();
      return $new_contact->save() ? $this->email_owner($new_contact) : http_response_code(400);
    }
    catch(Exception $e){
      http_response_code(400);
    }
  }

  private function build_contact_info(){
      $contact_data = $this->retrieve_contact_data();
      return new ContactInfo($contact_data['name'], $contact_data['email'], $contact_data['message'], $contact_data['phone']);
  }

  private function retrieve_contact_data(){
    $name = empty($_POST['name']) ? null : $_POST['name'];
    $email = empty($_POST['email']) ? null : $_POST['email'];
    $message = empty($_POST['message']) ? null : $_POST['message'];
    $phone = empty($_POST['phone']) ? null : $_POST['phone'];
    return array ('name' => $name,'email'=>$email,'message'=>$message,'phone'=>$phone);
  }

  protected function email_owner($contact, $email_service = null){
    if (is_null($email_service)) $email_service = new EmailService("guy-smiley@example.com","Contact Information",$this->mail_message_builder($contact));

    if($email_service->send()){
      return http_response_code(200);
    }
    else{
      return http_response_code(206);
    }
  }

  private function mail_message_builder($contact){
    return ("Full Name: " . $contact->name ."\n Email: " . $contact->email . "\n Phone: " . $contact->phone . "\n Message: " . $contact->message);
  }
}

$contact_api = new ContactInfoApi;
header('content-Type: application/json');
$contact_api->call_api();
?>

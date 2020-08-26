<?php
require_once dirname(dirname(__FILE__)) . "../models/ContactInfo.php";

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
      return $new_contact->save() ? $this->mail_owner($new_contact) : http_response_code(400);
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

  private function mail_owner($contact){
    $msg = ("Full Name: " . $contact->name ."\n Email: " . $contact->email . "\n Phone: " . $contact->phone . "\n Message: " . $contact->message);
    $msg = wordwrap($msg,70);
    $headers = "From: Aaron Smith";
    if(mail("guy-smiley@example.com","Contact Information",$msg,"From: aaronsmithweb@gmail.com")){
      return http_response_code(200);
    }
    else{
      echo 'message not accepted';
      return http_response_code(206);
    }
  }

}

$contact_api = new ContactInfoApi;
header('content-Type: application/json');
$contact_api->call_api();
?>

<?php
require_once dirname(dirname(__FILE__)) . "../models/ContactInfo.php";

class ContactInfoApi
{
  private $result = null;

  public function create(){
    try {
      $new_contact = $this->build_contact_info();
      return $new_contact->save() ? http_response_code(200) : http_response_code(410);
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

}

$contact_api = new ContactInfoApi;
header('content-Type: application/json');
$contact_api->create();
?>

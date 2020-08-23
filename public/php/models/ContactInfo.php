<?php

class ContactInfo
{
  public $name;
  public $email;
  public $message;
  public $phone = null;

  public function __construct($name, $email, $message, $phone = NULL){
    $this->valid_properties($name, $email, $message) ? $this->set_properties($name, $email, $message, $phone) : $this->invalid_arguments();
  }

  private function valid_properties($name, $email, $message){
    return isset($name, $email, $message) ? true : false;
  }

  private function set_properties($name, $email, $message, $phone){
    $this->name = $name;
    $this->email = $email;
    $this->message = $message;
    $this->phone = $phone;
  }

  private function invalid_arguments(){
    throw new InvalidArgumentException('ContactInfo requires a name, email, and message');
  }

  private function save_contact_info(){

  }
}
?>

<?php
require_once "DatabaseConnection.php";

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

  public function save(){
    $conn = new DatabaseConnection();
    $stmt = $conn->statement("INSERT INTO contact_info (Name, Email, Phone, Message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $this->name, $this->email, $this->phone, $this->message);
    $result = $stmt->execute();

    if ($result){
      return true;
    }
    else{
      return false;
    }

    $conn->close();
  }
}
?>

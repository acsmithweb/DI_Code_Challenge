<?php
require_once "DatabaseConnection.php";

//A model to represent info from the contact form
class ContactInfo
{
  public $name;
  public $email;
  public $message;
  public $phone = null;

  //populate the new object with the given arguments phone number optional
  public function __construct($name, $email, $message, $phone = NULL){
    $this->valid_properties($name, $email, $message) ? $this->set_properties($name, $email, $message, $phone) : $this->invalid_arguments();
  }

  //check to make sure required arguments are present
  private function valid_properties($name, $email, $message){
    return isset($name, $email, $message) ? true : false;
  }

  //set the properties for the object
  private function set_properties($name, $email, $message, $phone){
    $this->name = $name;
    $this->email = $email;
    $this->message = $message;
    $this->phone = $phone;
  }

  private function invalid_arguments(){
    throw new InvalidArgumentException('ContactInfo requires a name, email, and message');
  }

  //Save function inserts contactinfo object into database takes a connection as an option
  public function save($conn = null){
    if (is_null($conn)) $conn = new DatabaseConnection;
    $stmt = $conn->statement("INSERT INTO contact_info (Name, Email, Phone, Message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $this->name, $this->email, $this->phone, $this->message);
    $result = $stmt->execute();

    $conn->close();
    return $result;
  }
}
?>

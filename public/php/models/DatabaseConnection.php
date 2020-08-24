<?php

class DatabaseConnection
{
  Private $servername = "localhost";
  Private $username = "root";
  Private $password = NULL;
  Private $database = "DI_CHALLENGE_DB";
  Public $conn;

  public function __construct(){
    $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);

    if ($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }
  }

  public function statement($prep_stmt){
    $stmt = $this->conn->prepare($prep_stmt);
    return $stmt;
  }

  public function close(){
    $this->conn->close();
    echo 'connection closed';
  }
}
?>

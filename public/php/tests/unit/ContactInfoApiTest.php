<?php
use PHPUnit\Framework\TestCase;
require_once dirname(dirname(__FILE__)) . "../../api/ContactInfoApi.php";

class ContactInfoApiTest extends TestCase
{
  //should return a 200 response when valid data is given
  public function testCreateContactInfoEndpoint()
  {
    $_SERVER['REQUEST_METHOD'] = 'POST';
    $_POST['name'] = 'Aaron';
    $_POST['email'] = "aaronsmithweb@gmail.com";
    $_POST['message'] = 'cool message';

    $contact_api = new ContactInfoApi;
    $contact_api->call_api();

    $this->assertEquals(200, http_response_code());
  }

  //should return a 400 response when invalid data is given
  public function testInvalidCreateContactInfoEndpoint()
  {
    $_SERVER['REQUEST_METHOD'] = 'POST';
    $_POST['name'] = 'Aaron';
    $_POST['email'] = "aaronsmithweb@gmail.com";
    $_POST['message'] = null;

    $contact_api = new ContactInfoApi;
    $contact_api->call_api();

    $this->assertEquals(400, http_response_code());
  }

  //should return a 404 response when a non POST call is made
  public function testInvalidEndpointCall()
  {
    $_SERVER['REQUEST_METHOD'] = 'GET';
    $contact_api = new ContactInfoApi;

    $contact_api->call_api();

    $this->assertEquals(404, http_response_code());
  }
}
?>

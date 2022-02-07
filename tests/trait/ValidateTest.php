<?php
require_once $_SERVER['DOCUMENT_ROOT'] . 'app/trait/Validate.php';

use PHPUnit\Framework\TestCase;

class ValidateTest extends TestCase
{
  use Validate;

  public function testValidateFieldStringWithDataEmpty()
  {
    $keyMessage = 'Key test';
    $min = 7;
    $max = 50;
    $data = '';

    $result = $this->validateFieldString($keyMessage, $min, $max, $data);
    $this->assertIsString($result);
  }

  public function testValidateFieldStringWithDataInvalid()
  {
    $keyMessage = 'Key test';
    $min = 7;
    $max = 50;
    $data = 'String';

    $result = $this->validateFieldString($keyMessage, $min, $max, $data);
    $this->assertIsString($result);
  }

  public function testValidateFieldStringWithDataValid()
  {
    $keyMessage = 'Key test';
    $min = 7;
    $max = 50;
    $data = 'String Valid';

    $result = $this->validateFieldString($keyMessage, $min, $max, $data);
    $this->assertNull($result);
  }

  public function testValidateFieldRegexSpecialWithDataEmpty()
  {
    $data = '';
    $regex = '/\S+@\S+\.\S+/';
    $messageEmpty = 'Data input empty!';
    $messageRegex = 'Data input not match!';
    $result = $this->validateFieldRegexSpecial($data, $regex, $messageEmpty, $messageRegex);
    $this->assertIsString($result);
  }

  public function testValidateFieldRegexSpecialWithDataInvalid()
  {
    $data = 'abbgmail.com';
    $regex = '/\S+@\S+\.\S+/';
    $messageEmpty = 'Data input empty!';
    $messageRegex = 'Data input not match!';
    $result = $this->validateFieldRegexSpecial($data, $regex, $messageEmpty, $messageRegex);
    $this->assertIsString($result);
  }

  public function testValidateFieldRegexSpecialWithDataValid()
  {
    $data = 'abb@gmail.com';
    $regex = '/\S+@\S+\.\S+/';
    $messageEmpty = 'Data input empty!';
    $messageRegex = 'Data input not match!';
    $result = $this->validateFieldRegexSpecial($data, $regex, $messageEmpty, $messageRegex);
    $this->assertNull($result);
  }

  public function testValidateFieldConfirmWithDataEmpty()
  {
    $keyMessage = 'Hello';
    $data = 'string';
    $dataConfirm = null;
    $result = $this->validateConfirm($keyMessage, $data, $dataConfirm);
    $this->assertIsString($result);
  }

  public function testValidateFieldConfirmWithDataInvalid()
  {
    $keyMessage = 'Hello';
    $data = 'String';
    $dataConfirm = 'string';
    $result = $this->validateConfirm($keyMessage, $data, $dataConfirm);
    $this->assertIsString($result);
  }

  public function testValidateFieldConfirmWithDataValid()
  {
    $keyMessage = 'Hello';
    $data = 'string';
    $dataConfirm = 'string';
    $result = $this->validateConfirm($keyMessage, $data, $dataConfirm);
    $this->assertNull($result);
  }

  public function testValidateBirthdayWithDataEmpty()
  {
    $data = '';
    $messageEmpty = 'Data input empty';
    $messageDate = 'Date must be before today';
    $result = $this->validateBirthday($data, $messageEmpty, $messageDate);
    $this->assertIsString($result);
  }

  public function testValidateBirthdayWithDataInvalid()
  {
    $data = '2022-06-06';
    $messageEmpty = 'Data input empty';
    $messageDate = 'Date must be before today';
    $result = $this->validateBirthday($data, $messageEmpty, $messageDate);
    $this->assertIsString($result);
  }

  public function testValidateBirthdayWithDataValid()
  {
    $data = '2020-06-06';
    $messageEmpty = 'Data input empty';
    $messageDate = 'Date must be before today';
    $result = $this->validateBirthday($data, $messageEmpty, $messageDate);
    $this->assertNull($result);
  }

  public function testValidateDateBeforeAnotherWithDataEmpty()
  {
    $date = '';
    $anotherDate = '2020-06-06';
    $messageEmpty = 'Data input empty';
    $messageDate = 'Date must be before today';
    $result = $this->validateDateBeforeAnother($date, $anotherDate, $messageEmpty, $messageDate);
    $this->assertIsString($result);
  }

  public function testValidateDateBeforeAnotherWithDataInvalid()
  {
    $date = '2021-01-01';
    $anotherDate = '2020-06-06';
    $messageEmpty = 'Data input empty';
    $messageDate = 'Date must be before today';
    $result = $this->validateDateBeforeAnother($date, $anotherDate, $messageEmpty, $messageDate);
    $this->assertIsString($result);
  }

  public function testValidateDateBeforeAnotherWithDataValid()
  {
    $date = '2019-01-01';
    $anotherDate = '2020-06-06';
    $messageEmpty = 'Data input empty';
    $messageDate = 'Date must be before today';
    $result = $this->validateDateBeforeAnother($date, $anotherDate, $messageEmpty, $messageDate);
    $this->assertNull($result);
  }
}
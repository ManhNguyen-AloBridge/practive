<?php

declare(strict_types=1);
require_once $_SERVER['DOCUMENT_ROOT'] . 'app/controllers/Form/FormController.php';

use PHPUnit\Framework\TestCase;

if (!isset($_SESSTION)) $_SESSION = [];

class FormControllerTest extends TestCase
{
  public $formController;

  public function setUp(): void
  {
    $_SESSION['user_id'] = 1;
    $this->formController = new FormController();
  }

  public function testShowFormWithIdValid()
  {
    $formId = 60;
    $result = $this->formController->show($formId);
    $this->assertIsArray($result);
  }

  public function testShowFormWithIdInvalid()
  {
    $formId = 3;
    $result = $this->formController->show($formId);
    $this->assertIsArray($result);
  }

  public function testGetListForm()
  {
    $result = $this->formController->getListForm();
    $this->assertIsArray($result);
  }
}
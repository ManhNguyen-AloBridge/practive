<?php
require_once $_SERVER['DOCUMENT_ROOT'] . 'app/services/FormService.php';

use PHPUnit\Framework\TestCase;

if (!isset($_SESSTION)) $_SESSION = [];

class FormServiceTest extends TestCase
{

  public $formService;


  public function setUp(): void
  {
    $_SESSION['user_id'] = 1;
    $this->formService = new FormService();
  }

  public function testCreateNewForm()
  {
    $data = [
      'form_type_id' => '1',
      'reason' => 'Ly do',
      'extend_inlate_early_id' => null,
      'extend_absence_id ' => '1',
      'start_date' => '2020-01-01',
      'end_date' => '2020-01-01',
      'detail_time' => 'Thong tin nghi chi tiet',
      'created_at' => '2020-01-01',
      'deleted_at' => null,
    ];

    if (!isset($_SESSION)) {
    }

    $result = $this->formService->store($data);
    $this->assertTrue($result);
  }

  public function testGetListForm()
  {
    $result = $this->formService->getListForm();
    $this->assertIsArray($result);
  }

  public function testGetListExtendInLateEarly()
  {
    $result = $this->formService->getListExtendInlateEarly();
    $this->assertIsArray($result);
  }

  public function testGetListExtendAbsence()
  {
    $result = $this->formService->getListExtendAbsence();
    $this->assertIsArray($result);
  }

  public function testFindFormById()
  {
    $id = 110;
    $result = $this->formService->FindById($id);
    $this->assertIsArray($result);
  }

  public function testGetListFormType()
  {
    $result = $this->formService->getListFormType();
    $this->assertIsArray($result);
  }

  public function testDeleteSoftForm()
  {
    $id = 61;
    $result = $this->formService->deleteSoft($id);
    $this->assertTrue($result);
  }
}
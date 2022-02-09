<?php
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

  /**
  * @runInSeparateProcess
  */
  public function testStoreWithValidData(){
    $data = [
      'form_type_id' => '1',
      'reason' => 'aaaaaaaaaaa',
      'extend_inlate_early_id' => '1',
      'extend_absence_id ' => null,
      'start_date' => '2020-01-01',
      'end_date' => '2020-01-01',
      'detail_time' => 'Thong tin nghi chi tiet',
      'created_at' => '2020-01-01',
      'deleted_at' => null,
      'user_id' => 'aaaaaaaaaaa',
      'status_id' => 'aaaaaaaaaaa'
    ];

    $result = $this->formController->store($data);
    $this->assertNull($result);
  }

  /**
  * @runInSeparateProcess
  * @dataProvider dataInvalidStoreProvider
  */
  public function testStoreWithInValidData($data){
    $result = $this->formController->store($data);
    $this->assertNull($result);
  }

  public function dataInvalidStoreProvider()
    {
        return [
          [
            [
              'form_type_id' => '2',
              'reason' => 'aaaaaaaaaaa',
              'extend_inlate_early' => '',
              'extend_absence' => '',
              'start_date' => '2020-01-01',
              'end_date' => '2020-01-01',
              'detail_time' => 'Thong tin nghi chi tiet',
              'created_at' => '2020-01-01',
              'deleted_at' => null,
              'user_id' => 'aaaaaaaaaaa',
              'status_id' => 'aaaaaaaaaaa'
            ],
          ],
          [
            [
              'form_type_id' => '3',
              'reason' => 'aaaaaaaaaaa',
              'extend_inlate_early' => '',
              'extend_absence' => '',
              'start_date' => '2020-01-01',
              'end_date' => '2020-01-01',
              'detail_time' => 'Thong tin nghi chi tiet',
              'created_at' => '2020-01-01',
              'deleted_at' => null,
              'user_id' => 'aaaaaaaaaaa',
              'status_id' => 'aaaaaaaaaaa'
            ]
          ],
          [
            [
              'form_type_id' => '',
              'reason' => 'aaaaaaaaaaa',
              'extend_inlate_early' => '',
              'extend_absence' => '',
              'start_date' => '',
              'end_date' => '2020-01-01',
              'detail_time' => 'Thong tin nghi chi tiet',
              'created_at' => '2020-01-01',
              'deleted_at' => null,
              'user_id' => 'aaaaaaaaaaa',
              'status_id' => 'aaaaaaaaaaa'
            ]
          ],
        ];
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

  /**
  * @runInSeparateProcess
  */
  public function testDeleteFormWithValidId(){
    $id = 1;
    $result = $this->formController->delete($id);
    $this->assertNull($result);
  }
}
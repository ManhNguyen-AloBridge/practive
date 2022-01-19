<?php
require_once(dirname(__DIR__) . '/repositories/FormRepository.php');
require_once(dirname(__DIR__) . '/models/Form.php');

class FormService
{

  function __construct()
  {
    $this->formRepository  = new FormRepository();
    $this->formModel = new Form();
  }

  public function store(array $data)
  {
    session_start();
    $newData = array_merge($data, [
      'user_id' => $_SESSION['user_id'],
      'status_id' => $this->formModel::PENDING,
    ]);


    $dataInsert = [
      $newData['user_id'],
      $newData['form_type_id'],
      $newData['extend_inlate_early'],
      $newData['extend_absence'],
      $newData['reason'],
      $newData['status_id'],
      $newData['start_date'],
      $newData['end_date'],
      $newData['detail_time'],
      $newData['created_at'],
      $newData['deleted_at'],
    ];

    return $this->formRepository->store($dataInsert);
  }

  public function getListForm()
  {
    return $this->formRepository->getListForm();
  }

  public function getListExtendInlateEarly()
  {
    return $this->formRepository->getListExtendInlateEarly();
  }

  public function getListExtendAbsence()
  {
    return $this->formRepository->getListExtendAbsence();
  }
}
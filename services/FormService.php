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
    $type = intval($data['form_type_id']);
    session_start();
    $_SESSION['user_id'] = 1; //fake session get user_id when user login

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

    if ($type == $this->formModel::ABSENCE) { //absence
      if ($data['extend_absence'] == null) {
        return false;
      }
      return $this->formRepository->store($dataInsert);
    }

    if ($type == $this->formModel::INLATE_EARLY) { //inlate/early
      if ($data['extend_inlate_early'] == null) {
        return false;
      }
      return $this->formRepository->store($dataInsert);
    }

    if ($type == $this->formModel::REMOTE) { //remote
      return $this->formRepository->store($dataInsert);
    }
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
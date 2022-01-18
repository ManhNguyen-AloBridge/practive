<?php
require_once(dirname(__DIR__) . '/repositories/FormRepository.php');
require_once(dirname(__DIR__) . '/models/Form.php');

class FormService
{

  function __construct()
  {
    $formRepository = new FormRepository();
    $this->formRepository = $formRepository;
    $form = new Form();
    $this->formModel = $form;
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

    if ($type == 1) { //absence
      if ($data['extend_absence'] == null) {
        return false;
      }
      return $this->formRepository->store($dataInsert);
    }

    if ($type == 2) { //inlate/early
      if ($data['extend_inlate_early'] == null) {
        return false;
      }
      return $this->formRepository->store($dataInsert);
    }

    if ($type == 3) { //remote
      return $this->formRepository->store($dataInsert);
    }
  }
}
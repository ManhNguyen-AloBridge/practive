<?php
require_once(dirname(__DIR__) . '/repositories/FormRepository.php');
require_once(dirname(__DIR__) . '/models/Form.php');

class FormService
{

  function __construct()
  {
    $this->formRepository  = new FormRepository();
  }

  public function store(array $data)
  {
    session_start();

    $data['user_id'] = $_SESSION['user_id'];
    $data['status_id'] = Form::STATUS_PENDING;

    $dataInsert = array_values($data);

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
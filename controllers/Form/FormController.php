<?php
require_once(dirname('/home/giangtuan/Documents/Code/study/practive/controllers') . '/services/FormService.php');
require_once(dirname('/home/giangtuan/Documents/Code/study/practive/controllers') . '/models/Form.php');
class FormController
{

  function __construct()
  {
    $this->formService = new FormService();
    $this->formModel = new Form();
  }

  public function store(array $data)
  {
    $type = intval($data['form_type_id']);
    session_start();

    if ($type == $this->formModel::ABSENCE && $data['extend_absence'] == null || $type == $this->formModel::INLATE_EARLY && $data['extend_inlate_early'] == null) { //absence
      $this->createSessionError();
    }

    $result = $this->formService->store($data);

    if (!$result) {
      $this->createSessionError();
    }

    $_SESSION['success_create_form'] = 'Gửi form thành công';
    header('Location: /views/pages/form/list-form.php');
  }

  private function createSessionError()
  {
    $_SESSION['error_create_form'] = 'Gửi form không thành công';
    die(header('Location: /views/pages/form/create.php'));
  }

  public function getListForm()
  {
    return $this->formService->getListForm();
  }
}
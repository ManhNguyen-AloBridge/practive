<?php
require_once('../../services/FormService.php');

class FormController
{

  function __construct()
  {
    $formService = new FormService();
    $this->formService = $formService;
  }

  public function store(array $data)
  {
    $result = $this->formService->store($data);

    if (!$result) {
      $_SESSION['error_create_form'] = 'Gửi form không thành công';

      return header('Location: /views/pages/form/create.php');
    }

    if (isset($_SESSION['error_create_form'])) {
      unset($_SESSION['error_create_form']);
    }

    $_SESSION['success_create_form'] = 'Gửi form thành công';

    header('Location: /views/pages/form/list-form.php');
  }
}
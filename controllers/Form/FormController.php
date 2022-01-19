<?php
// require_once(dirname(__DIR__) . '/service/FormService.php');
require_once('../../../services/FormService.php');

class FormController
{

  function __construct()
  {
    $formService = new FormService();
    $this->formService = $formService;
  }

  public function getListForm()
  {
    return $this->formService->getListForm();
  }
}
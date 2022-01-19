<?php
require_once(dirname(__DIR__) . '/repositories/FormRepository.php');

class FormService
{

  function __construct()
  {
    $formPosition = new FormPosition();
    $this->formPosition = $formPosition;
  }

  public function getListForm()
  {
    return $this->formPosition->getListForm();
  }
}
<?php
require_once(dirname('/home/giangtuan/Documents/Code/study/practive/controllers') . '/services/FormService.php');
require_once(dirname('/home/giangtuan/Documents/Code/study/practive/controllers') . '/models/Form.php');
require_once(dirname('/home/giangtuan/Documents/Code/study/practive/controllers') . '/trait/Validate.php');
class FormController
{

  use Validate;

  function __construct()
  {
    $this->formService = new FormService();
  }

  public function store(array $data)
  {
    session_start();

    $this->validateCreateForm($data);

    $type = intval($data['form_type_id']);


    if (($type == Form::TYPE_ABSENCE && $data['extend_absence'] == null) || ($type == Form::TYPE_INLATE_EARLY && $data['extend_inlate_early'] == null)) {
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

  public function show(int $formId)
  {
    $result = $this->formService->findById($formId);

    if (!$result) {
      session_start();
      $_SESSION['error_show'] = ' Thông tin form không tồn tại.';
    }

    return $result;
  }

  private function validateCreateForm(array $data)
  {
    $errors = [];
    unset($data['deleted_at']);
    if (empty($data['form_type_id'])) {
      $errors['form_type'] = 'Hãy chọn một yêu cầu cho form.';
    }

    $errors['reason'] = $this->validateFieldString('Lý do', 7, 100, $data['reason']);

    if ($data['form_type_id'] == Form::TYPE_INLATE_EARLY && empty($data['extend_inlate_early'])) {
      $errors['extend_inlate_early'] = 'Hãy chọn chi tiết.';
    }

    if ($data['form_type_id'] == Form::TYPE_ABSENCE &&  empty($data['extend_absence'])) {
      $errors['extend_absence'] = 'Hãy chọn khoảng thời gian bạn muốn xin nghỉ.';
    }
    if (empty($data['start_date'])) {
      $errors['start_date'] = 'Hãy chọn ngày bắt đầu.';
    }

    $errors['end_date'] = $this->validateDateBeforeAnother($data['start_date'], $data['end_date'], 'Hãy chọn ngày kết thúc.', 'Ngày kết thúc phải sau ngày bắt đầu');

    $errors['detail_time'] = $this->validateFieldString('Thông tin bổ sung', 7, 100, $data['detail_time']);


    if ($data['form_type_id'] == Form::TYPE_INLATE_EARLY) {
      $data['extend_absence'] = null;
    }

    if ($data['form_type_id'] == Form::TYPE_ABSENCE) {
      $data['extend_inlate_early'] = null;
    }

    if ($data['form_type_id'] == Form::TYPE_REMOTE) {
      $data['extend_absence'] = null;
      $data['extend_inlate_early'] = null;
    }

    if (count(array_filter($errors)) > 0) {
      $_SESSION['old_data'] = $data;
      $_SESSION['errors_validate'] = $errors;
      die(header('Location: /views/pages/form/create.php'));
    }
  }

  function delete(int $formId)
  {
    $form = $this->formService->findById($formId);
    session_start();
    if (!$form) {
      $this->errorDeleteForm();
    }

    $data = [
      'id' => $formId,
      'deleted_at' => date('Y-m-d'),
    ];

    $result = $this->formService->deleteSoft($data);

    if (!$result) {
      $this->errorDeleteForm();
    }

    $_SESSION['success_delete'] = 'Xóa form thành công.';
    return header('Location: /views/pages/form/list-form.php');
  }

  private function errorDeleteForm()
  {
    $_SESSION['error_delete'] = 'Xóa form không thành công!';
    die(header('Location: /views/pages/form/list-form.php'));
  }
}
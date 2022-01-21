<?php

/**
 * 
 */
trait Validate
{
  public function validateFieldString(string $keyMessage, int $min, int $max, ?string $data)
  {

    if (empty($data)) {
      return $keyMessage . ' không được để trống.';
    } else {

      $checkName = preg_match('/^.{' . $min . ',' . $max . '}$/', $data);
      if (!$checkName) {
        return $keyMessage . ' tối thiểu phải có ' . $min . ' ký tự và tối đa ' . $max . ' ký tự.';
      }
    }
  }

  public function validateFieldRegexSpecial(?string $data, string $regex, string $messageEmpty, string $messageRegex)
  {
    if (empty($data)) {
      return $messageEmpty;
    } else {

      $checkField = preg_match($regex, $data);
      if (!$checkField) {
        return $messageRegex;
      }
    }
  }

  public function validateConfirm(string $keyMessage, ?string $data, ?string $dataConfirm)
  {
    if (empty($dataConfirm)) {
      return 'Xác nhận ' . $keyMessage . ' không được để trống.';
    } else {

      if ($dataConfirm != $data) {
        return 'Xác nhận ' . $keyMessage . ' không khớp.';
      }
    }
  }

  public function validateBirthday(?string $data, string $messageEmpty, string $messageDate)
  {
    if (empty($data)) {
      return $messageEmpty;
    } else {
      if ($data >= date('Y-m-d')) {
        return $messageDate;
      }
    }
  }

  public function validateDateBeforeAnother(?string $date, ?string $anotherDate, string $messageEmpty, string $messageDate)
  {
    if (empty($date)) {
      return $messageEmpty;
    } else {
      if ($date > $anotherDate) {
        return $messageDate;
      }
    }
  }
}
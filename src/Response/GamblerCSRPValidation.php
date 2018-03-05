<?php

namespace Rozklad\Rofus\Response;

use SoapVar;
use stdClass;

class GamblerCSRPValidation
{
  /**
   * @var string
   */
  protected $GamblerCSRPValidationResult;

  /**
   * GamblerCSRPValidationResponse constructor.
   *
   * @param string
   */
  public function __construct($GamblerCSRPValidationResult)
  {
    $this->GamblerCSRPValidationResult = $GamblerCSRPValidationResult;
  }

  /**
   * @return string
   */
  public function getGamblerCSRPValidationResult()
  {
    return $this->GamblerCSRPValidationResult;
  }
}
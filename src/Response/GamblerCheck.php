<?php

namespace Rozklad\Rofus\Response;

class GamblerCheck
{
  /**
   * @var string
   */
  protected $GetGamblerCheckResult;

  /**
   * GamblerCheckResponse constructor.
   *
   * @param string
   */
  public function __construct($GetGamblerCheckResult)
  {
    $this->GetGamblerCheckResult = $GetGamblerCheckResult;
  }

  /**
   * @return string
   */
  public function getGetGamblerCheckResult()
  {
    return $this->GetGamblerCheckResult;
  }
}
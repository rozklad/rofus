<?php

namespace Rozklad\Rofus\Request;

class GamblerCheck
{
  /**
   * @var string
   */
  protected $PersonCPRNumber;

  /**
   * GamblerCheck constructor.
   *
   * @param string $PersonCPRNumber
   */
  public function __construct($PersonCPRNumber)
  {
    $this->PersonCPRNumber = $PersonCPRNumber;
  }

  /**
   * @return string
   */
  public function getPersonCPRNumber()
  {
    return $this->PersonCPRNumber;
  }

}
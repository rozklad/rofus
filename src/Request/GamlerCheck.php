<?php

namespace Rozklad\Rofus\Request;

class GamblerCheck
{
  /**
   * @var string
   */
  protected $CurrencyFrom;

  /**
   * @var string
   */
  protected $CurrencyTo;

  /**
   * @var string
   */
  protected $RateDate;

  /**
   * @var string
   */
  protected $Amount;

  /**
   * GamblerCheck constructor.
   *
   * @param string $CurrencyFrom
   * @param string $CurrencyTo
   * @param string $RateDate
   * @param string $Amount
   */
  public function __construct($CurrencyFrom, $CurrencyTo, $RateDate, $Amount)
  {
    $this->CurrencyFrom = $CurrencyFrom;
    $this->CurrencyTo   = $CurrencyTo;
    $this->RateDate     = $RateDate;
    $this->Amount       = $Amount;
  }

  /**
   * @return string
   */
  public function getCurrencyFrom()
  {
    return $this->CurrencyFrom;
  }

  /**
   * @return string
   */
  public function getCurrencyTo()
  {
    return $this->CurrencyTo;
  }

  /**
   * @return string
   */
  public function getRateDate()
  {
    return $this->RateDate;
  }

  /**
   * @return string
   */
  public function getAmount()
  {
    return $this->Amount;
  }
}
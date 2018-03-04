<?php

namespace Rozklad\Rofus\Request;

use SoapVar;
use stdClass;

class GamblerCheck
{
  /**
   * @var string
   */
  protected $PersonCPRNumber;

  protected $Kontekst;

  protected $PersonInformation;

  /**
   * GamblerCheck constructor.
   *
   * @param string $PersonCPRNumber
   */
  public function __construct($PersonCPRNumber)
  {
    $this->PersonCPRNumber = $PersonCPRNumber;
    $this->Kontekst = $this->getKontekst();
    $this->PersonInformation = $this->getPersonInformation($PersonCPRNumber);
  }

  public function getPersonInformation($PersonCPRNumber)
  {
    $object = new stdClass();
    $object->PersonCPRNumber = $PersonCPRNumber;
    return new SoapVar($object, SOAP_ENC_OBJECT);
  }

  public function getKontekst() 
  {
    $object = new stdClass();
    $object->HovedOplysninger = new SoapVar('HovedOplysninger', SOAP_ENC_OBJECT, 'string', 'http://skat.dk/begrebsmodel/xml/schemas/kontekst/2007/05/31/', 'HovedOplysninger', 'ns1');
    $object->HovedOplysninger->TransaktionsID = 'Betbuzz' . date('c') . 'r' . rand() * 100000;
    $object->HovedOplysninger->TransaktionsTid = date('c');

    return new SoapVar($object, SOAP_ENC_OBJECT);
  }

  /**
   * @return string
   */
  public function getPersonCPRNumber()
  {
    return $this->PersonCPRNumber;
  }

}
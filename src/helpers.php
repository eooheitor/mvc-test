<?php

namespace src;

class Helpers
{
  public static function getUri()
  {
    $requestUri = $_SERVER['REQUEST_URI'];
    $publicPos = strpos($requestUri, '/public/');
    if ($publicPos !== false) {
      return substr($requestUri, 0, $publicPos + strlen('/public/'));
    }
  }

  public static function removeAccents($string)
  {
    $unwantedArray = [
      'á' => 'a',
      'à' => 'a',
      'ã' => 'a',
      'â' => 'a',
      'ä' => 'a',
      'é' => 'e',
      'è' => 'e',
      'ê' => 'e',
      'ë' => 'e',
      'í' => 'i',
      'ì' => 'i',
      'î' => 'i',
      'ï' => 'i',
      'ó' => 'o',
      'ò' => 'o',
      'õ' => 'o',
      'ô' => 'o',
      'ö' => 'o',
      'ú' => 'u',
      'ù' => 'u',
      'û' => 'u',
      'ü' => 'u',
      'ç' => 'c',
      'ñ' => 'n',
      'Á' => 'A',
      'À' => 'A',
      'Ã' => 'A',
      'Â' => 'A',
      'Ä' => 'A',
      'É' => 'E',
      'È' => 'E',
      'Ê' => 'E',
      'Ë' => 'E',
      'Í' => 'I',
      'Ì' => 'I',
      'Î' => 'I',
      'Ï' => 'I',
      'Ó' => 'O',
      'Ò' => 'O',
      'Õ' => 'O',
      'Ô' => 'O',
      'Ö' => 'O',
      'Ú' => 'U',
      'Ù' => 'U',
      'Û' => 'U',
      'Ü' => 'U',
    ];

    return strtr($string, $unwantedArray);
  }

  public static function returnTipo($value)
  {
    $aTipoContato = [
      0 => 'Telefone',
      1 => 'Email',
    ];
    return $aTipoContato[$value];
  }
}

<?php

class Autoload
{
  /**
   * library
   *
   * @param mixed $className 
   * @return object
   */
  public function library($className)
  {
    $className = ltrim($className, '\\');
    $fileName = '';
    $nameSpace = '';

    if ($lastNsPos = strpos($className, '\\')) {
      $nameSpace = substr($className, 0, $lastNsPos);
      $className = substr($className, $lastNsPos + 1);
      $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $nameSpace) . DIRECTORY_SEPARATOR;
    }

    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);

    $fileName = '..' . DIRECTORY_SEPARATOR . 'App' . DIRECTORY_SEPARATOR . str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
    require_once $fileName;
  }
}

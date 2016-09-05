<?php
function FS_Autoloader($classname) {
  $pathParts = explode("\\", $classname);
  array_unshift($pathParts, 'lib');
  $path = implode(DIRECTORY_SEPARATOR, $pathParts);
  $filename = __DIR__.DIRECTORY_SEPARATOR.$path.'.class.php';
  if (is_readable($filename)) {
    require_once $filename;
  }
}
spl_autoload_register('FS_Autoloader', true);

<?php

namespace FS;

class FileHelper {

  function __construct( $fileName = '' ) {
    if ( !empty( $fileName ) ) {
      $this->file = $fileName;
    }
  }

  public static function mkdir( $dir ) {
    if ( strpos( $dir, DIRECTORY_SEPARATOR ) !== 0 ) {
      $dir = DIRECTORY_SEPARATOR . $dir;
    }
    // if directory doesn't exist, create it
    if ( file_exists( $dir ) === false ) {
      mkdir( $dir , 0777, true);  // make the directory
      chmod( $dir , 0777);  // permission the directory
    }

    return $dir;
  }

  public static function climbDirectory( $levels = 1, $basePath = '' ) {
    if ( empty( $basePath ) ) {
      $basePath = current( debug_backtrace() )['file'];
    }
    $directoryList = explode('/', $basePath);

    for ($i=0; $i < $levels; $i++) {
      array_pop($directoryList);
    }

    return implode('/', $directoryList);
  }

  public static function SQLDateToPath( $SQLDate ) {
    $timeStamp = strtotime( $SQLDate );

    return implode( DIRECTORY_SEPARATOR, [
      date('Y', $timeStamp),
      date('m', $timeStamp),
      date('d', $timeStamp),
    ]);
  }

  public static function getSQLDate() {
    return date('Y-m-d H:i:s');
  }

}

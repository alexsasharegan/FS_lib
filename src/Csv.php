<?php

namespace FS;

class Csv implements \JsonSerializable {

  function __construct( $csvFileName = '' ) {
    $this->data = [];
    $this->csvFileName = $csvFileName;
    if ( !empty( $this->csvFileName ) ) {
      $this->readCsvToArray( $this->csvFileName );
    }
  }

  public function readCsvToArray() {

    if ( ( $fileHandle = fopen( $this->csvFileName, 'r' ) ) !== false ) {
      $this->fields = array_map( 'trim', fgetcsv($fileHandle) );
      $this->data = [];

      while ( ($data = fgetcsv( $fileHandle ) ) !== false) {
        $dataIndex = count( $this->data );
        $length = count( $data );

        for ( $i=0; $i < $length; $i++ ) {
          $value = $data[$i];
          if ( isset( $this->fields[$i] ) ) {
            $this->data[$dataIndex][$this->fields[$i]] = $value;
          }
        } // end for loop

      } // end while
      fclose( $fileHandle );
      return $this;
    } else {
      return false;
    }
  } // end setCsv()

  public function jsonSerialize() {
    return $this->data;
  }

  public function printCsv() {
    print_r( $this->data );
  }

  public function __toString() {
    return print_r( $this->data, true );
  }
}

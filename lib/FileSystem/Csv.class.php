<?php

namespace FileSystem;

class Csv {

  function __construct() {
    #code
  }

  public function setCsv($csvFileName) {

    if (($fileHandle = fopen($csvFileName, 'r')) !== FALSE) {
      $this->fields = fgetcsv($fileHandle);
      $this->data = [];

      while (($data = fgetcsv($fileHandle)) !== FALSE) {
        $dataIndex = count($this->data);
        $length = count($data);

        for ($i=0; $i < $length; $i++) {
          $value = $data[$i];

          if (isset($this->fields[$i])) {
            $this->data[$dataIndex][$this->fields[$i]] = $value;
          }

        } // end for loop

      } // end while

      fclose($fileHandle);

    } // end if

  }

  public function printCsv() {
    print_r($this->data);
  }
}

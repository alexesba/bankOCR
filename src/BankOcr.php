<?php

use Exceptions\FileNotFound;
class BankOcr
{
  var $length_account = 9;
  var $digit_length   = 3;

  protected $lines     = array();


  public function load($file_path)
  {
    $this->file = $file_path;
    $this->handle = NULL;
  }

  public function read()
  {
    if(!file_exists($this->file))
    {
      throw new FileNotFound('The does not exist!.');
    }
    $this->handle = @fopen($this->file, 'r');

    return $this;
  }

  public function setLine($line){
    $this->lines[] = $line;
  }


  public function getNextLine()
  {
    if($this->handle){
      if(($current_line = fgets($this->handle, 4096)) !== false){
        $this->setLine($current_line);
      }
    }
  }

  public function linesToNumbers(){
    echo $this->lines[0][4];
  }


}

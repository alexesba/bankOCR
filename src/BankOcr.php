<?php

use Exceptions\FileNotFound;
class BankOcr
{
  var $length_account = 9;
  var $digit_length   = 3;
  var $numbers        = array();
  var  $flag = "";

  var $lines     = array();



  public function load($file_path)
  {
    $this->file = $file_path;
    $this->handle = NULL;
    return $this;
  }

  public function read()
  {
    if(!file_exists($this->file))
    {
      throw new FileNotFound('The file does not exist!.');
    }
    $this->handle = @fopen($this->file, 'r');

    return $this;
  }

  public function setLine($line){
    $this->lines[] = $line;
  }


  public function getNextLine()
  {
    #read recursively the file
    if($this->handle){
      if(($current_line = fgets($this->handle, 1024)) !== false){
        $this->setLine(preg_replace('/\r\n|\r|\n/', ' ', $current_line));
        $this->getNextLine();
      }
    }
    return $this;
  }

  public function linesToNumbers(){
    $this->processLines();
    return $this;
  }

  public function getAccountNumber(){
    return $this->account_number.$this->flag;
  }

  public function processLines(){
    for( $index=0; $index < $this->length_account; $index++ ){
      $this->numbers[] = $this->stringToNumber($this->getSubstring($index));
    }

    $this->account_number = implode($this->numbers, '');

    if(!$this->isValid()){
      if(in_array('?', $this->numbers, true)){
        $this->flag.=" ERR";
      }else{
        $this->flag.=" ILL";
      }

    }
    return $this;
  }

  public function isValid(){
    return ($this->checkSum() %  11) === 0;
  }

  public function checkSum(){
    foreach(array_reverse($this->numbers) as $index=>$value ){
      if($index == 0)
      {
        $result = (integer)$value;
      }else{
        $index++;
        $result+= ($index * $value);
      }
    }
    return $result;
  }

  public function getSubstring($index)
  {
    $start = ($index * $this->digit_length);
    $a = substr($this->lines[0], $start, $this->digit_length );
    $b = substr($this->lines[1], $start, $this->digit_length );
    $c = substr($this->lines[2], $start, $this->digit_length );
    $d = substr($this->lines[3], $start, $this->digit_length );
    return "$a$b$c$d";
  }

  public function stringToNumber($string){

    switch(md5($string))
    {
      case '49aba1ce5f1d22713f7be4d15cff8bae':
        return 0;
        break;

      case '805d68b92dafd5181c807665831d70fc':
        return 1;
        break;
      case '698d411a09d832519c7a91fbf8bfe7e6':
        return 2;
        break;
      case '215b524980706407d560fa28a5aee7fb':
        return 3;
        break;
      case '6996d3a504fde8c96b837d99507c04ee':
        return 4;
        break;
      case 'd1b1bc32561993df52a37db677598f6a':
        return 5;
        break;
      case '5cda28cf7f9302c0f0fe5682454bae81':
        return 6;
        break;
      case 'cac39771f632cc83bd60c9b48816f153':
        return 7;
        break;
      case '8bd184d9e57f27a66f10904dd13884df':
        return 8;
        break;
      case 'be5f4894297e0e487df9a213c3f989ed':
        return 9;
        break;
      default:
        return '?';
        break;

    }
  }


}


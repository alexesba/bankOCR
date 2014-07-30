<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BankOcrSpec extends ObjectBehavior
{
    const BASEFILE = __DIR__;

    static function file_path($file){
      return self::BASEFILE."/../src/$file";
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('BankOcr');
    }

    function it_loads_a_file(){
      $file = '/Users/pair/work/BanckOCR/src/file';
      $this->load($file)->file->shouldbeEqualTo($file);
    }

    function it_throw_an_error_when_reads_the_file_if_not_exists()
    {
      $this->load('fake');
      $this->shouldThrow('Exceptions\FileNotFound')->duringRead();
    }

    function it_parse_the_file_content_into_lines(){
      $file = self::file_path('file');
      $this->load($file)->read();
      $this->getNextLine()->lines->beAnInstanceOf('array');
      $this->lines->shouldHaveCount(4);
    }

    function it_should_has_length_account_with_exact_nine_digits(){
      $this->length_account->shouldbeEqualTo(9);
    }

    function it_should_has_digit_length_with_exact_three_digits(){
      $this->digit_length->shouldbeEqualTo(3);
    }


    function it_process_the_file_with_cero_numbers(){
      $file = self::file_path('0.txt');
      $this->load($file)->read()->getNextLine();
      $this->linesToNumbers()->account_number->shouldbeEqualTo("000000000");

    }
    function it_process_the_file_with_numbers_one(){
      $file = self::file_path('1.txt');
      $this->load($file)->read()->getNextLine();
      $this->linesToNumbers()->account_number->shouldbeEqualTo("111111111");

    }

    function it_process_the_file_with_numbers_two(){
      $file = self::file_path('2.txt');
      $this->load($file)->read()->getNextLine();
      $this->linesToNumbers()->account_number->shouldbeEqualTo("222222222");

    }

    function it_process_the_file_with_numbers_three(){
      $file = self::file_path('3.txt');
      $this->load($file)->read()->getNextLine();
      $this->linesToNumbers()->account_number->shouldbeEqualTo("333333333");
    }

    function it_process_the_file_with_numbers_four(){
      $file = self::file_path('4.txt');
      $this->load($file)->read()->getNextLine();
      $this->linesToNumbers()->account_number->shouldbeEqualTo("444444444");
    }

    function it_process_the_file_with_numbers_five(){
      $file = self::file_path('5.txt');
      $this->load($file)->read()->getNextLine();
      $this->linesToNumbers()->account_number->shouldbeEqualTo("555555555");
    }

    function it_process_the_file_with_numbers_six(){
      $file = self::file_path('6.txt');
      $this->load($file)->read()->getNextLine();
      $this->linesToNumbers()->account_number->shouldbeEqualTo("666666666");
    }

    function it_process_the_file_with_numbers_seven(){
      $file = self::file_path('7.txt');
      $this->load($file)->read()->getNextLine();
      $this->linesToNumbers()->account_number->shouldbeEqualTo("777777777");
    }

    function it_process_the_file_with_numbers_eight(){
      $file = self::file_path('8.txt');
      $this->load($file)->read()->getNextLine();
      $this->linesToNumbers()->account_number->shouldbeEqualTo("888888888");
    }
    function it_process_the_file_with_numbers_nine(){
      $file = self::file_path('9.txt');
      $this->load($file)->read()->getNextLine();
      $this->linesToNumbers()->account_number->shouldbeEqualTo("999999999");
    }

    function it_process_the_file_content_into_numbers(){
      $file = self::file_path('file');
      $this->load($file)->read()->getNextLine();
      $this->linesToNumbers()->getAccountNumber()->shouldbeEqualTo("123456789");
    }

    function case_use_3()
    {
      $file = self::file_path('case3');
      $this->load($file)->read()->getNextLine();
      $this->linesToNumbers()->getAccountNumber()->shouldbeEqualTo("000000051");

    }
}

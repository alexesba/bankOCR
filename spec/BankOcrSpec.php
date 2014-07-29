<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BankOcrSpec extends ObjectBehavior
{

    function it_is_initializable()
    {
        $this->shouldHaveType('BankOcr');
    }

    function it_load_a_file(){
      $this->load('file');
    }

    function it_throw_an_error_when_reads_the_file_if_not_exists()
    {
      $this->load('fake');
      $this->shouldThrow('Exceptions\FileNotFound')->duringRead();
    }

    function it_parse_the_file_content_reading_lines(){
      $this->load('file');
      $this->getNextLine();
    }

    function it_should_has_length_account_with_exact_nine_digits(){
      $this->length_account->shouldbeEqualTo(9);
    }
    function it_should_has_digit_length_with_exact_three_digits(){
      $this->digit_length->shouldbeEqualTo(3);
    }
}

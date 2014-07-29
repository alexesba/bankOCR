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

}

<?php

namespace spec\Model;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CompanySpec extends ObjectBehavior
{
    function it_should_require_a_string_for_the_name()
    {
        $this->beConstructedWith('');

        $this->shouldThrow(new \InvalidArgumentException('No company name specified'))->duringInstantiation();
    }
}

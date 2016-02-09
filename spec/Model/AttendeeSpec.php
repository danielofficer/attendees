<?php

namespace spec\Model;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AttendeeSpec extends ObjectBehavior
{
    private $companyId = 1;
    private $firstName = 'John';
    private $lastName = 'Smith';
    private $email = 'john.smith@example.org';

    function it_should_require_a_positive_int_for_the_company_id()
    {
        $this->beConstructedWith(0, $this->firstName, $this->lastName, $this->email);

        $this->shouldThrow(new \InvalidArgumentException('No company ID specified'))->duringInstantiation();
    }

    function it_should_require_a_string_for_the_first_name()
    {
        $this->beConstructedWith($this->companyId, '', $this->lastName, $this->email);

        $this->shouldThrow(new \InvalidArgumentException('No first name specified'))->duringInstantiation();
    }

    function it_should_require_a_string_for_the_last_name()
    {
        $this->beConstructedWith($this->companyId, $this->firstName, '', $this->email);

        $this->shouldThrow(new \InvalidArgumentException('No last name specified'))->duringInstantiation();
    }

    function it_should_require_a_string_for_the_email_address()
    {
        $this->beConstructedWith($this->companyId, $this->firstName, $this->lastName, '');

        $this->shouldThrow(new \InvalidArgumentException('No email address specified'))->duringInstantiation();
    }

    function it_should_decline_an_invalid_email_address()
    {
        $brokenEmail = 'brokenemail';
        $this->beConstructedWith($this->companyId, $this->firstName, $this->lastName, $brokenEmail);

        $this->shouldThrow(new \InvalidArgumentException("Invalid email address '$brokenEmail' specified"))->duringInstantiation();
    }

    function it_should_accept_a_valid_email_address()
    {
        $this->beConstructedWith($this->companyId, $this->firstName, $this->lastName, $this->email);

        $this->shouldNotThrow(new \InvalidArgumentException("Invalid email address '".$this->email."' specified"))->duringInstantiation();
    }
}

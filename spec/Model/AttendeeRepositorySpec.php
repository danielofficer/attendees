<?php

namespace spec\Model;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * I'm aware that you shouldn't normally spec repositories, but in this case I think there
 * is justification to show that the data objects are being build correctly
 * @package spec\Model
 */
class AttendeeRepositorySpec extends ObjectBehavior
{
    function it_should_build_the_attendee_from_the_id(\PDO $db, \PDOStatement $stmt)
    {
        $data = [
            'id' => 1,
            'id_company' => 2,
            'firstname' => 'John',
            'lastname' => 'Smith',
            'email' => 'john.smith@example.org'
        ];

        $stmt->fetch(Argument::any())->willReturn($data);
        $stmt->execute(Argument::any())->willReturn();
        $db->prepare(Argument::any())->willReturn($stmt);
        $this->beConstructedWith($db);

        $attendee = $this->findById(1);

        $attendee->shouldHaveType('\Model\Attendee');
        $attendee->getId()->shouldReturn(1);
        $attendee->getCompanyId()->shouldReturn(2);
        $attendee->getFirstName()->shouldReturn('John');
        $attendee->getLastName()->shouldReturn('Smith');
        $attendee->getEmail()->shouldReturn('john.smith@example.org');
    }

    function it_should_return_a_list_of_attendee_objects_with_the_matched_name(\PDO $db, \PDOStatement $stmt)
    {
        $data = [
            [
                'id' => 1,
                'id_company' => 2,
                'firstname' => 'John',
                'lastname' => 'Smith',
                'email' => 'john.smith@example.org'
            ], [
                'id' => 2,
                'id_company' => 1,
                'firstname' => 'Mike',
                'lastname' => 'Smith',
                'email' => 'mike.smith@example.org'
            ]
        ];

        $stmt->fetchAll(Argument::any())->willReturn($data);
        $stmt->execute(Argument::any())->willReturn();
        $db->prepare(Argument::any())->willReturn($stmt);
        $this->beConstructedWith($db);

        $attendeeList = $this->findByName('john');

        $attendeeList->shouldHaveCount(2);
        $attendeeList[$data[0]['id']]->shouldHaveType('\Model\Attendee');
        $attendeeList[$data[1]['id']]->shouldHaveType('\Model\Attendee');
    }
}

<?php

namespace Model;

class AttendeeRepository
{
    /**
     * @var \PDO
     */
    private $db;

    /**
     * @param \PDO $db
     */
    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function fetchAll()
    {
        $stmt = $this->db->query(
            'select * from attendees'
        );

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if (empty($result)) {
            throw new EntityNotFoundException('No attendees available');
        }

        return $this->buildAttendeeList($result);
    }

    /**
     * @param string $name
     *
     * @return Attendee[]
     */
    public function findByName($name)
    {
        if (empty($name)) {
            throw new EntityNotFoundException('Please supply a search term');
        }

        $stmt = $this->db->prepare(
            "select * from attendees where concat(firstname, ' ', lastname) like :partialName"
        );
        $stmt->execute(['partialName' => "%$name%"]);
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if (empty($results)) {
            throw new EntityNotFoundException("Unable to find attendees matching '$name'");
        }

        return $this->buildAttendeeList($results);
    }

    /**
     * @param int $id
     *
     * @return Attendee
     */
    public function findById($id)
    {
        $stmt = $this->db->prepare(
            'select * from attendees where id = :id'
        );

        $stmt->execute(['id' => $id]);

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (empty($result)) {
            throw new EntityNotFoundException("Unable to find attendee ID '$id'");
        }

        return $this->buildAttendee($result);
    }

    /**
     * @param Attendee $attendee
     */
    public function delete(Attendee $attendee)
    {
        if (empty($attendee->getId())) {
            throw new \InvalidArgumentException('Attendee must have an id to be deleted');
        }

        $stmt = $this->db->prepare(
            'delete from attendees where id = :id'
        );

        $stmt->execute(['id' => $attendee->getId()]);
    }

    /**
     * @param array $results
     *
     * @return Attendee[]
     */
    private function buildAttendeeList($results)
    {
        $attendeeList = [];
        foreach ($results as $resultLine) {
            $attendeeList[$resultLine['id']] = $this->buildAttendee($resultLine);
        }

        return $attendeeList;
    }

    /**
     * @param array $resultLine
     *
     * @return Attendee
     */
    private function buildAttendee($resultLine)
    {
        $attendee = new Attendee(
            (int) $resultLine['id_company'],
            $resultLine['firstname'],
            $resultLine['lastname'],
            $resultLine['email']
        );
        $attendee->setId($resultLine['id']);

        return $attendee;
    }
}

<?php

namespace Model;

class Attendee
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var int
     */
    private $companyId;
    /**
     * @var string
     */
    private $firstName;
    /**
     * @var string
     */
    private $lastName;
    /**
     * @var string
     */
    private $email;

    /**
     * @param int    $companyId
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     */
    public function __construct($companyId, $firstName, $lastName, $email)
    {
        $this->validate($companyId, $firstName, $lastName, $email);
        $this->companyId = $companyId;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param $companyId
     * @param $firstName
     * @param $lastName
     * @param $email
     */
    private function validate($companyId, $firstName, $lastName, $email)
    {
        if (!(is_int($companyId) && $companyId > 0)) {
            throw new \InvalidArgumentException('No company ID specified');
        }

        if (empty($firstName)) {
            throw new \InvalidArgumentException('No first name specified');
        }
        if (empty($lastName)) {
            throw new \InvalidArgumentException('No last name specified');
        }
        if (empty($email)) {
            throw new \InvalidArgumentException('No email address specified');
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("Invalid email address '$email' specified");
        }
    }
}

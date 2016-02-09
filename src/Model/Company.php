<?php

namespace Model;

class Company
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $companyName;

    public function __construct($companyName)
    {
        $this->validate($companyName);
        $this->companyName = $companyName;
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
     * @return string
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * @param string $companyName
     */
    private function validate($companyName)
    {
        if (empty($companyName)) {
            throw new \InvalidArgumentException('No company name specified');
        }
    }
}

<?php

namespace Model;

class CompanyRepository
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

    /**
     * @return Company[]
     *
     * @throws EntityNotFoundException
     */
    public function fetchAll()
    {
        $stmt = $this->db->query(
            'select * from companies'
        );

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if (empty($result)) {
            throw new EntityNotFoundException('No companies available');
        }

        return $this->buildCompanyList($result);
    }

    /**
     * @param int $id
     *
     * @return Company
     *
     * @throws EntityNotFoundException
     */
    public function findById($id)
    {
        $stmt = $this->db->prepare(
            'select * from companies where id = :id'
        );

        $stmt->execute(['id' => $id]);

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (empty($result)) {
            throw new EntityNotFoundException("Unable to find company ID '$id'");
        }

        return $this->buildCompany($result);
    }

    /**
     * @param array $results
     *
     * @return Company[]
     */
    private function buildCompanyList($results)
    {
        $companyList = [];
        foreach ($results as $resultLine) {
            $companyList[$resultLine['id']] = $this->buildCompany($resultLine);
        }

        return $companyList;
    }

    /**
     * @param array $result
     *
     * @return Company
     */
    private function buildCompany($result)
    {
        $company = new Company($result['name']);
        $company->setId($result['id']);

        return $company;
    }
}

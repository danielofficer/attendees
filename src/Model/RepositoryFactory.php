<?php

namespace Model;

use PDO;

abstract class RepositoryFactory
{
    /**
     * @param $type
     *
     * @return RepositoryInterface
     */
    public static function create($type)
    {
        $parameters = parse_ini_file(__DIR__.'/../../app/config/parameters.ini');
        $db = new PDO(
            $parameters['db_type'].':host='.$parameters['db_host'].';dbname='.$parameters['db_name'].';charset=utf8',
            $parameters['db_user'],
            $parameters['db_password'],
            array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
        );
        switch ($type) {
            case 'attendee':
                return new AttendeeRepository($db);
            case 'company':
                return new CompanyRepository($db);
        }

        throw new \InvalidArgumentException("Invalid type $type");
    }
}

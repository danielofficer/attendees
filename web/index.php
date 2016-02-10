<?php
use Controller\AttendeeController;
use Model\AttendeeRepository;
use Model\CompanyRepository;

require_once __DIR__ . '/../vendor/autoload.php';

session_start();
if (!isset($_SESSION['xtoken'])) {
    $_SESSION['xtoken'] = sha1(time() . 'my event');
}

$parameters = parse_ini_file(__DIR__.'/../app/config/parameters.ini');
$db = new PDO(
    $parameters['db_type'].':host='.$parameters['db_host'].';dbname='.$parameters['db_name'].';charset=utf8',
    $parameters['db_user'],
    $parameters['db_password'],
    array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
);

$attendeeRepository = new AttendeeRepository($db);
$companyRepository = new CompanyRepository($db);

$attendeeController = new AttendeeController($attendeeRepository, $companyRepository);

try {
    if (empty($_GET['url'])) {
        $attendeeController->indexAction();

    } else if ($_GET['url'] == 'search') {
        $attendeeController->searchAction();

    } else if ($_GET['url'] == 'attendee') {
        $attendeeController->findAttendeeAction();

    } else if ($_GET['url'] == 'attendee/delete') {
        $attendeeController->deleteAttendeeAction();

    } else {
        $attendeeController->pageNotFoundAction();
    }
} catch (\Exception $e) {
    $attendeeController->errorAction($e);
}


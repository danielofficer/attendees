<?php
use Controller\AttendeeController;

require_once __DIR__ . '/../vendor/autoload.php';

session_start();
if (!isset($_SESSION['xtoken'])) {
    $_SESSION['xtoken'] = sha1(time() . 'my event');
}

$attendeeController = new AttendeeController();

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


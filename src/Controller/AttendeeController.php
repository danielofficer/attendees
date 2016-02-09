<?php

namespace Controller;

use Model\EntityNotFoundException;
use Model\RepositoryFactory;

class AttendeeController
{
    public function indexAction()
    {
        $pageTitle = 'View all attendees';

        $attendees = RepositoryFactory::create('attendee')->fetchAll();

        require_once __DIR__.'/../../resources/views/search.php';
    }

    public function searchAction()
    {
        $name = '';
        if (!empty($_POST['searchBox'])) {
            $this->checkCsrfToken();
            $name = htmlentities($_POST['searchBox']);
        }

        $pageTitle = "Searching for attendee: '$name'";

        try {
            $attendees = RepositoryFactory::create('attendee')->findByName($name);
        } catch (EntityNotFoundException $e) {
            $errorMessage = $e->getMessage();
        }

        require_once __DIR__.'/../../resources/views/search.php';
    }

    public function findAttendeeAction()
    {
        $pageTitle = 'View Attendee';

        if (empty($_GET['id'])) {
            $errorMessage = 'Invalid attendee, please select another';
            $_SESSION['flash'] = $errorMessage;
            header('Location: /');
            exit();
        } else {
            $id = (int) $_GET['id'];
            try {
                $attendee = RepositoryFactory::create('attendee')->findById($id);
                $company = RepositoryFactory::create('company')->findById($attendee->getCompanyId());
            } catch (EntityNotFoundException $e) {
                $errorMessage = $e->getMessage();
            }
            require_once __DIR__.'/../../resources/views/profile.php';
        }
    }

    public function deleteAttendeeAction()
    {
        if (isset($_GET['id'])) {
            try {
                $attendeeRepository = RepositoryFactory::create('attendee');
                $attendee = $attendeeRepository->findById($_GET['id']);
                $attendeeRepository->delete($attendee);
                $_SESSION['flash'] = 'Attendee '.$attendee->getFirstName().' '.$attendee->getLastName().' deleted.';
            } catch (EntityNotFoundException $e) {
                $_SESSION['flash'] = 'Unable to delete attendee';
            }
        } else {
            $_SESSION['flash'] = 'No attendee specified for deletion';
        }

        header('Location: /');
        exit();
    }

    public function errorAction(\Exception $e)
    {
        $pageTitle = 'Oops...';

        require_once __DIR__.'/../../resources/views/error.php';
    }

    public function pageNotFoundAction()
    {
        $pageTitle = 'Page Not Found';

        require_once __DIR__.'/../../resources/views/404.php';
    }

    private function checkCsrfToken()
    {
        if ($_POST['xtoken'] != $_SESSION['xtoken']) {
            throw new \InvalidArgumentException('CSRF Token does not match');
        }
    }
}

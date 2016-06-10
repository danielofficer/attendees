<?php

namespace Controller;

use Model\AttendeeRepository;
use Model\CompanyRepository;
use Model\EntityNotFoundException;

class AttendeeController
{
    /**
     * @var AttendeeRepository
     */
    private $attendeeRepository;
    /**
     * @var CompanyRepository
     */
    private $companyRepository;

    public function __construct(AttendeeRepository $attendeeRepository, CompanyRepository $companyRepository)
    {
        $this->attendeeRepository = $attendeeRepository;
        $this->companyRepository = $companyRepository;
    }

    public function indexAction()
    {
        $pageTitle = 'View all attendees';

        $attendees = $this->attendeeRepository->fetchAll();

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
            $attendees = $this->attendeeRepository->findByName($name);
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
                $attendee = $this->attendeeRepository->findById($id);
                $company = $this->companyRepository->findById($attendee->getCompanyId());
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
                $attendee = $this->attendeeRepository->findById($_GET['id']);
                $this->attendeeRepository->delete($attendee);
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

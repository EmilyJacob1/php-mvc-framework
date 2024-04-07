<?php

require_once '../app/models/lessonModel.php';
require_once '../app/core/authenticator.php';

class LessonController
{
    private $lessonModel;

    public function __construct()
    {
        // start session if not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        //check if admin is logged in first
        Authenticator::checkForStudent();
        //create new lessonModel instance
        $this->lessonModel = new LessonModel();
    }

    //currently everything is so a student can make a lesson, would need to adjust and add for instructeurs
    public function renderLessons()
    {
        $accountId = $_SESSION['accountId'];
        $lessons = $this->lessonModel->getAllLessons($accountId);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // $this->deleteLesson();
        } else {
            require '../app/views/lessonsView.php';
        }
    }


    public function renderAddLesson()
    {
        $instructeurs = $this->lessonModel->getInstructeurs();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->addLesson();
        } else {
            require '../app/views/addLessonView.php';
        }
    }

    private function addLesson()
    {
        $lessonDate = $_POST['lessonDate'] ?? '';
        $startTime = $_POST['startTime'] ?? '';
        //create the endtime
        $endTime = date('H:i:s', strtotime($startTime . '+1 hour'));
        $instructeurId = $_POST['instructeurId'];
        $accountId = $_SESSION['accountId'];

        $errors = $this->validateLesson($lessonDate, $startTime, $endTime, $instructeurId);

        if (!empty($errors)) {
            $errors;
            $formData = [
                'lessonDate' => $lessonDate,
                'startTime' => $startTime,
                'instructeurId' => $instructeurId,
            ];
            require '../app/views/addLessonView.php';
            exit;
        } else {
            $this->lessonModel->addLesson($lessonDate, $startTime, $endTime, $instructeurId, $accountId);
            header("Location: lessons.php");
            exit;
        }
    }


    private function validateLesson($lessonDate, $startTime, $endTime, $instructeurId)
    {
        //store the errors in an array
        $errors = [];
        //check for empty fields etcetera.
        if (empty($lessonDate)) {
            $errors['lessonDate'] = 'er moet een datum worden ingevoerd';
        }

        $today = date('Y-m-d');
        if ($lessonDate < $today) {
            $errors['lessonDate'] = 'De datum mag niet in het verleden liggen';
        }

        if (empty($startTime)) {
            $errors['startTime'] = 'er moet een begintijd worden ingevoerd';
        }

        if (empty($instructeurId)) {
            $errors['instructeurId'] = 'Er moet een instructeur zijn geselecteerd';
        }

        //check if instructeur is available
        if (!$this->lessonModel->isInstructeurAvailable($lessonDate, $startTime, $endTime, $instructeurId)) {
            $errors['availability'] = 'deze les is niet beschikbaar op dit tijdstip';
        }

        return $errors;
    }
}

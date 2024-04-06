<?php

require_once '../app/models/accountModel.php';
require_once '../app/core/authenticator.php';

class AccountController
{
    private $accountModel;

    public function __construct()
    {
        // start session if not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        //check if admin is logged in first
        Authenticator::checkAuthenticationAdmin();
        //create new accountmodel instance
        $this->accountModel = new AccountModel();
    }

    public function renderAccounts()
    {
        $accounts = $this->accountModel->getAllAccounts();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->deleteAccount();
        } else {
            require '../app/views/accountsView.php';
        }
    }

    public function renderAddAccount()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->addAccount();
        } else {
            require '../app/views/addAccountView.php';
        }
    }

    public function renderEditAccount()
    {
        $id = $_GET['id'] ?? null;
        $account = $this->accountModel->getAccountById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->editAccount();
        } else {
            require '../app/views/editAccountView.php';
        }
    }

    private function addAccount()
    {
        $accountRole = $_POST['accountRole'] ?? '';
        $username = $_POST['username'] ?? '';
        $accountEmail = $_POST['accountEmail'] ?? '';
        $accountPassword = $_POST['accountPassword'] ?? '';

        $errors = $this->validateAccountData($accountRole, $username, $accountEmail, $accountPassword);

        if (!empty($errors)) {
            $errors;
            $formData = [
                'accountRole' => $accountRole,
                'username' => $username,
                'accountEmail' => $accountEmail,
                'accountPassword' => $accountPassword,
            ];
            require '../app/views/addAccountView.php';
            exit;
        } else {
            $hashedPassword = password_hash($accountPassword, PASSWORD_DEFAULT);
            $this->accountModel->addAccount($accountRole, $username, $accountEmail, $hashedPassword);
            header("Location: accounts.php");
            exit;
        }
    }

    private function deleteAccount()
    {
        $id = $_POST['id'] ?? '';
        $this->accountModel->deleteAccount($id);
        //after delete reload page
        header("Location: accounts.php");
    }

    private function editAccount()
    {
        //get all the data
        $id = $_POST['id'] ?? '';
        $accountRole = $_POST['accountRole'] ?? '';
        $username = $_POST['username'] ?? '';
        $accountEmail = $_POST['accountEmail'] ?? '';
        $accountPassword = $_POST['accountPassword'] ?? '';
        //validate and check for errors
        $errors = $this->validateAccountData($accountRole, $username, $accountEmail, $accountPassword);

        if (!empty($errors)) {
            $errors;
            $formData = [
                'id' => $id,
                'accountRole' => $accountRole,
                'username' => $username,
                'accountEmail' => $accountEmail,
                'accountPassword' => $accountPassword,
            ];
            require '../app/views/editAccountView.php';
            exit;
        } else {
            // Retrieve existing hashed password from the database
            $existingAccount = $this->accountModel->getAccountById($id);
            $existingHashedPassword = $existingAccount['accountPassword'];

            // check if the entered password matches the current password
            if ($accountPassword === $existingHashedPassword) {
                // keep the existing hashed password
                $hashedPassword = $existingHashedPassword;
            } else {
                // hash the new password
                $hashedPassword = password_hash($accountPassword, PASSWORD_DEFAULT);
            }

            // update the account
            $this->accountModel->editAccount($id, $accountRole, $username, $accountEmail, $hashedPassword);
            header("Location: accounts.php");
            exit;
        }
    }

    private function validateAccountData($accountRole, $username, $accountEmail, $accountPassword)
    {
        //store the errors in an array
        $errors = [];
        //check for empty fields etcetera.
        if (empty($username) || strlen($username) > 55) {
            $errors['username'] = 'Gebruikersnaam is verplicht en mag max. 55 karakters bevatten.';
        }

        if (empty($accountRole)) {
            $errors['accountRole'] = 'Er moet een account rol zijn geselecteerd';
        }

        if (empty($accountEmail)) {
            $errors['accountEmail'] = 'Email adres is verplicht in te voeren.';
        }

        if (empty($accountPassword) || strlen($accountPassword) < 15) {
            $errors['releaseYear'] = 'Wachtwoord is verplicht en moet minimaal 15 karakters bevatten.';
        }

        //check if email is available and not allready taken
        if (!$this->accountModel->isEmailAvailable($accountEmail)) {
            $errors['emailTaken'] = 'Dit e-mailadres is al in gebruik';
        }

        return $errors;
    }
}

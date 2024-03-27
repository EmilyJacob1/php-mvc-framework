<?php

require_once '../app/models/accountModel.php';
require_once '../app/core/authenticator.php';

class AccountController
{
    private $accountModel;

    public function __construct()
    {
        //check if admin is logged in first
        Authenticator::checkAuthenticationAdmin();
        $this->accountModel = new AccountModel();
    }

    public function renderAccounts()
    {
        $accounts = $this->accountModel->getAllAccounts();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'deleteaccount') {
            $this->deleteAccount();
        } else {
            require '../app/views/accountsView.php';
        }
    }

    public function renderAddAccount()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
            $this->addAccount();
        } else {
            require '../app/views/addAccountView.php';
        }
    }

    public function renderEditAccount()
    {
        $id = $_GET['id'] ?? null;
        $account = $this->accountModel->getAccountById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit') {
            $this->editAccount();
        } else {
            require '../app/views/editAccountView.php';
        }
    }

    private function addAccount()
    {
        $accountRole = $_POST['accountRole'] ?? '';
        $username = $_POST['username'] ?? '';
        $accountemail = $_POST['accountemail'] ?? '';
        $accountPassword = $_POST['accountPassword'] ?? '';

        $errors = $this->validateAccountData($accountRole, $username, $accountemail, $accountPassword);

        if (!empty($errors)) {
            $errors;
            $formData = [
                'accountRole' => $accountRole,
                'username' => $username,
                'accountemail' => $accountemail,
                'accountPassword' => $accountPassword,
            ];
            require '../app/views/addAccountView.php';
            exit;
        } else {
            $hashedPassword = password_hash($accountPassword, PASSWORD_DEFAULT);
            $this->accountModel->addAccount($accountRole, $username, $accountemail, $hashedPassword);
            header("Location: accounts.php");
            exit;
        }
    }

    private function deleteAccount()
    {
        $id = $_POST['id'] ?? '';
        $this->accountModel->deleteAccount($id);
        header("Location: accounts.php");
    }

    private function editAccount()
    {
        $id = $_POST['id'] ?? '';
        $accountRole = $_POST['accountRole'] ?? '';
        $username = $_POST['username'] ?? '';
        $accountemail = $_POST['accountemail'] ?? '';
        $accountPassword = $_POST['accountPassword'] ?? '';

        $errors = $this->validateAccountData($accountRole, $username, $accountemail, $accountPassword);

        if (!empty($errors)) {
            $errors;
            $formData = [
                'id' => $id,
                'accountRole' => $accountRole,
                'username' => $username,
                'accountemail' => $accountemail,
                'accountPassword' => $accountPassword,
            ];
            require '../app/views/editAccountView.php';
            exit;
        } else {
            // Retrieve existing hashed password from the database
            $existingAccount = $this->accountModel->getAccountById($id);
            $existingHashedPassword = $existingAccount['accountPassword'];

            // check if the entered password matches the existing hashed password
            if ($accountPassword === $existingHashedPassword) {
                // keep the existing hashed password
                $hashedPassword = $existingHashedPassword;
            } else {
                // hash the new password
                $hashedPassword = password_hash($accountPassword, PASSWORD_DEFAULT);
            }

            // update the account
            $this->accountModel->editAccount($id, $accountRole, $username, $accountemail, $hashedPassword);
            header("Location: accounts.php");
            exit;
        }
    }

    private function validateAccountData($accountRole, $username, $accountemail, $accountPassword)
    {
        $errors = [];

        if (empty($username) || strlen($username) > 55) {
            $errors['username'] = 'Gebruikersnaam is verplicht en mag max. 55 karakters bevatten.';
        }

        if (empty($accountRole)) {
            $errors['accountRole'] = 'Er moet een account rol zijn geselecteerd';
        }

        if (empty($accountemail)) {
            $errors['accountemail'] = 'Email adres is verplicht in te voeren.';
        }

        //also check if email is allready taken or not here

        if (empty($accountPassword) || strlen($accountPassword) < 15) {
            $errors['releaseYear'] = 'Wachtwoord is verplicht en moet minimaal 15 karakters bevatten.';
        }


        return $errors;
    }
}

<?php

require_once '../app/models/AccountModel.php';

class LoginController
{
    private $accountModel;

    public function __construct()
    {
        $this->accountModel = new AccountModel();

        // start session if not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function renderLogin()
    {
        // check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            // call the login function
            $this->login($email, $password);
        } else {
            // only load the view
            require '../app/views/loginView.php';
        }
    }


    public function login($email, $password)
    {
        //first handle validation
        $errors = $this->validateLoginData($email, $password);
    
        if (!empty($errors)) {
            $errors;
            require '../app/views/loginView.php';
            exit;
        } else {
            // attempt to get user by email
            $account = $this->accountModel->getAccountByEmail($email);
    
            //if there is an account with this email and the passwords match
            if ($account && password_verify($password, $account['accountpassword'])) {
                // login successful
                $_SESSION['accountid'] = $account['accountid'];
                $_SESSION['role'] = $account['role'];
                $_SESSION['username'] = $account['username'];
                //send to home page
                header("Location: home.php"); 
                exit();
            } else {
                // invalid email or password
                $errors[] = "Verkeerd email of wachtwoord";
                require '../app/views/loginView.php';
                exit();
            }
        }
    }

    private function validateLoginData($email, $password)
    {
        //store error(s) inside of the $errors array
        $errors = [];

        // check if email or password is empty
        if (empty($email) || empty($password)) {
            $errors['emptyEmail'] = "Email adres en wachtwoord moeten ingevuld zijn.";
        }

        return $errors;
    }

    public function logout()
    {
        session_destroy();
        //redirect to the login page
        header("Location: index.php"); 
        exit();
    }
}

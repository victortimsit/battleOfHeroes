<?php
include 'signIn_form.php';
include 'signOut.php';
include 'signUp_form.php';

class Rooter {
    public function __construct($namesOfInputArray, $pdo) {
        // Set inputs names and errors array
        $this->inputs = $namesOfInputArray;
        // $this->errors = $errors;

        $this->pdo = $pdo;

        // If query is empty
        if(!empty($_POST)) {
            foreach($this->inputs as $input) {
                if(empty($_POST[$input])) {
                    // Fill errors array
                    global $signInErrors;
                    $signInErrors[$input] = '--empty';

                    global $signUpErrors;
                    $signUpErrors[$input] = '--empty';
                    // $this->displayErrors();
                }
            }
            // Call signIn if form isn't empty
            if(!empty($_POST['user_name']) AND !empty($_POST['password'])) {
                $this->signIn($this->pdo);
            }
            // Call signUp if form isn't empty
            if(!empty($_POST['create_user_name']) AND !empty($_POST['create_email']) AND !empty($_POST['create_password']) AND !empty($_POST['confirm_password'])) {
                $this->signUp($this->pdo);
            }
        }
    }
    function signIn($pdo) {
        $inputs = ['user_name', 'password'];
        $signIn = new Register($pdo);
    }
    function signUp($pdo) {
        $signUp = new SignUp($pdo);
    }
    function displayErrors() {
        echo '<pre>';
        print_r($this->errors);
        echo '</pre>';
    }
}
?>
<?php
include 'signIn_form.php';
include 'signOut.php';

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
                    global $registerErrors;
                    $registerErrors[$input] = '--empty';
                    // $this->displayErrors();
                }
            }
            // Call signIn if form isn't empty
            if(!empty($_POST['user_name']) AND !empty($_POST['password'])) {
                $this->signIn($this->pdo);
            }
        }
    }
    function signIn($pdo) {
        $inputs = ['user_name', 'password'];
        $signIn = new Register($pdo);
    }
    function displayErrors() {
        echo '<pre>';
        print_r($this->errors);
        echo '</pre>';
    }
}
?>
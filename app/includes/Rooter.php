<?php
include 'signIn_form.php';
class Rooter {
    public function __construct($namesOfInputArray, $pdo) {
        // Set inputs names and errors array
        $this->inputs = $namesOfInputArray;
        $this->errors = [];

        $this->pdo = $pdo;

        // If query is empty
        if(!empty($_POST)) {
            foreach($this->inputs as $input) {
                if(empty($_POST[$input])) {
                    // Fill errors array
                    $this->errors[$input] = '--empty';
                    $this->displayErrors();
                }
            }
            // Call signIn if form isn't empty
            if(!empty($_POST['user_name']) AND !empty($_POST['password'])) {
                $this->signIn($this->pdo, $this->errors);
            }
        }
    }
    function signIn($pdo, $errors) {
        $inputs = ['user_name', 'password'];
        $signIn = new Register($pdo, $errors);
    }
    function displayErrors() {
        echo '<pre>';
        print_r($this->errors);
        echo '</pre>';
    }
}
?>
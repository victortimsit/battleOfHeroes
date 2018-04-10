<?php
class Register {
    public function __construct($pdo) {
        $this->userName = htmlspecialchars(trim($_POST['user_name']));
        $this->password = htmlspecialchars(trim($_POST['password']));

        $this->pdo = $pdo;

        // Select all users
        $this->signInCheck($this->userName, $this->password);
    }

    function signInCheck($userName, $password) {
        // Values
        $data = ['user_name' => $userName];
                
        // Prepare request
        $prepare = $this->pdo->prepare('SELECT * FROM users WHERE user_name = :user_name');

        // Bind values
        $prepare->bindValue(':user_name', $data['user_name']);
        
        // Execute request
        $exec = $prepare->execute($data);

        $user = $prepare->fetch();

        if(!empty($user)) {
            $this->passwordCheck($user, $password);
        } else {
            global $signInErrors;
            $signInErrors['connection'] = '--invalid';
        }
    }

    function passwordCheck($user, $password) {
        // Catch user password
        $userPassword = $user->password;
        if(password_verify($password, $userPassword)) {
            connection($user->user_name, $user->id);
        } else {
            global $signInErrors;
            $signInErrors['connection'] = "--invalid";
        }
    }
}
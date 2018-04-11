<?php
class SignUp {
    public function __construct($pdo) {
        $this->userName = htmlspecialchars(trim($_POST['create_user_name']));
        $this->email = htmlspecialchars(trim($_POST['create_email']));
        $this->password = htmlspecialchars(trim($_POST['create_password']));
        $this->confirmPassword = htmlspecialchars(trim($_POST['confirm_password']));
        $this->avatar = $_POST['avatar'];
        $this->pdo = $pdo;

        echo '<pre>';
        print_r($this->avatar);
        echo '</pre>';

        $this->signUpCheck($this->userName, $this->password, $this->confirmPassword);
    }

    function signUpCheck($userName, $password, $confirmPassword) {
        // Values
        $data = ['user_name' => $userName];
                
        // Prepare request
        $prepare = $this->pdo->prepare('SELECT * FROM users WHERE user_name = :user_name');

        // Bind values
        $prepare->bindValue(':user_name', $data['user_name']);
        
        // Execute request
        $exec = $prepare->execute($data);

        $user = $prepare->fetch();

        // Check if email is valid
        $atIn = strpos($this->email, '@');
        $pointIn = strpos($this->email, '.');
        if(!$atIn || !$pointIn) {
            global $signUpErrors;
            $signUpErrors['email'] = '--invalid';
        }
        if(empty($user)) {
            if($this->password != $confirmPassword ) {
                global $signUpErrors;
                $signUpErrors['password'] = '--notSame';
            } 
            else if($this->password == $this->userName) {
                global $signUpErrors;
                $signUpErrors['password'] = '--sameAsUserName';
            }
            else {
                $this->createAccount($this->userName, $this->email, $this->password, $this->avatar);
            }
        } else {
            global $signUpErrors;
            $signUpErrors['user_name'] = '--alreadyExist';
        }
    }    
    function createAccount($userName, $email, $password, $avatar) {
        echo '<pre>';
        print_r('Account created !');
        echo '</pre>';
        // Values
        $data = ['user_name' => $userName, 'email' => $email, 'password' => password_hash($password, PASSWORD_DEFAULT), 'avatar' => $avatar];
                
        // Prepare request
        $prepare = $this->pdo->prepare('INSERT INTO users (user_name, email, password, avatar) VALUES (:user_name, :email, :password, :avatar)');

        // Bind values
        $prepare->bindValue(':user_name', $data['user_name']);
        $prepare->bindValue(':email', $data['email']);
        $prepare->bindValue(':password', $data['password']);
        $prepare->bindValue(':avatar', $data['avatar']);
        
        // Execute request
        $exec = $prepare->execute();
    }
}

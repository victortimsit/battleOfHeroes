<?php
class SignUp {
    public function __construct($pdo) {
        $this->userName = htmlspecialchars(trim($_POST['create_user_name']));
        $this->email = htmlspecialchars(trim($_POST['create_email']));
        $this->password = htmlspecialchars(trim($_POST['create_password']));
        $this->confirmPassword = htmlspecialchars(trim($_POST['confirm_password']));
        $this->avatar = $_POST['avatar'];
        $this->pdo = $pdo;

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
        if(!$atIn AND !$pointIn) {
            global $signUpErrors;
            $signUpErrors['create_email'] = '--invalid';
        }
        if(empty($user)) {
            if($this->password != $confirmPassword ) {
                global $signUpErrors;
                $signUpErrors['create_password'] = '--notSame';
            } 
            else if($this->password == $this->userName) {
                global $signUpErrors;
                $signUpErrors['create_password'] = '--sameAsUserName';
            }
            else if(empty($signUpErrors['email'])){
                $this->createAccount($this->userName, $this->email, $this->password, $this->avatar);
                header('Location: ./signUpConfirm.php');
            }
        } else {
            global $signUpErrors;
            $signUpErrors['create_user_name'] = '--alreadyExist';
        }
    }    
    function createAccount($userName, $email, $password, $avatar) {
        // echo '<pre>';
        // print_r('Account created !');
        // echo '</pre>';
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

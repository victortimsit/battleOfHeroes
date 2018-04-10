<?php

// if(!empty($_POST)) {
//     !empty($_POST['user_name']) ? $userName = $_POST['user_name'] : $registerErrors['user_name'] = 'register__emptyError--active';
//     !empty($_POST['password']) ? $password = $_POST['password'] : $registerErrors['password'] = 'password__emptyError--active';

//     if(!empty($_POST['user_name']) && !empty($_POST['password'])) {

//         // Prepare query
//         $query = $pdo->query('SELECT * FROM users');
    
//         // Exec query and catch datas
//         $users = $query->fetchAll();

//         // Set user names and user passwords
//         $usersName = array();
//         $passwords = array();

//         foreach($users as $_user) {
//             $usersName[] = $_user->user_name;
//         }

//         // userCheck($userName, $usersName, $users, $pdo);
//         function userCheck($userName, $usersName, $users, $pdo) {
//             if(!empty($_POST['user_name']) AND !empty($_POST['password'])) {
//                 // Values
//                 $data = ['user_name' => $userName];
                
//                 // Prepare request
//                 $prepare = $pdo->prepare('SELECT * FROM users WHERE user_name = :user_name');
        
//                 // Bind values
//                 $prepare->bindValue(':user_name', $data['user_name']);
                
//                 // Execute request
//                 $exec = $prepare->execute($data);

//                 $user = $prepare->fetch();
        
//                 if($user) {
//                     passwordCheck($user, $_POST['password']);
                    
//                 } else {
//                     echo 'pas trouvé';
//                     $registerErrors['user_name'] = "register__invalidUsername--active"; // NE FONCTIONNE PAS
//                 }
//             }
//         }
        
//         userCheck($userName, $usersName, $users, $pdo);
//     }
// }

// function passwordCheck($user, $password) {
//     // Catch user password
//     $userPassword = $user->password;
//     if(password_verify($password, $userPassword)) {
//         connection($user->user_name, $user->id);
//     } else {
//         $registerErrors['password'] = "register__invalidPassword--active";
//     }
// }

// // Deconnection
// if(!empty($_GET['action']) && $_GET['action']=='deconnection')
// {
//     deconnection();
// }

// if(!empty($_POST)) {
//     !empty($_POST['user_name']) ? $userName = $_POST['user_name'] : $registerErrors['user_name'] = 'register__emptyError--active';
//     !empty($_POST['password']) ? $password = $_POST['password'] : $registerErrors['password'] = 'password__emptyError--active';

//     if(!empty($_POST['user_name']) && !empty($_POST['password'])) {

//         // Prepare query
//         $query = $pdo->query('SELECT * FROM users');
    
//         // Exec query and catch datas
//         $users = $query->fetchAll();


//         // Set user names and user passwords
//         $usersName = array();
//         $passwords = array();

//         foreach($users as $_user) {
//             $usersName[] = $_user->user_name;
//         }

//         // userCheck($userName, $usersName, $users, $pdo);
//         function userCheck($userName, $usersName, $users, $pdo) {
//             if(!empty($_POST['user_name']) AND !empty($_POST['password'])) {
//                 // Values
//                 $data = ['user_name' => $userName];
                
//                 // Prepare request
//                 $prepare = $pdo->prepare('SELECT * FROM users WHERE user_name = :user_name');
        
//                 // Bind values
//                 $prepare->bindValue(':user_name', $data['user_name']);
                
//                 // Execute request
//                 $exec = $prepare->execute($data);

//                 $user = $prepare->fetch();
        
//                 if($user) {
//                     passwordCheck($user, $_POST['password']);
                    
//                 } else {
//                     echo 'pas trouvé';
//                     $registerErrors['user_name'] = "register__invalidUsername--active"; // NE FONCTIONNE PAS
//                 }
//             }
//         }
        
//         userCheck($userName, $usersName, $users, $pdo);
//     }
// }

// function passwordCheck($user, $password) {
//     // Catch user password
//     $userPassword = $user->password;
//     if(password_verify($password, $userPassword)) {
//         connection($user->user_name, $user->id);
//     } else {
//         $registerErrors['password'] = "register__invalidPassword--active";
//     }
// }

// Deconnection
if(!empty($_GET['action']) && $_GET['action']=='deconnection')
{
    deconnection();
}

class Register {
    public function __construct($pdo, $errors) {
        $this->userName = $_POST['user_name'];
        $this->password = $_POST['password'];

        $this->pdo = $pdo;
        $this->errors = $errors;

        // Select all users
        $this->selectUser($this->userName, $this->password);


    }

    function selectUser($userName, $password) {
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
            $this->errors['connection'] = '--invalid';
        }

        // echo '<pre>';
        // print_r('user '.$user.' '.'exec '.$exec);
        // echo '</pre>';


        // isset($user) ? false : $this->errors['user_name'] = '--notExist';





        echo '<pre>';
        print_r($this->errors);
        echo '</pre>';
    }

    function passwordCheck($user, $password) {
        // Catch user password
        $userPassword = $user->password;
        if(password_verify($password, $userPassword)) {
            connection($user->user_name, $user->id);
        } else {
            $this->errors['connection'] = "--invalid";
        }
    }
}
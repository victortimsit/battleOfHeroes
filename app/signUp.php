<?php
  include 'includes/dataBase_connection.php';
  include 'includes/errors.php';
  include 'includes/Rooter.php';

  $inputs = ['create_user_name', 'create_email', 'create_password', 'confirm_password', 'avatar'];

  $rooter = new Rooter($inputs, $pdo);

  // if(!empty($_POST['create_user_name']) || !empty($_POST['create_email']) || !empty($_POST['create_password']) || !empty($_POST['confirm_password'])) {
  //   echo '<pre>';
  //   print_r($signUpErrors);
  //   echo '</pre>';
  // }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link href="https://fonts.googleapis.com/css?family=Signika:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="styles/css/main.css" />
  </head>
  <body>
    <div class="signUp">
      <h1 class="signUp__title">Sign up</h1>
        <form class="signUp__form" action="#" method="post">
            <label class="signUp__label" for="create_user_name">User name</label>
            <input class="signUp__input" type="text" name="create_user_name" placeholder="User name" value="<?= !empty($_POST['create_user_name']) ? $_POST['create_user_name'] : false ?>">
            <p class="signUp__error signUp__error<?= !empty($signUpErrors['create_user_name']) ? $signUpErrors['create_user_name'] : false ?>">
            <?php if(!empty($signUpErrors['create_user_name'])) { ?>
            <?= $signUpErrors['create_user_name'] == '--empty' ? 'User name is required' : false?>
            <?= $signUpErrors['create_user_name'] == '--alreadyExist' ? 'This user name already exist' : false?>
            <?php } ?>
            </p>
            <label class="signUp__label" for="create_email">Email</label>
            <input class="signUp__input" type="text" name="create_email" placeholder="Email" value="<?= !empty($_POST['create_email']) ? $_POST['create_email'] : false ?>">
            <p class="signUp__error signUp__error<?= !empty($signUpErrors['create_email']) ? $signUpErrors['create_email'] : false ?>">
            <?php if(!empty($signUpErrors['create_email'])) { ?>
            <?= $signUpErrors['create_email'] == '--empty' ? 'Email adress is required' : false?>
            <?= $signUpErrors['create_email'] == '--invalid' ? 'Invalid email adress' : false?>
            <?php } ?>
            </p>
            <div class="signUp__passwords">
              <div class="signUp__password">
                <label class="signUp__label signUp__labelPassword" for="create_password">Password</label>
                <input class="signUp__input signUp__inputPassword" type="password" name="create_password" placeholder="Password">
              </div>
              <div class="signUp__confirmPassword">
                <label class="signUp__label signUp__labelPassword" for="confirm_password">Confirm password</label>
                <input class="signUp__input signUp__inputPassword" type="password" name="confirm_password" placeholder="Confirm password">
              </div>
            </div>
            <p class="signUp__error signUp__passwordError">
              <?php 
              if(!empty($signUpErrors['create_password'])) { 
                echo $signUpErrors['create_password'] == '--empty' ? 'Password is required' : false; 
                echo $signUpErrors['create_password'] == '--sameAsUserName' ? 'Password could not be same as user name' : false; 
                echo $signUpErrors['create_password'] == '--notSame' ? 'Password not confirmed correctly' : false; 
                } 
              if(!empty($signUpErrors['confirm_password']) AND empty($signUpErrors['create_password'])) {
                echo $signUpErrors['confirm_password'] == "--empty" ? 'Please confirmed password' : false;
              }
              ?>
            </p>
            <div class="signUp__line"></div>
            <label class="signUp__label">Avatar</label>
            <?php $rand = rand(1, 9); ?>
            <div class="signUp__avatars">
              <?php for($i = 1; $i < 10 ; $i++) { ?>
                <label class="signUp__avatar">
                  <input class="signUp__radio signUp__radio--hidden" type="radio" name="avatar" value="<?= $i ?>" <?= $rand == $i ? 'checked' : false ?>>
                  <img class="signUp__avatarImg" src="assets/avatars/<?= $i ?>.jpg" alt="avatar">
                </label>
              <?php } ?>
            </div>
            <label>
              <input class="signUp__radio--hidden" type="submit">
              <div class="signUp__button">Create an account</div>
            </label>
        </form>
    </div>
  </body>
</html>
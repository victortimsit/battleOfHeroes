<?php
  include 'includes/dataBase_connection.php';
  include 'includes/errors.php';
  include 'includes/Rooter.php';

  $inputs = ['create_user_name', 'create_email', 'create_password', 'confirm_password', 'avatar'];

  $rooter = new Rooter($inputs, $pdo);

  if(!empty($_POST['create_user_name']) || !empty($_POST['create_email']) || !empty($_POST['create_password']) || !empty($_POST['confirm_password'])) {
    echo '<pre>';
    print_r($signUpErrors);
    echo '</pre>';
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="styles/css/base/register.css" />
  </head>
  <body>
    <div class="register">
        <form action="#" method="post">
            <label class="register__label" for="create_user_name">User name</label>
            <input class="register__input" type="text" name="create_user_name" placeholder="User name">
            <label class="register__label" for="create_email">Email</label>
            <input class="register__input" type="text" name="create_email" placeholder="Email">
            <label class="register__label" for="create_password">Password</label>
            <input class="register__input" type="password" name="create_password" placeholder="Password">
            <label class="register__label" for="confirm_password">Confirm password</label>
            <input class="register__input" type="password" name="confirm_password" placeholder="Confirm password">
            <?php $rand = rand(1, 9); ?>
            <?= $rand ?>
            <?php for($i = 0; $i < 10 ; $i++) {?>
            <label>
              <input type="radio" name="avatar" value="<?= $i ?>" <?= $rand == $i ? 'checked' : false ?>>
              <img src="assets/avatars/<?= $i ?>.jpg" alt="avatar">
            </label>
            <?php } ?>
            <div class="register__button">
              <label>
              <input class="register__submit" type="submit">
              <div>Create an account</div>
              </label>
            </div>
        </form>
    </div>
  </body>
</html>
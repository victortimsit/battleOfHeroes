<?php
  session_start();
  include 'includes/dataBase_connection.php';
  include 'includes/errors.php';
  include 'includes/Rooter.php';
  
  $inputs = ['user_name', 'password'];

  // $signInErrors;
  $rooter = new Rooter($inputs, $pdo);

  // echo '<pre>';
  // print_r($signUpErrors);
  // echo '</pre>';

  function connection($account, $id) {
    $_SESSION['user'] = $account;
    $_SESSION['id'] = $id;
    header('Location: ./');
  }

  function deconnection() {
    unset($_SESSION['user']);
    header('Location: ./');
  }

  if(!empty($_POST['user_name']) || !empty($_POST['password'])) {
    echo '<pre>';
    print_r($signInErrors);
    echo '</pre>';
  }
?>

<?php 
  if (isset($_SESSION['user'])) { ?>
    <!DOCTYPE html>
    <html lang="fr">
      <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale = 1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?= $_SESSION['id'] ?></title>
        <h1>Title</h1>
        <a href="./?action=deconnection">Sign out</a>
        <!--build:css styles/styles.min.css-->
        <link rel="stylesheet" href="styles/css/main.css" />
        <!--endbuild-->
      </head>
      <body>
        <!--build:js scripts/main.min.js -->
        <script src="scripts/script.js"></script>
        <!--endbuild-->
      </body>
    </html>
<?php } else { ?>
  <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Register</title>
      <link rel="stylesheet" href="styles/css/main.css" />
    </head>
    <body>
      <div class="signUp">
        <h1 class="signUp__title">Log in</h1>
          <form class="signUp__form" action="#" method="post">
              <label class="signUp__label" for="user_name">User name</label>
              <input class="signUp__input" type="text" name="user_name" placeholder="User name">
              <p class="signUp__error signUp__error<?= !empty($signInErrors['user_name']) ? $signInErrors['user_name'] : false ?>">
              <?php if(!empty($signInErrors['user_name'])) { ?>
              <?= $signInErrors['user_name'] == '--empty' ? 'User name is required' : false?>
              <?php } ?>
              </p>
              <label class="signUp__label" for="password">Password</label>
              <input class="signUp__input" type="password" name="password" placeholder="Password">
              <p class="signUp__error signUp__error<?= !empty($signInErrors['password']) ? $signInErrors['password'] : false ?>">
              <?php if(!empty($signInErrors['password'])) { ?>
              <?= $signInErrors['password'] == '--empty' ? 'Password is required' : false?>
              <?php } ?>
              <?php if(!empty($signInErrors['connection'])) { ?>
              <?= $signInErrors['connection'] == '--invalid' ? 'Wrong user name or password' : false?>
              <?php } ?>
              </p>
              <label>
              <input class="signUp__radio--hidden" type="submit">
              <div class="signUp__connexion">Connexion</div>
              </label>
          </form>
          <div class="signIn__lines">
            <div class="signIn__line"></div>
            <p class="signIn__or">or</p>
            <div class="signIn__line"></div>
          </div>

          <a class="signIn__signUp" href="signUp.php">
          <input class="signUp__radio--hidden" type="submit">
          <div class="signUp__button">Create a account</div>
          </a>         

        </div>
    </body>
    </html>
    <?php
  }
?>
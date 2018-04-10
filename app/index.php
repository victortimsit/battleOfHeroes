<?php
  session_start();
  include 'includes/dataBase_connection.php';
  include 'includes/Rooter.php';

  $inputs = ['user_name', 'password'];

  $rooter = new Rooter($inputs, $pdo);

  function connection($account, $id) {
    $_SESSION['user'] = $account;
    $_SESSION['id'] = $id;
    header('Location: ./');
  }

  function deconnection() {
    unset($_SESSION['user']);
    header('Location: ./');
  }

  // deconnection()
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
        <link rel="stylesheet" href="styles/css/base/styles.css" />
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
      <link rel="stylesheet" href="styles/css/base/register.css" />
    </head>
    <body>
      <div class="register">
          <form action="#" method="post">
              <label class="register__label" for="user_name">User name</label>
              <input class="register__input" type="text" name="user_name" placeholder="User name">
              <label class="register__label" for="password">Password</label>
              <input class="register__input" type="password" name="password" placeholder="Password">
              <div class="register__button">
                <label>
                <input class="register__submit" type="submit">
                <div>Connexion</div>
                </label>
              </div>
          </form>
          <a href="createAccount.php">Create a account</a>
      </div>
    </body>
    </html>
    <?php
  }
?>
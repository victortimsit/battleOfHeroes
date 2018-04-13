<?php
  include_once('session.php');
  include 'dataBase_connection.php';
  include 'errors.php';
  include 'Rooter.php';
  
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
  <?php
    include 'timeline.php'
  ?>
<?php } else { ?>
  <?php
    include 'signIn.php'
  ?>
<?php } ?>


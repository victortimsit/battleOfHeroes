<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Register</title>
        <link rel="stylesheet" href="../styles/css/main.css" />
        <link href="https://fonts.googleapis.com/css?family=Signika:300,400,600,700" rel="stylesheet">
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
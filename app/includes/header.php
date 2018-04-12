<?php 
    // include 'dataBase_connection.php';
    //Get the data from the database and fetch them in an Array  
    $query = $pdo->query('SELECT * FROM users WHERE id = '.$_SESSION['id'].'');
    $user = $query->fetch();
?>
<div class="header">
    <div class="header__container">
        <div class="header__start">
            <div class="header__logo">
                <a href="index.php">MARVEL THEORIES</a>
            </div>
            <div class="header__menu">
                <div class="header__timeline header__timeline--active">
                    <a href="index.php">TIMELINE</a>
                </div>
                <div class="header__theories">
                    <a href="articleFlow.php">THEORIES</a>
                </div>
            </div>
        </div>
        <div class="header__end">
                <div class="header__addTheories">
                    <a href="addTheory.php">+ ADD THEORIES</a>
                </div>
            <div class="header__account">
                <span class="header__profilePicture">
                    <img class="header__profilePictureImg" src="../assets/avatars/<?= $user->avatar ?>.jpg" alt="">
                </span>
                <span class="header__profileName"><?= $_SESSION['user'] ?></span>
                <a href="./?action=deconnection">
                    <svg class="header__icon">
                        <use class="header__iconUse"xlink:href="../assets/images/icons/signOut.svg#signOut"></use>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>
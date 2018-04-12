<?php

    $url = 'https://api.themoviedb.org/3/list/62792?api_key=829b41a4cec76e1a71b780aa42cc2498&language=en-US';
    $movieList = json_decode(file_get_contents($url));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles/css/main.css" />
    <title>Timeline</title>
</head>
<body>
    <img class="background" src="assets/images/background.png" alt="background">
    <div class="header">
        <div class="header__container">
            <div class="header__start">
                <div class="header__logo">
                    <a href="#">MARVEL THEORIES</a>
                </div>
                <div class="header__menu">
                    <div class="header__timeline header__timeline--active">
                        <a href="#">TIMELINE</a>
                    </div>
                    <div class="header__theories">
                        <a href="#">THEORIES</a>
                    </div>
                </div>
            </div>
            <div class="header__end">
                <div class="header__account">
                    <span class="header__profilePicture">
                        <!-- <img src="assets/avatars/.jpg" alt=""> -->
                    </span>
                    <span class="header__profileName"><?= $_SESSION['user'] ?></span>
                    <a href="./?action=deconnection">
                        <svg class="header__icon">
                            <use class="header__iconUse"xlink:href="assets/images/icons/signOut.svg#signOut"></use>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="phases">
        <div class="phases__first"></div>
        <div class="phases__second"></div>
        <div class="phases__third"></div>
        <div class="phases__fourth"></div>
    </div>
    <div class="timeline">
        <div class="timeline__container">
        <?php $i = 0 ?>
        <?php foreach($movieList->items as $_item): ?>
            <div class="timeline__dots">
                <div class="<?=  $i == 0 ? 'timeline__firstRedLine' : false ?> <?=  $i == sizeof($movieList->items)-1 ? 'timeline__lastRedLine' : false ?> timeline__redLine"></div>
                <div class="timeline__poster timeline__poster<?= $i%2 ? "--bottom" : "--top" ?> " >
                <?php if($i%2 == 0) { ?>
                    <img src="https://image.tmdb.org/t/p/w150_and_h225_bestv2<?= $_item->poster_path ?>" alt="<?= $_item->original_title ?>">
                    <div class="timeline__year"><?= $_item->release_date ?></div>
                    <div class="timeline__hover timeline__hover<?= $i%2 ? "--bottom" : "--top" ?>">
                    <div class="timeline__hoverBackground">
                        <a class="timeline__hoverButton" href="#">See Theories</a>
                        <a class="timeline__hoverButton" href="#">See Movie</a>
                    </div>
                    </div>
                <?php 
                }else { ?>
                    <div class="timeline__year"><?= $_item->release_date ?></div>
                    <img class="timeline__bottomPoster"src="https://image.tmdb.org/t/p/w150_and_h225_bestv2<?= $_item->poster_path ?>" alt="<?= $_item->original_title ?>">
                    <div class="timeline__hover timeline__hover<?= $i%2 ? "--bottom" : "--top" ?>">
                        <div class="timeline__hoverBackground">
                            <a class="timeline__hoverButton" href="#">See Theories</a>
                            <a class="timeline__hoverButton" href="#">See Movie</a>
                        </div>
                    </div>
                <?php } ?>
                </div>
                <div class="timeline__preview">
                    <img class="timeline__image" src="https://image.tmdb.org/t/p/w300_and_h450_bestv2<?= $_item->poster_path ?>" alt="<?= $_item->original_title ?>">
                    <h1 class="timeline__title"><?= $_item->original_title ?> (<?=$_item->release_date ?>)</h1>
                    <div class="timeline__popularity"><?= $_item->popularity ?></div>
                    <h2 class="timeline__subTitle">Synopsis</h2>
                    <div class="timeline__overview"><?= $_item->overview ?></div>
                    <div class="timeline__seeTheories">
                        <p class="timeline__buttonText">Discover Theories</p>
                    </div>
                </div>
            </div>
        <?php $i++ ?>
        <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
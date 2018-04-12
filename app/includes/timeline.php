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
                <div class="timeline__poster timeline__poster<?= $i % 2 ? "--bottom" : "--top" ?> " >
                <?php if($i % 2 == 0) { ?>
                    <img src="https://image.tmdb.org/t/p/w150_and_h225_bestv2<?= $_item->poster_path ?>" alt="<?= $_item->original_title ?>">
                    <div class="timeline__hover timeline__hover<?= $i % 2 ? "--bottom" : "--top" ?>">
                    <div class="timeline__hoverBackground--top">
                        <span class="timeline__year"><?= date("Y",strtotime($_item->release_date)) ?></span>
                        <div class="timeline__hoverButton--white">Synopsis</div>
                        <div class="timeline__hoverButton--red">See Theories</div>
                    </div>
                    </div>
                <?php 
                }else { ?>
                    <img class="timeline__bottomPoster"src="https://image.tmdb.org/t/p/w150_and_h225_bestv2<?= $_item->poster_path ?>" alt="<?= $_item->original_title ?>">
                    <div class="timeline__hover timeline__hover<?= $i % 2 ? "--bottom" : "--top" ?>">
                        <div class="timeline__hoverBackground--bottom">
                            <div class="timeline__hoverButton--red">See Theories</div>
                            <div class="timeline__hoverButton--white">Synopsis</div>
                            <span class="timeline__year"><?= date("Y",strtotime($_item->release_date)) ?></span>
                        </div>
                    </div>
                <?php } ?>
                </div>
                <div class="timeline__preview timeline__preview--unDisplay <?= $i % 2 ? '--bottom' : '--top' ?> <?=  $i == 0 ? 'timeline__firstPreview' : false ?> <?=  $i == 1 ? 'timeline__secondPreview' : false ?> <?=  $i == 2 ? 'timeline__thirdPreview' : false ?> <?=  $i == sizeof($movieList->items) - 1 ? 'timeline__lastPreview' : false ?>">
                    <img class="timeline__image" src="https://image.tmdb.org/t/p/w300_and_h450_bestv2<?= $_item->poster_path ?>" alt="<?= $_item->original_title ?>">
                    <div class="timeline__content">
                        <h1 class="timeline__title"><?= $_item->original_title ?> (<?=$_item->release_date ?>)</h1>
                        <div class="timeline__popularity"><?= $_item->popularity ?></div>
                        <h2 class="timeline__subTitle">Synopsis</h2>
                        <div class="timeline__overview"><?= $_item->overview ?></div>
                        <div class="timeline__hoverButton--absolute timeline__hoverButton--red">Discover Theories</div>
                    </div>
                </div>
            </div>
        <?php $i++ ?>
        <?php endforeach; ?>
        </div>
    </div>
    <script src="scripts/SynopsisDisplay.js"></script>
    <script src="scripts/script.js"></script>
</body>
</html>
<?php

    include 'dataBase_connection.php';
    //Get the data from the database and fetch them in an Array  

    echo '<pre>';
    var_dump($articles->dislikes);
    echo '</pre>';

    $query = $pdo->query('SELECT * FROM paragraphs');
    $paragraphs = $query->fetchAll();

    $query = $pdo->query('SELECT * FROM articles WHERE id = 35 '/* $paragraphs[0]->articleID */);
    $articles = $query->fetch();

    $query = $pdo->query('SELECT * FROM users WHERE id = '.$articles->authorID);
    $user = $query->fetch();

    $url = 'https://api.themoviedb.org/3/movie/'.$articles->movieID.'?api_key=829b41a4cec76e1a71b780aa42cc2498&language=en-US';
    $movie = json_decode(file_get_contents($url));

    $resultCredible = 0;
    $resultPopularity = 0;

    if($articles->dislikes != 0)
        { $resultCredible = ($articles->likes / ( $articles->dislikes + $articles->likes)) * 100;}

    if($articles->notCredible != 0)
        { $resultPopularity = ($articles->credible / ( $articles->notCredible + $articles->credible)) * 100;}

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Read <?= $articles->title ?></title>

    <link href="https://fonts.googleapis.com/css?family=Signika" rel="stylesheet"> 
    <link rel="stylesheet" href="../styles/css/main.css" />
</head>
<body>
    <img class="background" src="../assets/images/background.png" alt="background">
    <div class="article">
        <div class="article__header">
            <img class="article__headerImg" src="https://image.tmdb.org/t/p/w300_and_h450_bestv2<?= $movie->poster_path ?>" alt="Movie Poster" class="article__headerPoster">
            <h1 class="article__headerTitle"><?= $articles->title ?></h1>
            <div class="article__author">
                <span class="header__profilePicture">
                    <img src="../assets/avatars/<?= $user->avatar ?>.jpg" alt="Avatar" class="header__profilePictureImg">
                </span>
                <p class="article__authorName"><?= $user->user_name ?></p>
            </div>
            <div class="article__credibility">
                <p class="article__credibilityTitle">Credibility</p>
                <div class="article__credibilityBar">
                    <div class="article__credibilityBarFill" data-credibility="<?= $resultCredible ?>"></div>
                </div>
            </div>
            <div class="article__popularity">
                <p class="article__popularityTitle">Popularity</p>
                <div class="article__popularityBar">
                    <div class="article__popularityBarFill" data-popularity="<?= $resultPopularity ?>"></div>
                </div>            
            </div>
        </div>
        <div class="article__text">
            <?php foreach($paragraphs as $_paragraph): ?>
                <?php if($_paragraph->type == 'title') { ?>
                    <div class="article__textTitle">
                        <div class="article__textTitleContent">
                            <?= $_paragraph->content ?>
                        </div>
                        <div class="article__commentsIconContainer article__commentsIconContainer--top">
                            <img src="../assets/images/icons/commenticon.png" alt="Comments" class="articles__commentsIcon">
                            <div class="article__userComments">
                                <div class="article__userCommentsAuthor">
                                    <img src="#" alt="" class="article__userCommentsAuthor--avatar">
                                    <div class="article__userCommentsAuthor--name">Michel</div>
                                </div>
                                <div class="article__userCommentsContent">
                                    <p>Amazing theory man omg <3<3</p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }else { ?>
                    <div class="article__textCore">
                        <div class="article__textTitleContent">
                            <?= $_paragraph->content ?>
                        </div>
                        <div class="article__commentsIconContainer">
                            <img src="../assets/images/icons/commenticon.png" alt="Comments" class="articles__commentsIcon">
                            <div class="article__userComments">
                                <div class="article__userCommentsAuthor">
                                    <div class="article__userCommentsAuthor--avatar">
                                        <img src="#" alt="" class="article__userCommentsAuthor--avatarImg">
                                    </div>
                                    <div class="article__userCommentsAuthor--name">Michel</div>
                                </div>
                                <div class="article__userCommentsContent">
                                    <p>AMAZING !!! I love it sounds really great !</p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
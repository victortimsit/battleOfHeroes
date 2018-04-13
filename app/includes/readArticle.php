<?php

    include 'dataBase_connection.php';
    //Get the data from the database and fetch them in an Array  

    $query = $pdo->query('SELECT * FROM article_content');
    $articleContents = $query->fetchAll();

    $query = $pdo->query('SELECT * FROM articles WHERE id ='.$articleContents[0]->articleId);
    $articles = $query->fetch();

    $url = 'https://api.themoviedb.org/3/movie/'.$articles->movieID.'?api_key=829b41a4cec76e1a71b780aa42cc2498&language=en-US';
    $movie = json_decode(file_get_contents($url));
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
                <img src="#" alt="Avatar" class="article__authorAvatar">
                <p class="article__authorName">Oldelaf</p>
            </div>
            <div class="article__credibility">
                <p class="article__credibilityTitle">Credibility</p>
                <div class="article__credibilityBar">
                    <div class="article__credibilityBarFill" data-credibility="<?= ($article->credible / ( $article->notCredible + $article->credible)) * 100 ?>"></div>
                </div>
            </div>
            <div class="article__popularity">
                <p class="article__popularityTitle">Popularity</p>
                <div class="article__popularityBar">
                    <div class="article__popularityBarFill" data-popularity="<?= ($article->likes / ( $article->dislikes + $article->likes)) * 100 ?>"></div>
                </div>            
            </div>
        </div>
        <div class="article__text">
            <?php foreach($articleContents as $_articleContent): ?>
                <?php if($_articleContent->type == 'title') { ?>
                    <div class="article__textTitle">
                        <div class="article__textTitleContent">
                            <?= $_articleContent->content ?>
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
                            <?= $_articleContent->content ?>
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
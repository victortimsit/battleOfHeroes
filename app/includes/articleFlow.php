<?php 
    include "database_connection.php";

    //Get the data from the database and fetch them in an Array  
    $query = $pdo->query('SELECT * FROM articles');
    $articles = $query->fetchAll();

    $url = 'https://api.themoviedb.org/3/list/62792?api_key=829b41a4cec76e1a71b780aa42cc2498&language=en-US';
    $movieList = json_decode(file_get_contents($url));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Articles</title>

    <link rel="stylesheet" href="../styles/css/main.css" />
</head>
<body>
    <img class="background" src="../assets/images/background.png" alt="background">
    <div class="theoriesFlow">
        <h1 class="theoriesFlow__pageTitle">All THEORIES</h1>
        <?php foreach($articles as $article): ?>
        <?php $poster = 0; ?>
        <div class="theoriesFlow__container">
            <div class="theoriesFlow__user">
                <div class="theoriesFlow__userAvatar">
                    <img src="#" alt="Avatar">
                </div>
                <div class="theoriesFlow__userName">GUIGUI</div>
            </div>
            <?php for($i=0; $i < sizeof($movieList->items); $i++)
            {
                if($article->movieID == $movieList->items[$i]->id ) $poster = $movieList->items[$i]->poster_path;
            ?>
            <?php } ?>
            <img class="theoriesFlow__poster" src="https://image.tmdb.org/t/p/w150_and_h225_bestv2<?= $poster ?>" alt="Poster">
            <div class="theoriesFlow__title"><?=$article->title ?></div>
            <div class="theoriesFlow__notes">
                <div class="theoriesFlow__credibility">
                    CREDIBILITY
                    <div class="theoriesFlow__credibilityBar">
                        <div class="theoriesFlow__credibilityBarFill" dataset-credibility="<?= ($article->credible / ( $article->notCredible + $article->credible)) * 100 ?>"></div>
                    </div>
                </div>
                <div class="theoriesFlow__popularity">
                    POPULARITY
                    <div class="theoriesFlow__popularityBar">
                        <div class="theoriesFlow__popularityBarFill" dataset-popularity="<?= ($article->likes / ( $article->dislikes + $article->likes)) * 100 ?>"></div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
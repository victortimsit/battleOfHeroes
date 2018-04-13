<?php 
    include_once('session.php');
    include 'dataBase_connection.php';
    include 'errors.php';
    include 'Rooter.php';
    //Get the data from the database and fetch them in an Array  
    $query = $pdo->query('SELECT * FROM articles');
    $articles = $query->fetchAll();

    $query = $pdo->query('SELECT * FROM users');
    $users = $query->fetchAll();
    

    $url = 'https://api.themoviedb.org/3/list/62792?api_key=829b41a4cec76e1a71b780aa42cc2498&language=en-US';
    $movieList = json_decode(file_get_contents($url));
?>
<?php if (isset($_SESSION['user'])) { ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Articles</title>
        <link href="https://fonts.googleapis.com/css?family=Signika:300,400,600,700" rel="stylesheet">
        <link rel="stylesheet" href="../styles/css/main.css" />
    </head>
    <body>
        <img class="background" src="../assets/images/background.png" alt="background">
        <div class="header--default">
            <?php include 'header.php'?>
        </div>
        <div class="theoriesFlow">
            <?php foreach($articles as $article): ?>
            <?php $poster = 0; ?>
            <a href="./readArticle.php?id=<?= $article->id ?>">
            <div class="theoriesFlow__container">
                <div class="theoriesFlow__user">
                    <div class="header__profilePicture">
                        <?php 
                            $authorID = $article->authorID;
                            $query = $pdo->query('SELECT * FROM users WHERE id = '.$authorID.'');
                            $user = $query->fetch();
                        ?>                    
                        <img class="header__profilePictureImg" src="../assets/avatars/<?= $user->avatar ?>.jpg" alt="Avatar">
                    </div>
                    <div class="theoriesFlow__userName"><?= $user->user_name ?></div>
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
                        Credibility
                        <div class="theoriesFlow__credibilityBar">
                            <div class="theoriesFlow__credibilityBarFill" data-credibility="<?= ($article->credible / ( $article->notCredible + $article->credible)) * 100 ?>"></div>
                        </div>
                    </div>
                    <div class="theoriesFlow__popularity">
                        Popularity
                        <div class="theoriesFlow__popularityBar">
                            <div class="theoriesFlow__popularityBarFill" data-popularity="<?= ($article->likes / ( $article->dislikes + $article->likes)) * 100 ?>"></div>
                        </div>
                    </div>
                </div>
            </div>
            </a>
            <?php endforeach; ?>
        </div>
        <script src="../scripts/MarkRatio.js" ></script>
    </body>
    </html>
<?php } else { ?>
    <?php include 'signIn.php'; ?>
<?php } ?>
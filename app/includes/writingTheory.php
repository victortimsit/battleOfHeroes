<?php 
    include 'writingArticle__form.php';
    $url = 'https://api.themoviedb.org/3/list/62792?api_key=829b41a4cec76e1a71b780aa42cc2498&language=en-US';
    $movieList = json_decode(file_get_contents($url));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Theory Writing</title>
    <link href="https://fonts.googleapis.com/css?family=Signika:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="../styles/css/main.css" />
</head>
<body>
<?php include 'header.php' ?>
<img class="background" src="../assets/images/background.png" alt="background">
    <div class="theoryCreation">
        <div class="theoryCreation__create">
            <div class="theoryCreation__poster">
                <img src="https://image.tmdb.org/t/p/w300_and_h450_bestv2/qJawKUQcIBha507UahUlX0keOT7.jpg" alt="Choosen film"> <!-- /qJawKUQcIBha507UahUlX0keOT7.jpg Ceci est le poster path -->
                <h2 class="theoryCreation__posterTitle">Avengers</h2>
            </div>
            <form action="#" method="post">
            <div class="theoryCreation__chooseMovie">
                <?php foreach($movieList->items as $_item): ?>
                    <label>
                        <input name="movie" class="theoryCreation__radio signUp__radio--hidden" value="<?= $_item->id ?>" type="radio">
                        <img class="theoryCreation__moviesPosterImg" data-moviePoster="<?= $_item->poster_path ?>" data-movieTitle="<?= $_item->original_title ?>" src="https://image.tmdb.org/t/p/w150_and_h225_bestv2<?= $_item->poster_path ?>" alt="<?= $_item->original_title ?>">
                    </label>
                <?php endforeach; ?>
            </div>
            <div class="theoriCreation__formContainer"></div>
                <div class="theoryCreation__addText">
                    <label class="theoryCreation__addTitle theoryCreation__addTitleLabel" for="Title">Title</label>
                    <input name="title" class="theoryCreation__input" type="text" placeholder="Title">
                    <label class="theoryCreation__addParagraph theoryCreation__addParagraphLabel" for="paragraph">Type your text</label>
                    <textarea name="paragraph" class="theoryCreation__inputText " placeholder="Type your theory" id="" cols="30" rows="10"></textarea>
                    <input type="hidden" name="date" value="<?= time() ?>">
                </div>
            <label>
            <input class="signUp__radio--hidden" type="submit">
            <div class="theoryCreation__send timeline__hoverButton--red">Publish your theory</div>
            </label>
            </form>
            <div class="theoryCreation__addButtons">
                <div class="theoryCreation__addButton theoryCreation__addButtonTitle">
                        <div class="theoryCreation__addButtonIcon">
                            <img class="theoryCreation__addButtonIconImg" src="../assets/images/icons/titleIcon.png" alt="Create Title">
                        </div>
                    <p>
                        Add Title
                    </p>
                </div>
                <div class="theoryCreation__addButton theoryCreation__addButtonParagraph">
                    <div class="theoryCreation__addButtonIcon">
                        <img class="theoryCreation__addButtonIconImg" src="../assets/images/icons/paragraphicon.png" alt="Create Paragraph">
                    </div>
                    <p class="theoryCreation__addButtonText">
                        Add paragraph
                    </p>
                </div>
            </div>
        </div>
    </div>
    <script src="../scripts/addText.js"></script>
</body>
</html>
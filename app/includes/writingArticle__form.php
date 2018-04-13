<?php 
include_once('session.php');
include 'dataBase_connection.php';

if(!empty($_POST)) {
    global $writingArticleErrors;
    !empty($_POST['movie']) ? $movie = $_POST['movie'] : $writingArticleErrors['movie'] = '--empty';
    !empty($_POST['title']) ? $title = $_POST['title'] : $writingArticleErrors['title'] = '--empty';
    !empty($_POST['paragraph']) ? $paragraph = $_POST['paragraph'] : $writingArticleErrors['paragraph'] = '--empty';
    $user_id = $_SESSION['id'];
    
    if(!empty($_POST['movie']) AND !empty($_POST['title'])) {
        // Values
        $data = ['authorID' => $user_id, 'movieID' => $movie, 'title' => $title];
        
        // Prepare request
        $prepare = $pdo->prepare('INSERT INTO articles (authorID, movieID, title) VALUES (:authorID, :movieID, :title)');

        $prepare->bindValue(':authorID', $data['authorID']);
        $prepare->bindValue(':movieID', $data['movieID']);
        $prepare->bindValue(':title', $data['title']);
        
        // Execute request
        $exec = $prepare->execute($data);

        header('Location: ./');
    }
}

$titles = [];
$paragraphs = [];

for($i = 0; $i < sizeof($_POST) - 1; $i++) {
    $title = $_POST['title'.$i];
    // Values
    $data = ['content' => $title];
    
    // Prepare request
    $prepare = $pdo->prepare('INSERT INTO paragraphs (content) VALUES (:content)');
    
    $prepare->bindValue(':content', $data['content']);
    
    // Execute request
    $exec = $prepare->execute($data);
    
    header('Location: ./');

    $paragraph = $_POST['paragraph'.$i];

    // Values
    $data = ['content' => $paragraph];
        
    // Prepare request
    $prepare = $pdo->prepare('INSERT INTO paragraphs (content) VALUES (:content)');

    $prepare->bindValue(':content', $data['content']);
    
    // Execute request
    $exec = $prepare->execute($data);

    header('Location: ./');
}


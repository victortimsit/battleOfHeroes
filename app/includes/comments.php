<?php 
include_once('session.php');
// include 'dataBase_connection.php';

if(!empty($_POST)) {
    global $writingArticleErrors;
    !empty($_POST['content']) ? $content = $_POST['content'] : $writingArticleErrors['comment'] = '--empty';
    !empty($_POST['articleID']) ? $articleID = $_POST['articleID'] : $writingArticleErrors['comment'] = '--empty';
    !empty($_POST['paragraphID']) ? $paragraphID = $_POST['paragraphID'] : $writingArticleErrors['comment'] = '--empty';
    !empty($_POST['date']) ? $date = $_POST['date'] : $writingArticleErrors['comment'] = '--empty';
    $authorID = $_SESSION['id'];
    
    if(!empty($_POST['content'])) {
        // Values
        $data = ['content' => $content, 'articleID' => $articleID, 'paragraphID' => $paragraphID, 'date' => $date, 'authorID' => $authorID];
        
        // Prepare request
        $prepare = $pdo->prepare('INSERT INTO comments (articleID, paragraphID, authorID, date, content) VALUES (:articleID, :paragraphID, :authorID, :date, :content)');

        $prepare->bindValue(':articlesID', $data['articlesID']);
        $prepare->bindValue(':paragraphID', $data['paragraphID']);
        $prepare->bindValue(':authorID', $data['authorID']);
        $prepare->bindValue(':date', $data['date']);
        $prepare->bindValue(':content', $data['content']);
        
        // Execute request
        $exec = $prepare->execute($data);

    }
}

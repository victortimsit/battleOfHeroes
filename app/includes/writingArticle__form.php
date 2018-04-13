<?php 
include_once('session.php');
include 'dataBase_connection.php';

if(!empty($_POST)) {
    global $writingArticleErrors;
    !empty($_POST['movie']) ? $movie = $_POST['movie'] : $writingArticleErrors['theory'] = '--empty';
    !empty($_POST['title']) ? $title = $_POST['title'] : $writingArticleErrors['theory'] = '--empty';
    // !empty($_POST['paragraph']) ? $paragraph = $_POST['paragraph'] : $writingArticleErrors['paragraph'] = '--empty';
    !empty($_POST['date']) ? $date = $_POST['date'] : $writingArticleErrors['theory'] = '--empty';
    $user_id = $_SESSION['id'];
    
    if(!empty($_POST['movie']) AND !empty($_POST['title'])) {
        // Values
        $data = ['authorID' => $user_id, 'movieID' => $movie, 'title' => $title, 'date' => $date];
        
        // Prepare request
        $prepare = $pdo->prepare('INSERT INTO articles (authorID, movieID, title, date) VALUES (:authorID, :movieID, :title, :date)');

        $prepare->bindValue(':authorID', $data['authorID']);
        $prepare->bindValue(':movieID', $data['movieID']);
        $prepare->bindValue(':title', $data['title']);
        $prepare->bindValue(':date', $data['date']);
        
        // Execute request
        $exec = $prepare->execute($data);

        for($i = 0; $i < sizeof($_POST); $i++) {
            !empty($_POST['content'.$i]) ? $content = $_POST['content'.$i] : $writingArticleErrors['theory'] = '--empty';
            // Values
            if(empty($writingArticleErrors)) {
                $data = ['content' => $content, 'date' => $date];
                
                // Prepare request
                $prepare = $pdo->prepare('INSERT INTO paragraphs (content, date) VALUES (:content, :date)');
                
                $prepare->bindValue(':content', $data['content']);
                $prepare->bindValue(':date', $data['date']);
                
                // Execute request
                $exec = $prepare->execute($data);
            
                header('Location: ./');
            }
        }
    }
}



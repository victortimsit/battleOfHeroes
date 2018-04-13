<?php 
include_once('session.php');
include 'dataBase_connection.php';

if(!empty($_POST)) {
    global $writingArticleErrors;
    !empty($_POST['movie']) ? $movie = $_POST['movie'] : $writingArticleErrors['theory'] = '--empty';
    !empty($_POST['title']) ? $title = $_POST['title'] : $writingArticleErrors['theory'] = '--empty';
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
            !empty($_POST['title'.$i]) ? $content = $_POST['title'.$i] : false;
            !empty($_POST['paragraph'.$i]) ? $content = $_POST['paragraph'.$i] : false;
            !empty($_POST['title'.$i]) ? $type = 'title' : false;
            !empty($_POST['paragraph'.$i]) ? $type = 'paragraph' : false;

            // Values
            if(!empty($_POST['title'.$i]) || !empty($_POST['paragraph'.$i])) {
                $data = ['content' => $content, 'type' => $type, 'date' => $date];
                
                // Prepare request
                $prepare = $pdo->prepare('INSERT INTO paragraphs (content, type, date) VALUES (:content, :type, :date)');
                
                $prepare->bindValue(':content', $data['content']);
                $prepare->bindValue(':type', $data['type']);
                $prepare->bindValue(':date', $data['date']);
                
                // Execute request
                $exec = $prepare->execute($data);

                header('Location: ./');
            }
        }
    }
}



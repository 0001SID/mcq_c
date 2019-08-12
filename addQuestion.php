<?php
    if(isset($_POST['submit'])){
        require "./db/connection.php";
        $chapter = htmlentities($_POST['chapter']);
        $question = htmlentities($_POST['question']);
        $code = htmlentities($_POST['code']);
        $answer = htmlentities($_POST['answer']);
        $explanation = htmlentities(($_POST['explanation']));
        $op1 = htmlentities($_POST['op1']);
        $op2 = htmlentities($_POST['op2']);
        $op3 = htmlentities($_POST['op3']);
        $op4 = htmlentities($_POST['op4']);
        
        $query = $conn->prepare('insert into questions(chapter,question,code,op1,op2,op3,op4,answer,explanation)
         values(:chapter,:question,:code,:op1,:op2,:op3,:op4,:answer,:explanation);');
        $query->bindValue(':chapter',$chapter);
        $query->bindValue(':question',$question);
        $query->bindValue(':code',$code);
        $query->bindValue(':op1',$op1);
        $query->bindValue(':op2',$op2);
        $query->bindValue(':op3',$op3);
        $query->bindValue(':op4',$op4);
        $query->bindValue(':answer',$answer);
        $query->bindValue(':explanation',$explanation);

        try{
            $query->execute();
            $result = true;
        }
        catch(PDOException $err){
            $result = false;
        }

        echo json_encode($result);

    }

?>
<?php
if(isset($_POST['submit'])){
    require "./db/connection.php";
    $questionQ = $conn->prepare("select * from questions where chapter = :chapter");
    $questionQ->bindValue(':chapter',htmlentities($_POST['chapterName']));
    $questionQ->execute();
    $questions = $questionQ->fetchAll();
    $res = 0;
    for($i = 0; $i<count($questions);$i++){ 
        if(isset($_POST['a'.($i+1)])){
            if($questions[$i]['answer'] == $_POST['a'.($i+1)]){
                $res++;
            }
        }
    }
    echo json_encode($res);

}
?>
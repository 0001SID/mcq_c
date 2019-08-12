<?php
if(isset($_POST['submit'])){
    require "./db/connection.php";
    $questionQ = $conn->prepare("select * from questions");
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
    echo $res;
}
?>
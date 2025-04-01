<?php
$conn = mysqli_connect("localhost", "root", "", "parikshak");
$qtitle = $_GET["quizTitle"];
$i1 = "INSERT INTO quizzes ('title') VALUES ('$qtitle')";
if (mysqli_query($conn, $i1)){
    $idquiz = mysqli_insert_id($conn);
$qc = count($_GET["question_text"]);
for($i = 0; $i < $qc; $i++){
    echo $_GET["question_text"][$i]."<br><br>";
    if ($_GET["question_type"][$i] == "MCQ"){
        for ($j = 0; $j < 4; $j++){
            echo $_GET['options'][$i+1][$j];
            if ($_GET['correct_option'][$i+1][$j+1] == 1){
                echo "&nbsp; Correct Option";
            }
            echo "<br>";
        }
    }else{
        echo $_GET["numerical_answer"][$i+1];
    }
    echo "<br><br>";
}
}
?>


<?php
    header('Access-Control-Allow-Origin: *');
    include "../connect/connect.php";
    include "../connect/session.php";
?>

<?php
    $QnAID = $_POST['myQnAID'];
    $myMemberID = $_SESSION['myMemberID'];

    $plusSql = "UPDATE myQnA SET isChoiced='yes' WHERE myMemberID=$myMemberID and myQnAID=$QnAID;";
    $result = $connect -> query($plusSql);
    
    if ($result) {
        $jsonResult = "good";
    }
    else {
        $jsonResult = "bad"; 
    }
    
    echo json_encode(array("result" => $jsonResult));
?>
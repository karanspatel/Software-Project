<?php
session_start();
header("Content-Type: application/json; charset=UTF-8");
$obj = json_decode($_GET["x"], false);

$conn = new PDO('mysql:host=127.0.0.1;dbname=ghostpost', "root", "");

if($obj->requestType == 1){
    $stmt = $conn->prepare("SELECT * FROM posts WHERE UniversityName= :u ORDER BY TimeAndDate DESC");
    $stmt->bindParam(':u', $obj->uni);
    $stmt->execute();
    $outp = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($outp);
}elseif ($obj->requestType == 2){
    $stmt = $conn->prepare("INSERT INTO posts(PostID, UniversityName, Content, Upvotes, Downvotes, TimeAndDate, UserID) 
                            VALUES (:pID, :UN,:C,:L,:D,:TD,:uID)");
    $stmt->bindParam(":pID", $obj->postId);
    $stmt->bindParam(":UN", $obj->uni);
    $stmt->bindParam(":C", $obj->content);
    $stmt->bindParam(":L", $obj->upvotes);
    $stmt->bindParam(":D", $obj->downvotes);
    $stmt->bindParam(":TD", $obj->timeAndDate);
    $stmt->bindParam("uID", $_SESSION['userID']);
    $stmt->execute();
}elseif($obj->requestType == 3){
    $stmt = $conn->prepare("SELECT * FROM users WHERE Email= :E AND Pswd= :P");
    $stmt->bindParam(':E', $obj->email_address);
    $stmt->bindParam(':P', $obj->password);
    $stmt->execute();
    $outp = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($outp);
}elseif($obj->requestType == 4){
    $_SESSION['email'] = $obj->email_address;
    $_SESSION['userID'] = $obj->user_id;
}elseif($obj->requestType == 5) {
    session_destroy();
    $_SESSION = array();
}elseif($obj->requestType == 6) {
    if(isset($_SESSION['email']) && !empty($_SESSION['email'])) {
        echo "continue";
    } else {
        echo "login";
    }
}elseif($obj->requestType == 7) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE Email= :E");
    $stmt->bindParam(':E', $obj->Email);
    $stmt->execute();
    $outp = $stmt->rowCount();
    if($outp == 0) {
        $stmt = $conn->prepare("INSERT INTO users(UserID, Email, Pswd) 
                            VALUES (:u,:E,:P)");
        $stmt->bindParam(":u", $obj->UserID);
        $stmt->bindParam(":E", $obj->Email);
        $stmt->bindParam(":P", $obj->Pswd);
        $stmt->execute();
        echo "Success";
    } else {
        echo "Failure";
    }
}elseif($obj->requestType == 8) {
    $stmt = $conn->prepare("SELECT * FROM posts WHERE UserID= :u ORDER BY TimeAndDate DESC");
    $stmt->bindParam(':u', $_SESSION['userID']);
    $stmt->execute();
    $outp = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($outp);
}elseif($obj->requestType == 9) {
    $stmt = $conn->prepare("UPDATE posts SET Upvotes = Upvotes+1 WHERE PostID = :pID");
    $stmt->bindParam(':pID', $obj->postID);
    $stmt->execute();
   
}elseif($obj->requestType == 10) {
    $stmt = $conn->prepare("UPDATE posts SET Downvotes = Downvotes+1 WHERE PostID = :pID");
    $stmt->bindParam(':pID', $obj->postID);
    $stmt->execute();
}



?>

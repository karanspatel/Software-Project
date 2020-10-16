<?php
    header("Content-Type: application/json; charset=UTF-8");
    $obj = json_decode($_GET["x"], false);

    $conn = new mysqli("127.0.0.1", "root", "", "GhostPost");

    //requestType 1 is simply to check if the database connected.
    if($obj->requestType == 1) {
        echo "Succeeded";
    } elseif($obj->requestType == 2) { //2 is to check if something was inserted correctly. 
        $stmt = $conn->prepare("INSERT INTO Posts(PostID, UniversityName, Content, Likes, Dislikes, TimeAndDate) 
                            VALUES (:pID,:UN,:C,:L,:D,:TD)");
        $stmt->bindParam(":pID", 333);
        $stmt->bindParam(":UN", "East Carolina University");
        $stmt->bindParam(":C", "Test");
        $stmt->bindParam(":L", 3);
        $stmt->bindParam(":D", 2);
        $stmt->bindParam(":TD", "10/13/15");

        if($stmt->execute()) {
            echo "Insertion successful";
        } else {
            echo "Insertion failed";
        }
    }
    
    
?>
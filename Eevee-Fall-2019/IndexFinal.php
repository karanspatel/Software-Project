<?php
    session_start();
?>

<!doctype html>

<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- External JavaScript -->
    
    <title>Ghost Post</title>
</head>

<body>
    

    <script>
        function previous_logon() {
            obj = {
                "requestType": 6
            };

            dbParam = JSON.stringify(obj);
            xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    serverResponse = this.responseText;
                    console.log(serverResponse);
                    //var userFromDatabase = JSON.parse(serverResponse);

                    if(serverResponse != "continue") {
                        window.alert("Please log in");
                        window.location.replace("loginPage.php");
                    }
                }
            };

            

            xmlhttp.open("GET", "scripts/RequestScript.php?x=" + dbParam, false);
            xmlhttp.send();
        } 
        previous_logon();
    </script>

    <div align="center" style="padding-top: 15px; padding-bottom: 50px;">
        <h1 class="display-1">Ghost<small class="text-muted">post</small></h1>
    </div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

    <div>
    </div>
    <div class="container-fluid gedf-wrapper">
        <div class="row justify-content-center">
            <div class="col-md-6 gedf-main">
                <p align="center" style="font-weight: bold">Welcome, <?php echo $_SESSION['email'];?></p>
                <div class="dropdown text-center" style="padding-bottom: 30px;">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select Your School...
                    </button>
                    <button id="logout"  class="btn btn-secondary" type="button" onclick=logout()>
                            Logout
                    </button>
                    <button id="get_my_posts"  class="btn btn-secondary" type="button" onclick=aggregate_user_posts()>
                        My Posts
                    </button>
                    <div id="uniOptions" class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" id="ECU" href="#">East Carolina University</a>
                        <a class="dropdown-item" href="#">Clemson</a>
                    </div>
                </div>
                <!---Start Post Box-->
                <div id="post_box" class="card gedf-card">

                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="posts" role="tabpanel"
                                aria-labelledby="posts-tab">
                                <div class="form-group">
                                    <label class="sr-only" for="message">post</label>
                                    <textarea class="form-control" style="resize: none;" id="message" rows="3"
                                        placeholder="Got some drama? Post it..."></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="btn-toolbar justify-content-end">
                            <div class="btn-group">
                                <button id="post_btn" type="submit" class="btn btn-secondary">
                                    <h3
                                        style="padding-right: 40px; padding-left: 40px; padding-top: 3px; font-size: 14pt;">
                                        Post</h6>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Post Box-->


                <ul id="post_feed" class="list-group">
                </ul>

                <script src="scripts/Main.js"></script>
                <script>
                    function logout() {
                        obj = {
                            "requestType": 5
                        };

                        dbParam = JSON.stringify(obj);
                        xmlhttp = new XMLHttpRequest();

                        xmlhttp.open("GET", "scripts/RequestScript.php?x=" + dbParam, false);
                        xmlhttp.send();

                        window.location.reload(false);
                    }
                    function aggregate_user_posts() {
                        var obj, dbParam, xmlhttp, serverResponse;

                        obj = {
                            "requestType": 8
                        };

                        dbParam = JSON.stringify(obj);
                        xmlhttp = new XMLHttpRequest();

                        var postList = document.getElementById("post_feed");
                        postList.innerHTML = "";


                        xmlhttp.onreadystatechange = function () {
                            if (this.readyState == 4 && this.status == 200) {
                                serverResponse = this.responseText;

                                var postsFromDatabase = JSON.parse(serverResponse);

                                postsArray = Object.entries(postsFromDatabase);
                                console.log(postsArray);

                                for (var i = 0; i < postsArray.length; i++) {

                                    var li = document.createElement("li");
                                    li.className = "list-group-item";
                                    li.innerHTML = postHtmlGen(postsArray[i][1].Content, postsArray[i][1].TimeAndDate);
                                    postListRef.appendChild(li);

                                }


                            }
                        };

                        xmlhttp.open("GET", "scripts/RequestScript.php?x=" + dbParam, true);
                        xmlhttp.send();
                    }
                </script>

                



            </div>

        </div>
    </div>


</body>

</html>

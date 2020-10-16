document.getElementById("post_box").style.display = "none";
var postBtn = document.getElementById("post_btn");
$(postBtn).prop("disabled", true);


var textarea = document.getElementById("message");

textarea.addEventListener('input', hideOnEmpty);

function hideOnEmpty() {
    var text = this.value;
    if (text !== '') {
        $(postBtn).prop("disabled", false);

    } else {
        $(postBtn).prop("disabled", true);
    }
}



var uniList = document.getElementById('uniOptions');

var request = new XMLHttpRequest();
request.open("GET", "Universities.json", false);
request.send(null);
var universitiesFile = JSON.parse(request.responseText);

for (let i = 0; i < universitiesFile.length; ++i) {
    $(uniList).append('<a class="dropdown-item">' + universitiesFile[i].university + '</a>');
}


var postsArray;
//Utility functions
function uuidv4() {
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
        var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
        return v.toString(16);
    });
}

function setVariables(email_address, userID) {
    obj = {
        "email_address": email_address,
        "user_id": userID,
        "requestType": 4
    }

    dbParam = JSON.stringify(obj);
    xmlhttp = new XMLHttpRequest();

    xmlhttp.open("GET", "scripts/RequestScript.php?x=" + dbParam, true);
    xmlhttp.send();
}

function login() {
    // Here should probably be a check to see if the email address is valid.
    // Check to make sure an email and a password have been entered 
    var email_address = document.getElementById("email_address").value;
    var password = document.getElementById("password").value;
    
    var serverResponse, userID;

    var serverResponse, userID;


    var result;

    obj = {
        "email_address": email_address,
        "password": password,
        "requestType": 3
    };
    dbParam = JSON.stringify(obj);
    xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            serverResponse = this.responseText;
            console.log(serverResponse);
            var userFromDatabase = JSON.parse(serverResponse);

            var userArray = Object.entries(userFromDatabase);

            if(userArray.length > 0) {
                // The user was found
                result = true;
                userID = userArray[0][1].UserID;

            } else {
                result = false;
            }
        }
    };

    xmlhttp.open("GET", "scripts/RequestScript.php?x=" + dbParam, false);
    xmlhttp.send();

    if(result) {
        setVariables(email_address, userID);
    }
    console.log(result);
    return result;
    
}

function register() {
    // Here should probably be a check to see if the email address is valid.
    // Check to make sure an email and a password have been entered 
    var email_address = document.getElementById("email_address").value;
    var password = document.getElementById("password").value;
    
    var serverResponse;

    
    var result;

    obj = { 
        "UserID": uuidv4(),
        "Email": email_address,
        "Pswd": password,
        "requestType": 7
    };
    dbParam = JSON.stringify(obj);
    xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            serverResponse = this.responseText;

            console.log(serverResponse);

            if(serverResponse == "Success") {
               // console.log(userArray);
                // The user was found
                result = true;
                // make another call to php, this time assigning the
                // session variables. 

            } else {
                // console.log("here2");
                result = false;
            }
        }
    };

    xmlhttp.open("GET", "scripts/RequestScript.php?x=" + dbParam, false);
    xmlhttp.send();

    // Currently, result is sent back before onreadstatechange function is run
    // this leads to the value undefined being sent back. 

    console.log(result);
    return result;
}

function postHtmlGen(content, timeAndDate, postID, upvotes, downvotes) {
    return `<div class="card gedf-card>
        <div class="card-body">
            <p style="padding-left: 15px; padding-top: 10px" class="card-text">`
                +content+
            `</p>
        <div class="text-muted h7 mb-2"> <i style="padding-left: 15px"class="fa fa-clock-o"></i>` + timeAndDate + `</div>
        <div class="card-footer">
            <a style="cursor:pointer" onclick = "upvoteFunction(&#39;`+postID+`&#39;)" class="card-link text-success"><i class="fa fa-gittip"></i>Upvote <span class="badge">`+upvotes+`</span></a>
            <a style="cursor:pointer" onclick = "downvoteFunction(&#39;`+postID+`&#39;)" class="card-link text-danger"><i class="fa fa-mail-forward"></i>Downvote <span class="badge">`+downvotes+`</span></a>
            
        </div>`;
    //<a style="cursor:pointer" id="reportBtn" <span class="label label-warning">Report!</span></a>
}


function upvoteFunction(postID) {
    var obj, dbParam, xmlhttp;
    obj = {
        "postID": postID,
        "requestType": 9
    };
    dbParam = JSON.stringify(obj);
    xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "scripts/RequestScript.php?x=" + dbParam, true);
    xmlhttp.send();

    repopFeed(currentUniSelection);


}

function downvoteFunction(postID) {
    var obj, dbParam, xmlhttp;
    obj = {
        "postID": postID,
        "requestType": 10
    };
    dbParam = JSON.stringify(obj);
    xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "scripts/RequestScript.php?x=" + dbParam, true);
    xmlhttp.send();

    repopFeed(currentUniSelection);

}




function repopFeed(selectedItem) {
    var obj, dbParam, xmlhttp, selectedItem, serverResponse;

    var postList = document.getElementById("post_feed");
    postList.innerHTML = "";


    obj = { "uni": selectedItem, "requestType": 1 };
    dbParam = JSON.stringify(obj);
    xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            serverResponse = this.responseText;

            var postsFromDatabase = JSON.parse(serverResponse);

            postsArray = Object.entries(postsFromDatabase);
            console.log(postsArray);

            for (var i = 0; i < postsArray.length; i++) {

                var li = document.createElement("li");
                li.className = "list-group-item";
                li.innerHTML = postHtmlGen(postsArray[i][1].Content, postsArray[i][1].TimeAndDate, postsArray[i][1].PostID, postsArray[i][1].Upvotes, postsArray[i][1].Downvotes);
                postListRef.appendChild(li);

            }


        }
    };
    xmlhttp.open("GET", "scripts/RequestScript.php?x=" + dbParam, true);
    xmlhttp.send();
}


//End utility functions



var currentUniSelection;


var postListRef = document.querySelector("ul");
$('.dropdown-menu a').click(function () {
    $('#dropdownMenuButton').text($(this).text());
    document.getElementById("post_box").style.display = "block";

    currentUniSelection = $(this).text();
    console.log(currentUniSelection);
    //After selection of school populate list
    repopFeed(currentUniSelection);

})

var postBtn = document.getElementById("post_btn");

postBtn.addEventListener("click", function () {
    $(postBtn).prop("disabled", true);
    var postText = document.getElementById("message").value;

    document.getElementById("message").value = "";

    var obj, dbParam, xmlhttp;
    obj = {
        "uni": currentUniSelection, "postId": uuidv4(),
        "content": postText, "upvotes": 0,
        "downvotes": 0, "timeAndDate": new Date(),
        "requestType": 2
    };
    dbParam = JSON.stringify(obj);
    xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "scripts/RequestScript.php?x=" + dbParam, true);
    xmlhttp.send();

    repopFeed(currentUniSelection);

})

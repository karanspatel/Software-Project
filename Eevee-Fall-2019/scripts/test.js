function sleep(milliseconds) {
    var start = new Date().getTime();
    for (var i = 0; i < 1e7; i++) {
        if ((new Date().getTime() - start) > milliseconds){
            break;
        }
    }
}

function connectToDatabase() {
    var display = document.getElementById("connect_to_database");
    var obj = {"requestType": 1};
    var dbParam = JSON.stringify(obj);

    xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "scripts/test.php?x=" + dbParam, true);
    xmlhttp.send();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            var response = this.responseText;

            if(response != "Succeeded") {
                display.innerHTML = "Connected to GhostPost database: ".concat("Failed");
            }
            else {
                display.innerHTML = "Connected to GhostPost database: ".concat("Succeeded");
            }
        } 
    }
}

function insertIntoDatabase() {
    var display = document.getElementById("insert_into_database");
    var response;

    var obj = {
        "uni": "East Carolina University", 
        "postId": 696969,
        "content": "Test", 
        "likes": 0,
        "dislikes": 0,
        "timeAndDate": new Date(),
        "requestType": 2
    };
    var dbParam = JSON.stringify(obj);

    xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "scripts/test.php?x=" + dbParam, true);
    xmlhttp.send();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            response = this.responseText;
            if(response.includes("Insertion successful")) {
                display.innerHTML = "Insertion into GhostPost database: ".concat("Succeeded");
            }
            else {
                display.innerHTML = "Insertion into GhostPost database: ".concat("Failed");
            }
        } 
    }
}

function removeFromDatabase() {
    var display = document.getElementById("remove_from_database");
    var response;

    var obj = {"requestType": 3};
    var dbParam = JSON.stringify(obj);

    xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "scripts/test.php?x=" + dbParam, true);
    xmlhttp.send();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            response = this.responseText;
            if(!response.includes("Removal successful")) {
                display.innerHTML = "Removal from GhostPost database: ".concat("Failed");
            }
            else {
                display.innerHTML = "Removal from GhostPost database: ".concat("Succeeded");
            }
        } 
    }
}

function validateInsertAndRemove() {
    var display = document.getElementById("validate_insert_and_remove");
    var response;

    var obj = {
        "uni": "East Carolina University", "postId": 563456345,
        "content": "Content for the post", "likes": 0,
        "dislikes": 0, "timeAndDate": new Date(),
        "requestType": 4
    };
    var dbParam = JSON.stringify(obj);

    xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "scripts/test.php?x=" + dbParam, true);
    xmlhttp.send();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            response = this.responseText;
            display.innerHTML = response;
        }
    }
    
}

function runTests() {
    connectToDatabase();
    insertIntoDatabase();
    removeFromDatabase();
    validateInsertAndRemove();
}
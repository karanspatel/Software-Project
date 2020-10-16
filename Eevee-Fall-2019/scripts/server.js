var express = require('express');
var app = express();
var path = require('path');
var con = null;
var mysql = require('mysql');
var postArray;



function create_UUID(){
    var dt = new Date().getTime();
    var uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
        var r = (dt + Math.random()*16)%16 | 0;
        dt = Math.floor(dt/16);
        return (c=='x' ? r :(r&0x3|0x8)).toString(16);
    });
    return uuid;
}

// viewed at http://localhost:8080
app.get('/', function (req, res) {
    res.sendFile(path.join(__dirname + '/indexFinal.html'));
});

app.listen(8080);

if (con == null) {
    con = mysql.createConnection({
        host: "localhost",
        user: "root",
        password: "connor97",
        database: "GhostPost"
    })

    con.connect(function (err) {
        if (err) console.log('Error');//throw err;
        else console.log("Connected");
    })

    postArray = returnAllPosts();
    console.log(postArray);
}




function closeConnection() {
    console.log("Connection closed");
    con.end();
    con = null;
}

function returnAllPosts() {
    var toReturn;
    con.query("SELECT * FROM Posts", function (err, result, fields) {
        if (err) throw err;
        toReturn = result;
        console.log(result);
    });
    return toReturn;
}


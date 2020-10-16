var button = document.getElementById('post_btn');

function replaceWords(event) {
    //Prevent form submission to server 
    event.preventDefault();
    var commentContent = document.getElementById('comments');
    var badWords = ["ass", "damn", "shit", "fuck", "asshole", "piss", "bastard"];
    var censored = censore(commentContent.value, badWords);
    commentContent.value = censored;
}

function censore(string, filters) {
    // "i" is to ignore case and "g" for global "|" for OR match
    var regex = new RegExp(filters.join("|"), "gi");
    return string.replace(regex, function (match) {
        //replace each letter with a star
        var stars = '';
        for (var i = 0; i < match.length; i++) {
            stars += '*';
        }
        return stars;
    });

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

$('.message b').click(function(){
   $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});
$(".message-list").animate({ scrollTop: $(".message-list").prop("scrollHeight")}, 1000);

// If user wants to end session
$(".message-user__leave a").click(function(){
    var exit = confirm("Are you sure you want to end the session?");
    if(exit==true){window.location = 'index.php?logout=true';}		
});

//Load the file containing the chat log
var loadLog = function() {		
    
    $.ajax({
        url: "log.html",
        cache: false,
        success: function(html){		
            $(".message-list").html(html); //Insert chat log into the #chatbox div
        },
    });
}

// Post Message
var postMessage = function() {
    var messageInput = $('.message-input textarea');
    
    if (messageInput.val()) {
        $.post("post.php", {text: messageInput.val()});
        messageInput.val('');
        return false;

        Push.create("Hello world!", {
            body: "How's it hangin'?",
            timeout: 4000,
            onClick: function () {
                window.focus();
                this.close();
            }
        });
        
    }
}

$('.message-input button').click(function (){
    postMessage();
    loadLog();
    $(".message-list").delay(600).queue(function(next) {$(this).animate({ scrollTop: $(".message-list").prop("scrollHeight")}, 1000); next(); });
    
});

$('.message-input').keypress(function(e) {
    if(e.which == 13) {
        e.preventDefault();
        postMessage();
        loadLog();
        $(".message-list").delay(600).queue(function(next) {$(this).animate({ scrollTop: $(".message-list").prop("scrollHeight")}, 1000); next(); });
    }
});

//setInterval (loadLog, 250);
<?php session_start(); ?>
<?php 
    if(isset($_GET['logout'])){ 

        //Simple exit message
        $fp = fopen("log.html", 'a');
        fwrite($fp, "<div class='message-line'><em>". $_SESSION['name'] ." has left the chat session.</em></div>");
        fclose($fp);

        session_destroy();
        header("Location: index.php"); //Redirect the user
    } 
?>

<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messenger Web Chat</title>
    <link rel="stylesheet" href="assets/dist/css/main.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
</head>

<body>

    <?php function loginForm() {
        echo '
        <div id="loginform">
            <form action="index.php" method="post">
                <h1>Messenger</h1>
                <input type="text" name="name" id="name" placeholder="Please type your name" />
                <input type="submit" name="enter" id="enter" value="Enter" />
            </form>
        </div>';
    } ?>

    <?
    if(isset($_POST['enter'])){
        if($_POST['name'] != ""){
            $_SESSION['name'] = stripslashes(htmlspecialchars($_POST['name']));
        }
        else {
            echo '<span class="error">Please type in a name</span>';
        }
    }
    ?>
    
    <?php if(!isset($_SESSION['name'])) {
            loginForm();
        } else { 
        //Simple enter message
        $fp = fopen("log.html", 'a');
        fwrite($fp, "<div class='message-line--joined'><em>". $_SESSION['name'] ." has joined the chat session.</em></div>");
        fclose($fp);
    ?>
    
        <div id="messenger">
          <div class="message-user">
            <span class="message-user__img"><i class="fa fa-user"></i></span>
            <span class="message-user__name"><?php echo $_SESSION['name']; ?></span>
            <span class="message-user__leave"><a href="#">Leave Chat</a></span>
          </div>

          <div class="message-window">
              <ul class="message-list">
                <?php
                    if(file_exists("log.html") && filesize("log.html") > 0){
                        $handle = fopen("log.html", "r");
                        $contents = fread($handle, filesize("log.html"));
                        fclose($handle);

                        echo $contents;
                    }
                ?>
              </ul>
          </div>

          <div class="message-input">
            <textarea placeholder="Type your message here"></textarea>
            <button>Send</button>
          </div>

        </div>
    
    <?php } ?>
    
    
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="assets/src/js/push.min.js"></script>
    <script src="assets/src/js/message.js"></script>
</body>
</html>

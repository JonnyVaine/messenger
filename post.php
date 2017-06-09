<?
session_start();
if(isset($_SESSION['name'])){
    $text = $_POST['text'];
     
    $fp = fopen("log.html", 'a');
    fwrite($fp, "<li class='message-bubble' data-time='".date("g:i A")."'><strong>".$_SESSION['name']."</strong>: ".stripslashes(htmlspecialchars($text))."</li>");
    fclose($fp);
}
?>
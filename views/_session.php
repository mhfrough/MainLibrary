<?php if($_SESSION['name'] == "mhfrough"){ ?>
<div class="currrent-session">
<h4>Current Session</h4>
<?php
$data = "".php_uname()."<br/>".browser()." ".$_SERVER["SERVER_NAME"]." ".$_SERVER["REMOTE_ADDR"]." ".date ("l t, Y - H:i")."";
echo ($data."<br/>Disk space: ".bytes(disk_total_space("/"))."/ ".bytes(disk_free_space("/"))."<br/></br/>");
?>
</div>
<div class="previous-session">
<h4>Previous Session</h4>
<form method="post" enctype="multipart/form-data" action="?login=yes"><input class="unlink" type="submit" name="unlink" value="logdata.txt"/></form>
<?php
$dir = "./stored/";
$file_x = $_POST["unlink"];
    if(isset($file_x)){
        unlink($dir . "" . $file_x);
        logdata($file_x, "unlink:");}
if($_SESSION['name'] == "mhfrough"){
    logdata($data,"");
    $myfile = fopen("./stored/logdata.txt", "r") or die("Unable to open file!");
    echo fread($myfile,filesize("./stored/logdata.txt"));
    fclose($myfile);}
if($_GET["login"] == no){
    logdata("","Logout");}
?>
</div>
<?php } else{ header("Location: /index.php"); } ?>
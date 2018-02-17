<?php
session_start();
$password = "852dc5f99baaf9023e8c4f2671ac9895b95b8762";
if($password == sha1(stripslashes(preg_replace('/[^A-Za-z0-9\-]/', '',$_POST["password"])))){ $_SESSION['name'] = "mhfrough"; }
if (isSet($_SESSION["time"])){
    if((mktime() - $_SESSION["time"] - 60 * 10) > 0){
       session_destroy(); }}
else{$_SESSION["time"] = mktime();}
function logdata($filename,$logtype){
    $myfile = fopen("./stored/logdata.txt", "a") or die("can't open file");
    $existingText = file_get_contents($myfile);
    $zippost = $logtype." ".$filename." at ".date ("l t, Y - H:i")."<br/><br/>";
    fwrite($myfile, $existingText. PHP_EOL.$zippost);
    fclose($myfile);}
function bytes($size) {
    $mod = 1024;
    $units = explode(' ','B KB MB GB TB PB');
    for ($i = 0; $size > $mod; $i++) {
        $size /= $mod;}
    return round($size, 2) . ' ' . $units[$i];}
function browser(){
    $ExactBrowserNameUA=$_SERVER['HTTP_USER_AGENT'];
    if (strpos(strtolower($ExactBrowserNameUA), "safari/") and strpos(strtolower($ExactBrowserNameUA), "opr/")) {$ExactBrowserNameBR="Opera"; }
    elseIf (strpos(strtolower($ExactBrowserNameUA), "safari/") and strpos(strtolower($ExactBrowserNameUA), "chrome/")) {$ExactBrowserNameBR="Chrome";}
    elseIf (strpos(strtolower($ExactBrowserNameUA), "msie")) { $ExactBrowserNameBR="Internet Explorer"; }
    elseIf (strpos(strtolower($ExactBrowserNameUA), "firefox/")) {$ExactBrowserNameBR="Firefox";}
    elseIf (strpos(strtolower($ExactBrowserNameUA), "safari/") and strpos(strtolower($ExactBrowserNameUA), "opr/")==false and strpos(strtolower($ExactBrowserNameUA), "chrome/")==false) {$ExactBrowserNameBR="Safari";  }
    else {$ExactBrowserNameBR="OUT OF DATA";}
    return $ExactBrowserNameBR;}
?>
<!DOCTYPE html>
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta content="MetaLibrary" name="og:title"/>
        <meta content="http://www.metalibrary.ml/" name="og:url"/>
        <meta content="Download, Like and Share Programing Codes with MainLibrary" name="og:description"/>
        <meta name="description" content="MainLibrary - Shared data and Programming Codes"/>
        <meta name="robots" content="NOODP"/>
        <meta name="googlebot" content="NOODP"/>
        <meta name="keywords" content="Code,Programming,DLL,HTML,CSS,XML,JavaScript,Shared"/>
        <meta name="author" content="Mohammad Hamza"/>
        <meta name="language" content="English"/>
        <meta http-equiv="refresh" content="180"/>
        <link rel="icon" href="/drawable/mainlibrary.ico" />
        <link rel="stylesheet" href="/assets/css/style.min.css" />
        <script type="text/javascript" src="/assets/js/jquery.js"></script>
        <script type="text/javascript" src="/assets/js/script.js"></script>
        <title>MainLibrary<?php echo " - $pagetitle"; ?></title>
    </head>
    <body>
        <?php include_once("../../analyticstracking.php") ?>
        <nav>
            <span class="logo">
                <a href="../index.php"><strong>main</strong>library</a>
            </span>
            <a href="javascript:void();" onclick="$('nav ul').slideToggle();">
                <img class="menu" src="/drawable/menu.png" alt="menu" />
            </a>
            <ul>
                <li><a href="../index.php">home</a></li>
                <li><a href="../stored/stored.php">share</a></li>
                <li><a href="../github.php">github</a></li>
                <?php if($_SESSION['name'] == "mhfrough"){ ?>
                <li><a href="../panel.php">panel</a></li>
                <li><a href="../session.php#bottom">session</a></li>
                <?php } ?>
            </ul>
            <?php if($_SESSION['name'] != "mhfrough"){ ?>
            <a class="log" href="javascript:void();" onclick="$('.logform').slideToggle();">log<strong>in</strong></a>
            <?php } else { if($_GET["login"] == no) { session_destroy(); header("Refresh:0");} ?>
            <a href="?login=no" class="log">logout<strong class="menu-short"><?php echo($_SESSION["name"]); }?> </strong></a>
        </nav>
        <div class="content">
            <header>
                <h1><?php echo "$pagetitle"; ?></h1>
            </header>
            <?php if($_SESSION['name'] != "mhfrough"){ ?>
            <div class="logform">
                <form method="post" enctype="multipart/form-data" action="?login=yes">
                    <input type="password" name="password" placeholder=" Authorized Password" />
                </form>
            </div>
            <?php } include($pagecontent); ?>
            <div class="footer">
                <p>Copyright &#169;<script type="text/javascript">document.write(new Date().getFullYear())</script> <strong>Main</strong>Library theme, Design by <a href="http://www.mainlibrary.ml" rel="dct:creator"><span title="dct:title">Mohammad Hamza</span></a></p>
            </div>
            <div id="bottom"></div>
        </div>
    </body>
</html>
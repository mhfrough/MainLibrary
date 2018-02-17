<?php
$dir = $_SERVER['DOCUMENT_ROOT'] . "/stored/";
$myDirectory = opendir('.');
while($entryName = readdir($myDirectory)) {$dirArray[] = $entryName;} closedir($myDirectory);
$indexCount = count($dirArray);
usort($dirArray,NULL);
for($index=0; $index < $indexCount; $index++){
    if (substr("$dirArray[$index]", 0, 1) != "."){
        $zip  =  zip_open($dirArray[$index]);
        if(is_resource($zip)){
            echo str_replace(".zip","","<div class=\"post\" onclick=\"$(&quot;.entry$index, .comment$index&quot;).slideToggle();\" ><h4><a href=\"#$dirArray[$index]\">$dirArray[$index]</a><pre> ".date ("l t, Y", filemtime($dirArray[$index]))."");
            if($_SESSION['name'] == "mhfrough"){ echo "    file size ".bytes(filesize($dirArray[$index])).""; }
            echo "    <a href=\"$dirArray[$index]\">Download</a></pre></div>";
            $zip = zip_open($dirArray[$index]);
            if ($zip){
                echo "<style>.entry$index {display:none; padding:16px; background:#fff;border:1px solid #eee;}</style>";
                echo "<div class=\"entry$index\">";
                $co = "";
                while ($zip_entry = zip_read($zip)){
                    if (zip_entry_open($zip, $zip_entry)){
                        $contents = zip_entry_read($zip_entry,9999);
                        $co =$contents;
                        echo nl2br( htmlspecialchars($contents));
                        zip_entry_close($zip_entry);}}
                zip_close($zip);
                echo "</div>";}}}}
?>
<?php if($_SESSION['name'] == "mhfrough"){ ?>
<div class="editor">
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="title" placeholder=" Filename" />
        <textarea name="code-post"></textarea>
        <input type="text" name="delete" placeholder=" Delete file" list="delete"/>
        <datalist id="delete">
        <?php
            foreach (glob("*stored/*") as $filename) {
                $zip  =  zip_open($filename);
                $filetext = str_replace(".zip","",$filename);
                if(is_resource($zip)){
                    echo"<option label=\"$filename\">".str_replace("stored/","",$filetext)."</option>";
                }
            }
        ?>
        </datalist>
        <input type="file" name="file[]" id="file" multiple="multiple"/>
        <input type="submit" name="submit"/>
    </form>
</div>
<div class="echo">
<?php
    $dir = "./stored/";
    if (isset($_POST["submit"])) {
        $zip = new ZipArchive;
        $res = $zip->open($dir . "" . $_POST["title"].".zip", ZipArchive::CREATE);
        if ($res === true) {
            $zip->addFromString($_POST["title"].".txt", $_POST["code-post"]);
            $zip->close();
            if($_POST["title"].".zip" != ".zip"){
                logdata($_POST["title"], "Post:");
                echo "Post file: ".$_POST["title"]."<br/>Size:".($_POST["title"]/1024)." kB<br/>";}}
        $total = count($_FILES['file']['name']);
        for($i=0; $i<$total; $i++) {
            $tmpFilePath = $_FILES['file']['tmp_name'][$i];
            if ($tmpFilePath != ""){
                $newFilePath = $dir. "" . $_FILES['file']['name'][$i];
                echo "Stored file: ".$_FILES["file"]["name"][$i]."<br/>Size:".($_FILES["file"]["size"][$i]/1024)." kB<br/>";
                if(move_uploaded_file($tmpFilePath, $newFilePath)) {}}}
        $file_x = $_POST["delete"].".zip";
        if(isset($file_x)){
            unlink($dir . "" . $file_x);
            logdata($file_x, "Delete:");
            echo "Delete: ".$file_x."";}}
    else{echo "Nothing to display";}
?>
</div>
<?php } else{ header("Location: /index.php"); } ?>
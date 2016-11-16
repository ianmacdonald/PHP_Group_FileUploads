
<?php

function uploadFile() {
    // Check for all fields selected
    if (!empty($_FILES['fileToUpload']['name']) && !empty($_REQUEST['upload_directory']) && 
        !empty($_REQUEST['upload_form_submit'])) {
        $target_file = basename($_FILES["fileToUpload"]["name"]);
        $target_Path = $_REQUEST['upload_directory'] . "/$target_file";
        $uploadSuccessful = 1;
        // getting filetype if we want to do something with this later
        $fileType = pathinfo($target_file, PATHINFO_EXTENSION);


        // Check file size and return message if too large
        if ($_FILES["fileToUpload"]["size"] > 1000000) {
            $uploadState = "Sorry, your file is too large.";
            $uploadSuccessful = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            $uploadState = "Sorry, file already exists.";
            $uploadSuccessful = 0;
        }

        // Check for any errors
        if ($uploadSuccessful == 0) {
            $uploadState = "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $uploadState = "The file " . basename( $_FILES["fileToUpload"]["name"]) . " has been uploaded to " . $_REQUEST['upload_directory'];
            } else {
                $errorCode = error_code($_FILES["fileToUpload"]["error"]);
                $uploadState = "Sorry, there was an error uploading your file." . $errorCode;
            }
        }
    }
    return $uploadState;
}

?>

<!--
/**************************************************************************************** 
The following code borrows from: 
http://hills.ccsf.edu/~kfreedma/cs130a/examples/filesupload.php 

This function displays the file upload form 
****************************************************************************************/ 
-->

<?php
    function upload_form ($path,$msg="") { 


        <form enctype='multipart/form-data'  
               action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]); ?>" method='POST'> 

            <fieldset> 
                <legend>Upload File</legend> 
                  <span class="label">File to upload (max 1 MB):</span> 
                  <input type="hidden" name="MAX_FILE_SIZE" value="1000000"> 
                  <input name='fileToUpload' type='file'/><br><br> 
                  <span class="label">Upload directory:</span> 
                    <select name='upload_directory'> 
                        <?php echo build_directory_select_box($path, 'upload_directory'); ?> 
                   </select><br><br> 
              <input type='submit' name='upload_form_submit' value='Upload File'/> 
            <p class="msg"><?php echo $msg ?></p> <!-- display status or error msg --> 
          </fieldset> 
        </form> 
    <?php 
    } //end upload_file 
?>
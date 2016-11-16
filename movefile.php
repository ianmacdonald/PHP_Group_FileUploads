<?php
    function movefile_form () { 


        <form enctype = 'multipart/form-data'  
        action = "<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]); ?>" method="POST"> 

        <fieldset> 
            <legend>Move File</legend> 
                <span class="label">File to Move:</span>
                <input name='fileToMove' type='file'/><br><br> 
                <span class="label">Target directory:</span> 
                <select name="target_directory"> 
                    <?php echo build_directory_select_box($path, 'target_directory'); ?> 
                </select><br><br> 
            <input type='submit' name='upload_form_submit' value='Upload File'/> 
            <p class="msg"><?php echo $msg ?></p> <!-- display status or error msg --> 
        </fieldset> 
        </form>  
    }} //end upload_file 
?>



<?php
                            
function buildFilelist() {
    // not sure how we will set "current_directory"
    $dir = $_REQUEST['current_directory'];
    $files = scandir($dir, 1);
    
    foreach ($files as $value) {
        echo <option value="$value">$value</option>;
    }
}
    
function moveFile() {
    //variables for both selected dir and target dir
    $selectedDir = ;
    $targetDir = ;

    //Create a directory list of each file in directory
}


?>
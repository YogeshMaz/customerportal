<div class="row justify-content-center" style="display:none;" id="testform">
    <div class="col-xl-6 col-lg-12 col-md-9 p-4 mb-2">
        <form action="test_form_data.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Upload File" name="submit">
        </form>
    </div>
</div>
<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Check if file was uploaded without errors
    if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == 0) {
        
        $targetDir = "uploads/"; // Directory where you want to store uploaded files
        $targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]); // Path of the uploaded file
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION)); // File extension

        // Check if file already exists
        if (file_exists($targetFile)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size (optional)
        if ($_FILES["fileToUpload"]["size"] > 500000) { // Adjust size as necessary
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats (optional)
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) { // Adjust formats as necessary
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            // If everything is ok, try to upload file
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "No file uploaded or an error occurred.";
    }
}
?>

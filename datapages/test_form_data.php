<?php
include '../header.php';
include '../nav.php';
include '../footer.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
</head>
<body>
    <h2>File Upload Form</h2>
    <form method="POST" action="test_form_data.php" enctype="multipart/form-data">
        <label for="file">File name:</label>
        <input type="file" name="uploadfile" />
        <input type="submit" name="submit" value="Upload" />
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Define the target directory (ensure this path is correct)
        $targetDir = "../"; // Directory where files will be saved

        // Ensure the target directory exists
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true); // Create directory if it doesn't exist
        }

        // Get the target file path
        $targetFile = $targetDir . basename($_FILES["uploadfile"]["name"]);

        echo "<b>File to be uploaded: </b>" . htmlspecialchars($_FILES["uploadfile"]["name"]) . "<br>";
        echo "<b>Type: </b>" . htmlspecialchars($_FILES["uploadfile"]["type"]) . "<br>";
        echo "<b>File Size: </b>" . ($_FILES["uploadfile"]["size"] / 1024) . " KB<br>";
        echo "<b>Store in: </b>" . htmlspecialchars($_FILES["uploadfile"]["tmp_name"]) . "<br>";

        // Check if the file already exists
        if (file_exists($targetFile)) {
            echo "<h3>The file already exists</h3>";
        } else {
            // Attempt to move the uploaded file to the target directory
            if (move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $targetFile)) {
                echo "<h3>File Successfully Uploaded</h3>";
            } else {
                echo "<h3>Sorry, there was an error uploading your file.</h3>";
            }
        }
    }
    ?>
</body>
</html>

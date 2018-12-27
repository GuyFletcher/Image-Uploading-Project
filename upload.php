<html>
<head>
<title>Basic Image Site - Upload</title>
</head>
<body>


<?php

        $target_dir="uploads/";
        $fileToUpload = $_FILES['fileToUpload']['name'];
        $target_file=$target_dir.basename($_FILES["fileToUpload"]["name"]);
        $uploadOK = 1;
        $imageFileType=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
    
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        
        
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                require '../../configure.php';
                
                $db_handle = mysqli_connect(DB_SERVER,DB_USER,DB_PASS);
                
                $database="images";
                
                $db_found = mysqli_select_db( $db_handle, $database );
                
                
                $img = basename($_FILES['fileToUpload']['name']);
                $SQL = "INSERT INTO tbl_images (fileName) VALUES ('$img')";
                
                $result = mysqli_query($db_handle, $SQL);
                
                echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        
        mysqli_close($db_handle);
        
        header("Refresh:0; url=sample.php?page=0");
    
?>


</body>
</html>
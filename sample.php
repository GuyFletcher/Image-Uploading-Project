<html>
<head>
<title>Basic Image Site</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

    <form action="upload.php" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
    </form>

    <div class="row">
            <?php     
                require '../../configure.php';
                
                $db_handle = mysqli_connect(DB_SERVER,DB_USER,DB_PASS);
                
                $database="images";
                
                $db_found = mysqli_select_db( $db_handle, $database );
                
                $SQL = "SELECT * FROM tbl_images";
                
                $result = mysqli_query($db_handle, $SQL);
                
                
                while ( $db_field = mysqli_fetch_assoc($result) ) {
                    echo '<div ><img class="images" src="'.$db_field['fileName'].'" style="width:100;height:100" /><br /></div>';
                    
                }
                
                mysqli_close($db_handle);
            ?>
    </div>

    <?php 
        /*
        require '../configure.php';
        
        $db_handle = mysqli_connect(DB_SERVER,DB_USER,DB_PASS);
        
        $database="addressbook";
        
        $db_found = mysqli_select_db( $db_handle, $database );
        
        if($db_found){            
            $SQL = "INSERT INTO images (fileName) VALUES ()";
            $result = mysqli_query($db_handle, $SQL);
            
           // $SQL = "SELECT * FROM tbl_address_book";
           // $result = mysqli_query($db_handle, $SQL);
            
            while ( $db_field = mysqli_fetch_assoc($result) ) {

            print $db_field['ID'] . "<BR>";
            print $db_field['First_Name'] . "<BR>";
            print $db_field['Surname'] . "<BR>";
            print $db_field['Address'] . "<BR>";
            }
            
          
        }
        else{
            print "Database not found";
        }
        
        mysqli_close($db_handle);
        */
    ?>

</body>
</html>
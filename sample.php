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
    

    <div id="row">
            <?php     
                require '../../configure.php';
                
                $db_handle = mysqli_connect(DB_SERVER,DB_USER,DB_PASS);
                
                $database="images";
                
                $db_found = mysqli_select_db( $db_handle, $database );
                
                $start = intval($_GET['page'])*3;
                
                $SQL = "SELECT * FROM tbl_images WHERE ID LIMIT ".$start.",3";
                
                $result = mysqli_query($db_handle, $SQL);
                
                
                while ( $db_field = mysqli_fetch_assoc($result) ) {
                    echo '<div><img class="images" src="'.$db_field['fileName'].'" /><br /></div>';
                }
                
                $SQL = "SELECT * FROM tbl_images";
                $result = mysqli_query($db_handle, $SQL);
                $num_row = mysqli_num_rows($result);
                
                
                mysqli_close($db_handle);
                echo '<div id="num">';
                for($x = 0; $x <= $num_row/3; $x++){
                    echo '<a href="sample.php?page='.$x.'">'.($x+1).'</a>';
                }
                echo '</div>';
            ?>
            
            
    </div>

</body>
</html>
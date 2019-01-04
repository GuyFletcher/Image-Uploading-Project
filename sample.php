<html>
<head>
<title>Basic Image Site</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
    <header id="head">
        <div>
        <ul>
          <li><a href="sample.php?page=0">Home</a></li>
          <li><a href="contact.php">Contact</a></li>
          <li><a href="about.asp">About</a></li>
        </ul>
        </div>
    </header>
    
    <div id="row">
        <div id="column1">
            <form action="search.php">
                Search:
                <input type="text" name="search">
                <input type="submit">
            </form>

            <form action="upload.php" method="post" enctype="multipart/form-data">
                Select image to upload:
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="Upload Image" name="submit">
            </form>
        </div>
        <div id="column2">
            <?php     
                require '../../configure.php';
                
                //error_reporting(0);       //turn off error reporting, not to be used during testing.
                
                $db_handle = mysqli_connect(DB_SERVER,DB_USER,DB_PASS);
                
                $database="images";
                
                $numImages = 5; //number of images per page
                
                $db_found = mysqli_select_db( $db_handle, $database );
                
                if(isset($_GET['page'])){
                   $start = intval($_GET['page'])* $numImages;    //if page is set, multiply by numImages for starting value 
                }
                else {
                    header("Refresh:0; url=sample.php?page=0");     //refresh and set page=0
                }
                
                
                $SQL = "SELECT * FROM tbl_images WHERE ID LIMIT ".$start.",".$numImages."";
                
                $result = mysqli_query($db_handle, $SQL);
                
                $img_count = 0;
                echo '<div class="imgRow">';
                while ( $db_field = mysqli_fetch_assoc($result) ) {
                    if($img_count < 4){
                        echo '<a href="image.php?image='.$db_field['fileName'].'"><img class="images" src="uploads/'.$db_field['fileName'].'"/></a><br />';
                    }
                    else {
                        echo '</div>';
                        $img_count = 1;
                        echo '<div class="imgRow">';
                        echo '<a href="image.php?image='.$db_field['fileName'].'"><img class="images" src="uploads/'.$db_field['fileName'].'"/></a><br />';
                    }
                    $img_count+=1;
                }
                echo '</div>';
                
                $SQL = "SELECT * FROM tbl_images";
                $result = mysqli_query($db_handle, $SQL);
                $num_row = mysqli_num_rows($result);
                
                
                mysqli_close($db_handle);
                echo '<div id="num">';
                for($x = 0; $x < $num_row/$numImages; $x++){
                    echo '<a href="sample.php?page='.$x.'">'.($x+1).'</a>';
                }
                echo '</div>';
            ?>
        </div>
    </div>

</body>
</html>
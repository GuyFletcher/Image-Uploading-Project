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
        <?php     
            require '../../configure.php';
            
            //error_reporting(0);       //turn off error reporting, not to be used during testing.
            
            $db_handle = mysqli_connect(DB_SERVER,DB_USER,DB_PASS);
            
            $database="images";
            
            $numImages = 4; //number of images per page
            
            $db_found = mysqli_select_db( $db_handle, $database );
            
            if(isset($_GET['page'])){
                   $start = intval($_GET['page'])* $numImages;    //if page is set, multiply by numImages for starting value 
            }
            else {
                $start = 0;
            }
            
            $SQL = "SELECT tbl_images.fileName FROM tbl_images 
            INNER JOIN tbl_img_tags ON tbl_images.ID = tbl_img_tags.IMG_ID 
            INNER JOIN tbl_tags ON tbl_img_tags.TAG_ID = tbl_tags.ID WHERE tbl_tags.tag = '".$_GET['search']."' LIMIT ".$start.",".$numImages."";
            
            $result = mysqli_query($db_handle, $SQL);
            
            
            while ( $db_field = mysqli_fetch_assoc($result) ) {
                echo '<div><a href="image.php?image='.$db_field['fileName'].'"><img class="images" src="uploads/'.$db_field['fileName'].'"/></a><br /></div>';
            }
            
            $SQL = "SELECT tbl_images.fileName FROM tbl_images 
            INNER JOIN tbl_img_tags ON tbl_images.ID = tbl_img_tags.IMG_ID 
            INNER JOIN tbl_tags ON tbl_img_tags.TAG_ID = tbl_tags.ID WHERE tbl_tags.tag = '".$_GET['search']."'";
            $result = mysqli_query($db_handle, $SQL);
            $num_row = mysqli_num_rows($result);
            
            
            mysqli_close($db_handle);
            echo '<div id="num">';
            for($x = 0; $x < $num_row/$numImages; $x++){
                echo '<a href="search.php?search='.$_GET['search'].'&page='.$x.'">'.($x+1).'</a>';
            }
            echo '</div>';
        ?>
</div>




</body>


</html>
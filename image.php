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

<form action="add_tag.php" method="post" enctype="multipart/form-data">
        Add a tag to image:
        <input type="text" name="tag">
        <input type='hidden' name='image' value='<?php echo $_GET['image'];?>'/> 
        <input type="submit" value="Add tag" name="submit">
</form>

<div id="imgBod">
<?php
    require '../../configure.php';
    
    
    $db_handle = mysqli_connect(DB_SERVER,DB_USER,DB_PASS);
                
    $database="images";
    
    $db_found = mysqli_select_db( $db_handle, $database );
    
    
    $SQL = "SELECT tbl_tags.tag FROM tbl_tags 
            INNER JOIN tbl_img_tags ON tbl_img_tags.TAG_ID = tbl_tags.ID 
            INNER JOIN tbl_images ON tbl_img_tags.IMG_ID = tbl_images.ID
            WHERE tbl_images.fileName = '".$_GET['image']."'";
    
    $result = mysqli_query($db_handle, $SQL);
    
    echo '<div id="column1"> <h3>Tags</h3>';
    while ($db_field = mysqli_fetch_assoc($result)) {
        echo '<div>'.$db_field['tag'].'</div>';
    }
    echo '</div>';

    echo '<div id="column2"><img src="uploads/'.$_GET['image'].'"/></div>';


?>
</div>

</body>


</html>
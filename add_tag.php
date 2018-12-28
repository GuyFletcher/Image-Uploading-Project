<?php
        require '../../configure.php';
                
        $db_handle = mysqli_connect(DB_SERVER,DB_USER,DB_PASS);
        
        $database="images";
        
        $db_found = mysqli_select_db( $db_handle, $database );

        $tag = $_POST["tag"];
        $image = $_POST["image"];
        $SQL = "INSERT IGNORE INTO tbl_tags (tag) VALUES ('$tag')";    //insert into table, if present error thrown and nothing done
        $result = mysqli_query($db_handle, $SQL);
        
        $SQL = "INSERT IGNORE INTO tbl_img_tags (IMG_ID, TAG_ID) SELECT img.id, t.id FROM tbl_images img, tbl_tags t WHERE img.fileName='$image' AND t.tag ='$tag'";
        $result = mysqli_query($db_handle, $SQL);

        header("Refresh:0; url=image.php?image=".$image);
?>
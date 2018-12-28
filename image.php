<html>
<head>
<title>Basic Image Site</title>
<link rel="stylesheet" href="style.css">
</head>

<body>
<header id="head">
<h1>Basic Image Site</h1>
<div>
<a href="sample.php?page=0">Home</a>
</div>
</header>
<form action="add_tag.php" method="post" enctype="multipart/form-data">
        Add a tag to image:
        <input type="text" name="tag">
        <input type='hidden' name='image' value='<?php echo $_GET['image'];?>'/> 
        <input type="submit" value="Add tag" name="submit">
</form>

<?php

    

    echo '<div><img src="uploads/'.$_GET['image'].'"/></div>';




?>
</body>


</html>
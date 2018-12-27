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

<?php

    

    echo '<div><img src="uploads/'.$_GET['image'].'"/></div>';




?>
</body>


</html>
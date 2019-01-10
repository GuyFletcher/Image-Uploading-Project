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
            if(isset($_POST['submit'])) 
            { 
                $subject = $_POST['subject'];
                $message = $_POST['Message'];
                $headers  = 'From: testfletcherhart@gmail.com' . "\r\n" .
                'MIME-Version: 1.0' . "\r\n" .
                'Content-type: text/html; charset=utf-8';
                
                if(mail("testfletcherhart@gmail.com",$subject,$message, $headers)) {
                    echo "success";
                }
            }
        ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
           Subject <input type="text" name="subject"><br>
           Message: <textarea name="Message" cols="40" rows="5">Example</textarea>
           <input type="submit" name="submit" value="Submit Form"><br>
        </form>
    </div>

</body>
</html>
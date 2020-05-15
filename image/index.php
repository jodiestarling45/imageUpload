<?php
    if(isset($_POST['upload'])){
        $target = "images/".basename($_FILES['image']['name']);
        $db = new PDO('mysql:host=localhost;dbname=image','admin','123456');
        $image = $_FILES['image']['name'];
        $sql = "INSERT INTO `images`(`image`) VALUES ('$image')";
        $db->exec($sql);
        if (move_uploaded_file($_FILES['image']['tmp_name'],$target)){
            $msg = "image upload ";
        }else{
            $msg = "false";
        }
        $stmt = $db->query("SELECT * FROM `images`");
        $result = $stmt->fetchAll();
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="content">
    <form action="index.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="size" value="10000000">
        <div>
            <input type="file" name="image">
        </div>
        <?php foreach ($result as $key => $image):?>
            <img src="images/<?php echo $image['image']?>" alt="">
        <?php endforeach;?>
        <div>
            <input type="submit" name="upload" value="upload image">
        </div>
    </form>
</div>
</body>
</html>

<?php 
    include("server.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

            <?php
                if(isset($_GET['view'])){
                    $id = $_GET['view'];

                    $v = mysqli_query($conn, "SELECT * FROM info WHERE id=$id");
                    $view = mysqli_fetch_array($v);

                    $name = $view['name'];
                    $address = $view['address'];
                    $img = $view['img_path']
            ?>
    <div class="profile">
        <h3>Customer's Profile</h3>
        <div class="profile-section">
            <img width="30%" src="<?php echo $img ?>">
            <div>
         
            
            <p>Name: <?php echo $name ?> </p>
            <p>Address: <?php echo $address ?></p>

            <?php  } ?>
            </div>
        </div>
    </div>
</body>
</html>
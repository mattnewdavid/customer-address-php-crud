<?php 
    session_start();

    $edit_state = false;
    $conn = mysqli_connect("localhost", "root", "", "crud");

    if(isset($_POST['save'])){
        $name = $_POST['name'];
        $address = $_POST['address'];

        $image_folder= 'image/';
        $path = $image_folder . basename($_FILES['nfile']['name']);
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $imagesize = $_FILES['nfile']['size'];
        $imagetmp = $_FILES['nfile']['tmp_name'];

        if($ext != "png" && $ext != 'jpg' && $ext != 'JPEG'){
            echo 'File type not supported';
        }else{
            $upload = move_uploaded_file($imagetmp, $path);
    
            $query = "INSERT INTO info(name, address, img_path) VALUES('$name', '$address', '$path')";
            $result = mysqli_query($conn, $query);
            $_SESSION['msg'] = "Address saved";
            header("location: index.php");
        }

        // $query = "INSERT INTO info(name, address) VALUES ('$name', '$address')";
        // mysqli_query($conn, $query);
     

    }
    if(isset($_POST['update'])){
        $name = $_POST['name'];
        $address = $_POST['address'];
        $id = $_POST['id'];

        mysqli_query($conn, "UPDATE info SET name='$name', address='$address' WHERE id=$id");
        $_SESSION['msg'] = "Address updated";
        header("location: index.php");
    }

    if(isset($_GET['del'])){
        $id = $_GET['del'];

        mysqli_query($conn, "DELETE FROM info WHERE id=$id");
        $_SESSION['msg'] = "Address deleted";
        header("location: index.php");

    }
   $result = mysqli_query($conn, "SELECT * FROM info");


?>
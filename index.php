<?php 
    include('upload.php');
    include("server.php");
    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        $edit_state = true;

        $rec = mysqli_query($conn, "SELECT * FROM info WHERE id=$id");
        $record = mysqli_fetch_array($rec);
        $name = $record['name'];
        $address = $record['address'];
        $id = $record["id"];
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers Address Information - CRUD</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    
    <h1>Customer Address Information</h1>
    <?php if(isset($_SESSION['msg'])){ ?>
    <div class="msg text-center mx-auto">
        <h5 >
        <?php echo $_SESSION['msg'];
              unset($_SESSION['msg']);
            }
        ?>
        </h5>
    </div>

    <table class="p-4 mx-auto mt-3 col-md-9">
       
        <thead>
            <tr>
                <th class="px-4">Name</th>
                <th class="px-4">Address</th>
                <th class="px-4">Image</th>
                <th class="px-4">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            while($row = mysqli_fetch_array($result)){?>
            
                <tr class="my-5">
                <td class="px-4"><?php echo $row["name"]; ?></td>
                <td class="px-4"><?php echo $row["address"]; ?></td>
                <td class="col-md-3"><img width="50%" src="<?php echo $row['img_path'] ?>"></td>
                <td class="px-4 col-md-4">
                    <a class="btn-edit btn p-2 mt-4" href="index.php?edit=<?php echo $row['id']; ?> ">Edit</a>
                    <a class="btn-delete btn p-2 mt-4" href="server.php?del=<?php echo $row['id']; ?>">Delete</a>
                    <div class="modal" id="verify" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="exampleModalLabel">Modal Title</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h6>Are you sure you want to delete?</h6>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="button" class="btn btn-success"><a href="server.php?del=<?php echo $row['id']; ?>">Yes</a></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-profile p-2 mt-4" href="view.php?view=<?php echo $row['id']; ?>">View Profile</a>
                </td>
            </tr>
          <?php  } ?>
            
        </tbody>
    </table>

    <form method="POST" action="server.php" enctype="multipart/form-data">
        <h2>Input Information</h2>
    <input type="hidden" name="id" value = "<?php if($edit_state == true){echo $id;}  ?>">
        <div>
            
            <input type="text" name="name"  value = "<?php if($edit_state == true){echo $name;}  ?>" placeholder="Name">
        </div>
        <div>
            
            <input type="" name="address"  value = "<?php if($edit_state == true){echo $address;}  ?>" placeholder="Address">
        </div>
        <input name="nfile" type="file" class="img-upload">
        <?php if($edit_state == false){ ?>
        <button type="submit" name="save">Save</button>
        <?php } else{ ?>
        <button type="submit" name="update">Update</button>
        <?php } ?>
    </form>

    
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
</body>
</html>
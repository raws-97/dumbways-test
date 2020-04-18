<!doctype html>
<?php include 'config.php'; ?>
<?php $sql = mysqli_query($conn,"SELECT * FROM categories ORDER BY id ASC;"); ?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
  <?php include'nav.php'; ?>

  
  <div class="container" style="width: 50%; margin-top:5%">
  <form method="post" enctype="multipart/form-data">
      
        <div class="form-group" >
            <label for="foodCategory">Kategori Makanan</label>
            <select class="form-control" id="foodCategory" name="foodCategory">
                <?php if(mysqli_num_rows($sql)>-1) {
                    while ($row = mysqli_fetch_array($sql)) {?>
            <option value=<?php echo $row['id'] ?>><?php echo $row['name'] ?></option>
                    <?php } }?>
            </select> <br>
            <a class="btn btn-success" href="addcategory.php" role="button">Add New Category</a>
        </div>
        <div class="form-group">
            <label for="foodName">Food Name</label>
            <input type="text" class="form-control" name="foodName" id="foodName" > <br>
            
        </div>
        <div class="form-group">
            <label for="foodStock">Food Stock</label>
            <input type="number" class="form-control" name="foodStock" id="foodStock" > <br>
            <a class="btn btn-success" href="addcategory.php" role="button">Update</a>
        </div>
        <div class="form-group">
            <label for="imageData">Insert Image</label>
            <input type="file" class="form-control-file" name="imageData" id="imageData">
        </div>
        <div class="form-group">
            <label for="desc">Food Description</label>
            <input type="text" class="form-control" name="desc" id="desc" >
        </div>
        

        <input type="submit" name="submit" class="btn btn-primary" value="Submit"></input>

</form>
</div>
  

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <?php 
    
    if(isset($_POST['submit'])){
        $name = $_POST['foodName'];
        $stock = $_POST['foodStock'];
        $desc = $_POST['desc'];
        $cat_id = $_POST['foodCategory'];
        
        if(getimagesize($_FILES['imageData']['tmp_name'])==FALSE){
            echo "failed";
        } else {
            $img = base64_encode(file_get_contents(addslashes($_FILES['imageData']['tmp_name'])));
            savedata($name,$stock,$img,$desc,$cat_id);
        }
    }

    function savedata($name,$stock,$img,$desc,$cat_id){
        include 'config.php';
        $sql = "INSERT INTO foods (name,stok,image,deskripsi,category_id)
        VALUES ('$name','$stock','$img','$desc','$cat_id')";

        if (mysqli_query($conn, $sql)) {
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>Success!</strong> You should check in Home.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn); 

    }

        

         

    
    
    
    ?>
  </body>
</html>
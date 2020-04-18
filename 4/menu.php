<!doctype html>
<html lang="en">
<?php include 'config.php' ?>
<?php $id = $_GET['food']; ?>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body onload="checkker()">
    <?php include 'nav.php' ?>

    <?php
     $sql2 = mysqli_query($conn,"SELECT * FROM foods WHERE id = '$id';");
     $num = mysqli_num_rows($sql2);
     
     for($i=0; $i< $num; $i++){
        $res=mysqli_fetch_array($sql2);
        $img = $res['image'];
    ?>
    <center>
    <div class="container">
    <img <?php echo 'src="data:image;base64,'.$img.'"'; ?> class="img-fluid" alt="Responsive image">
    <h1><?php echo $res['name']; ?></h1>
    <p><?php echo $res['deskripsi']; ?></p>
    <p id="stokk"><?php echo $res['stok']; ?></p>

    
    <?php } ?>

    <form method="post">
        <div class="form-group">
            <label for="foodStock">Food Stock</label>
            <input type="number" class="form-control" name="foodStock" id="foodStock" >
        </div>
        <input type="submit" name="submit" class="btn btn-warning" value="Buy" id="submit"></input>
        <input type="submit" name="refresh" class="btn btn-success" value="Refresh"></input>
        
        <a class="btn btn-primary" <?php echo 'href="addstock.php?food='.$id.'"';?> role="button">Update</a>
    </form>
    </div>
    </center>

    <?php
    if(isset($_POST['submit'])){
        $data = $res['stok'];
        $stock = $_POST['foodStock'];
        $jumlah = $data - $stock;
        

        $sql = "UPDATE foods SET stok='$jumlah' WHERE id='$id'";
        
        if (mysqli_query($conn, $sql)) {
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>Success!</strong> Thanks for purchasing.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>";
         
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        
        mysqli_close($conn); 
    } else {
        
    }

    if(isset($_POST['refresh'])){

    }
    ?>
     
     
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script>
        var x = document.getElementById("submit").style;
        var jumlah = document.getElementById("stokk").innerHTML;
        var int = parseInt(jumlah);
        
        function checkker(){
        if(int <= 0){
            x.display = "none";
        } else {
            x.display = "block";
        }
        }
    </script>
  </body>
</html>
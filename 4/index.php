<!doctype html>
<?php include 'config.php'; ?>
<?php //$sql = "SELECT * FROM foods LEFT JOIN categories ON foods.category_id = categories.id"; 
      $sql = mysqli_query($conn,"SELECT * FROM categories ORDER BY id ASC;");
      
        ?>
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

    <div class="jumbotron">
            <h1 class="display-4">Selamat Datang di Warung Makan Putra</h1>
            <p class="lead">Pilih lah makanan favorit kamu. Selamat menikmati hindangannya. </p>
            <hr class="my-4">
            <form method="post" enctype="multipart/form-data">
      
        <div class="form-group" >
            <label for="foodCategory">Kategori Makanan</label>
            <select class="form-control" id="foodCategory" name="foodCategory">
                <?php if(mysqli_num_rows($sql)>-1) {
                    while ($row = mysqli_fetch_array($sql)) {?>
            <option value=<?php echo $row['id'] ?>><?php echo $row['name'] ?></option>
                    <?php } }?>
            </select> <br>
        <input type="submit" name="search" class="btn btn-success" value="Search"></input>
        <input type="submit" name="all" class="btn btn-warning" value="All Menu"></input><br>

        </form>
        <br>

        
        <?php
        if(isset($_POST['search'])){
            $search = $_POST['foodCategory'];
            $sql2 = mysqli_query($conn,"SELECT * FROM foods WHERE category_id = '$search';");
            $num = mysqli_num_rows($sql2);
         
              
               ?>
            <div class="row">
                <?php for($i=0; $i< $num; $i++){
                $res=mysqli_fetch_array($sql2);
                $img = $res['image'];
               ?>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card" style="width: 18rem;">
                <img <?php echo 'src="data:image;base64,'.$img.'"'; ?> class="card-img-top" >
                <div class="card-body">
                    <h5 class="card-title"><?php echo $res['name']; ?></h5>
                    <p class="card-text"><?php echo $res['deskripsi']; ?></p>
                    <p class="card-text centered">Stock : <?php echo $res['stok']; ?></p>
                </div>
                <a <?php echo 'href="menu.php?food='.$cat.'"';?> class="btn btn-warning">Buy</a>
                </div>
            </div>
                <?php } ?>
            </div>
            <?php } else {
                $sql2 = mysqli_query($conn,"SELECT * FROM foods;");
                $num = mysqli_num_rows($sql2);

             ?>
            <div class="row">
                <?php for($i=0; $i< $num; $i++){
                $res=mysqli_fetch_array($sql2);
                $img = $res['image'];
                $cat = $res['id'];
               ?>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card" style="width: 18rem;">
                <img <?php echo 'src="data:image;base64,'.$img.'"'; ?> class="card-img-top" >
                <div class="card-body">
                    <h5 class="card-title"><?php echo $res['name']; ?></h5>
                    <p class="card-text"><?php echo $res['deskripsi']; ?></p>
                    <p class="card-text centered">Stock : <?php echo $res['stok']; ?></p>
                </div>
                <a <?php echo 'href="menu.php?food='.$cat.'"';?> class="btn btn-warning">Buy</a>
                </div>
            </div>
                <?php } ?>
            </div>
                <?php } ?>

                <?php if(isset($_POST['all'])){
                        
                } ?>
            
                    
        

            </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
<?php  
// INSERT INTO `products` (`p_id`, `Title`, `Content`, `tstamp`) VALUES (NULL, 'sdas', 'dsad', '2023-11-20 15:30:12.000000');
// UPDATE `notes` SET `Title` = 'sdasd', `Content` = 'dsadd' WHERE `notes`.`sno` = 1; 
$insert = false;
$update = false;
$delete = false;
// Connect to the Database 
$servername = "localhost";
$username = "root";
$password = "";
$database = "company";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Die if connection was not successful
if (!$conn){
    die("Sorry we failed to connect: ". mysqli_connect_error());
}

if(isset($_GET['delete'])){
  $p_id = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `products` WHERE `p_id` = $p_id";
  $result = mysqli_query($conn, $sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
if (isset( $_POST['p_idEdit'])){
  // Update the record
    $p_id = $_POST["p_idEdit"];
    $p_name = $_POST["p_nameEdit"];
    $p_type = $_POST["p_typeEdit"];
    $PricePerUnit = $_POST["PricePerUnitEdit"];
    $Market_PPU = $_POST["Market_PPUEdit"];
    $Currency = $_POST["CurrencyEdit"];
    $Unit = $_POST["UnitEdit"];

  // Sql query to be executed
  $sql = "UPDATE `products` SET `p_name` = '$p_name', `p_type` = '$p_type', `PricePerUnit` = '$PricePerUnit', `Market_PPU` = '$Market_PPU', `Currency` = '$Currency', `Unit` = '$Unit' WHERE `products`.`p_id` =$p_id ;";
  $result = mysqli_query($conn, $sql);
  if($result){
    $update = true;
}
else{
    echo "We could not update the record successfully";
}
}
else{
    $p_name = $_POST["p_name"];
    $p_type = $_POST["p_type"];
    $PricePerUnit = $_POST["PricePerUnit"];
    $Market_PPU = $_POST["Market_PPU"];
    $Currency = $_POST["Currency"];
    $Unit = $_POST["Unit"];

  // Sql query to be executed
  $sql = "INSERT INTO `products` (`p_name`, `p_type`, `PricePerUnit`, `Market_PPU`, `Currency`, `Unit`) VALUES ('$p_name', '$p_type', '$PricePerUnit', '$Market_PPU', '$Currency', '$Unit');";
  $result = mysqli_query($conn, $sql);

   
  if($result){ 
      $insert = true;
  }
  else{
      echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
  } 
}
}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="style.css">

 <title>Product Management</title>

</head>

<body>
 

  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="/DBMS/index.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="p_idEdit" id="p_idEdit">
            <div class="form-group">
        <label for="p_nameEdit">Product name</label>
        <input type="text" class="form-control" id="p_nameEdit" name="p_nameEdit" aria-describedby="productHelp">
      </div>
      <div class="form-group">
        <label for="p_typeEdit">Product Type</label>
        <input type="text" class="form-control" id="p_typeEdit" name="p_typeEdit" aria-describedby="productHelp">
      </div>
      <div class="form-group">
        <label for="PricePerUnitEdit">PricePerUnit</label>
        <input type="number" class="form-control" id="PricePerUnitEdit" name="PricePerUnitEdit" aria-describedby="productHelp">
      </div>
      <div class="form-group">
        <label for="Market_PPUEdit">Market_PPU</label>
        <input type="number" class="form-control" id="Market_PPUEdit" name="Market_PPUEdit" aria-describedby="productHelp">
      </div>
      <div class="form-group">
        <label for="CurrencyEdit">Currency</label>
        <input type="text" class="form-control" id="CurrencyEdit" name="CurrencyEdit" aria-describedby="productHelp">
      </div>
      <div class="form-group">
        <label for="UnitEdit">Unit</label>
        <input type="text" class="form-control" id="UnitEdit" name="UnitEdit" aria-describedby="productHelp">
      </div>
          </div>
          <div class="modal-footer d-block mr-auto">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php
  if($insert){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> The data has been inserted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> The data has been deleted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($update){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> The data has been updated successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <div class="container my-4">
    <h2>Start your journey with us by registering your products</h2>
    <form action="/DBMS/index.php" method="POST">
      <div class="form-group">
        <label for="p_name">Product name</label>
        <input type="text" class="form-control" id="p_name" name="p_name" aria-describedby="productHelp">
      </div>
      <div class="form-group">
        <label for="p_type">Product Type</label>
        <input type="text" class="form-control" id="p_type" name="p_type" aria-describedby="productHelp">
      </div>
      <div class="form-group">
        <label for="PricePerUnit">PricePerUnit</label>
        <input type="number" class="form-control" id="PricePerUnit" name="PricePerUnit" aria-describedby="productHelp">
      </div>
      <div class="form-group">
        <label for="Market_PPU">Market_PPU</label>
        <input type="number" class="form-control" id="Market_PPU" name="Market_PPU" aria-describedby="productHelp">
      </div>
      <div class="form-group">
        <label for="Currency">Currency</label>
        <input type="text" class="form-control" id="Currency" name="Currency" aria-describedby="productHelp">
      </div>
      <div class="form-group">
        <label for="Unit">Unit</label>
        <input type="text" class="form-control" id="Unit" name="Unit" aria-describedby="productHelp">
      </div>
      <button type="submit" class="btn btn-primary">Add data</button>
    </form>
  </div>

  <div class="container my-4">
  

    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">Product ID</th>
          <th scope="col">Product name</th>
          <th scope="col">Product type</th>
          <th scope="col">PricePerUnit</th>
          <th scope="col">Market_PPU</th>
          <th scope="col">Currency</th>
          <th scope="col">Unit</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $sql = "SELECT * FROM `products`";
          $result = mysqli_query($conn, $sql);
          $p_id = 0;
          while($row = mysqli_fetch_assoc($result)){
            $p_id = $p_id + 1;
            echo "<tr>
            <th scope='row'>". $p_id . "</th>     
            <td>". $row['p_name'] . "</td>
            <td>". $row['p_type'] . "</td>
            <td>". $row['PricePerUnit'] . "</td>
            <td>". $row['Market_PPU'] . "</td>
            <td>". $row['Currency'] . "</td>
            <td>". $row['Unit'] . "</td>
            <td> <button class='edit btn btn-sm btn-primary' id=".$row['p_id'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['p_id'].">Delete</button>  </td>
          </tr>";
        } 
          ?>


      </tbody>
    </table>
  </div>
  <hr>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>
  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        tr = e.target.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode;
        p_name = tr.getElementsByTagName("td")[0].innerText;
        p_type = tr.getElementsByTagName("td")[1].innerText;
        PricePerUnit = tr.getElementsByTagName("td")[2].innerText;
        Market_PPU = tr.getElementsByTagName("td")[3].innerText;
        Currency = tr.getElementsByTagName("td")[4].innerText;
        Unit = tr.getElementsByTagName("td")[5].innerText;
        console.log(p_name, p_type,PricePerUnit,Market_PPU,Currency,Unit);
        p_nameEdit.value = p_name;
        p_typeEdit.value = p_type;
        p_idEdit.value = e.target.id;
        PricePerUnitEdit.value = PricePerUnit;
        Market_PPUEdit.value = Market_PPU;
        Currency.value = Currency;
        UnitEdit.value = Unit;
        console.log(e.target.id)
        $('#editModal').modal('toggle');
      })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        p_id = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this record!")) {
          console.log("yes");
          window.location = `/DBMS/index.php?delete=${p_id}`;
        }
        else {
          console.log("no");
        }
      })
    })
  </script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>reciever</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/d2747108de.js" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>
    <style>body {
    background-image: url("img/4.jpg");
    background-size: cover;
    height: 100%;
    width: 100%;
    background-repeat: no-repeat;
    background-attachment: fixed;
    }</style>
</head>

<body>
    <!-- __________________NAVIGATION BAR____________________ -->
    <div id="title">
        <nav id="navbar" class="navbar navbar-expand-lg navbar-dark ">
            <a id="navbar-brand" href="index.php">Keval's<span>  Bank</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
                aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#footer">Contact</a>
                    </li>

                </ul>
            </div>
        </nav>
    </div>

    <?php  
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "bank";
    // Create a database connection
    $con = mysqli_connect($server, $username, $password, $database);

    // Check for connection success
    if(!$con){
        die("connection to this database failed due to" . mysqli_connect_error());
    }
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $name = $_POST['cus'];
    }
    $sql = "SELECT balance FROM customer WHERE Name='$name';";
     $sql1 = "SELECT Name FROM customer;";
?>
    <div class="intro">
        <h1>Make a Transaction</h1>
    </div><br>
    <div class="container-xl" style="width:30%">
        <form action="payment.php" method="POST">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Sender &nbsp</span>
                </div>
                <input type="text" value="<?php echo $name?>" class="form-control" id="sender" name="sender"
                    aria-label="Default" aria-describedby="inputGroup-sizing-default" readonly>
            </div>
            
            <?php $result=mysqli_query($con,$sql); ?>
            <?php while($row=mysqli_fetch_array($result)):; ?>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Balance&nbsp</span>
                </div>
                <input type="text" value="<?php echo $row[0];?>" class="form-control" aria-label="Default"
                    aria-describedby="inputGroup-sizing-default" readonly>
            </div>
            <?php endwhile ;
            ?>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Receiver</span>
                </div>
                <select id="rec" name="rec" class="form-control" aria-label="Default"
                    aria-describedby="inputGroup-sizing-default">
                    <?php $result1=mysqli_query($con,$sql1); ?>
                    <?php while($row1=mysqli_fetch_array($result1)):; ?>
                    <option value="<?php echo $row1[0]; ?>">
                        <?php echo $row1[0]; ?>
                    </option>
                    <?php endwhile ;
            $con->close();
            ?>
                </select>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Amount</span>
                </div>
                <input type="number" name="amount" class="form-control" aria-label="Default"
                    aria-describedby="inputGroup-sizing-default" required placeholder="Enter Amount here"
                    oninvalid="this.setCustomValidity('Please Enter Price')" oninput="this.setCustomValidity('')">
            </div>
            <button class="btn btn-dark btn-lg btn-block" value="Transfer">Send Money</button>
        </form>
    </div>
</body>
<footer id="footer">
  <i class="social-icon fas fa-phone-square-alt"></i>
  <i class="social-icon fab fa-twitter-square"></i>
  <i class="social-icon fas fa-envelope-square"></i>
  <p>© Copyright 2021 Keval's Bank</p>
</footer>

</html>
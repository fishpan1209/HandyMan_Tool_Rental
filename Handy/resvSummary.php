<?php session_start(); ?>
<html lang = "en">

    <head>
        <title>Handyman Tool</title>
        <style type="text/css">
            label{
              display:inline-block;
              height: 30px;
              margin: 0 auto;
              width: 35px;
            }
        </style>
    </head>


    <body>
        <h2>Reservation Summary</h2>

        <h2>Tools Reserved</h2>
        <?php
           
            include('dbconn.php');
            global $conn;
            if (empty($_SESSION['login_user'])) {
                die("You are not login yet!");
                header("refresh:3;url=index.php");
            }
            $condition = 0;
            if (!isset($_SESSION['tool_list'])) {
                echo '&nbsp&nbsp<span style="color:#FF0000;text-align:center;font-size: 18pt;">You reached this page by error, please go back to Main Menu</span>';
            } else {
                $condition = 1;
                $total_rental = $_SESSION['rental'];
                $total_deposit = $_SESSION['deposit'];
                $tool_list = $_SESSION['tool_list'];
                $start = $_SESSION['startdate'];
                $end = $_SESSION['enddate'];
                $resv_number = $_SESSION['resv_number'];
                if (isset($_POST['logout'])) {
                    session_destroy();
                    echo "<script> window.location.assign('index.php'); </script>";
                }
            }
            if (isset($_POST['back'])) {
                unset($tool_list);
                unset($_SESSION['tool_list']);
                unset($_SESSION['startdate']);
                unset($_SESSION['enddate']);
                unset($_SESSION['rental']);
                unset($_SESSION['deposit']);
                unset($_SESSION['resv_number']);
                echo "<script> window.location.assign('customer.php'); </script>";
            }
        ?>

        <div class = "container">
            <form class = "form-signin" role = "form" method = "post">
                <?php if ($condition == 1) { ?>
                <h4>Reservation Number: <?php echo $resv_number ?></h4>
                <p><h4><?php 
                ksort($tool_list);
                foreach ($tool_list as $id => $abbr) {
                    echo "<p><label>#$id</label> " . $abbr ."</p>";
                }?></h4></p>
                <hr>
                <p>Start Date <?php echo $start ?></p>
                <p>End Date&nbsp <?php echo $end ?></p>
                <p>Total Rental&nbsp&nbsp <?php echo "$$total_rental" ?></p>
                <p>Total Deposit <?php echo "$$total_deposit" ?></p>
                </p>
                <?php } ?>
                <br>
                <p>
                <button class = "btn btn-lg btn-primary btn-block" type = "submit" name = "back">Main Menu</button>
                </p>
                <p>
                <hr>
                <button class = "btn btn-lg btn-primary btn-block" type = "submit" name = "logout">Log Out</button>
                </p>
            </form>
        </div>
   </body>
</html>
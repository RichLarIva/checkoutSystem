<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">

        <div class="flexreport">
            <div class="reportbox">
                <h1>Daily Report</h1>

                <ul>
                    <h2>Products Sold: </h2>
                    <li><!-- (Name of product and date of sale here) --></li>
                    <li><!-- (Name of product and date of sale here) --></li>
                </ul>

                <h1 class="daily-cash">Cash payments:</h1>
                <h1 class="daily-swish"> Swish Payments:</h1>
                <h1 class="daily-sum">Total sales: </h1>
            </div>

            <div class="reportbox">
                <h1>Monthly Report</h1>

                <ul>
                    <h2>Products Sold: </h2>
                    <li><!-- (Name of product and date of sale here) --></li>
                    <li><!-- (Name of product and date of sale here) --></li>
                </ul>

                <h1 class="monthly-cash">Cash payments:</h1>
                <h1 class="monthly-swish"> Swish Payments:</h1>
                <h1 class="monthly-sum">Total sales: </h1>
            </div>
        </div>

    </div>
<?php include "footer.php"; ?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Appointments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        h1 {
            margin: 40px 0;
        }

        header img {
            width: 50px;
            height: 50px;
            margin-right: 20px;
        }

        #date_selector {
            width: 200px;
        }

        #form_date>div>label {
            margin-top: 20px;
            width: 15%;
            font-size: 20px;
        }

        .top {
            display: flex;
            align-items: center;
        }
    </style>

</head>

<?php

if ($_GET['date_selector'] == "") {
    // Reference how get current date https://www.php.net/manual/en/function.date.php
    $current_date = date("Y-m-d");
} else {
    $current_date = $_GET['date_selector'];
}

?>

<header>
    <div class="container">
        <div class="top">
            <img src="https://cdn-icons-png.flaticon.com/512/1869/1869397.png" alt="Icon Calendar">
            <h1>Check Appointments</h1>
        </div>
    </div>
</header>

<body>
    <main>
        <div class="container">
            <form action="" id="form_date">
                <div class="row justify-content-md-center">
                    <label for="date_selector">Select a date:</label>
                    <!-- Reference for check option input change event https://www.w3schools.com/jsref/event_onchange.asp -->
                    <input type="date" class="form-control" id="date_selector" name="date_selector" onchange="changeDate()" value="<?php echo $current_date; ?>">
                </div>
            </form>
            <br>

            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">With</th>
                        <th scope="col">Where</th>
                    </tr>
                </thead>

                <?php
                //connect to db
                $serverName = 'localhost';
                $userName = 'juliana2023'; //credentials
                $password = 'Juli@na12402023'; //credentials
                $databaseName = 'appointments'; //database name

                $conn = mysqli_connect($serverName, $userName, $password, $databaseName);

                // Query to select from db with date that user choosed or current date
                $sql = "SELECT * FROM all_appointments WHERE  date = '$current_date'";
                $result = mysqli_query($conn, $sql);

                // Loop to show the result with th in html
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tbody>
                        <tr>
                            <th scope="row"><?php echo $row['id']; ?></th>
                            <td><?php echo $row['date']; ?></td>
                            <td><?php echo $row['time']; ?></td>
                            <td><?php echo $row['meeting_with']; ?></td>
                            <td><?php echo $row['meeting_where']; ?></td>
                        </tr>
                    </tbody>
                <?php
                }
                ?>
            </table>

        </div>
    </main>
</body>

<script>
    // https://www.w3schools.com/jsref/met_form_submit.asp

    function changeDate() {
        document.getElementById("form_date").submit();
    }
</script>

</html>
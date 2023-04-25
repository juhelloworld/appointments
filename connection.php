<?php
//connect to db
$serverName = 'localhost';
$userName = 'juliana2023'; //credentials
$password = 'Juli@na12402023'; //credentials
$databaseName = 'appointments'; //database name

$conn = mysqli_connect($serverName, $userName, $password, $databaseName);

if ($_GET['date_selector'] == "") {
    // Reference how get current date https://www.php.net/manual/en/function.date.php
    $current_date = date("Y-m-d");
} else {
    $current_date = $_GET['date_selector'];
}

// Query to select from db with date that user choosed or current date
$sql = "SELECT * FROM all_appointments WHERE  date = '$current_date'";
$result = mysqli_query($conn, $sql);

// Loop to show the result with th in html
while ($row = mysqli_fetch_assoc($result)) {
    $notes[] = array(
        "id" => $row["id"],
        "date" => $row["date"],
        "time" => $row["time"],
        "meeting_with" => $row["meeting_with"],
        "meeting_where" => $row["meeting_where"]
    );
}
mysqli_close($conn);
   echo json_encode($notes);
?>
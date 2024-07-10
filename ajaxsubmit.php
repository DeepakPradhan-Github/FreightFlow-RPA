<?php
// Connect to your database (replace with your actual credentials)
$con = mysqli_connect("localhost", "root", "", "ship");

if(isset($_POST['query'])) {
$query = $_POST['query'];
$sql = "SELECT port_name FROM ports WHERE port_name LIKE '%$query%'";
$result = mysqli_query($con, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    echo '<div class="suggestion-item">' . $row['port_name'] . '</div>';
}
}

if(isset($_POST['query2'])) {
$query2 = $_POST['query2'];
$sql = "SELECT port_name FROM ports WHERE port_name LIKE '%$query2%'";
$result = mysqli_query($con, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    echo '<div class="suggestion-item2">' . $row['port_name'] . '</div>';
}
}
?>

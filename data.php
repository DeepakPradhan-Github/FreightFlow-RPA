<?php 

$host = "92.205.100.199";
$username = 'rpa_user';
$password = 'rpa_user@123';
$database = 'rpa_db';
$port = 3306; 

$conn = mysqli_connect($host, $username, $password, $database);


if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
  
}
echo "Connected successfully";

//$result = mysqli_query($conn,"SELECT * FROM test"); //SELECT * FROM quotation_enquiry
$result = mysqli_query($conn,"SELECT * FROM quotation_input");
//$result1 = mysqli_query($conn, "Describe quotation_enquiry");
//$result = mysqli_query($conn,"INSERT INTO quotation_enquiry (job_id, user_id, date, source, destination, container, commodity, departure_time, arrival_time, get_in_deadline, quotation_price, estimation_arrival, estimation_destination) VALUES ('1', '001', '2024-07-11', 'MUMBAI', 'HONG KONG', 'Test Container', 'Test Commodity', '13:30 am', '10:30 pm', 'get_in_deadline_test', '1,000', 'ea', 'ed')");


while($row = mysqli_fetch_array($result))
  {
    echo "<pre>";
    echo $row['source'].'-'.$row['destination'].'-'.$row['container'].'-'.$row['job_id'];
  }

 //echo $result1; 

  ?>
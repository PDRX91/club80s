<?php 
require_once('../mysqli_connect.php');
// $date = $_POST['date'];
$date = '2018-04-27';

$reservedSpotsQuery = "SELECT table_id FROM reservation_info WHERE date_of_reservation = $date";

$reservedSpots = mysqli_query($dbcon, $reservedSpotsQuery);
while($row = mysqli_fetch_assoc($reservedSpots)){
    $row['table_id']= addSlashes($row['table_id']);
}
print_r($row);
$tableArray = [1,2,3,4,5,6,7,8];
for($i = 0; $i<8; $i++){
    
};

?>
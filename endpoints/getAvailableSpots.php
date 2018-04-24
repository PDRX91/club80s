<?php 
require_once('../mysqli_connect.php');
// $date = $_POST['date'];
$date = '2018-04-27';

$reservedSpotsQuery = "SELECT table_id FROM reservation_info WHERE date_of_reservation ='$date'";

$results = mysqli_query($dbcon, $reservedSpotsQuery);

$reservedSpots = [];
while($row = mysqli_fetch_assoc($results)){
    $reservedSpots[]= addSlashes($row['table_id']);
}
// print_r($reservedSpots);
// $reservedCount = count($reservedSpots);
$tableArray = [1,2,3,4,5,6,7,8];
$availableTables=[];
for($i = 0; $i<8; $i++){
    if(in_array($tableArray[$i], $reservedSpots)===false){
        $availableTables[]=$tableArray[$i];
    }
};
$encodedTables = json_encode($availableTables);
print_r($encodedTables);
?>
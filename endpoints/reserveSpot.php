<?php 
require_once('../mysqli_connect.php');
// $date = $_POST['date'];
$date = '2018-04-27';
// $tableToReserve = $_POST['table'];
$tableToReserve = 3;
// $firstName= $_POST['first_name'];
$firstName= 'parker';
// $lastName= $_POST['last_name'];
$lastName= 'rebensdorf';
// $email= $_POST['email'];
$email= 'parker.rebensdorf@gmail.com';
// $phone= $_POST['phone'];
$phone= '9098675309';
// $partySize = $_POST['party_size'];
$partySize = '4';

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

if(in_array($tableToReserve, $availableTables)){
    $guestQuery = "INSERT INTO `guest_info` (`first_name`, `last_name`, `email`, `phone`) 
        VALUES ('$firstName', '$lastName', '$email', '$phone')";
    if(mysqli_query($dbcon, $guestQuery)){
        $lastID = mysqli_insert_id($dbcon);
    } else {
        echo 'Sorry, we had an issue with our database. Please try again later.';
    }
    
    $reservationQuery = "INSERT INTO `reservation_info`(`guest_id`, `party_size`, `date_of_reservation`, `table_id`) 
        VALUES ('$lastID', '$partySize', '$date', '$tableToReserve')";
    if(mysqli_query($dbcon, $reservationQuery)){
        echo 'Thank you, your reservation has been confirmed.  Please arrive before 9PM on the day of your reservation or your reservation will be forfeited.';
    } else {
        echo 'Sorry, we had an issue with our database. Please try again later.';
    }

} else{
    echo "Sorry, that table isn't available, please select another table and try again.";
}
?>
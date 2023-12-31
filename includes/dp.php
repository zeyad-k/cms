<?php ob_start();

global $connection;
$connection = mysqli_connect('localhost', 'root', '', 'cms');
if (!$connection) {

    die(' connection Failed');

}

// $connection = mysqli_connect('localhost','root','','cms') ;

// if ($connection) 
// {
//     echo "We are connected.";
//     # code...
// }  



?>
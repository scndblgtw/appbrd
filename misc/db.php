<?php
function db_init($host, $duser, $dpw, $dname){
  $conn = mysqli_connect($host, $duser, $dpw);
  mysqli_select_db($conn, $dname);
  return $conn;
}

// function db_init(){
//     $conn = mysqli_connect("localhost", "root", "987654321");
//     mysqli_select_db($conn, 'opentutorials');
//   return $conn;
// }
?>

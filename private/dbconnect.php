<?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'bookship';

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if(!$conn){
        die('Not Connected'.mysqli_connect_error());
    }
  ?>
  <style>
      ::-webkit-scrollbar {
  width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f1f1f1; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #888; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555; 
}
  </style>
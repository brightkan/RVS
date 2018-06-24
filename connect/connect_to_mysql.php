<?php

//THIS CODE WAS TESTED AND WORKS
//place db host name. Sometimes "localhost" but
//sometimes looks like this:>> ???mysql?? someserver.net

$db_host = 'localhost';
//place the username for the Mysql database here

$db_username ='root';

//place the name for the Mysql database here

$db_name = 'rvsudcDBtest';

//place your  Mysql database password here

$db_pass = '';

//Run the actual connection here

$conn = mysqli_connect("$db_host","$db_username","$db_pass","$db_name") or 
die('could not connect to mysql '. mysqli_connect_error().'');

//mysql_select_db("$db_name") or die ('no database '.mysqli_connect_error().'');



?>
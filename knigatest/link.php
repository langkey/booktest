<?php 

$connection = mysqli_connect('127.0.0.1', 'root', '', 'guest_book');

	if($connection == false){
	echo 'Нет подключения к базе данных<br>';
	echo mysqli_connect_error();
		exit();
	}
 ?>
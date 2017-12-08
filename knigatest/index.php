<?php
require "link.php";
require "add.php";

//подсчитываем общее количество записей в таблице
$select1 = mysqli_query($connection, "SELECT COUNT(*) FROM `comments`");
if(!$select1) {die ('Error for count'.mysqli_error());}
$row1 = mysqli_fetch_array($select1);
$count_post = $row1 [0];


echo "<h4>Всего коментариев: $count_post</h4>";	
echo "<br>";


//sort
if (isset($_GET['order'])){
    $order = $_GET['order'];
}else{
    $order = 'nickname';
}

if (isset($_GET['sort'])){
    $sort = $_GET['sort'];
}else{
    $sort = 'ASC';
}

//pagination


$rpp = 25;

//Check for set page
isset($_GET['page']) ? $page = $_GET['page'] : $page = 0;

if($page > 1){
    $start = ($page * $rpp) - $rpp;
}else{
    $start = 0;
}

$resultset = $connection->query("SELECT id FROM comments");

$numRows =  $resultset->num_rows;

$totalPages = $numRows / $rpp;

$resultset = $connection->query("SELECT * FROM comments ORDER BY $order $sort LIMIT $start, $rpp");

//end


if($resultset->num_rows > 0){

	$sort == 'DESC' ? $sort = 'ASC' : $sort = 'DESC';

	echo "
	<table border = '1'>
	<tr>
		<th><a href='?order=nickname&&sort=&sort'>Имя</a></th>
		<th>text</th>
		<th><a href='?order=email&&sort=$sort'>email</a></th>
		<th><a href='?order=pubdate&&sort=$sort'>pubdate</a></th>
		<th>homepage</th>
		</tr>
	";
    
	while($rows = $resultset->fetch_assoc())
	{
		$nickname = $rows['nickname'];
		$email = $rows['email'];
		$pubdate = $rows['pubdate'];
        $text = $rows['text'];
        $homepage = $rows['homepage'];

		echo "
		<tr>
		<td>$nickname</td>
		<td>$text</td>
		<td>$email</td>
		<td>$pubdate</td>
		<td>$homepage</td>
		</tr>
		";
	}

	echo "
	</table>
	";
}


for($x = 1; $x <= $totalPages+1; $x++)
{
    echo "<a href='?page=$x'>$x</a>";
}

?>
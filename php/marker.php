<?php
/*
if(isset($_POST['start']) && isset($_POST['end'])){
	echo $_POST['start']. "," .$_POST['end'];
}*/
$dbconn = pg_connect("host=localhost port=5432 dbname=gis user=postgres ");
$query = "SELECT ST_X(ST_Transform(way,4326)) AS lon, ST_Y(ST_Transform(way,4326)) AS lat, name FROM planet_osm_point WHERE UPPER(name) LIKE UPPER('%".$_POST['locate']."%')";

//query_start = "SELECT ST_X(ST_Transform(way,4326)) AS lon, ST_Y(ST_Transform(way,4326)) AS lat, name FROM beijing_point WHERE name LIKE '%sydney%'";

$result = pg_query($dbconn, $query);

$arr = pg_fetch_all($result);

echo json_encode($arr);

  // Free resultset
pg_free_result($result);

// Closing connection
pg_close($dbconn);
?>
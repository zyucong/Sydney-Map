<?php

$dbconn = pg_connect("host=localhost port=5432 dbname=gis user=postgres");
$query_start = "SELECT ST_X(ST_Transform(way,4326)) AS lon, ST_Y(ST_Transform(way,4326)) AS lat, name FROM planet_osm_point WHERE UPPER(name) LIKE UPPER('%".$_POST['start']."%')";
$query_end = "SELECT ST_X(ST_Transform(way,4326)) AS lon, ST_Y(ST_Transform(way,4326)) AS lat, name FROM planet_osm_point WHERE UPPER(name) LIKE UPPER('%".$_POST['end']."%')";
//$query_start = "SELECT ST_X(ST_Transform(way,4326)) AS lon, ST_Y(ST_Transform(way,4326)) AS lat, name FROM beijing_point WHERE name LIKE '%五道口%'";
//$query_end = "SELECT ST_X(ST_Transform(way,4326)) AS lon, ST_Y(ST_Transform(way,4326)) AS lat, name FROM beijing_point WHERE name LIKE '%四道口%'";

$result_start = pg_query($dbconn, $query_start);
$result_end = pg_query($dbconn, $query_end);
//$affected_start = pg_affected_rows($result_start);
$arr_start = pg_fetch_all($result_start);
$arr_end = pg_fetch_all($result_end);

$arr = array();
array_push($arr,$arr_start);
array_push($arr,$arr_end);
//print_r ($arr);
//echo '</br>';
echo json_encode($arr);
/*
if($row = pg_fetch_assoc($result_start)){
	$lon_start = $row['lon'];
	$lat_start = $row['lat'];
}
if($row = pg_fetch_assoc($result_end)){
	$lon_end = $row['lon'];
	$lat_end = $row['lat'];
}
*/
//echo $lon_start.','.$lat_start.','.$lon_end.','.$lat_end;
//echo $affected_start;
//$coord_start = array($lon_start,$lat_start);
//$coord_end = array($lon_end,$lat_end);
  // Free resultset
pg_free_result($result_start);
pg_free_result($result_end);

// Closing connection
pg_close($dbconn);
?>
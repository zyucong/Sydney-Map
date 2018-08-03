<?php 
$dbconn = pg_connect("host=localhost port=5432 dbname=gis user=postgres");
//$query_knn = "SELECT ST_X(ST_Transform(way,4326)) AS lon, ST_Y(ST_Transform(way,4326)) AS lat, name FROM beijing_point WHERE amenity = 'restaurant' AND name IS NOT NULL ORDER BY ST_Transform(way,4326) <-> 'SRID=4326; POINT(116.349152315585  39.9597649972128)'::geometry LIMIT 10";
if ($_POST['selected'] == 'supermarket'){
	$query_knn = "SELECT ST_X(ST_Transform(way,4326)) AS lon, ST_Y(ST_Transform(way,4326)) AS lat, name FROM planet_osm_point WHERE name IS NOT NULL AND ST_Distance_Sphere(ST_Transform(way, 4326), ST_MakePoint(".$_POST['coord'][0]." , ".$_POST['coord'][1].")) < ".$_POST['radius']." AND shop = 'supermarket' ORDER BY ST_Transform(way,4326) <-> 'SRID=4326; POINT(".$_POST['coord'][0]."  ".$_POST['coord'][1].")'::geometry LIMIT 10";
}elseif($_POST['selected'] == 'hotel'){
	$query_knn = "SELECT ST_X(ST_Transform(way,4326)) AS lon, ST_Y(ST_Transform(way,4326)) AS lat, name FROM planet_osm_point WHERE name IS NOT NULL AND ST_Distance_Sphere(ST_Transform(way, 4326), ST_MakePoint(".$_POST['coord'][0]." , ".$_POST['coord'][1].")) < ".$_POST['radius']." AND tourism = 'hotel' ORDER BY ST_Transform(way,4326) <-> 'SRID=4326; POINT(".$_POST['coord'][0]."  ".$_POST['coord'][1].")'::geometry LIMIT 10";
}else{
	$query_knn = "SELECT ST_X(ST_Transform(way,4326)) AS lon, ST_Y(ST_Transform(way,4326)) AS lat, name FROM planet_osm_point WHERE name IS NOT NULL AND ST_Distance_Sphere(ST_Transform(way, 4326), ST_MakePoint(".$_POST['coord'][0]." , ".$_POST['coord'][1].")) < ".$_POST['radius']." AND amenity = '".$_POST['selected']."' ORDER BY ST_Transform(way,4326) <-> 'SRID=4326; POINT(".$_POST['coord'][0]."  ".$_POST['coord'][1].")'::geometry LIMIT 10";
}

//echo $query_knn;
$result_knn = pg_query($dbconn, $query_knn);
$arr_knn = pg_fetch_all($result_knn);
echo json_encode($arr_knn);
pg_close($dbconn);
?>
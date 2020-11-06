<?php

$output = '';
$sql = "SELECT * FROM nv4_vi_location_district WHERE id_provide = '".$_POST["provideId"]."' ORDER BY alias";
$r1 = $db->query($sql2);
$output = [];
while ($row1 = mysqli_fetch_array($r1)){
    $output .= '<option value="'.$row1["id"].'">'.$row1["title"].'</option>';
}
echo $output;

?>
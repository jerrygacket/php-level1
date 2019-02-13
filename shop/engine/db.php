<?php
function getAssocResult($sql){
    $db = mysqli_connect(HOST, USER, PASS, DB);
	$result = mysqli_query($db, $sql);
	if(is_bool($result)) {
        return [];
    }
	$array_result = array();
	while($row = mysqli_fetch_assoc($result))
		$array_result[] = $row;

    mysqli_close($db);
	return $array_result;
}

function executeQuery($sql){
    $db = mysqli_connect(HOST, USER, PASS, DB);
	$result = mysqli_query($db, $sql);
    mysqli_close($db);
	return $result;
}

function sanitizeSQL($sql){
    $db = mysqli_connect(HOST, USER, PASS, DB);
    $result = mysqli_real_escape_string($db, (string)htmlspecialchars(strip_tags($sql)));
    mysqli_close($db);
    return $result;
}
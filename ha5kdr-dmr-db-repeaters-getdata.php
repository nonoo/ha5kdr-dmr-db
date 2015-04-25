<?php
//	ini_set('display_errors','On');
//	error_reporting(E_ALL);

	function sanitize($s) {
		return strip_tags(stripslashes(trim($s)));
	}

	include('ha5kdr-dmr-db-config.inc.php');

	$conn = mysql_connect(DMR_DB_HOST, DMR_DB_USER, DMR_DB_PASSWORD);
	if (!$conn) {
		echo "can't connect to mysql database!\n";
		return;
	}

	$db = mysql_select_db(DMR_DB_NAME, $conn);
	if (!$db) {
		mysql_close($conn);
		echo "can't connect to mysql database!\n";
		return;
	}

	mysql_query("set names 'utf8'");
	mysql_query("set charset 'utf8'");

	$searchfor = sanitize($_POST['searchfor']);
	$searchtoks = explode(' ', $searchfor);
	$search = '';
	for ($i = 0; $i < count($searchtoks); $i++) {
		if ($i == 0)
			$search = 'where ';
		else
			$search .= 'and ';

		$searchtok = mysql_real_escape_string($searchtoks[$i]);
		$search .= "(`callsign` like '%$searchtok%' or " .
			"`callsignid` like '%$searchtok%' or " .
			"`qrg` like '%$searchtok%' or " .
			"`shift` like '%$searchtok%' or " .
			"`cc` like '%$searchtok%' or " .
			"`mix` like '%$searchtok%' or " .
			"`ctcss` like '%$searchtok%' or " .
			"`net` like '%$searchtok%' or " .
			"`city` like '%$searchtok%' or " .
			"`county` like '%$searchtok%' or " .
			"`country` like '%$searchtok%' or " .
			"`lat` like '%$searchtok%' or " .
			"`lon` like '%$searchtok%') ";
	}

	$sorting = sanitize($_GET['jtSorting']);
	$startindex = sanitize($_GET['jtStartIndex']);
	if (!ctype_digit($startindex))
		return;
	$pagesize = sanitize($_GET['jtPageSize']);
	if (!ctype_digit($pagesize))
		return;

	// Getting record count
	$result = mysql_query('select count(*) as `recordcount` from `' . DMR_DB_TABLE_REPEATERS . '` ' . $search);
	$row = mysql_fetch_array($result);
	$recordcount = $row['recordcount'];

	$result = mysql_query('select * from `' . DMR_DB_TABLE_REPEATERS . '` ' . $search . 'order by ' . mysql_real_escape_string($sorting) .
		' limit ' . mysql_real_escape_string($startindex) . ',' . mysql_real_escape_string($pagesize));
	$rows = array();
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
	    $rows[] = $row;

	$jtableresult = array();
	$jtableresult['Result'] = "OK";
	$jtableresult['TotalRecordCount'] = $recordcount;
	$jtableresult['Records'] = $rows;
	echo json_encode($jtableresult);

	mysql_close($conn);
?>

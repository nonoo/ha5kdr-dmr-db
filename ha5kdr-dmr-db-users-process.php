#!/usr/bin/php5
<?php
	ini_set('display_errors','On');
	error_reporting(E_ALL);

	include('ha5kdr-dmr-db-config.inc.php');

	$dmrdata = file_get_contents(DMR_DB_USER_DATA_URL);
	if ($dmrdata === FALSE) {
		echo "error downloading user data file!\n";
		return 1;
	}

	$conn = mysqli_connect(DMR_DB_HOST, DMR_DB_USER, DMR_DB_PASSWORD, DMR_DB_NAME);
	if (!$conn) {
		echo "can't connect to mysql database!\n";
		return 1;
	}

	$conn->query("set names 'utf8'");
	$conn->query("set charset 'utf8'");

	$rows = explode("\n", $dmrdata);

	// Checking if the second line's first segment is a number.
	$row_exploded = explode(';', $rows[1]);
	if (count($rows) < 10 || !ctype_digit($row_exploded[0])) {
		echo "invalid csv file\n";
		return 1;
	}

	// Deleting old entries.
	$conn->query('truncate table `' . DMR_DB_TABLE_USERS . '`');

	$i = 0;
	foreach ($rows as $row) {
		if ($i++ == 0) // Skipping the first row of the CSV file.
			continue;

		$row_exploded = explode(';', $row);
		if (count($row_exploded) < 4)
			continue;
		$callsign = $row_exploded[1];
		$callsignid = $row_exploded[2];
		$name = $row_exploded[3];
		$country = $row_exploded[4];

		$conn->query('insert into `' . DMR_DB_TABLE_USERS . '` ' .
			'(`callsign`, `callsignid`, `name`, `country`) values (' .
			'"' . $conn->escape_string($callsign) . '", ' .
			'"' . $conn->escape_string($callsignid) . '", ' .
			'"' . $conn->escape_string($name) . '", ' .
			'"' . $conn->escape_string($country) . '")');
	}

	$conn->close();
?>

#!/usr/bin/php5
<?php
	ini_set('display_errors','On');
	error_reporting(E_ALL);

	include('ha5kdr-dmr-db-config.inc.php');

	$dmrdata = file_get_contents(DMR_DB_REPEATER_DATA_URL);
	if ($dmrdata === FALSE) {
		echo "error downloading repeater data file!\n";
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
	$conn->query('truncate table `' . DMR_DB_TABLE_REPEATERS . '`');

	$i = 0;
	foreach ($rows as $row) {
		if ($i++ == 0) // Skipping the first row of the CSV file.
			continue;

		$row_exploded = explode(';', $row);
		if (count($row_exploded) < 4)
			continue;
		$callsign = $row_exploded[1];
		$callsignid = $row_exploded[2];
		$qrg = $row_exploded[3];
		$shift = $row_exploded[4];
		$cc = $row_exploded[5];
		$mix = ($row_exploded[6] ? 1 : 0);
		$ctcss = $row_exploded[7];
		$net = $row_exploded[8];
		$city = $row_exploded[9];
		$county = $row_exploded[10];
		$country = $row_exploded[11];
		$lat = $row_exploded[13];
		$lon = $row_exploded[14];

		$conn->query('insert into `' . DMR_DB_TABLE_REPEATERS . '` ' .
			'(`callsign`, `callsignid`, `qrg`, `shift`, `cc`, `mix`, `ctcss`, ' .
			'`net`, `city`, `county`, `country`, `lat`, `lon`) values (' .
			'"' . $conn->escape_string($callsign) . '", ' .
			'"' . $conn->escape_string($callsignid) . '", ' .
			'"' . $conn->escape_string($qrg) . '", ' .
			'"' . $conn->escape_string($shift) . '", ' .
			'"' . $conn->escape_string($cc) . '", ' .
			'"' . $conn->escape_string($mix) . '", ' .
			'"' . $conn->escape_string($ctcss) . '", ' .
			'"' . $conn->escape_string($net) . '", ' .
			'"' . $conn->escape_string($city) . '", ' .
			'"' . $conn->escape_string($county) . '", ' .
			'"' . $conn->escape_string($country) . '", ' .
			'"' . $conn->escape_string($lat) . '", ' .
			'"' . $conn->escape_string($lon) . '")');
	}

	$conn->close();
?>

<?php
	session_start();
	error_reporting(0);
	include('../config/cfg.php');

	if (isset($_GET['security']) && $_GET['security'] == '123465') {

		$sql = "SELECT 
					mb.branch_id,
					mb.branch_name,
					mb.branch_code,
					mb.address_line,
					p.prov_name,
					c.city_name,
					b.brgy_name
				FROM mgmt_branch mb
				LEFT JOIN ref_provinces p ON p.prov_id = mb.prov_id
				LEFT JOIN ref_cities    c ON c.city_id = mb.city_id
				LEFT JOIN ref_barangays b ON b.brgy_id = mb.brgy_id
				ORDER BY mb.branch_name ASC";

		$n = 1;
		$table = "";

		if ($result = $conn->query($sql)) {
			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {

					$branch_id   = (int)$row['branch_id'];
					$branch_name = htmlspecialchars($row['branch_name'] ?? '', ENT_QUOTES, 'UTF-8');
					$branch_code = htmlspecialchars($row['branch_code'] ?? '', ENT_QUOTES, 'UTF-8');

					$prov = htmlspecialchars($row['prov_name'] ?? '', ENT_QUOTES, 'UTF-8');
					$city = htmlspecialchars($row['city_name'] ?? '', ENT_QUOTES, 'UTF-8');
					$brgy = htmlspecialchars($row['brgy_name'] ?? '', ENT_QUOTES, 'UTF-8');
					$addr = htmlspecialchars($row['address_line'] ?? '', ENT_QUOTES, 'UTF-8');

					$location = trim($brgy . ", " . $city . ", " . $prov . ", " . $addr, " ,");

					$table .= "<tr><td class='text-center'>{$n}</td><td class='text-center' data-column='Branch: '>{$branch_name}</td><td class='text-center' data-column='Code: '>{$branch_code}</td><td class='text-center' data-column='Location: '>{$location}</td><td class='text-center' data-column='Action: '><div class='btn btn-outline-info btn-sm btn-edit' data-id='{$branch_id}'><span class='feather icon-edit'></span></div><div class='btn btn-outline-danger btn-sm btn-del' data-id='{$branch_id}'><span class='feather icon-trash-2'></span></div>	</td></tr>";
					$n++;
				}
				$result->free();
			}
		}

		echo $table;
		exit;
	}
?>

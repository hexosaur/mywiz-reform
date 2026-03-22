<?php
session_start();
error_reporting(0);
include('../../config/cfg.php');

if (isset($_GET['security']) && $_GET['security'] == '123465') {

	$sql = "SELECT 
				p.product_id,
				p.sku,
				p.product_name,
				p.image,
				p.markup,
				p.status,
				c.category_name,
				u.unit_name,
				b.brand_name,
				GROUP_CONCAT(s.supplier_name ORDER BY s.supplier_name SEPARATOR '||') AS suppliers
			FROM inv_products p
			LEFT JOIN inv_categories c ON c.category_id = p.category_id
			LEFT JOIN inv_units u ON u.unit_id = p.base_unit_id
			LEFT JOIN inv_brands b ON b.brand_id = p.brand_id
			LEFT JOIN inv_product_suppliers ps ON ps.product_id = p.product_id
			LEFT JOIN inv_suppliers s ON s.supplier_id = ps.supplier_id
			GROUP BY p.product_id
			ORDER BY p.product_name ASC";

	$n = 1;
	$table = "";

	$result = $conn->query($sql);

	if ($result) {
		while ($row = $result->fetch_assoc()) {

			$id       = (int)$row['product_id'];
			$sku      = htmlspecialchars($row['sku'] ?? '', ENT_QUOTES, 'UTF-8');
			$name     = htmlspecialchars($row['product_name'] ?? '', ENT_QUOTES, 'UTF-8');
			$category = htmlspecialchars($row['category_name'] ?? '', ENT_QUOTES, 'UTF-8');
			$brand    = !empty($row['brand_name'])
				? htmlspecialchars($row['brand_name'], ENT_QUOTES, 'UTF-8')
				: "<span class='text-muted'>No Brand</span>";
			$unit     = htmlspecialchars($row['unit_name'] ?? '', ENT_QUOTES, 'UTF-8');
			$markup   = htmlspecialchars($row['markup'] ?? '0.00', ENT_QUOTES, 'UTF-8');
			$image    = htmlspecialchars($row['image'] ?? '', ENT_QUOTES, 'UTF-8');
			$statusNo = (int)($row['status'] ?? 1);

			if ($statusNo === 1) {
				$status = "<span class='badge badge-pill badge-success'>Active</span>";
			} else if ($statusNo === 2) {
				$status = "<span class='badge badge-pill badge-dark'>End of Life</span>";
			} else if ($statusNo === 3) {
				$status = "<span class='badge badge-pill badge-warning'>Low Stock</span>";
			} else if ($statusNo === 4) {
				$status = "<span class='badge badge-pill badge-secondary'>No Stock</span>";
			} else {
				$status = "<span class='badge badge-pill badge-danger'>Inactive</span>";
			}

			$img_html = $image != ''
				? "<img src='../{$image}' alt='Product Image' class='tbl-product-image'>"
				: "<img src='../pkg/assets/media/img/default.jpg' alt='Default Image' class='tbl-product-image'>";

			// ===== MULTIPLE SUPPLIERS (VERTICAL, MAX 6 + MORE INDICATOR) =====
			$supplier_html = "<span class='text-muted'>No Supplier Tagged</span>";

			if (!empty($row['suppliers'])) {
				$all_suppliers = explode('||', $row['suppliers']);
				$total_suppliers = count($all_suppliers);
				$visible_suppliers = array_slice($all_suppliers, 0, 3);

				$supplier_html = "<div class='tbl-supplier-container'>";

				foreach ($visible_suppliers as $sup) {
					$sup = htmlspecialchars($sup, ENT_QUOTES, 'UTF-8');
					$supplier_html .= "<div class='tbl-supplier-item'>{$sup}</div>";
				}

				if ($total_suppliers > 3) {
					$more_count = $total_suppliers - 3;
					$supplier_html .= "<div class='tbl-supplier-more'>+{$more_count} more</div>";
				}

				$supplier_html .= "</div>";
			}

			$table .= "
				<tr class='align-middle'>
					<td class='text-center align-middle'>{$n}</td>
					<td class='align-middle' data-column='Product: '>
						<div class='d-flex align-items-center'>
							{$img_html}
							<div>
								{$name}<br><small>{$sku}</small>
							</div>
						</div>
					</td>
					<td class='align-middle' data-column='Category: '>{$category}</td>
					<td class='align-middle' data-column='Brand: '>{$brand}</td>
					<td class='align-middle' data-column='Supplier: '>{$supplier_html}</td>
					<td class='text-center align-middle' data-column='Unit: '>{$unit}</td>
					<td class='text-center align-middle' data-column='Markup: '>{$markup}%</td>
					<td class='text-center align-middle' data-column='Status: '>{$status}</td>
					<td class='text-center align-middle' data-column='Action: '>
						<div class='btn btn-outline-info btn-sm btn-edit' data-id='{$id}'><span class='feather icon-edit'></span></div>
						<div class='btn btn-outline-danger btn-sm btn-del' data-id='{$id}'><span class='feather icon-trash-2'></span></div>
					</td>
				</tr>
			";

			$n++;
		}

		echo $table;
		exit;
	}
}
?>
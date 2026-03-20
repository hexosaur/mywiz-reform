-- INVENTORY BASICS
CREATE TABLE inv_categories (
	category_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	category_name VARCHAR(100) NOT NULL UNIQUE,
	description TEXT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE inv_units (
	unit_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	unit_name VARCHAR(50) NOT NULL,
	unit_code VARCHAR(20) NOT NULL UNIQUE,
	description VARCHAR(150) NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE inv_brands (
	brand_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	brand_name VARCHAR(100) NOT NULL UNIQUE,
	description TEXT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE inv_warehouses (
	warehouse_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	warehouse_name VARCHAR(100) NOT NULL UNIQUE,
	warehouse_code VARCHAR(30) NOT NULL UNIQUE,
	address VARCHAR(255) NULL,
	status ENUM('active','inactive') NOT NULL DEFAULT 'active',
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE inv_suppliers (
	supplier_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	supplier_name VARCHAR(150) NOT NULL,
	contact_person VARCHAR(100) NULL,
	contact_number VARCHAR(50) NULL,
	email VARCHAR(100) NULL,
	address VARCHAR(255) NULL,
	tin_no VARCHAR(50) NULL,
	status ENUM('active','inactive') NOT NULL DEFAULT 'active',
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE inv_products (
	product_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	sku VARCHAR(100) NOT NULL UNIQUE,
	barcode VARCHAR(100) NULL UNIQUE,
	product_name VARCHAR(150) NOT NULL,
	category_id INT UNSIGNED NOT NULL,
	base_unit_id INT UNSIGNED NOT NULL,
	brand_id INT UNSIGNED NULL,
	is_serialized TINYINT(1) NOT NULL DEFAULT 0,
	description TEXT NULL,
	reorder_level DECIMAL(12,2) NOT NULL DEFAULT 0.00,
	markup DECIMAL(12,2) NOT NULL DEFAULT 0.00,
	status ENUM('active','inactive') NOT NULL DEFAULT 'active',
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	CONSTRAINT fk_products_category FOREIGN KEY (category_id) REFERENCES inv_categories(category_id),
	CONSTRAINT fk_products_base_unit FOREIGN KEY (base_unit_id) REFERENCES inv_units(unit_id),
	CONSTRAINT fk_products_brand FOREIGN KEY (brand_id) REFERENCES inv_brands(brand_id)
);
CREATE TABLE inv_product_serials (
	serial_id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	product_id INT UNSIGNED NOT NULL,
	serial_no VARCHAR(150) NOT NULL UNIQUE,
	barcode VARCHAR(150) NULL UNIQUE,
	qr_code VARCHAR(150) NULL UNIQUE,
	warehouse_id INT UNSIGNED NOT NULL,
	status ENUM('In Stock','Issued','Sold','Damaged','Lost') NOT NULL DEFAULT 'In Stock',
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	CONSTRAINT fk_serial_product FOREIGN KEY (product_id) REFERENCES inv_products(product_id),
	CONSTRAINT fk_serial_warehouse FOREIGN KEY (warehouse_id) REFERENCES inv_warehouses(warehouse_id)
);

-- ADDED: product unit conversions
CREATE TABLE inv_product_units (
	product_unit_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	product_id INT UNSIGNED NOT NULL,
	unit_id INT UNSIGNED NOT NULL,
	conversion_to_base DECIMAL(12,4) NOT NULL,
	is_default_purchase TINYINT(1) DEFAULT 0,
	is_default_issue TINYINT(1) DEFAULT 0,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	UNIQUE KEY uq_product_unit (product_id, unit_id),
	CONSTRAINT fk_product_units_product FOREIGN KEY (product_id) REFERENCES inv_products(product_id) ON DELETE CASCADE,
	CONSTRAINT fk_product_units_unit FOREIGN KEY (unit_id) REFERENCES inv_units(unit_id)
);


-- INVENTORY PURCHASING AND TRANSFERS
CREATE TABLE inv_purchase_orders (
	po_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	po_no VARCHAR(50) NOT NULL UNIQUE,
	supplier_id INT UNSIGNED NOT NULL,
	warehouse_id INT UNSIGNED NOT NULL,
	po_date DATE NOT NULL,
	expected_date DATE NULL,
	status ENUM('Draft','Approved','Partially Received','Received','Cancelled') NOT NULL DEFAULT 'Draft',
	remarks TEXT NULL,
	subtotal DECIMAL(12,2) NOT NULL DEFAULT 0.00,
	discount_amount DECIMAL(12,2) NOT NULL DEFAULT 0.00,
	tax_amount DECIMAL(12,2) NOT NULL DEFAULT 0.00,
	total_amount DECIMAL(12,2) NOT NULL DEFAULT 0.00,
	created_by INT UNSIGNED NULL,
	approved_by INT UNSIGNED NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	CONSTRAINT fk_po_supplier FOREIGN KEY (supplier_id) REFERENCES inv_suppliers(supplier_id),
	CONSTRAINT fk_po_warehouse FOREIGN KEY (warehouse_id) REFERENCES inv_warehouses(warehouse_id)
);

-- MODIFIED: added unit_id
CREATE TABLE inv_purchase_order_items (
	po_item_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	po_id INT UNSIGNED NOT NULL,
	product_id INT UNSIGNED NOT NULL,
	unit_id INT UNSIGNED NOT NULL, -- ADDED
	qty_ordered DECIMAL(12,2) NOT NULL,
	qty_received DECIMAL(12,2) NOT NULL DEFAULT 0.00,
	unit_cost DECIMAL(12,2) NOT NULL,
	line_discount DECIMAL(12,2) NOT NULL DEFAULT 0.00,
	line_total DECIMAL(12,2) NOT NULL DEFAULT 0.00,
	CONSTRAINT fk_po_items_po FOREIGN KEY (po_id) REFERENCES inv_purchase_orders(po_id) ON DELETE CASCADE,
	CONSTRAINT fk_po_items_product FOREIGN KEY (product_id) REFERENCES inv_products(product_id),
	CONSTRAINT fk_po_items_unit FOREIGN KEY (unit_id) REFERENCES inv_units(unit_id) -- ADDED
);

-- RECEIVING SECTION
CREATE TABLE inv_receivings (
	receiving_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	receiving_no VARCHAR(50) NOT NULL UNIQUE,
	po_id INT UNSIGNED NOT NULL,
	supplier_id INT UNSIGNED NOT NULL,
	warehouse_id INT UNSIGNED NOT NULL,
	receiving_date DATE NOT NULL,
	reference_no VARCHAR(100) NULL,
	remarks TEXT NULL,
	created_by INT UNSIGNED NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	CONSTRAINT fk_receiving_po FOREIGN KEY (po_id) REFERENCES inv_purchase_orders(po_id),
	CONSTRAINT fk_receiving_supplier FOREIGN KEY (supplier_id) REFERENCES inv_suppliers(supplier_id),
	CONSTRAINT fk_receiving_warehouse FOREIGN KEY (warehouse_id) REFERENCES inv_warehouses(warehouse_id)
);

-- MODIFIED: added unit_id
CREATE TABLE inv_receiving_items (
	receiving_item_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	receiving_id INT UNSIGNED NOT NULL,
	po_item_id INT UNSIGNED NOT NULL,
	product_id INT UNSIGNED NOT NULL,
	unit_id INT UNSIGNED NOT NULL, -- ADDED
	qty_received DECIMAL(12,2) NOT NULL,
	unit_cost DECIMAL(12,2) NOT NULL,
	line_total DECIMAL(12,2) NOT NULL DEFAULT 0.00,
	CONSTRAINT fk_receiving_items_receiving FOREIGN KEY (receiving_id) REFERENCES inv_receivings(receiving_id) ON DELETE CASCADE,
	CONSTRAINT fk_receiving_items_po_item FOREIGN KEY (po_item_id) REFERENCES inv_purchase_order_items(po_item_id),
	CONSTRAINT fk_receiving_items_product FOREIGN KEY (product_id) REFERENCES inv_products(product_id),
	CONSTRAINT fk_receiving_items_unit FOREIGN KEY (unit_id) REFERENCES inv_units(unit_id) -- ADDED
);

-- STOCK MOVEMENTS
CREATE TABLE inv_stock_movements (
	movement_id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	movement_date DATETIME NOT NULL,
	reference_type ENUM(
		'opening_balance',
		'purchase_receiving',
		'transfer_out',
		'transfer_in',
		'adjustment_add',
		'adjustment_less',
		'stock_count_gain',
		'stock_count_loss',
		'issuance',
		'return_in',
		'return_out'
	) NOT NULL,
	reference_id INT UNSIGNED NULL,
	reference_no VARCHAR(50) NULL,
	warehouse_id INT UNSIGNED NOT NULL,
	product_id INT UNSIGNED NOT NULL,
	qty_in DECIMAL(12,2) NOT NULL DEFAULT 0.00,
	qty_out DECIMAL(12,2) NOT NULL DEFAULT 0.00,
	unit_cost DECIMAL(12,2) NOT NULL DEFAULT 0.00,
	remarks TEXT NULL,
	created_by INT UNSIGNED NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	CONSTRAINT fk_movements_warehouse FOREIGN KEY (warehouse_id) REFERENCES inv_warehouses(warehouse_id),
	CONSTRAINT fk_movements_product FOREIGN KEY (product_id) REFERENCES inv_products(product_id)
);
CREATE TABLE inv_stock_transfers (
	transfer_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	transfer_no VARCHAR(50) NOT NULL UNIQUE,
	from_warehouse_id INT UNSIGNED NOT NULL,
	to_warehouse_id INT UNSIGNED NOT NULL,
	transfer_date DATE NOT NULL,
	status ENUM('draft','approved','completed','cancelled') NOT NULL DEFAULT 'draft',
	remarks TEXT NULL,
	created_by INT UNSIGNED NULL,
	approved_by INT UNSIGNED NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	CONSTRAINT fk_transfer_from_warehouse FOREIGN KEY (from_warehouse_id) REFERENCES inv_warehouses(warehouse_id),
	CONSTRAINT fk_transfer_to_warehouse FOREIGN KEY (to_warehouse_id) REFERENCES inv_warehouses(warehouse_id)
);
CREATE TABLE inv_stock_transfer_items (
	transfer_item_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	transfer_id INT UNSIGNED NOT NULL,
	product_id INT UNSIGNED NOT NULL,
	unit_id INT UNSIGNED NOT NULL, -- ADDED
	qty DECIMAL(12,2) NOT NULL,
	unit_cost DECIMAL(12,2) NOT NULL DEFAULT 0.00,
	CONSTRAINT fk_transfer_items_transfer FOREIGN KEY (transfer_id) REFERENCES inv_stock_transfers(transfer_id) ON DELETE CASCADE,
	CONSTRAINT fk_transfer_items_product FOREIGN KEY (product_id) REFERENCES inv_products(product_id),
	CONSTRAINT fk_transfer_items_unit FOREIGN KEY (unit_id) REFERENCES inv_units(unit_id) -- ADDED
);
CREATE TABLE inv_stock_adjustments (
	adjustment_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	adjustment_no VARCHAR(50) NOT NULL UNIQUE,
	warehouse_id INT UNSIGNED NOT NULL,
	adjustment_date DATE NOT NULL,
	reason VARCHAR(150) NULL,
	status ENUM('draft','posted','cancelled') NOT NULL DEFAULT 'draft',
	remarks TEXT NULL,
	created_by INT UNSIGNED NULL,
	approved_by INT UNSIGNED NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	CONSTRAINT fk_adjustment_warehouse FOREIGN KEY (warehouse_id) REFERENCES inv_warehouses(warehouse_id)
);
-- MODIFIED: added unit_id
CREATE TABLE inv_stock_adjustment_items (
	adjustment_item_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	adjustment_id INT UNSIGNED NOT NULL,
	product_id INT UNSIGNED NOT NULL,
	unit_id INT UNSIGNED NOT NULL, -- ADDED
	adjustment_type ENUM('add','deduct') NOT NULL,
	qty DECIMAL(12,2) NOT NULL,
	unit_cost DECIMAL(12,2) NOT NULL DEFAULT 0.00,
	remarks VARCHAR(255) NULL,
	CONSTRAINT fk_adjustment_items_adjustment FOREIGN KEY (adjustment_id) REFERENCES inv_stock_adjustments(adjustment_id) ON DELETE CASCADE,
	CONSTRAINT fk_adjustment_items_product FOREIGN KEY (product_id) REFERENCES inv_products(product_id),
	CONSTRAINT fk_adjustment_items_unit FOREIGN KEY (unit_id) REFERENCES inv_units(unit_id) -- ADDED
);
CREATE TABLE inv_stock_counts (
	stock_count_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	stock_count_no VARCHAR(50) NOT NULL UNIQUE,
	warehouse_id INT UNSIGNED NOT NULL,
	count_date DATE NOT NULL,
	status ENUM('draft','reconciled','posted','cancelled') NOT NULL DEFAULT 'draft',
	remarks TEXT NULL,
	created_by INT UNSIGNED NULL,
	approved_by INT UNSIGNED NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	CONSTRAINT fk_stock_count_warehouse FOREIGN KEY (warehouse_id) REFERENCES inv_warehouses(warehouse_id)
);
-- MODIFIED: added unit_id
CREATE TABLE inv_stock_count_items (
	stock_count_item_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	stock_count_id INT UNSIGNED NOT NULL,
	product_id INT UNSIGNED NOT NULL,
	unit_id INT UNSIGNED NOT NULL, -- ADDED
	system_qty DECIMAL(12,2) NOT NULL DEFAULT 0.00,
	counted_qty DECIMAL(12,2) NOT NULL DEFAULT 0.00,
	variance_qty DECIMAL(12,2) NOT NULL DEFAULT 0.00,
	unit_cost DECIMAL(12,2) NOT NULL DEFAULT 0.00,
	CONSTRAINT fk_stock_count_items_count FOREIGN KEY (stock_count_id) REFERENCES inv_stock_counts(stock_count_id) ON DELETE CASCADE,
	CONSTRAINT fk_stock_count_items_product FOREIGN KEY (product_id) REFERENCES inv_products(product_id),
	CONSTRAINT fk_stock_count_items_unit FOREIGN KEY (unit_id) REFERENCES inv_units(unit_id) -- ADDED
);
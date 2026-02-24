-- **************************************************** -- 
-- ************		ORGANIZATIONAL TABLE	*********** -- 
-- **************************************************** -- 

-- <!-- THIS IS FOR THE BRANCHES -->
CREATE TABLE IF NOT EXISTS mgmt_branch (
	branch_id     INT UNSIGNED NOT NULL AUTO_INCREMENT,
	branch_name   VARCHAR(150) NOT NULL,
	branch_code   VARCHAR(30)  NOT NULL,
	prov_id       INT UNSIGNED NOT NULL,
	city_id       INT UNSIGNED NOT NULL,
	brgy_id       INT UNSIGNED NOT NULL,
	address_line  VARCHAR(255) NOT NULL,
	created_at    TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	updated_at    TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (branch_id),
	UNIQUE KEY uq_branch_code (branch_code),
	KEY idx_branch_prov (prov_id),
	KEY idx_branch_city (city_id),
	KEY idx_branch_brgy (brgy_id),
	CONSTRAINT fk_branch_province
		FOREIGN KEY (prov_id) REFERENCES ref_provinces(prov_id)
		ON UPDATE CASCADE ON DELETE RESTRICT,
	CONSTRAINT fk_branch_city
		FOREIGN KEY (city_id) REFERENCES ref_cities(city_id)
		ON UPDATE CASCADE ON DELETE RESTRICT,
	CONSTRAINT fk_branch_barangay
		FOREIGN KEY (brgy_id) REFERENCES ref_barangays(brgy_id)
		ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- <!-- THIS IS FOR THE C DEPARTMENT DO NOT CHANGE IT JUST INSERT THIS AS WELL UNLESS YOU WANT MODIFICATION-->
CREATE TABLE IF NOT EXISTS mgmt_departments (
	department_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	department_name VARCHAR(150) NOT NULL,
	department_scope ENUM('all', 'specific') NOT NULL DEFAULT 'all',
	created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (department_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO mgmt_departments (department_name, department_scope) 
VALUES 
	('Administration', 'all'),
	('Finance', 'all'),
	('Human Resource', 'all'),
	('Sales & Marketing', 'all'),
	('Operations', 'all'),
	('Customer Service', 'all'),
	('Information Technology', 'all');

-- THIS TABLE IS FOR ACCESS LEVEL MEANIGN HEIRARCHY ON WHICH IS USEFUL FOR MULTIPLE SYSTEM FUNCTIONALITY
CREATE TABLE IF NOT EXISTS ref_access_levels (
	access_level_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	access_level_name VARCHAR(150) NOT NULL,
	access_level_description TEXT,
	access_level_value INT NOT NULL,
	created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	
	PRIMARY KEY (access_level_id),
	UNIQUE KEY uq_access_level_name (access_level_name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- <!-- THIS IS FOR ROLES TABLE -->
CREATE TABLE IF NOT EXISTS mgmt_roles (
	role_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	role_name VARCHAR(150) NOT NULL,
	role_description TEXT,
	department_id INT UNSIGNED NOT NULL,
	access_level_id INT UNSIGNED NOT NULL,
	created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	
	PRIMARY KEY (role_id),
	FOREIGN KEY (department_id) REFERENCES mgmt_departments(department_id) ON DELETE CASCADE,
	FOREIGN KEY (access_level_id) REFERENCES ref_access_levels(access_level_id) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- <!-- THIS IS FOR PERMISSIONS TABLE -->
CREATE TABLE IF NOT EXISTS mgmt_permissions (
	permission_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	permission_name VARCHAR(150) NOT NULL,
	permission_title VARCHAR(150) NOT NULL,
	permission_class VARCHAR(150) NOT NULL,
	permission_description TEXT,
	PRIMARY KEY (permission_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- <!-- THIS IS A MERGING TABLE FOR PERMISSIONS AND ROLES -->
CREATE TABLE IF NOT EXISTS mgmt_role_permissions (
	role_permission_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	role_id INT UNSIGNED NOT NULL,
	permission_id INT UNSIGNED NOT NULL,
	PRIMARY KEY (role_permission_id),
	FOREIGN KEY (role_id) REFERENCES mgmt_roles(role_id) ON DELETE CASCADE,
	FOREIGN KEY (permission_id) REFERENCES mgmt_permissions(permission_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
-- Insert preset permissions
INSERT INTO mgmt_permissions (permission_name, permission_title, permission_class, permission_description)
VALUES 
	('view_branch', 'View Branch', 'branch-permission', 'Permission to view branch data'),
	('edit_branch', 'Edit Branch', 'branch-permission', 'Permission to edit branch data'),
	('delete_branch', 'Delete Branch', 'branch-permission', 'Permission to delete branch data'),
	('view_designation', 'View Designation', 'designation-permission', 'Permission to view designation data'),
	('edit_designation', 'Edit Designation', 'designation-permission', 'Permission to edit designation data'),
	('delete_designation', 'Delete Designation', 'designation-permission', 'Permission to delete designation data'),
	('view_employee', 'View Employee', 'employee-permission', 'Permission to view employee data'),
	('edit_employee', 'Edit Employee', 'employee-permission', 'Permission to edit employee data'),
	('delete_employee', 'Delete Employee', 'employee-permission', 'Permission to delete employee data'),
	('view_leave_category', 'View Leave Category', 'leave-category-permission', 'Permission to view leave category data'),
	('edit_leave_category', 'Edit Leave Category', 'leave-category-permission', 'Permission to edit leave category data'),
	('delete_leave_category', 'Delete Leave Category', 'leave-category-permission', 'Permission to delete leave category data'),
	('view_leave_archive', 'View Leave Archive', 'leave-archive-permission', 'Permission to view archived leave data'),
	('edit_leave_archive', 'Edit Leave Archive', 'leave-archive-permission', 'Permission to edit archived leave data'),
	('delete_leave_archive', 'Delete Leave Archive', 'leave-archive-permission', 'Permission to delete archived leave data'),
	('view_leave_archive', 'View Leave Archive', 'leave-archive-permission', 'Permission to view archived leave data'),
	('edit_leave_archive', 'Edit Leave Archive', 'leave-archive-permission', 'Permission to edit archived leave data'),
	('delete_leave_archive', 'Delete Leave Archive', 'leave-archive-permission', 'Permission to delete archived leave data'),
	('view_product_brand', 'View Product Brand', 'product-brand-permission', 'Permission to view product brand data'),
	('edit_product_brand', 'Edit Product Brand', 'product-brand-permission', 'Permission to edit product brand data'),
	('delete_product_brand', 'Delete Product Brand', 'product-brand-permission', 'Permission to delete product brand data'),
	('view_product_supplier', 'View Product Supplier', 'product-supplier-permission', 'Permission to view product supplier data'),
	('edit_product_supplier', 'Edit Product Supplier', 'product-supplier-permission', 'Permission to edit product supplier data'),
	('delete_product_supplier', 'Delete Product Supplier', 'product-supplier-permission', 'Permission to delete product supplier data'),
	('view_product', 'View Product', 'product-permission', 'Permission to view product data'),
	('edit_product', 'Edit Product', 'product-permission', 'Permission to edit product data'),
	('delete_product', 'Delete Product', 'product-permission', 'Permission to delete product data'),
	('view_product_purchase', 'View Product Purchase', 'product-purchase-permission', 'Permission to view product purchase data'),
	('edit_product_purchase', 'Edit Product Purchase', 'product-purchase-permission', 'Permission to edit product purchase data'),
	('delete_product_purchase', 'Delete Product Purchase', 'product-purchase-permission', 'Permission to delete product purchase data'),
	('view_product_transfer', 'View Product Transfer', 'product-transfer-permission', 'Permission to view product transfer data'),
	('edit_product_transfer', 'Edit Product Transfer', 'product-transfer-permission', 'Permission to edit product transfer data'),
	('delete_product_transfer', 'Delete Product Transfer', 'product-transfer-permission', 'Permission to delete product transfer data'),
	('view_customer', 'View Customer', 'customer-permission', 'Permission to view customer data'),
	('edit_customer', 'Edit Customer', 'customer-permission', 'Permission to edit customer data'),
	('delete_customer', 'Delete Customer', 'customer-permission', 'Permission to delete customer data'),
	('view_pos_dashboard', 'View POS Dashboard', 'pos-dashboard-permission', 'Permission to view the POS dashboard'),
	('edit_pos_dashboard', 'Edit POS Dashboard', 'pos-dashboard-permission', 'Permission to edit POS dashboard settings'),
	('view_pos_customer', 'View POS Customer', 'pos-customer-permission', 'Permission to view customer data in the POS'),
	('edit_pos_customer', 'Edit POS Customer', 'pos-customer-permission', 'Permission to edit customer data in the POS'),
	('view_pos_sales', 'View POS Sales', 'pos-sales-permission', 'Permission to view POS sales data'),
	('edit_pos_sales', 'Edit POS Sales', 'pos-sales-permission', 'Permission to edit POS sales data'),
	('view_pos_discount', 'View POS Discounts', 'pos-discount-permission', 'Permission to view POS discount data'),
	('edit_pos_discount', 'Edit POS Discounts', 'pos-discount-permission', 'Permission to edit POS discount data');

-- EMPLOYEE MANAGEMENT TABLE 
CREATE TABLE IF NOT EXISTS mgmt_employees (
	employee_id       INT UNSIGNED NOT NULL AUTO_INCREMENT,
	employee_code     VARCHAR(30) NULL,            -- optional (you can auto-generate later)
	first_name        VARCHAR(80)  NOT NULL,
	middle_name       VARCHAR(80)  NULL,
	surname           VARCHAR(80)  NOT NULL,
	suffix            VARCHAR(20)  NULL,
	birth_date        DATE         NULL,
	marital_status    VARCHAR(30)  NULL,
	gender            VARCHAR(20)  NULL,
	email             VARCHAR(150) NULL,
	contact_no        VARCHAR(30)  NULL,
	prov_id           INT NULL,
	city_id           INT NULL,
	brgy_id           INT NULL,
	address_line      VARCHAR(255) NULL,
	date_hired        DATE         NULL,
	branch_id         INT UNSIGNED NOT NULL,
	department_id     INT UNSIGNED NOT NULL,
	role_id           INT UNSIGNED NOT NULL,
	daily_rate        DECIMAL(12,2) NULL,
	sss_no            VARCHAR(30)  NULL,
	pagibig_no        VARCHAR(30)  NULL,
	tin_no            VARCHAR(30)  NULL,
	philhealth_no     VARCHAR(30)  NULL,
	is_active         TINYINT(1) NOT NULL DEFAULT 1,
	created_at        TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	updated_at        TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (employee_id),
	UNIQUE KEY uq_emp_email (email),
	UNIQUE KEY uq_emp_code  (employee_code),
	KEY idx_emp_branch (branch_id),
	KEY idx_emp_dept   (department_id),
	KEY idx_emp_role   (role_id),
	KEY idx_emp_prov   (prov_id),
	KEY idx_emp_city   (city_id),
	KEY idx_emp_brgy   (brgy_id),

	CONSTRAINT fk_emp_branch
		FOREIGN KEY (branch_id) REFERENCES mgmt_branch(branch_id)
		ON UPDATE CASCADE ON DELETE RESTRICT,
	CONSTRAINT fk_emp_department
		FOREIGN KEY (department_id) REFERENCES mgmt_departments(department_id)
		ON UPDATE CASCADE ON DELETE RESTRICT,
	CONSTRAINT fk_emp_role
		FOREIGN KEY (role_id) REFERENCES mgmt_roles(role_id)
		ON UPDATE CASCADE ON DELETE RESTRICT,
	CONSTRAINT fk_emp_prov
		FOREIGN KEY (prov_id) REFERENCES ref_provinces(prov_id)
		ON UPDATE CASCADE ON DELETE RESTRICT,
	CONSTRAINT fk_emp_city
		FOREIGN KEY (city_id) REFERENCES ref_cities(city_id)
		ON UPDATE CASCADE ON DELETE RESTRICT,
	CONSTRAINT fk_emp_brgy
		FOREIGN KEY (brgy_id) REFERENCES ref_barangays(brgy_id)
		ON UPDATE CASCADE ON DELETE RESTRICT

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- USER MANAGEMENT TABLE
CREATE TABLE IF NOT EXISTS mgmt_users (
	user_id        INT UNSIGNED NOT NULL AUTO_INCREMENT,
	employee_id    INT UNSIGNED NOT NULL,
	username       VARCHAR(180) NOT NULL,
	password_hash  VARCHAR(255) NOT NULL,
	last_login_at  DATETIME NULL,
	created_at     TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	updated_at     TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

	PRIMARY KEY (user_id),

	UNIQUE KEY uq_users_username (username),
	UNIQUE KEY uq_users_employee (employee_id),

	KEY idx_users_employee (employee_id),

	CONSTRAINT fk_users_employee
		FOREIGN KEY (employee_id) REFERENCES mgmt_employees(employee_id)
		ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- SUPERADMIN TABLE
CREATE TABLE IF NOT EXISTS admin_superadmin (
    admin_id               INT UNSIGNED NOT NULL AUTO_INCREMENT,
    first_name             VARCHAR(80) NOT NULL,
    middle_name            VARCHAR(80) NULL,
    surname                VARCHAR(80) NOT NULL,
    suffix                 VARCHAR(20) NULL,
    username               VARCHAR(50) NOT NULL,
    password               VARCHAR(255) NOT NULL,
    is_active              TINYINT(1) NOT NULL DEFAULT 1,
    created_at             TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (admin_id),
    UNIQUE KEY uq_admin_username (username),
    UNIQUE KEY uq_admin_full_name (first_name, surname)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- DEFAULT super admin where username is administrator with a pass of admin@123465
INSERT INTO admin_superadmin (first_name, middle_name, surname, suffix, username, password, is_active)  VALUES ('Super Admin', NULL, 'Default', NULL, 'administrator', '59b7068b69ca4d4b48859c110334fc8c60e85151', '1');

-- **************************************************** -- 
-- ************		LEAVE MGMT TABLE	*************** -- 
-- **************************************************** -- 

-- BASICALLY THE LEAVE CATEGORIES NAME 
CREATE TABLE IF NOT EXISTS leave_types (
	type_id                INT UNSIGNED NOT NULL AUTO_INCREMENT,
	type_code              VARCHAR(30)  NOT NULL,
	type_name              VARCHAR(150) NOT NULL,
	type_description       TEXT NULL,
	with_pay               TINYINT(1) NOT NULL DEFAULT 1,
	requires_attachment    TINYINT(1) NOT NULL DEFAULT 0,
	requires_proxy         TINYINT(1) NOT NULL DEFAULT 0,
	default_allowed_days   DECIMAL(6,2) NOT NULL DEFAULT 0,
	allow_half_day         TINYINT(1) NOT NULL DEFAULT 1,
	gender 				   ENUM('All', 'Male', 'Female') NOT NULL DEFAULT 'All',
	is_active              TINYINT(1) NOT NULL DEFAULT 1,
	created_at             TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	updated_at             TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (type_id),
	UNIQUE KEY uq_leave_type_code (type_code),
	UNIQUE KEY uq_leave_type_name (type_name)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- LEAVE ENTITLEMENTS
CREATE TABLE IF NOT EXISTS leave_entitlements (
	entitlement_id      INT UNSIGNED NOT NULL AUTO_INCREMENT,
	employee_id         INT UNSIGNED NOT NULL,
	type_id             INT UNSIGNED NOT NULL,	
	scope               TINYINT(1) NOT NULL DEFAULT 0,
	entitlement_year    YEAR NULL,
	allocated_days      DECIMAL(6,2) NOT NULL DEFAULT 0.00,
	modified_days       DECIMAL(6,2) NOT NULL DEFAULT 0.00,
	used_days           DECIMAL(6,2) NOT NULL DEFAULT 0.00,
	last_modified_by    INT UNSIGNED NULL,
	last_modified_at    TIMESTAMP NULL,
	remarks             TEXT NULL,
	created_at          TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	updated_at          TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

	PRIMARY KEY (entitlement_id),
	UNIQUE KEY uq_entitlement_year (employee_id, type_id, entitlement_year, scope),
	KEY idx_ent_employee (employee_id),
	KEY idx_ent_type (type_id),
	KEY idx_ent_scope_year (scope, entitlement_year),
	CONSTRAINT fk_ent_type
		FOREIGN KEY (type_id) REFERENCES leave_types(type_id)
		ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT fk_ent_employee
		FOREIGN KEY (employee_id) REFERENCES mgmt_employees(employee_id)
		ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- RESET LEAVE ENTITLEMENTS FOR A NEW YEAR
UPDATE leave_entitlements SET
	used_days = 0,  -- Reset used_days
	remaining_days = allocated_days + modified_days,  -- Reset remaining days based on allocated and modified days
	modified_days = CASE
		WHEN scope = 0 THEN 0  -- Reset modified_days only for YEAR_ONLY
		ELSE modified_days  -- Keep modified_days unchanged for ALL_YEARS
	END
WHERE
	(scope = 0 AND entitlement_year = YEAR(CURDATE()) - 1)  -- Reset for the previous year
	OR
	(scope = 1 AND entitlement_year IS NULL);  -- Reset for ALL_YEARS (no specific year)

-- LEAVE REQUEST TABLE SECTION







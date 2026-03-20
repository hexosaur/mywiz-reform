SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
SET FOREIGN_KEY_CHECKS = 0;


-- *************************************************************************************************** --
-- *********************************        CREATE TABLES FIRST      ********************************* --
-- *************************************************************************************************** --


-- ***************************************** --
-- ********    MANAGEMENT TABLE      ******* --
-- ***************************************** --
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
    KEY idx_branch_brgy (brgy_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS mgmt_departments (
    department_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    department_name VARCHAR(150) NOT NULL,
    department_scope ENUM('all', 'specific') NOT NULL DEFAULT 'all',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (department_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

CREATE TABLE IF NOT EXISTS mgmt_roles (
    role_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    role_name VARCHAR(150) NOT NULL,
    role_description TEXT,
    department_id INT UNSIGNED NOT NULL,
    access_level_id INT UNSIGNED NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (role_id),
    KEY idx_roles_department (department_id),
    KEY idx_roles_access_level (access_level_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS mgmt_permissions (
    permission_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    permission_name VARCHAR(150) NOT NULL,
    permission_title VARCHAR(150) NOT NULL,
    permission_class VARCHAR(150) NOT NULL,
    permission_description TEXT,
    PRIMARY KEY (permission_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS mgmt_role_permissions (
    role_permission_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    role_id INT UNSIGNED NOT NULL,
    permission_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (role_permission_id),
    KEY idx_role_permissions_role (role_id),
    KEY idx_role_permissions_permission (permission_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS mgmt_employees (
    employee_id       INT UNSIGNED NOT NULL AUTO_INCREMENT,
    employee_code     VARCHAR(30) NULL,
    first_name        VARCHAR(80)  NOT NULL,
    middle_name       VARCHAR(80)  NULL,
    surname           VARCHAR(80)  NOT NULL,
    suffix            VARCHAR(20)  NULL,
    birth_date        DATE         NULL,
    marital_status    VARCHAR(30)  NULL,
    gender            VARCHAR(20)  NULL,
    email             VARCHAR(150) NULL,
    contact_no        VARCHAR(30)  NULL,
    prov_id           INT UNSIGNED NULL,
    city_id           INT UNSIGNED NULL,
    brgy_id           INT UNSIGNED NULL,
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
    KEY idx_emp_brgy   (brgy_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS mgmt_users (
    user_id        INT UNSIGNED NOT NULL AUTO_INCREMENT,
    employee_id    INT UNSIGNED NOT NULL,
    username       VARCHAR(180) NOT NULL,
    password_hash  VARCHAR(255) NOT NULL,
    profile_photo  VARCHAR(255) NULL,
    last_login_at  DATETIME NULL,
    created_at     TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at     TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id),
    UNIQUE KEY uq_users_username (username),
    UNIQUE KEY uq_users_employee (employee_id),
    KEY idx_users_employee (employee_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

CREATE TABLE IF NOT EXISTS auth_remember_tokens (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    user_type ENUM('admin','employee') NOT NULL,
    selector CHAR(12) NOT NULL,
    token_hash CHAR(64) NOT NULL,
    expires_at DATETIME NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    last_used_at DATETIME NULL,
    user_agent VARCHAR(255) NULL,
    ip_address VARCHAR(45) NULL,
    UNIQUE KEY uq_auth_selector (selector),
    INDEX idx_auth_user_type (user_id, user_type),
    INDEX idx_auth_expires (expires_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- ***************************************** --
-- **********    LEAVE TABLE      ********** --
-- ***************************************** --

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
    gender                 ENUM('All', 'Male', 'Female') NOT NULL DEFAULT 'All',
    is_active              TINYINT(1) NOT NULL DEFAULT 1,
    created_at             TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at             TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (type_id),
    UNIQUE KEY uq_leave_type_code (type_code),
    UNIQUE KEY uq_leave_type_name (type_name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
    KEY idx_ent_scope_year (scope, entitlement_year)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS ref_leave_reset_logs (
    reset_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    reset_year YEAR NOT NULL,
    reset_done_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    reset_done_by INT UNSIGNED NULL,
    PRIMARY KEY (reset_id),
    UNIQUE KEY uq_reset_year (reset_year)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS leave_requests (
    request_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    employee_id INT UNSIGNED NOT NULL,
    entitlement_id INT UNSIGNED NOT NULL,
    proxy_employee_id INT UNSIGNED NULL,
    purpose TEXT NULL,
    date_from DATE NOT NULL,
    date_to DATE NOT NULL,
    time_from ENUM('Morning','Afternoon') NULL,
    time_to   ENUM('Morning','Afternoon') NULL,
    requested_days DECIMAL(6,2) NOT NULL DEFAULT 0.00,
    status ENUM('Pending','Approved','Rejected','Cancelled') NOT NULL DEFAULT 'Pending',
    attachment VARCHAR(255) NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_lr_emp (employee_id),
    INDEX idx_lr_status (status),
    INDEX idx_lr_ent (entitlement_id),
    INDEX idx_lr_proxy (proxy_employee_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS leave_request_steps (
    step_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    request_id INT UNSIGNED NOT NULL,
    step_no INT UNSIGNED NOT NULL,
    step_type ENUM('BR_DEPT_CHAIN','BRANCH_CHAIN','HR','TOP') NOT NULL,
    required_min_value INT NOT NULL,
    branch_id INT UNSIGNED NULL,
    department_id INT UNSIGNED NULL,
    step_status ENUM('Pending','Approved','Rejected','Cancelled') NOT NULL DEFAULT 'Pending',
    acted_by INT UNSIGNED NULL,
    acted_at DATETIME NULL,
    remarks VARCHAR(255) NULL,
    UNIQUE KEY uq_req_step (request_id, step_no),
    INDEX idx_steps_req (request_id, step_no),
    KEY idx_steps_actor (acted_by)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ***************************************** --
-- ********    INVENTORY TABLE      ******** --
-- ***************************************** --






-- ***************************************** --
-- *********    PROJECT TABLE      ********* --
-- ***************************************** --









-- *************************************************************************************************** --
-- *******************************        INSERT DATA ON TABLES       ******************************** --
-- *************************************************************************************************** --
INSERT INTO mgmt_departments (department_name, department_scope)
VALUES
    ('Administration', 'all'),
    ('Finance', 'all'),
    ('Human Resource', 'all'),
    ('Sales & Marketing', 'all'),
    ('Operations', 'all'),
    ('Customer Service', 'all'),
    ('Information Technology', 'all');

INSERT INTO mgmt_permissions (permission_name, permission_title, permission_class, permission_description)
VALUES
    ('view_branch', 'View Branch', 'admin-permission', 'Permission to view branch data'),
    ('edit_branch', 'Edit Branch', 'admin-permission', 'Permission to edit branch data'),
    ('delete_branch', 'Delete Branch', 'admin-permission', 'Permission to delete branch data'),
    ('view_designation', 'View Designation', 'admin-permission', 'Permission to view designation data'),
    ('edit_designation', 'Edit Designation', 'admin-permission', 'Permission to edit designation data'),
    ('delete_designation', 'Delete Designation', 'admin-permission', 'Permission to delete designation data'),
    ('view_employee', 'View Employee', 'admin-permission', 'Permission to view employee data'),
    ('edit_employee', 'Edit Employee', 'admin-permission', 'Permission to edit employee data'),
    ('delete_employee', 'Delete Employee', 'admin-permission', 'Permission to delete employee data'),
    ('view_leave_category', 'View Leave Category', 'hr-permission', 'Permission to view leave category data'),
    ('edit_leave_category', 'Edit Leave Category', 'hr-permission', 'Permission to edit leave category data'),
    ('delete_leave_category', 'Delete Leave Category', 'hr-permission', 'Permission to delete leave category data'),
    ('view_leave_archive', 'View Leave Archive', 'hr-permission', 'Permission to view archived leave data'),
    ('edit_leave_archive', 'Edit Leave Archive', 'hr-permission', 'Permission to edit archived leave data'),
    ('delete_leave_archive', 'Delete Leave Archive', 'hr-permission', 'Permission to delete archived leave data'),
    ('view_product_brand', 'View Product Brand', 'inventory-permission', 'Permission to view product brand data'),
    ('edit_product_brand', 'Edit Product Brand', 'inventory-permission', 'Permission to edit product brand data'),
    ('delete_product_brand', 'Delete Product Brand', 'inventory-permission', 'Permission to delete product brand data'),
    ('view_product_supplier', 'View Product Supplier', 'inventory-permission', 'Permission to view product supplier data'),
    ('edit_product_supplier', 'Edit Product Supplier', 'inventory-permission', 'Permission to edit product supplier data'),
    ('delete_product_supplier', 'Delete Product Supplier', 'inventory-permission', 'Permission to delete product supplier data'),
    ('view_product', 'View Product', 'inventory-permission', 'Permission to view product data'),
    ('edit_product', 'Edit Product', 'inventory-permission', 'Permission to edit product data'),
    ('delete_product', 'Delete Product', 'inventory-permission', 'Permission to delete product data'),
    ('view_product_purchase', 'View Product Purchase', 'inventory-permission', 'Permission to view product purchase data'),
    ('edit_product_purchase', 'Edit Product Purchase', 'inventory-permission', 'Permission to edit product purchase data'),
    ('delete_product_purchase', 'Delete Product Purchase', 'inventory-permission', 'Permission to delete product purchase data'),
    ('view_product_transfer', 'View Product Transfer', 'inventory-permission', 'Permission to view product transfer data'),
    ('edit_product_transfer', 'Edit Product Transfer', 'inventory-permission', 'Permission to edit product transfer data'),
    ('delete_product_transfer', 'Delete Product Transfer', 'inventory-permission', 'Permission to delete product transfer data'),
    ('view_customer', 'View Customer', 'inventory-permission', 'Permission to view customer data'),
    ('edit_customer', 'Edit Customer', 'inventory-permission', 'Permission to edit customer data'),
    ('delete_customer', 'Delete Customer', 'inventory-permission', 'Permission to delete customer data'),
    ('view_pos_dashboard', 'View POS Dashboard', 'inventory-permission', 'Permission to view the POS dashboard'),
    ('edit_pos_dashboard', 'Edit POS Dashboard', 'inventory-permission', 'Permission to edit POS dashboard settings'),
    ('view_pos_customer', 'View POS Customer', 'inventory-permission', 'Permission to view customer data in the POS'),
    ('edit_pos_customer', 'Edit POS Customer', 'inventory-permission', 'Permission to edit customer data in the POS'),
    ('view_pos_sales', 'View POS Sales', 'inventory-permission', 'Permission to view POS sales data'),
    ('edit_pos_sales', 'Edit POS Sales', 'inventory-permission', 'Permission to edit POS sales data'),
    ('view_pos_discount', 'View POS Discounts', 'inventory-permission', 'Permission to view POS discount data'),
    ('edit_pos_discount', 'Edit POS Discounts', 'inventory-permission', 'Permission to edit POS discount data');

INSERT INTO admin_superadmin (first_name, middle_name, surname, suffix, username, password, is_active)
VALUES
    ('Super Admin', NULL, 'Default', NULL, 'administrator', '$2y$10$VUI1/nifFIufPzm93O15bOOCifv/AhepkjZs64iSSS/OgP5oOLZHy', '1');



-- *************************************************************************************************** --
-- ******************************        ALTER TABLE FOREIGN KEYS      ******************************* --
-- *************************************************************************************************** --
ALTER TABLE mgmt_branch
    ADD CONSTRAINT fk_branch_province
        FOREIGN KEY (prov_id) REFERENCES ref_provinces(prov_id)
        ON UPDATE CASCADE ON DELETE RESTRICT,
    ADD CONSTRAINT fk_branch_city
        FOREIGN KEY (city_id) REFERENCES ref_cities(city_id)
        ON UPDATE CASCADE ON DELETE RESTRICT,
    ADD CONSTRAINT fk_branch_barangay
        FOREIGN KEY (brgy_id) REFERENCES ref_barangays(brgy_id)
        ON UPDATE CASCADE ON DELETE RESTRICT;

ALTER TABLE mgmt_roles
    ADD CONSTRAINT fk_roles_department
        FOREIGN KEY (department_id) REFERENCES mgmt_departments(department_id)
        ON DELETE CASCADE,
    ADD CONSTRAINT fk_roles_access_level
        FOREIGN KEY (access_level_id) REFERENCES ref_access_levels(access_level_id)
        ON DELETE RESTRICT;

ALTER TABLE mgmt_role_permissions
    ADD CONSTRAINT fk_role_permissions_role
        FOREIGN KEY (role_id) REFERENCES mgmt_roles(role_id)
        ON DELETE CASCADE,
    ADD CONSTRAINT fk_role_permissions_permission
        FOREIGN KEY (permission_id) REFERENCES mgmt_permissions(permission_id)
        ON DELETE CASCADE;

ALTER TABLE mgmt_employees
    ADD CONSTRAINT fk_emp_branch
        FOREIGN KEY (branch_id) REFERENCES mgmt_branch(branch_id)
        ON UPDATE CASCADE ON DELETE RESTRICT,
    ADD CONSTRAINT fk_emp_department
        FOREIGN KEY (department_id) REFERENCES mgmt_departments(department_id)
        ON UPDATE CASCADE ON DELETE RESTRICT,
    ADD CONSTRAINT fk_emp_role
        FOREIGN KEY (role_id) REFERENCES mgmt_roles(role_id)
        ON UPDATE CASCADE ON DELETE RESTRICT,
    ADD CONSTRAINT fk_emp_prov
        FOREIGN KEY (prov_id) REFERENCES ref_provinces(prov_id)
        ON UPDATE CASCADE ON DELETE RESTRICT,
    ADD CONSTRAINT fk_emp_city
        FOREIGN KEY (city_id) REFERENCES ref_cities(city_id)
        ON UPDATE CASCADE ON DELETE RESTRICT,
    ADD CONSTRAINT fk_emp_brgy
        FOREIGN KEY (brgy_id) REFERENCES ref_barangays(brgy_id)
        ON UPDATE CASCADE ON DELETE RESTRICT;

ALTER TABLE mgmt_users
    ADD CONSTRAINT fk_users_employee
        FOREIGN KEY (employee_id) REFERENCES mgmt_employees(employee_id)
        ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE leave_entitlements
    ADD CONSTRAINT fk_ent_type
        FOREIGN KEY (type_id) REFERENCES leave_types(type_id)
        ON UPDATE CASCADE ON DELETE CASCADE,
    ADD CONSTRAINT fk_ent_employee
        FOREIGN KEY (employee_id) REFERENCES mgmt_employees(employee_id)
        ON UPDATE CASCADE ON DELETE RESTRICT;

ALTER TABLE leave_requests
    ADD CONSTRAINT fk_lr_employee
        FOREIGN KEY (employee_id) REFERENCES mgmt_employees(employee_id)
        ON UPDATE CASCADE ON DELETE RESTRICT,
    ADD CONSTRAINT fk_lr_entitlement
        FOREIGN KEY (entitlement_id) REFERENCES leave_entitlements(entitlement_id)
        ON UPDATE CASCADE ON DELETE RESTRICT,
    ADD CONSTRAINT fk_lr_proxy
        FOREIGN KEY (proxy_employee_id) REFERENCES mgmt_employees(employee_id)
        ON UPDATE CASCADE ON DELETE RESTRICT;

ALTER TABLE leave_request_steps
    ADD CONSTRAINT fk_steps_request
        FOREIGN KEY (request_id) REFERENCES leave_requests(request_id)
        ON UPDATE CASCADE ON DELETE CASCADE,
    ADD CONSTRAINT fk_steps_actor
        FOREIGN KEY (acted_by) REFERENCES mgmt_employees(employee_id)
        ON UPDATE CASCADE ON DELETE RESTRICT;






-- *************************************************************************************************** --
-- ****************************        END OF IMPORT FOREIGN KEYS      ******************************* --
-- *************************************************************************************************** --
SET FOREIGN_KEY_CHECKS = 1;
COMMIT;

-- =====================================================
-- IMPORT READY SCHEMA (FK SAFE VERSION)
-- Assumes ref_provinces, ref_cities, ref_barangays exist
-- with INT PRIMARY KEYS
-- =====================================================

SET FOREIGN_KEY_CHECKS=0;

-- ****************************************************
-- ORGANIZATIONAL TABLES
-- ****************************************************

CREATE TABLE IF NOT EXISTS mgmt_branch (
    branch_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    branch_name VARCHAR(150) NOT NULL,
    branch_code VARCHAR(30) NOT NULL,
    prov_id INT NOT NULL,
    city_id INT NOT NULL,
    brgy_id INT NOT NULL,
    address_line VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (branch_id),
    UNIQUE KEY uq_branch_code (branch_code),
    KEY idx_branch_prov (prov_id),
    KEY idx_branch_city (city_id),
    KEY idx_branch_brgy (brgy_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS mgmt_departments (
    department_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    department_name VARCHAR(150) NOT NULL,
    department_scope ENUM('all','specific') NOT NULL DEFAULT 'all',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (department_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO mgmt_departments (department_name, department_scope) VALUES
('Administration','all'),
('Finance','all'),
('Human Resource','all'),
('Sales & Marketing','all'),
('Operations','all'),
('Customer Service','all'),
('Information Technology','all');

CREATE TABLE IF NOT EXISTS ref_access_levels (
    access_level_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    access_level_name VARCHAR(150) NOT NULL,
    access_level_description TEXT,
    access_level_value INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (access_level_id),
    UNIQUE KEY uq_access_level_name (access_level_name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS mgmt_roles (
    role_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    role_name VARCHAR(150) NOT NULL,
    role_description TEXT,
    department_id INT UNSIGNED NOT NULL,
    access_level_id INT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (role_id),
    KEY idx_role_dept (department_id),
    KEY idx_role_access (access_level_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS mgmt_permissions (
    permission_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    permission_name VARCHAR(150) NOT NULL,
    permission_title VARCHAR(150) NOT NULL,
    permission_class VARCHAR(150) NOT NULL,
    permission_description TEXT,
    PRIMARY KEY (permission_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS mgmt_role_permissions (
    role_permission_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    role_id INT UNSIGNED NOT NULL,
    permission_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (role_permission_id),
    KEY idx_role_perm_role (role_id),
    KEY idx_role_perm_perm (permission_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ****************************************************
-- EMPLOYEE TABLES
-- ****************************************************

CREATE TABLE IF NOT EXISTS mgmt_employees (
    employee_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    employee_code VARCHAR(30),
    first_name VARCHAR(80) NOT NULL,
    middle_name VARCHAR(80),
    surname VARCHAR(80) NOT NULL,
    suffix VARCHAR(20),
    birth_date DATE,
    marital_status VARCHAR(30),
    gender VARCHAR(20),
    email VARCHAR(150),
    contact_no VARCHAR(30),
    prov_id INT,
    city_id INT,
    brgy_id INT,
    address_line VARCHAR(255),
    date_hired DATE,
    branch_id INT UNSIGNED NOT NULL,
    department_id INT UNSIGNED NOT NULL,
    role_id INT UNSIGNED NOT NULL,
    daily_rate DECIMAL(12,2),
    sss_no VARCHAR(30),
    pagibig_no VARCHAR(30),
    tin_no VARCHAR(30),
    philhealth_no VARCHAR(30),
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (employee_id),
    UNIQUE KEY uq_emp_email (email),
    UNIQUE KEY uq_emp_code (employee_code),
    KEY idx_emp_branch (branch_id),
    KEY idx_emp_dept (department_id),
    KEY idx_emp_role (role_id),
    KEY idx_emp_prov (prov_id),
    KEY idx_emp_city (city_id),
    KEY idx_emp_brgy (brgy_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS mgmt_users (
    user_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    employee_id INT UNSIGNED NOT NULL,
    username VARCHAR(180) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    profile_photo VARCHAR(255),
    last_login_at DATETIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id),
    UNIQUE KEY uq_users_username (username),
    UNIQUE KEY uq_users_employee (employee_id),
    KEY idx_users_employee (employee_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ****************************************************
-- SUPER ADMIN
-- ****************************************************

CREATE TABLE IF NOT EXISTS admin_superadmin (
    admin_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(80) NOT NULL,
    middle_name VARCHAR(80),
    surname VARCHAR(80) NOT NULL,
    suffix VARCHAR(20),
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (admin_id),
    UNIQUE KEY uq_admin_username (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO admin_superadmin 
(first_name,middle_name,surname,suffix,username,password,is_active)
VALUES 
('Super Admin',NULL,'Default',NULL,'administrator',
'$2y$10$VUI1/nifFIufPzm93O15bOOCifv/AhepkjZs64iSSS/OgP5oOLZHy',1);

-- ****************************************************
-- ADD FOREIGN KEYS LAST
-- ****************************************************

ALTER TABLE mgmt_branch
ADD CONSTRAINT fk_branch_province
FOREIGN KEY (prov_id) REFERENCES ref_provinces(prov_id)
ON UPDATE CASCADE ON DELETE RESTRICT;

ALTER TABLE mgmt_branch
ADD CONSTRAINT fk_branch_city
FOREIGN KEY (city_id) REFERENCES ref_cities(city_id)
ON UPDATE CASCADE ON DELETE RESTRICT;

ALTER TABLE mgmt_branch
ADD CONSTRAINT fk_branch_barangay
FOREIGN KEY (brgy_id) REFERENCES ref_barangays(brgy_id)
ON UPDATE CASCADE ON DELETE RESTRICT;

ALTER TABLE mgmt_roles
ADD CONSTRAINT fk_role_department
FOREIGN KEY (department_id) REFERENCES mgmt_departments(department_id);

ALTER TABLE mgmt_roles
ADD CONSTRAINT fk_role_access
FOREIGN KEY (access_level_id) REFERENCES ref_access_levels(access_level_id);

ALTER TABLE mgmt_role_permissions
ADD CONSTRAINT fk_role_perm_role
FOREIGN KEY (role_id) REFERENCES mgmt_roles(role_id)
ON DELETE CASCADE;

ALTER TABLE mgmt_role_permissions
ADD CONSTRAINT fk_role_perm_perm
FOREIGN KEY (permission_id) REFERENCES mgmt_permissions(permission_id)
ON DELETE CASCADE;

ALTER TABLE mgmt_employees
ADD CONSTRAINT fk_emp_branch
FOREIGN KEY (branch_id) REFERENCES mgmt_branch(branch_id);

ALTER TABLE mgmt_employees
ADD CONSTRAINT fk_emp_department
FOREIGN KEY (department_id) REFERENCES mgmt_departments(department_id);

ALTER TABLE mgmt_employees
ADD CONSTRAINT fk_emp_role
FOREIGN KEY (role_id) REFERENCES mgmt_roles(role_id);

ALTER TABLE mgmt_employees
ADD CONSTRAINT fk_emp_province
FOREIGN KEY (prov_id) REFERENCES ref_provinces(prov_id);

ALTER TABLE mgmt_employees
ADD CONSTRAINT fk_emp_city
FOREIGN KEY (city_id) REFERENCES ref_cities(city_id);

ALTER TABLE mgmt_employees
ADD CONSTRAINT fk_emp_barangay
FOREIGN KEY (brgy_id) REFERENCES ref_barangays(brgy_id);

ALTER TABLE mgmt_users
ADD CONSTRAINT fk_users_employee
FOREIGN KEY (employee_id) REFERENCES mgmt_employees(employee_id)
ON DELETE CASCADE;

SET FOREIGN_KEY_CHECKS=1;



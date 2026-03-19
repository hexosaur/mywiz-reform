CREATE TABLE ref_companies (
	company_id INT AUTO_INCREMENT PRIMARY KEY,
	company_name VARCHAR(255) NOT NULL,
	company_type ENUM('Private','Government','NGO','Others') NOT NULL DEFAULT 'Private',
	remarks TEXT DEFAULT NULL,
	is_active TINYINT(1) NOT NULL DEFAULT 1,
	created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE ref_clients (
	client_id INT AUTO_INCREMENT PRIMARY KEY,
	company_id INT NOT NULL,
	client_name VARCHAR(255) NOT NULL,
	contact_number VARCHAR(50) DEFAULT NULL,
	email VARCHAR(150) DEFAULT NULL,
	prov_id INT DEFAULT NULL,
	city_id INT DEFAULT NULL,
	brgy_id INT DEFAULT NULL,
	street_address VARCHAR(255) DEFAULT NULL,
	remarks TEXT DEFAULT NULL,
	created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

	CONSTRAINT fk_ref_clients_company
		FOREIGN KEY (company_id) REFERENCES ref_companies(company_id)
		ON DELETE CASCADE
		ON UPDATE CASCADE,

	CONSTRAINT fk_ref_clients_province
		FOREIGN KEY (prov_id) REFERENCES ref_provinces(prov_id)
		ON DELETE SET NULL
		ON UPDATE CASCADE,

	CONSTRAINT fk_ref_clients_city
		FOREIGN KEY (city_id) REFERENCES ref_cities(city_id)
		ON DELETE SET NULL
		ON UPDATE CASCADE,

	CONSTRAINT fk_ref_clients_barangay
		FOREIGN KEY (brgy_id) REFERENCES ref_barangays(brgy_id)
		ON DELETE SET NULL
		ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE proj_projects (
	project_id INT AUTO_INCREMENT PRIMARY KEY,
	client_id INT NOT NULL,
	project_title VARCHAR(255) NOT NULL,
	project_description TEXT DEFAULT NULL,
	prov_id INT DEFAULT NULL,
	city_id INT DEFAULT NULL,
	brgy_id INT DEFAULT NULL,
	site_address VARCHAR(255) DEFAULT NULL,
	abc_amount DECIMAL(15,2) NOT NULL DEFAULT 0.00,
	contract_amount DECIMAL(15,2) NOT NULL DEFAULT 0.00,
	start_date DATE DEFAULT NULL,
	target_completion_date DATE DEFAULT NULL,
	actual_completion_date DATE DEFAULT NULL,
	status ENUM('Pending','Ongoing','Cancelled','Finished','On-hold') NOT NULL DEFAULT 'Pending',
	progress_percent DECIMAL(5,2) NOT NULL DEFAULT 0.00,
	created_by INT DEFAULT NULL,
	remarks TEXT DEFAULT NULL,
	created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

	CONSTRAINT fk_proj_projects_client
		FOREIGN KEY (client_id) REFERENCES ref_clients(client_id)
		ON DELETE RESTRICT
		ON UPDATE CASCADE,

	CONSTRAINT fk_proj_projects_province
		FOREIGN KEY (prov_id) REFERENCES ref_provinces(prov_id)
		ON DELETE SET NULL
		ON UPDATE CASCADE,

	CONSTRAINT fk_proj_projects_city
		FOREIGN KEY (city_id) REFERENCES ref_cities(city_id)
		ON DELETE SET NULL
		ON UPDATE CASCADE,

	CONSTRAINT fk_proj_projects_barangay
		FOREIGN KEY (brgy_id) REFERENCES ref_barangays(brgy_id)
		ON DELETE SET NULL
		ON UPDATE CASCADE,

	CONSTRAINT fk_proj_projects_created_by
		FOREIGN KEY (created_by) REFERENCES mgmt_employees(employee_id)
		ON DELETE SET NULL
		ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE proj_team (
	project_team_id INT AUTO_INCREMENT PRIMARY KEY,
	project_id INT NOT NULL,
	employee_id INT NOT NULL,
	created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

	CONSTRAINT fk_proj_team_project
		FOREIGN KEY (project_id) REFERENCES proj_projects(project_id)
		ON DELETE CASCADE
		ON UPDATE CASCADE,

	CONSTRAINT fk_proj_team_employee
		FOREIGN KEY (employee_id) REFERENCES mgmt_employees(employee_id)
		ON DELETE RESTRICT
		ON UPDATE CASCADE,

	UNIQUE KEY uq_proj_team_project_employee (project_id, employee_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE proj_progress (
	progress_id INT AUTO_INCREMENT PRIMARY KEY,
	project_id INT NOT NULL,
	progress_date DATE NOT NULL,
	title VARCHAR(255) NOT NULL,
	accomplishment_details TEXT DEFAULT NULL,
	reported_by INT DEFAULT NULL,
	remarks TEXT DEFAULT NULL,
	created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

	CONSTRAINT fk_proj_progress_project
		FOREIGN KEY (project_id) REFERENCES proj_projects(project_id)
		ON DELETE CASCADE
		ON UPDATE CASCADE,

	CONSTRAINT fk_proj_progress_reported_by
		FOREIGN KEY (reported_by) REFERENCES mgmt_employees(employee_id)
		ON DELETE SET NULL
		ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE proj_files (
	file_id INT AUTO_INCREMENT PRIMARY KEY,
	project_id INT NOT NULL,
	progress_id INT DEFAULT NULL,
	file_category ENUM('Contract','Image','Document','Receipt','Report') NOT NULL DEFAULT 'Document',
	file_title VARCHAR(255) NOT NULL,
	file_name VARCHAR(255) NOT NULL,
	file_path VARCHAR(255) NOT NULL,
	file_type VARCHAR(100) DEFAULT NULL,
	uploaded_by INT DEFAULT NULL,
	remarks TEXT DEFAULT NULL,
	created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

	CONSTRAINT fk_proj_files_project
		FOREIGN KEY (project_id) REFERENCES proj_projects(project_id)
		ON DELETE CASCADE
		ON UPDATE CASCADE,

	CONSTRAINT fk_proj_files_progress
		FOREIGN KEY (progress_id) REFERENCES proj_progress(progress_id)
		ON DELETE SET NULL
		ON UPDATE CASCADE,

	CONSTRAINT fk_proj_files_uploaded_by
		FOREIGN KEY (uploaded_by) REFERENCES mgmt_employees(employee_id)
		ON DELETE SET NULL
		ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE proj_funds (
	fund_id INT AUTO_INCREMENT PRIMARY KEY,
	project_id INT NOT NULL,
	fund_type VARCHAR(50) NOT NULL DEFAULT 'mobilization',
	release_date DATE NOT NULL,
	amount_released DECIMAL(15,2) NOT NULL DEFAULT 0.00,
	released_by INT DEFAULT NULL,
	received_by INT DEFAULT NULL,
	remarks TEXT DEFAULT NULL,
	created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

	CONSTRAINT fk_proj_funds_project
		FOREIGN KEY (project_id) REFERENCES proj_projects(project_id)
		ON DELETE CASCADE
		ON UPDATE CASCADE,

	CONSTRAINT fk_proj_funds_released_by
		FOREIGN KEY (released_by) REFERENCES mgmt_employees(employee_id)
		ON DELETE SET NULL
		ON UPDATE CASCADE,

	CONSTRAINT fk_proj_funds_received_by
		FOREIGN KEY (received_by) REFERENCES mgmt_employees(employee_id)
		ON DELETE SET NULL
		ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE proj_expenses (
	expense_id INT AUTO_INCREMENT PRIMARY KEY,
	project_id INT NOT NULL,
	fund_id INT DEFAULT NULL,
	expense_date DATE NOT NULL,
	expense_category VARCHAR(50) NOT NULL DEFAULT 'miscellaneous',
	description VARCHAR(255) NOT NULL,
	amount DECIMAL(15,2) NOT NULL DEFAULT 0.00,
	paid_to VARCHAR(150) DEFAULT NULL,
	encoded_by INT DEFAULT NULL,
	remarks TEXT DEFAULT NULL,
	created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

	CONSTRAINT fk_proj_expenses_project
		FOREIGN KEY (project_id) REFERENCES proj_projects(project_id)
		ON DELETE CASCADE
		ON UPDATE CASCADE,

	CONSTRAINT fk_proj_expenses_fund
		FOREIGN KEY (fund_id) REFERENCES proj_funds(fund_id)
		ON DELETE SET NULL
		ON UPDATE CASCADE,

	CONSTRAINT fk_proj_expenses_encoded_by
		FOREIGN KEY (encoded_by) REFERENCES mgmt_employees(employee_id)
		ON DELETE SET NULL
		ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- FOR MOVABLE STATUS
CREATE TABLE proj_status_logs (
	status_log_id INT AUTO_INCREMENT PRIMARY KEY,
	project_id INT NOT NULL,
	old_status VARCHAR(30) DEFAULT NULL,
	new_status VARCHAR(30) NOT NULL,
	changed_by INT DEFAULT NULL,
	remarks TEXT DEFAULT NULL,
	changed_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
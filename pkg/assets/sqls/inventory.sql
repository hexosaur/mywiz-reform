SET FOREIGN_KEY_CHECKS = 0;

-- =========================================
-- 1. DROP ONLY THE REAL EXISTING LOCATION FKs
-- =========================================

ALTER TABLE ref_clients
    DROP FOREIGN KEY fk_ref_clients_province,
    DROP FOREIGN KEY fk_ref_clients_city,
    DROP FOREIGN KEY fk_ref_clients_barangay;

-- =========================================
-- 2. ALTER PARENT LOCATION TABLE IDS
-- =========================================

ALTER TABLE ref_provinces
    MODIFY prov_id INT UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE ref_cities
    MODIFY city_id INT UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE ref_barangays
    MODIFY brgy_id INT UNSIGNED NOT NULL AUTO_INCREMENT;

-- =========================================
-- 3. ALTER CHILD COLUMNS THAT REFERENCE THEM
-- =========================================

ALTER TABLE ref_clients
    MODIFY prov_id INT UNSIGNED DEFAULT NULL,
    MODIFY city_id INT UNSIGNED DEFAULT NULL,
    MODIFY brgy_id INT UNSIGNED DEFAULT NULL;

-- Only run this if proj_projects already exists
-- ALTER TABLE proj_projects
--     MODIFY prov_id INT UNSIGNED DEFAULT NULL,
--     MODIFY city_id INT UNSIGNED DEFAULT NULL,
--     MODIFY brgy_id INT UNSIGNED DEFAULT NULL;

-- =========================================
-- 4. RE-ADD THE SAME LOCATION FOREIGN KEYS
-- =========================================

ALTER TABLE ref_clients
    ADD CONSTRAINT fk_ref_clients_province
        FOREIGN KEY (prov_id) REFERENCES ref_provinces(prov_id)
        ON DELETE SET NULL
        ON UPDATE CASCADE,
    ADD CONSTRAINT fk_ref_clients_city
        FOREIGN KEY (city_id) REFERENCES ref_cities(city_id)
        ON DELETE SET NULL
        ON UPDATE CASCADE,
    ADD CONSTRAINT fk_ref_clients_barangay
        FOREIGN KEY (brgy_id) REFERENCES ref_barangays(brgy_id)
        ON DELETE SET NULL
        ON UPDATE CASCADE;

-- Only run this if proj_projects already exists and already has these FKs
-- ALTER TABLE proj_projects
--     ADD CONSTRAINT fk_proj_projects_province
--         FOREIGN KEY (prov_id) REFERENCES ref_provinces(prov_id)
--         ON DELETE SET NULL
--         ON UPDATE CASCADE,
--     ADD CONSTRAINT fk_proj_projects_city
--         FOREIGN KEY (city_id) REFERENCES ref_cities(city_id)
--         ON DELETE SET NULL
--         ON UPDATE CASCADE,
--     ADD CONSTRAINT fk_proj_projects_barangay
--         FOREIGN KEY (brgy_id) REFERENCES ref_barangays(brgy_id)
--         ON DELETE SET NULL
--         ON UPDATE CASCADE;

SET FOREIGN_KEY_CHECKS = 1;
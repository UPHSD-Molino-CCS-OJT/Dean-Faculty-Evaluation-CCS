-- Add signature columns to faculty table
-- Run this SQL to enable e-signature feature for faculty members

ALTER TABLE faculty 
ADD COLUMN signature_path VARCHAR(255) NULL AFTER status,
ADD COLUMN signature_date DATE NULL AFTER signature_path;

-- Add signature columns to evaluations table for per-evaluation signatures
ALTER TABLE evaluations 
ADD COLUMN dean_signature_path VARCHAR(255) NULL AFTER date_submitted,
ADD COLUMN dean_signature_date DATE NULL AFTER dean_signature_path,
ADD COLUMN faculty_signature_path VARCHAR(255) NULL AFTER dean_signature_date,
ADD COLUMN faculty_signature_date DATE NULL AFTER faculty_signature_path;

-- Create settings table for global dean signature storage
CREATE TABLE IF NOT EXISTS settings (
  id INT(11) NOT NULL AUTO_INCREMENT,
  setting_key VARCHAR(100) NOT NULL,
  setting_value TEXT DEFAULT NULL,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY setting_key (setting_key)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insert default settings for dean signature
INSERT INTO settings (setting_key, setting_value) VALUES 
('dean_signature_path', NULL),
('dean_signature_date', NULL)
ON DUPLICATE KEY UPDATE setting_key=setting_key;

-- Create signatures directory reference comment
-- Make sure to create the /signatures/ folder in your project root if it doesn't exist

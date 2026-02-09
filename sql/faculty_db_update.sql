-- Add role and faculty_id to users table for faculty login support
ALTER TABLE `users` 
ADD COLUMN IF NOT EXISTS `role` ENUM('admin', 'faculty') DEFAULT 'admin' AFTER `password`,
ADD COLUMN IF NOT EXISTS `faculty_id` INT(11) NULL AFTER `role`,
ADD COLUMN IF NOT EXISTS `full_name` VARCHAR(255) NULL AFTER `faculty_id`;

-- Add signature columns to faculty table
ALTER TABLE `faculty`
ADD COLUMN IF NOT EXISTS `signature_path` VARCHAR(255) NULL AFTER `status`,
ADD COLUMN IF NOT EXISTS `signature_date` DATE NULL AFTER `signature_path`;

-- Add signature columns to evaluations table for per-evaluation signatures
ALTER TABLE `evaluations` 
ADD COLUMN IF NOT EXISTS `dean_signature_path` VARCHAR(255) NULL AFTER `date_submitted`,
ADD COLUMN IF NOT EXISTS `dean_signature_date` DATE NULL AFTER `dean_signature_path`,
ADD COLUMN IF NOT EXISTS `faculty_signature_path` VARCHAR(255) NULL AFTER `dean_signature_date`,
ADD COLUMN IF NOT EXISTS `faculty_signature_date` DATE NULL AFTER `faculty_signature_path`;

-- Create settings table for global configuration
CREATE TABLE IF NOT EXISTS `settings` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `setting_key` VARCHAR(100) NOT NULL,
  `setting_value` TEXT DEFAULT NULL,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `setting_key` (`setting_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insert default settings for dean signature
INSERT INTO `settings` (`setting_key`, `setting_value`) VALUES 
('dean_signature_path', NULL),
('dean_signature_date', NULL)
ON DUPLICATE KEY UPDATE `setting_key`=`setting_key`;

-- Update existing admin users
UPDATE `users` SET `role` = 'admin' WHERE `id` IN (1, 2);

-- Create faculty users (password for all: faculty123)
-- Note: Run fix_passwords_now.php to properly hash these passwords
INSERT INTO `users` (`username`, `password`, `role`, `faculty_id`, `full_name`) VALUES
('val.fabregas', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'faculty', 3, 'Val Patrick Fabregas'),
('roberto.malitao', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'faculty', 4, 'Roberto Malitao'),
('homer.favenir', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'faculty', 5, 'Homer Favenir'),
('fe.antonio', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'faculty', 6, 'Fe Antonio'),
('marco.subion', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'faculty', 7, 'Marco Antonio Subion'),
('luvim.eusebio', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'faculty', 8, 'Luvim Eusebio'),
('rolando.quirong', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'faculty', 9, 'Rolando Quirong'),
('arnold.galve', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'faculty', 10, 'Arnold Galve'),
('edward.cruz', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'faculty', 11, 'Edward Cruz')
ON DUPLICATE KEY UPDATE `username`=`username`;

-- Add foreign key constraint if not exists
-- Note: MySQL doesn't support IF NOT EXISTS for constraints, so this may error if already exists
ALTER TABLE `users` 
ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculty`(`id`) ON DELETE SET NULL;

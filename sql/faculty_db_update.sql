-- Add role and faculty_id to users table for faculty login support
ALTER TABLE `users` 
ADD COLUMN `role` ENUM('admin', 'faculty') DEFAULT 'admin' AFTER `password`,
ADD COLUMN `faculty_id` INT(11) NULL AFTER `role`,
ADD COLUMN `full_name` VARCHAR(255) NULL AFTER `faculty_id`;

-- Update existing admin users
UPDATE `users` SET `role` = 'admin' WHERE `id` IN (1, 2);

-- Create sample faculty users (password for all: faculty123)
-- Note: You should run the setup_faculty_portal.php instead, or update these hashes
-- The hash below is a placeholder - use password_hash('faculty123', PASSWORD_DEFAULT) in PHP
INSERT INTO `users` (`username`, `password`, `role`, `faculty_id`, `full_name`) VALUES
('val.fabregas', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'faculty', 3, 'Val Patrick Fabregas'),
('roberto.malitao', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'faculty', 4, 'Roberto Malitao'),
('homer.favenir', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'faculty', 5, 'Homer Favenir'),
('fe.antonio', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'faculty', 6, 'Fe Antonio'),
('marco.subion', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'faculty', 7, 'Marco Antonio Subion'),
('luvim.eusebio', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'faculty', 8, 'Luvim Eusebio'),
('rolando.quirong', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'faculty', 9, 'Rolando Quirong'),
('arnold.galve', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'faculty', 10, 'Arnold Galve'),
('edward.cruz', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'faculty', 11, 'Edward Cruz');

-- Add foreign key constraint
ALTER TABLE `users` 
ADD CONSTRAINT `fk_faculty` FOREIGN KEY (`faculty_id`) REFERENCES `faculty`(`id`) ON DELETE SET NULL;

-- Add signature_path column to faculty table
-- Run this SQL to enable e-signature feature

ALTER TABLE faculty 
ADD COLUMN signature_path VARCHAR(255) NULL 
AFTER status;

-- Optional: Create signatures directory reference comment
-- Make sure to create the /signatures/ folder in your project root if it doesn't exist

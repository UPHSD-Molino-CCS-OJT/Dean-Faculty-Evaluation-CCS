# Database Updates Documentation

This document outlines all database schema changes for the Dean-Faculty Evaluation System.

## 📋 Table of Contents
- [Complete Database Schema](#complete-database-schema)
- [Update History](#update-history)
- [Migration Instructions](#migration-instructions)

---

## Complete Database Schema

### 1. `evaluations` Table
Stores faculty evaluation records with per-evaluation signatures.

```sql
CREATE TABLE `evaluations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `faculty_name` varchar(255) NOT NULL,
  `semester` varchar(20) DEFAULT NULL,
  `school_year` varchar(20) DEFAULT NULL,
  `total_units` int(11) DEFAULT NULL,
  `subject_handled` varchar(255) DEFAULT NULL,
  `sec1_avg` decimal(5,3) DEFAULT NULL,
  `sec2_avg` decimal(5,3) DEFAULT NULL,
  `sec3_avg` decimal(5,3) DEFAULT NULL,
  `sec4_avg` decimal(5,3) DEFAULT NULL,
  `sec5_avg` decimal(5,3) DEFAULT NULL,
  `total_points` int(11) DEFAULT NULL,
  `overall_rating` decimal(5,2) DEFAULT NULL,
  `additional_comments` text DEFAULT NULL,
  `official_complaint` varchar(10) DEFAULT NULL,
  `exceptional_performance` varchar(10) DEFAULT NULL,
  `date_submitted` datetime DEFAULT current_timestamp(),
  `dean_signature_path` varchar(255) DEFAULT NULL,      -- NEW
  `dean_signature_date` date DEFAULT NULL,              -- NEW
  `faculty_signature_path` varchar(255) DEFAULT NULL,   -- NEW
  `faculty_signature_date` date DEFAULT NULL,           -- NEW
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

**New Columns:**
- `dean_signature_path` - Stores dean's signature for this specific evaluation
- `dean_signature_date` - Date when dean signed this evaluation
- `faculty_signature_path` - Stores faculty's signature for this specific evaluation
- `faculty_signature_date` - Date when faculty signed this evaluation

---

### 2. `evaluation_details` Table
Stores individual question responses for each evaluation.

```sql
CREATE TABLE `evaluation_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `evaluation_id` int(11) NOT NULL,
  `question_code` varchar(50) NOT NULL,
  `rating` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `evaluation_id` (`evaluation_id`),
  CONSTRAINT `evaluation_details_ibfk_1` FOREIGN KEY (`evaluation_id`) 
    REFERENCES `evaluations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

---

### 3. `faculty` Table
Stores faculty member information and legacy signature storage.

```sql
CREATE TABLE `faculty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `department` varchar(100) DEFAULT 'College of Computer Studies',
  `status` enum('active','inactive') DEFAULT 'active',
  `signature_path` varchar(255) DEFAULT NULL,   -- NEW (legacy)
  `signature_date` date DEFAULT NULL,            -- NEW (legacy)
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

**New Columns:**
- `signature_path` - Legacy faculty signature storage (kept for backward compatibility)
- `signature_date` - Legacy signature date (kept for backward compatibility)

**Note:** Faculty signatures are now primarily stored per-evaluation in the `evaluations` table.

---

### 4. `users` Table
Stores login credentials for both admin and faculty users.

```sql
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','faculty') DEFAULT 'admin',  -- NEW
  `faculty_id` int(11) DEFAULT NULL,               -- NEW
  `full_name` varchar(255) DEFAULT NULL,           -- NEW
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `faculty_id` (`faculty_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`faculty_id`) 
    REFERENCES `faculty` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

**New Columns:**
- `role` - User type: 'admin' or 'faculty'
- `faculty_id` - Links to faculty table for faculty users
- `full_name` - Full name of the user

---

### 5. `settings` Table
Stores global system settings including current dean signature.

```sql
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(100) NOT NULL,
  `setting_value` text DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `setting_key` (`setting_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

**Default Settings:**
```sql
INSERT INTO `settings` (`setting_key`, `setting_value`) VALUES 
('dean_signature_path', NULL),
('dean_signature_date', NULL);
```

**Purpose:** 
- Stores the dean's current signature
- When a new evaluation is created, the signature is copied from settings to the evaluation record
- This allows each evaluation to maintain its own signature snapshot

---

## Update History

### Phase 1: Faculty Portal Support
- Added `role`, `faculty_id`, and `full_name` columns to `users` table
- Created faculty login functionality
- Password: `faculty123` for all faculty accounts

### Phase 2: E-Signature Support
- Created `settings` table for global configuration
- Added signature columns to `faculty` table
- Implemented dean signature upload/removal

### Phase 3: Per-Evaluation Signatures
- Added signature columns to `evaluations` table:
  - `dean_signature_path`
  - `dean_signature_date`
  - `faculty_signature_path`
  - `faculty_signature_date`
- Each evaluation now stores its own signatures independently
- Prevents signature changes from affecting previous evaluations

### Phase 4: Image Deduplication
- Implemented hash-based file storage (MD5)
- Files stored as `sig_{hash}.{extension}`
- Prevents duplicate storage of identical signature images
- Smart deletion checks references before removing files

---

## Migration Instructions

### Fresh Installation
Run the complete schema:
```bash
mysql -u root -p faculty_evaluation < sql/faculty_evaluation.sql
```

### Updating Existing Database
Run the update script:
```bash
mysql -u root -p faculty_evaluation < sql/faculty_db_update.sql
```

Or use the provided PHP scripts:
```bash
# Add faculty signature columns
php add_signature_date_column.php

# Add evaluation signature columns
php add_evaluation_signature_columns.php

# Fix faculty passwords
php fix_passwords_now.php
```

---

## Storage Optimization

### Hash-Based Storage
- Signatures are stored with content-based naming: `sig_{md5_hash}.{ext}`
- Multiple evaluations can reference the same file
- Example: 10 evaluations with same signature = 1 file (90% space saving)

### Cleanup Utility
Run periodically to remove orphaned files:
```
http://localhost/Dean-Faculty-Evaluation-CCS/cleanup_orphaned_signatures.php
```

---

## Security Notes

1. **Password Hashing**: All passwords use PHP's `password_hash()` with bcrypt
2. **File Upload**: Signature uploads are validated (type, size, content)
3. **SQL Injection**: All queries use proper escaping or prepared statements
4. **Access Control**: Faculty can only view/sign their own evaluations

---

## File Structure

```
sql/
├── faculty_evaluation.sql      # Complete database schema (updated)
├── faculty_db_update.sql       # Migration script for existing databases
├── add_signature_column.sql    # Adds all signature-related columns
└── DATABASE_UPDATES.md         # This documentation
```

---

**Last Updated:** February 9, 2026  
**Version:** 2.0.0

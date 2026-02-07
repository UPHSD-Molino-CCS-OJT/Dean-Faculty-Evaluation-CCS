# File Structure Documentation

## Overview
This document describes the organized file structure of the Dean Faculty Evaluation System for CCS.

## Directory Structure

### Root Level Files
- **index.php** - Main evaluation form (requires admin login)
- **login.php** - Admin authentication page
- **logout.php** - Admin session cleanup
- **register.php** - User registration page
- **LICENSE** - MIT License file
- **header-image.png** - Header image asset
- **footer-image.png** - Footer image asset

### /admin/ - Administrative Portal
Contains all administrator-facing pages and functionality.

| File | Purpose | Includes |
|------|---------|----------|
| dashboard.php | Main admin dashboard with evaluations and faculty management | ../includes/header.php |
| edit_faculty.php | Edit faculty member information | ../includes/header.php |
| full_evaluation.php | Display complete evaluation details | ../includes/header.php |
| process_faculty.php | Handle faculty CRUD operations | ../includes/header.php |
| view_evaluation.php | View individual evaluation summary | ../includes/header.php |
| welcome.php | Landing page with portal selection | None (standalone) |

**Internal Links:**
- Dashboard, evaluation views, and edit pages link to each other
- All redirect to ../login.php on authentication failure
- Welcome page links to ../login.php and ../faculty/faculty_login.php

### /faculty/ - Faculty Portal
Contains all faculty member-facing pages.

| File | Purpose | Security |
|------|---------|----------|
| faculty_dashboard.php | Faculty member dashboard with evaluation history | Session-based |
| faculty_login.php | Faculty authentication | Links to ../login.php and ../admin/welcome.php |
| faculty_logout.php | Faculty session cleanup | Redirects to faculty_login.php |
| faculty_view_evaluation.php | View evaluation details | Session-based |

**Navigation:**
- All pages require `$_SESSION['faculty_logged_in']`
- Logout redirects to faculty_login.php
- Dashboard links to faculty_view_evaluation.php

### /includes/ - Shared Components
Reusable PHP files included by other pages.

| File | Purpose | Used By |
|------|---------|---------|
| config.php | Database configuration constants | Available for future use |
| header.php | Admin navigation and header | All admin pages |
| submit.php | Process evaluation form submissions | index.php form action |

**Paths in header.php:**
- Redirects to: ../login.php, ../logout.php
- Links to: ../index.php, dashboard.php (relative)

**Paths in submit.php:**
- Redirects to: ../admin/dashboard.php

### /assets/ - Static Assets
Frontend resources (JavaScript, CSS, images, etc.)

```
assets/
└── js/
    └── script.js - Client-side functionality for evaluation forms
```

**Referenced by:**
- index.php: `<script src="assets/js/script.js"></script>`

### /sql/ - Database Files
SQL schema and update scripts.

| File | Purpose |
|------|---------|
| faculty_evaluation.sql | Main database schema with all tables |
| faculty_db_update.sql | Incremental database updates |

### /setup/ - Setup and Maintenance Scripts
One-time setup and utility scripts.

| File | Purpose | Links |
|------|---------|-------|
| setup_faculty_portal.php | Initial database setup and faculty account creation | ../admin/welcome.php |
| fix_faculty_passwords.php | Reset all faculty passwords to default | ../faculty/faculty_login.php, ../admin/welcome.php |

### /docs/ - Documentation
Project documentation files.

| File | Description |
|------|-------------|
| README.md | Main project documentation |
| QUICK_START.md | Quick setup guide |
| ARCHITECTURE.md | System architecture details |
| FACULTY_PORTAL_GUIDE.md | Faculty portal user guide |
| IMPLEMENTATION_SUMMARY.md | Implementation details |

## File Dependencies Map

### index.php (Evaluation Form)
- **Includes:** includes/header.php
- **Form Action:** includes/submit.php
- **Assets:** assets/js/script.js
- **Navigation:** Managed by header.php

### Admin Pages (admin/*.php)
- **Common Include:** ../includes/header.php
- **Authentication:** Checked by header.php → redirects to ../login.php
- **Internal Links:** All relative (dashboard.php, view_evaluation.php, etc.)

### Faculty Pages (faculty/*.php)
- **Authentication:** Session checks in each file
- **Login Redirect:** faculty_login.php (relative)
- **External Links:** ../login.php, ../admin/welcome.php
- **Internal Links:** All relative (faculty_dashboard.php, faculty_view_evaluation.php)

### Authentication Flow

```
User Access
    │
    ├─→ admin/welcome.php (Landing)
    │       ├─→ Admin Portal → ../login.php → admin/dashboard.php
    │       └─→ Faculty Portal → ../faculty/faculty_login.php → faculty/faculty_dashboard.php
    │
    ├─→ login.php (Admin)
    │       ├─→ Success: admin/dashboard.php
    │       └─→ Faculty role: faculty/faculty_dashboard.php
    │
    └─→ faculty/faculty_login.php (Faculty)
            ├─→ Success: faculty_dashboard.php
            └─→ Fail: Reload with error
```

## URL Patterns

### Public URLs
- Landing Page: `/admin/welcome.php`
- Admin Login: `/login.php`
- Faculty Login: `/faculty/faculty_login.php`

### Admin URLs (Require Authentication)
- Dashboard: `/admin/dashboard.php`
- New Evaluation: `/index.php`
- View Evaluation: `/admin/view_evaluation.php?id=N`
- Full Evaluation: `/admin/full_evaluation.php?id=N`
- Edit Faculty: `/admin/edit_faculty.php?id=N`

### Faculty URLs (Require Authentication)
- Dashboard: `/faculty/faculty_dashboard.php`
- View Evaluation: `/faculty/faculty_view_evaluation.php?id=N`

## Database Connection

All PHP files connect to database using:
```php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "faculty_evaluation";
```

Note: A centralized config file exists at `includes/config.php` for future refactoring.

## Asset Paths

All asset references use relative paths from the file location:
- From root: `assets/js/script.js`
- From admin/: `../assets/js/script.js` (if needed)
- From faculty/: `../assets/js/script.js` (if needed)

## Session Variables

### Admin Sessions
- `$_SESSION['admin_logged_in']` - Boolean
- `$_SESSION['user_id']` - Admin user ID

### Faculty Sessions
- `$_SESSION['faculty_logged_in']` - Boolean
- `$_SESSION['faculty_id']` - Faculty member ID
- `$_SESSION['faculty_name']` - Faculty member name
- `$_SESSION['user_id']` - User account ID

## Navigation Patterns

### Admin Navigation (via header.php)
- New Evaluation Button → ../index.php
- Dashboard Link → dashboard.php (relative)
- Logout → ../logout.php

### Faculty Navigation (custom per page)
- Dashboard → Relative links
- Logout → faculty_logout.php
- Back to Admin → ../login.php

## Maintenance Notes

### When Adding New Files:

1. **New Admin Page:**
   - Place in `/admin/` directory
   - Include: `../includes/header.php`
   - Use relative links for other admin pages

2. **New Faculty Page:**
   - Place in `/faculty/` directory
   - Implement session check for `faculty_logged_in`
   - Use relative links for other faculty pages

3. **New Shared Component:**
   - Place in `/includes/` directory
   - Update references with `../includes/filename.php`

4. **New Asset:**
   - Place in appropriate `/assets/` subdirectory
   - Reference with proper relative path

### Testing Checklist:
- [ ] Admin login works → redirects to admin/dashboard.php
- [ ] Faculty login works → redirects to faculty/faculty_dashboard.php
- [ ] Logout redirects correctly
- [ ] All navigation links work from each portal
- [ ] Evaluation form submits to correct location
- [ ] Welcome page links to both portals
- [ ] Setup scripts link to correct welcome/login pages

## File Move History

All files were reorganized from flat root structure to organized directories:
- PHP files → Categorized by role (admin/, faculty/, includes/)
- JS files → assets/js/
- SQL files → sql/
- Docs → docs/
- Setup → setup/

All file paths and includes were updated accordingly.

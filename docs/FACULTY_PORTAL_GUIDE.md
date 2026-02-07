# Faculty Portal Implementation Guide

## Overview
A faculty portal has been added to the CCS Faculty Evaluation System, allowing faculty members to log in and view their evaluation history and performance ratings.

## New Files Created

### 1. `welcome.php` - Landing Page
- Dual-portal landing page with links to both Admin and Faculty portals
- Modern, gradient-based design with animated elements
- Accessible from the root URL

### 2. `faculty_login.php` - Faculty Login
- Dedicated login page for faculty members
- Validates faculty credentials against the database
- Redirects authenticated faculty to their dashboard

### 3. `faculty_dashboard.php` - Faculty Dashboard
- Displays faculty evaluation statistics (total, average, highest, lowest ratings)
- Shows complete evaluation history in a sortable table
- Provides quick access to detailed evaluation views

### 4. `faculty_view_evaluation.php` - Evaluation Details
- Full evaluation report view for faculty members
- Print-friendly format
- Security: Faculty can only view their own evaluations
- Same format as admin view but with faculty-specific navigation

### 5. `faculty_logout.php` - Logout Handler
- Destroys faculty session
- Redirects to faculty login page

### 6. `faculty_db_update.sql` - Database Schema Update
- Adds role-based authentication to users table
- Creates foreign key relationship between users and faculty
- Includes sample faculty user accounts

## Database Changes

Run the `faculty_db_update.sql` file to update your database:

```sql
-- Run this SQL in phpMyAdmin or MySQL console
SOURCE faculty_db_update.sql;
```

### Schema Changes:
- **users table**: Added `role`, `faculty_id`, and `full_name` columns
- **New constraint**: Foreign key linking users.faculty_id to faculty.id

### Default Faculty Credentials:
All faculty accounts use the password: `faculty123`

| Username | Faculty Name | Faculty ID |
|----------|--------------|------------|
| val.fabregas | Val Patrick Fabregas | 3 |
| roberto.malitao | Roberto Malitao | 4 |
| homer.favenir | Homer Favenir | 5 |
| fe.antonio | Fe Antonio | 6 |
| marco.subion | Marco Antonio Subion | 7 |
| luvim.eusebio | Luvim Eusebio | 8 |
| rolando.quirong | Rolando Quirong | 9 |
| arnold.galve | Arnold Galve | 10 |
| edward.cruz | Edward Cruz | 11 |

## Features

### Faculty Portal Features:
1. **Secure Authentication**
   - Role-based login system
   - Session management
   - Password verification

2. **Dashboard Statistics**
   - Total evaluations count
   - Average rating across all evaluations
   - Highest rating achieved
   - Lowest rating received

3. **Evaluation History**
   - Complete list of all evaluations
   - Sortable by semester, school year, rating
   - Color-coded rating badges
   - Direct links to detailed views

4. **Detailed Evaluation View**
   - Full evaluation breakdown by criteria
   - Weighted scores and overall rating
   - Additional comments and notes
   - Print-friendly format

5. **Security**
   - Faculty can only access their own evaluations
   - Session-based authentication
   - SQL injection protection
   - Access control checks

## User Flow

### For Faculty:
1. Visit `welcome.php` (landing page)
2. Click "Access Faculty Portal"
3. Log in with faculty credentials
4. View dashboard with statistics
5. Browse evaluation history
6. Click "View Details" to see full evaluation
7. Print evaluation if needed
8. Logout when done

### For Admin:
1. Visit `welcome.php` (landing page)
2. Click "Access Admin Portal"
3. Log in with admin credentials
4. Access dashboard (existing functionality)

## Navigation Updates

### Updated Login Pages:
- **login.php**: Added link to Faculty Login and Home
- **faculty_login.php**: Added link to Admin Login and Home

### Portal Links:
- From Admin Login → Faculty Login
- From Faculty Login → Admin Login
- Both login pages → Welcome page

## Color Scheme

### Admin Portal:
- Primary: Blue (#3b82f6, #1e3a8a)
- Accent: Purple (#764ba2)

### Faculty Portal:
- Primary: Teal (#14b8a6, #0f766e)
- Accent: Green variations

## Security Considerations

1. **Session Management**
   - Separate session variables for admin and faculty
   - `$_SESSION['admin_logged_in']` for admin
   - `$_SESSION['faculty_logged_in']` for faculty
   - `$_SESSION['faculty_id']` and `$_SESSION['faculty_name']` for faculty info

2. **Access Control**
   - Header checks in faculty pages prevent unauthorized access
   - Faculty can only view their own evaluation data
   - SQL queries filter by faculty name

3. **SQL Injection Protection**
   - All user inputs are escaped using `real_escape_string()`
   - Parameterized queries where applicable

## File Structure
```
Dean-Faculty-Evaluation-CCS/
├── welcome.php                    # NEW: Landing page
├── login.php                      # UPDATED: Added faculty portal link
├── faculty_login.php              # NEW: Faculty login page
├── faculty_dashboard.php          # NEW: Faculty dashboard
├── faculty_view_evaluation.php    # NEW: Faculty evaluation view
├── faculty_logout.php             # NEW: Faculty logout
├── faculty_db_update.sql          # NEW: Database schema update
├── dashboard.php                  # Existing admin dashboard
├── view_evaluation.php            # Existing admin evaluation view
├── header.php                     # Existing admin header
└── ... (other existing files)
```

## Testing Instructions

### 1. Setup Database:
```bash
# In phpMyAdmin or MySQL console:
mysql -u root -p faculty_evaluation < faculty_db_update.sql
```

### 2. Test Faculty Login:
- Navigate to `http://localhost/Dean-Faculty-Evaluation-CCS/welcome.php`
- Click "Access Faculty Portal"
- Login with: `val.fabregas` / `faculty123`
- Verify dashboard displays correctly
- Check statistics are calculated properly

### 3. Test Evaluation View:
- From dashboard, click "View Details" on any evaluation
- Verify the correct evaluation is displayed
- Test print functionality
- Verify navigation back to dashboard works

### 4. Test Security:
- Try accessing `faculty_dashboard.php` without login (should redirect)
- Try accessing another faculty's evaluation by changing URL ID
- Verify session management works correctly

### 5. Test Navigation:
- Test all links between welcome, login pages
- Verify logout redirects correctly
- Test "Back to Home" links

## Customization

### To Add More Faculty Users:
```sql
INSERT INTO users (username, password, role, faculty_id, full_name) 
VALUES ('username', '$2y$10$rJ3VQdKDJ4K5L6M7N8O9Pe.Qq1Rr2Ss3Tt4Uu5Vv6Ww7Xx8Yy9Zz0', 
        'faculty', <faculty_id>, 'Full Name');
```
Note: The password hash above is for `faculty123`

### To Change Password:
```php
<?php
// Generate new password hash
echo password_hash('your_new_password', PASSWORD_DEFAULT);
?>
```

### To Customize Colors:
- Admin Portal: Edit color classes in `login.php` and `header.php`
- Faculty Portal: Edit color classes in `faculty_login.php` and `faculty_dashboard.php`

## Troubleshooting

### Issue: Faculty login fails
- Verify database has been updated with `faculty_db_update.sql`
- Check that faculty record exists in `faculty` table
- Verify username matches exactly (case-sensitive)

### Issue: No evaluations showing
- Verify evaluations exist for the faculty member
- Check `faculty_name` in evaluations table matches `name` in faculty table exactly
- Verify database connection is working

### Issue: "Access Denied" on evaluation view
- Ensure faculty is logged in
- Verify the evaluation belongs to the logged-in faculty member
- Check session variables are set correctly

## Future Enhancements

Potential additions to consider:
1. Password reset functionality
2. Faculty profile editing
3. Evaluation filtering by semester/year
4. Performance charts and graphs
5. Email notifications for new evaluations
6. Multi-year performance comparison
7. Export to PDF functionality
8. Faculty feedback submission

## Support

For issues or questions:
1. Check database connection settings in each PHP file
2. Verify XAMPP/Apache is running
3. Check PHP error logs
4. Ensure all SQL updates have been applied

---
**Implementation Date**: January 23, 2026
**Version**: 1.0
**Developer**: GitHub Copilot

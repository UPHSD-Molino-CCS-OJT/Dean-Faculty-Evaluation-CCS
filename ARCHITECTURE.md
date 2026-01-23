# Faculty Portal - System Architecture

## System Flow Diagram

```
┌─────────────────────────────────────────────────────────────────┐
│                         LANDING PAGE                             │
│                       (welcome.php)                              │
│                                                                  │
│  ┌────────────────────┐              ┌────────────────────┐    │
│  │   Admin Portal     │              │  Faculty Portal    │    │
│  │   Click to Access  │              │  Click to Access   │    │
│  └────────┬───────────┘              └─────────┬──────────┘    │
└───────────┼──────────────────────────────────────┼──────────────┘
            │                                      │
            ▼                                      ▼
┌───────────────────────┐          ┌────────────────────────────┐
│   ADMIN LOGIN         │          │   FACULTY LOGIN            │
│   (login.php)         │          │   (faculty_login.php)      │
│                       │          │                            │
│   • Admin credentials │          │   • Faculty credentials    │
│   • Redirect to       │          │   • Redirect to            │
│     dashboard         │          │     faculty_dashboard      │
└───────────┬───────────┘          └──────────┬─────────────────┘
            │                                  │
            ▼                                  ▼
┌───────────────────────┐          ┌────────────────────────────┐
│   ADMIN DASHBOARD     │          │   FACULTY DASHBOARD        │
│   (dashboard.php)     │          │   (faculty_dashboard.php)  │
│                       │          │                            │
│   • View all evals    │          │   • View own stats         │
│   • Manage faculty    │          │   • View own evals         │
│   • Create new eval   │          │   • Filter by semester     │
│   • View reports      │          │   • Print reports          │
└───────────┬───────────┘          └──────────┬─────────────────┘
            │                                  │
            │ Click "View"                     │ Click "View Details"
            ▼                                  ▼
┌───────────────────────┐          ┌────────────────────────────┐
│   ADMIN VIEW EVAL     │          │   FACULTY VIEW EVAL        │
│   (view_evaluation)   │          │   (faculty_view_eval)      │
│                       │          │                            │
│   • Full eval details │          │   • Full eval details      │
│   • Print option      │          │   • Print option           │
│   • Edit/Delete       │          │   • Read-only view         │
└───────────────────────┘          └────────────────────────────┘
```

## Database Schema

```
┌─────────────────────┐
│      USERS          │
├─────────────────────┤
│ id (PK)             │
│ username            │
│ password            │
│ role (ENUM)         │ ◄──── NEW: 'admin' or 'faculty'
│ faculty_id (FK)     │ ◄──── NEW: Links to faculty table
│ full_name           │ ◄──── NEW: Display name
└─────────┬───────────┘
          │
          │ Foreign Key
          │
          ▼
┌─────────────────────┐         ┌──────────────────────┐
│     FACULTY         │         │    EVALUATIONS       │
├─────────────────────┤         ├──────────────────────┤
│ id (PK)             │◄────────┤ id (PK)              │
│ name                │  Link   │ faculty_name         │
│ department          │  by     │ semester             │
│ status              │  name   │ school_year          │
│ created_at          │         │ total_units          │
└─────────────────────┘         │ sec1_avg - sec5_avg  │
                                │ overall_rating       │
                                │ additional_comments  │
                                └──────────────────────┘
```

## Session Variables

### Admin Session:
```php
$_SESSION['admin_logged_in'] = true;
```

### Faculty Session:
```php
$_SESSION['faculty_logged_in'] = true;
$_SESSION['faculty_id'] = 3;  // Links to faculty table
$_SESSION['faculty_name'] = 'Val Patrick Fabregas';
$_SESSION['user_id'] = 10;  // User record ID
```

## File Dependencies

```
welcome.php (no dependencies - standalone)
    │
    ├─► login.php
    │       │
    │       └─► header.php
    │               │
    │               ├─► dashboard.php
    │               │       │
    │               │       └─► view_evaluation.php
    │               │
    │               ├─► index.php (evaluation form)
    │               └─► edit_faculty.php
    │
    └─► faculty_login.php
            │
            └─► faculty_dashboard.php
                    │
                    └─► faculty_view_evaluation.php
```

## Security Flow

```
┌──────────────────┐
│  User Request    │
└────────┬─────────┘
         │
         ▼
┌──────────────────────────┐
│  Check Session           │
│  - admin_logged_in?      │
│  - faculty_logged_in?    │
└────────┬─────────────────┘
         │
         ├─► NOT SET ──────► Redirect to login
         │
         └─► SET
                 │
                 ▼
         ┌──────────────────┐
         │  Verify Role     │
         └────────┬─────────┘
                  │
                  ├─► Admin ──────► Access admin features
                  │
                  └─► Faculty ────► Filter by faculty_name
                                    Only show own data
```

## Data Flow - Faculty Viewing Evaluation

```
1. Faculty Login
   │
   ├─► Validate credentials
   │   └─► Query: SELECT * FROM users 
   │       WHERE username='...' AND role='faculty'
   │
   └─► Set session variables
       ├─► faculty_logged_in = true
       ├─► faculty_id = (from users.faculty_id)
       └─► faculty_name = (from faculty.name)

2. Dashboard Request
   │
   ├─► Check session (faculty_logged_in)
   │
   ├─► Get Statistics
   │   └─► Query: SELECT COUNT(*), AVG(overall_rating), ...
   │       FROM evaluations 
   │       WHERE faculty_name = SESSION[faculty_name]
   │
   └─► Get Evaluation List
       └─► Query: SELECT * FROM evaluations 
           WHERE faculty_name = SESSION[faculty_name]
           ORDER BY date_submitted DESC

3. View Evaluation Details
   │
   ├─► Check session (faculty_logged_in)
   │
   ├─► Verify Ownership
   │   └─► Query: SELECT * FROM evaluations 
   │       WHERE id = URL[id] 
   │       AND faculty_name = SESSION[faculty_name]
   │
   └─► Display if match found
       └─► 403 if no match (security)
```

## Color Coding

### Admin Portal Theme:
- **Primary:** Blue (#3b82f6, #1e3a8a)
- **Secondary:** Purple (#764ba2)
- **Accents:** Indigo, Blue variations
- **Buttons:** Blue gradient

### Faculty Portal Theme:
- **Primary:** Teal (#14b8a6, #0f766e)
- **Secondary:** Green (#10b981)
- **Accents:** Teal, Cyan variations
- **Buttons:** Teal gradient

### Visual Distinction:
```
ADMIN:  🔵 Blue/Purple  → Administrative Functions
FACULTY: 🟢 Teal/Green → Faculty Self-Service
```

## API Endpoints (Implicit)

```
POST /login.php
    ↳ Admin authentication
    ↳ Returns: Redirect to dashboard.php

POST /faculty_login.php
    ↳ Faculty authentication
    ↳ Returns: Redirect to faculty_dashboard.php

GET /faculty_dashboard.php
    ↳ Requires: faculty_logged_in session
    ↳ Returns: Statistics + Evaluation list

GET /faculty_view_evaluation.php?id={id}
    ↳ Requires: faculty_logged_in session
    ↳ Validates: Evaluation belongs to logged-in faculty
    ↳ Returns: Full evaluation details or 403

GET /faculty_logout.php
    ↳ Destroys session
    ↳ Returns: Redirect to faculty_login.php
```

## Deployment Checklist

```
□ 1. Backup current database
□ 2. Run setup_faculty_portal.php
□ 3. Verify database changes:
     □ users.role column exists
     □ users.faculty_id column exists
     □ users.full_name column exists
     □ Foreign key constraint created
     □ Faculty users created
□ 4. Test admin login (existing functionality)
□ 5. Test faculty login (new functionality)
□ 6. Verify faculty can view evaluations
□ 7. Verify faculty cannot see other faculty's data
□ 8. Test print functionality
□ 9. Test logout on both portals
□ 10. Delete setup_faculty_portal.php (optional)
```

## Performance Considerations

### Database Queries:
- **Dashboard:** 2 queries (statistics + list)
- **View Evaluation:** 1 query with ownership validation
- All queries use indexed columns (id, faculty_name)

### Optimization Tips:
```sql
-- Add index on faculty_name if many evaluations
CREATE INDEX idx_faculty_name ON evaluations(faculty_name);

-- Add composite index for faster filtering
CREATE INDEX idx_faculty_semester ON evaluations(faculty_name, semester, school_year);
```

### Caching Strategy:
- Session data cached in $_SESSION
- No additional caching needed for current scale
- Consider Redis/Memcached if scaling to 1000+ faculty

## Monitoring & Logs

### Key Metrics to Track:
1. Failed login attempts (both portals)
2. Evaluation views per faculty
3. Session duration
4. Print requests

### Log Points:
```php
// Login attempts
error_log("Faculty login attempt: " . $username);

// Unauthorized access attempts
error_log("Unauthorized eval access: Faculty " . $faculty_id . " tried to access eval " . $eval_id);

// Session management
error_log("Faculty session created: " . $faculty_id);
```

---
**Architecture Version:** 1.0  
**Last Updated:** January 23, 2026

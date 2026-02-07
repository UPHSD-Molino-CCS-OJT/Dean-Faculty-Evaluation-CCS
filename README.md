# CCS Faculty Evaluation System

## 🚀 Quick Start

### First Time Setup
1. **Initialize Database:** Visit `http://localhost/Dean-Faculty-Evaluation-CCS/setup/setup_faculty_portal.php`
2. **Click "Run Setup"** to create tables and accounts
3. **Login:** Go to `http://localhost/Dean-Faculty-Evaluation-CCS/login.php`

### Login Credentials

**Admin:**
- Username: `admin`
- Password: (your admin password)

**Faculty:**
- Username: `val.fabregas` (or any faculty username)
- Password: `faculty123`

The system automatically redirects you to the correct dashboard based on your role.

---

## 📁 Project Structure

```
Dean-Faculty-Evaluation-CCS/
├── admin/          Admin portal pages
├── faculty/        Faculty portal pages
├── includes/       Shared PHP components
├── assets/         JavaScript and static files
├── sql/            Database schemas
├── setup/          Setup scripts
├── docs/           Full documentation
├── login.php       Unified login (admin & faculty)
└── index.php       Evaluation form
```

---

## 📚 Full Documentation

See `/docs/README.md` for complete documentation, or visit:
- [README.md](docs/README.md) - Full system documentation
- [QUICK_START.md](docs/QUICK_START.md) - Setup guide
- [FILE_STRUCTURE.md](docs/FILE_STRUCTURE.md) - File organization
- [REORGANIZATION_SUMMARY.md](REORGANIZATION_SUMMARY.md) - Structure changes

---

## 🔐 Access Points

- **Login:** `/login.php` (for both admin and faculty)
- **Admin Dashboard:** `/admin/dashboard.php` (after login)
- **Faculty Dashboard:** `/faculty/faculty_dashboard.php` (after login)
- **New Evaluation:** `/index.php` (admin only)

---

**College of Computer Studies**  
UPHSD Molino Campus  
© 2026

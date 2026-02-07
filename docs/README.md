# CCS Faculty Evaluation System

## 🎓 Dean's Faculty Evaluation System
**College of Computer Studies - UPHSD Molino Campus**

A comprehensive web-based system for managing and viewing faculty evaluations with dual portal access for administrators and faculty members.

---

## 🌟 Features

### 👨‍💼 Admin Portal
- ✅ Create and manage faculty evaluations
- ✅ View comprehensive evaluation reports
- ✅ Manage faculty database
- ✅ Filter by semester and school year
- ✅ Print official evaluation records
- ✅ Analytics and statistics

### 👨‍🏫 Faculty Portal (NEW!)
- ✅ Personal dashboard with statistics
- ✅ View evaluation history
- ✅ Access detailed evaluation reports
- ✅ Track performance over time
- ✅ Print personal evaluation records
- ✅ Secure, read-only access

---

## 🚀 Quick Start

### 1. Setup Database
Visit: `http://localhost/Dean-Faculty-Evaluation-CCS/setup_faculty_portal.php`
Click "Run Setup Now"

### 2. Access the System
Visit: `http://localhost/Dean-Faculty-Evaluation-CCS/login.php`

### 3. Login
**Admin:**
- Username: `admin` or `AdminCCSDeptEval`
- Password: (your admin password)

**Faculty:**
- Username: `val.fabregas` (or any faculty username)
- Password: `faculty123`

---

## 📁 System Structure

```
📦 Dean-Faculty-Evaluation-CCS
├── 📁 admin/                         # Admin Portal Files
│   ├── dashboard.php                 # Main admin dashboard
│   ├── edit_faculty.php              # Edit faculty members
│   ├── full_evaluation.php           # Full evaluation view
│   ├── process_faculty.php           # Faculty CRUD operations
│   ├── view_evaluation.php           # View evaluation details
│   └── welcome.php                   # Landing page
│
├── 📁 faculty/                       # Faculty Portal Files
│   ├── faculty_dashboard.php         # Faculty member dashboard
│   ├── faculty_login.php             # Faculty authentication
│   ├── faculty_logout.php            # Faculty session cleanup
│   └── faculty_view_evaluation.php   # View evaluations
│
├── 📁 includes/                      # Shared Components
│   ├── config.php                    # Database configuration
│   ├── header.php                    # Admin header/navigation
│   └── submit.php                    # Evaluation submission handler
│
├── 📁 assets/                        # Static Assets
│   └── js/
│       └── script.js                 # JavaScript functionality
│
├── 📁 sql/                           # Database Files
│   ├── faculty_evaluation.sql        # Main database schema
│   └── faculty_db_update.sql         # Database updates
│
├── 📁 setup/                         # Setup Scripts
│   ├── fix_faculty_passwords.php     # Password reset utility
│   └── setup_faculty_portal.php      # Initial setup script
│
├── 📁 docs/                          # Documentation
│   ├── ARCHITECTURE.md               # System architecture
│   ├── FACULTY_PORTAL_GUIDE.md       # Faculty portal guide
│   ├── IMPLEMENTATION_SUMMARY.md     # Implementation details
│   ├── QUICK_START.md                # Quick start guide
│   └── README.md                     # This file
│
├── 🏠 index.php                      # Evaluation form (admin)
├── 🔐 login.php                      # Admin login
├── 🚪 logout.php                     # Admin logout
├── ✍️ register.php                   # User registration
└── 📄 LICENSE                        # MIT License
```

---

## 🚀 Getting Started

### First Time Setup
1. Visit: `http://localhost/Dean-Faculty-Evaluation-CCS/setup/setup_faculty_portal.php`
2. Click "Run Setup Now" to initialize the database
3. Navigate to: `http://localhost/Dean-Faculty-Evaluation-CCS/login.php`

### Access Points
- **Login Page**: `/login.php` (for both admin and faculty)
- **Admin Dashboard**: `/admin/dashboard.php`
- **Faculty Dashboard**: `/faculty/faculty_dashboard.php`
- **New Evaluation**: `/index.php` (requires admin login)

---

## 📚 Documentation

- **[QUICK_START.md](QUICK_START.md)** - Get started in 3 minutes
- **[FACULTY_PORTAL_GUIDE.md](FACULTY_PORTAL_GUIDE.md)** - Complete feature guide
- **[ARCHITECTURE.md](ARCHITECTURE.md)** - Technical documentation
- **[IMPLEMENTATION_SUMMARY.md](IMPLEMENTATION_SUMMARY.md)** - Implementation overview

---

## 🎨 Screenshots

### Landing Page
Two-portal selection with modern design
- Admin Portal (Blue theme)
- Faculty Portal (Teal theme)

### Faculty Dashboard
- Statistics cards (Total, Average, Highest, Lowest)
- Evaluation history table
- Quick access to detailed views

### Evaluation Details
- Complete evaluation breakdown
- All five criteria with weighted scores
- Print-friendly format

---

## 🔐 Security Features

- ✅ Role-based authentication (Admin/Faculty)
- ✅ Session management
- ✅ SQL injection protection
- ✅ Access control verification
- ✅ Data isolation (faculty see only their own data)

---

## 💾 Database Structure

### Tables:
- **users** - Admin and faculty login credentials (with role support)
- **faculty** - Faculty member information
- **evaluations** - Faculty evaluation records
- **evaluation_details** - Detailed rating breakdown

---

## 🛠️ Technology Stack

- **Backend:** PHP 8.2
- **Database:** MySQL/MariaDB
- **Frontend:** HTML5, Tailwind CSS, JavaScript
- **Server:** Apache (XAMPP)
- **Fonts:** Google Fonts (Inter)

---

## 📊 Evaluation Criteria

1. **Personal and Social Traits** (10%)
2. **Instructional Competence** (60%)
3. **Classroom Management** (10%)
4. **Conduct Towards School Authority** (10%)
5. **Professional Advancement** (10%)

**Total:** 100% → Overall Rating (out of 5.00)

---

## 👥 Default Faculty Accounts

All accounts use password: `faculty123`

| Username | Name |
|----------|------|
| val.fabregas | Val Patrick Fabregas |
| roberto.malitao | Roberto Malitao |
| homer.favenir | Homer Favenir |
| fe.antonio | Fe Antonio |
| marco.subion | Marco Antonio Subion |
| luvim.eusebio | Luvim Eusebio |
| rolando.quirong | Rolando Quirong |
| arnold.galve | Arnold Galve |
| edward.cruz | Edward Cruz |

---

## 🔄 Recent Updates

### January 23, 2026 - Faculty Portal Release
- ✅ Added faculty login system
- ✅ Created faculty dashboard with statistics
- ✅ Implemented evaluation viewing for faculty
- ✅ Added role-based authentication
- ✅ Created landing page with dual portal access
- ✅ Comprehensive documentation

---

## 📝 License

This project is developed for the College of Computer Studies, UPHSD Molino Campus.

---

## 🤝 Support

For technical issues:
1. Check documentation in `/docs` folder
2. Run `setup_faculty_portal.php` to verify database
3. Check Apache/MySQL logs
4. Review error messages in browser console

---

## 🎯 Future Enhancements

- [ ] Password reset functionality
- [ ] Email notifications
- [ ] Performance charts and graphs
- [ ] CSV export
- [ ] Multi-year comparison
- [ ] Faculty profile editing

---

## 📧 Contact

**College of Computer Studies**  
University of Perpetual Help System Dalta - Molino Campus

---

**Version:** 2.0 (Faculty Portal Enabled)  
**Last Updated:** January 23, 2026  
**Status:** Production Ready ✅

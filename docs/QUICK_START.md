# Faculty Portal - Quick Start Guide

## 🚀 What's New?

Your CCS Faculty Evaluation System now has a **Faculty Portal** where faculty members can log in and view their evaluation history!

## 📋 Quick Setup (3 Steps)

### Step 1: Run Database Setup
1. Open your browser
2. Navigate to: `http://localhost/Dean-Faculty-Evaluation-CCS/setup/setup_faculty_portal.php`
3. Click "Run Setup Now"
4. Wait for success messages

### Step 2: Test Login
1. Go to: `http://localhost/Dean-Faculty-Evaluation-CCS/login.php`
2. Login with admin or faculty account:
   - **Admin:** Username: `admin`, Password: (your admin password)
   - **Faculty:** Username: `val.fabregas`, Password: `faculty123`

### Step 3: Explore!
- View your evaluation statistics
- Browse evaluation history
- Click "View Details" to see full evaluations
- Test the print functionality

## 🎯 New Features

### For Faculty Members:
✅ **Personal Dashboard** - View all your evaluations in one place  
✅ **Statistics** - See your average, highest, and lowest ratings  
✅ **Detailed Views** - Access full evaluation reports  
✅ **Print Reports** - Print-friendly evaluation formats  
✅ **Secure Access** - Only view your own evaluations  

### For Administrators:
✅ **Unchanged Admin Portal** - All existing features work the same  
✅ **Role-Based Access** - Faculty and admin portals are separate  
✅ **Easy Management** - Faculty accounts linked to faculty database  

## 🔐 Default Credentials

### Admin Accounts (unchanged):
- Username: `admin` or `AdminCCSDeptEval`
- Password: (your existing password)

### Faculty Accounts (new):
All faculty accounts use password: **`faculty123`**

| Username | Faculty Name |
|----------|--------------|
| val.fabregas | Val Patrick Fabregas |
| roberto.malitao | Roberto Malitao |
| homer.favenir | Homer Favenir |
| fe.antonio | Fe Antonio |
| marco.subion | Marco Antonio Subion |
| luvim.eusebio | Luvim Eusebio |
| rolando.quirong | Rolando Quirong |
| arnold.galve | Arnold Galve |
| edward.cruz | Edward Cruz |

## 🗂️ New Files

1. **setup_faculty_portal.php** - Database setup script
2. **faculty_dashboard.php** - Faculty member dashboard  
3. **faculty_view_evaluation.php** - Detailed evaluation view
4. **faculty_logout.php** - Logout handler
5. **FACULTY_PORTAL_GUIDE.md** - Complete documentation

## 🌐 Portal URLs

### Main Entry Point:
```
## 🌐 Access URLs

### Unified Login:
```
http://localhost/Dean-Faculty-Evaluation-CCS/login.php
```

**Login credentials:**
- Admin: `admin` / (your admin password)
- Faculty: `val.fabregas` / `faculty123`

The system automatically redirects based on user role (admin or faculty).

## 💡 Usage Tips

### For Faculty:
1. **First Login:** Use the default password `faculty123`
2. **Dashboard:** Shows statistics and all your evaluations
3. **View Details:** Click to see complete evaluation breakdown
4. **Print:** Use the print button for official records
5. **Navigation:** Easy access back to dashboard from any page

### For Administrators:
1. Everything remains the same in admin portal
2. Continue using existing admin credentials
3. No changes to evaluation creation or management
4. Faculty accounts are automatically created from faculty database

## ⚙️ Technical Details

### Database Changes:
- Added `role` column to users table (admin/faculty)
- Added `faculty_id` column to link users to faculty
- Added `full_name` column for display purposes
- Foreign key constraint between users and faculty

### Security Features:
- Role-based authentication
- Session management
- Faculty can only view their own data
- SQL injection protection
- Access control on all pages

## 🎨 Design

### Admin Portal:
- Blue/Purple color scheme
- Existing design maintained

### Faculty Portal:
- Teal/Green color scheme
- Modern, card-based layout
- Responsive design
- Print-friendly views

## 📊 What Faculty Can See

### Dashboard Statistics:
- Total number of evaluations
- Average rating across all evaluations
- Highest rating achieved
- Lowest rating received

### Evaluation Details:
- Semester and school year
- All five evaluation criteria scores
- Weighted scores
- Overall rating
- Additional comments
- Subjects handled
- Date submitted

## 🔧 Troubleshooting

**Q: Faculty login not working?**  
A: Run `setup_faculty_portal.php` to ensure database is updated

**Q: No evaluations showing?**  
A: Check that evaluations exist for the faculty member in the database

**Q: "Access Denied" error?**  
A: Verify you're logged in as faculty, not admin

**Q: Can't access admin portal?**  
A: Admin and faculty portals are separate - use admin login for admin access

## 🔄 Future Password Changes

To change a faculty password:
```php
// Generate new password hash
echo password_hash('new_password', PASSWORD_DEFAULT);
// Then update in database users table
```

## 📞 Need Help?

See `FACULTY_PORTAL_GUIDE.md` for complete documentation including:
- Detailed feature descriptions
- Customization options
- Advanced troubleshooting
- Future enhancement ideas

## ✅ Post-Setup Checklist

- [ ] Run `setup_faculty_portal.php`
- [ ] Test admin login (existing credentials)
- [ ] Test faculty login (new credentials)
- [ ] Verify faculty can see evaluations
- [ ] Test print functionality
- [ ] Check navigation between portals
- [ ] Delete `setup_faculty_portal.php` (optional, for security)

---

**🎉 You're all set!** Faculty members can now access their evaluations anytime through the faculty portal.

**Start Here:** `http://localhost/Dean-Faculty-Evaluation-CCS/welcome.php`

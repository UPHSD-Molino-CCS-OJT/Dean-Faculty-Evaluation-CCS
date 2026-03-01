# Railway Deployment Guide

## 🚀 UPHSD Molino CCS - Dean Faculty Evaluation System

This guide will walk you through deploying the Faculty Evaluation System to Railway.com.

---

## Prerequisites

- GitHub account with your repository connected to Railway
- Railway account (free tier works fine for small projects)
- Your repository should already be pushed to GitHub

---

## Step 1: Create Railway Project

1. Go to [Railway.app](https://railway.app/)
2. Click **"Start a New Project"**
3. Select **"Deploy from GitHub repo"**
4. Choose your `Dean-Faculty-Evaluation-CCS` repository
5. Railway will automatically detect it as a PHP project

---

## Step 2: Add MySQL Database Service

1. In your Railway project dashboard, click **"+ New"**
2. Select **"Database"**
3. Choose **"Add MySQL"**
4. Railway will automatically provision a MySQL database with credentials

---

## Step 3: Configure Environment Variables

Railway's MySQL service automatically creates environment variables. Your application is configured to read both Railway's default variables (`MYSQLHOST`, `MYSQLUSER`, etc.) and standard variables (`DB_HOST`, `DB_USER`, etc.).

### Verify Auto-Generated Variables

Go to your **MySQL service** → **Variables** tab. You should see:
- `MYSQLHOST` - Database host
- `MYSQLPORT` - Database port (usually 3306)
- `MYSQLUSER` - Database username
- `MYSQLPASSWORD` - Database password
- `MYSQLDATABASE` - Database name

These are automatically available to your PHP application! ✅

### (Optional) Add Custom Variables

If you prefer custom variable names, go to your **PHP service** → **Variables** tab and add:

```bash
DB_HOST=${{MySQL.MYSQLHOST}}
DB_PORT=${{MySQL.MYSQLPORT}}
DB_USER=${{MySQL.MYSQLUSER}}
DB_PASSWORD=${{MySQL.MYSQLPASSWORD}}
DB_NAME=${{MySQL.MYSQLDATABASE}}
```

Railway will automatically reference the MySQL service variables.

---

## Step 4: Initialize Database Schema

After your application deploys successfully, you need to import the database schema.

### Option A: Using Railway's MySQL Client (Recommended)

1. In Railway dashboard, go to your **MySQL service**
2. Click **"Data"** tab
3. Click **"Query"** to open the SQL console
4. Copy the contents of `sql/faculty_evaluation.sql` from your repository
5. Paste and execute the SQL query
6. You should see success messages for all table creations

### Option B: Using Railway Database Initialization Script

1. Visit your Railway deployment URL followed by `/railway-db-init.php`:
   ```
   https://your-app-name.railway.app/railway-db-init.php
   ```
2. This will automatically:
   - Check if tables exist
   - Import the complete database schema
   - Create default admin account
   - Set up sample faculty data
   - Display a success/error report

3. **IMPORTANT**: After initialization succeeds, delete `railway-db-init.php` from your repository for security

### Option C: Local MySQL Client

1. Get your MySQL connection details from Railway's MySQL service → **Connect** tab
2. Use MySQL Workbench, phpMyAdmin, or command line:
   ```bash
   mysql -h [MYSQLHOST] -P [MYSQLPORT] -u [MYSQLUSER] -p[MYSQLPASSWORD] [MYSQLDATABASE] < sql/faculty_evaluation.sql
   ```

---

## Step 5: Configure Persistent Storage for Signatures

Faculty evaluation signatures are uploaded to the `signatures/` directory and need to persist across deployments.

### Set Up Railway Volume

1. In Railway dashboard, go to your **PHP service**
2. Click **"Settings"** tab
3. Scroll to **"Volumes"** section
4. Click **"+ Add Volume"**
5. Configure:
   - **Mount Path**: `/app/signatures`
   - **Size**: `1GB` (adjust based on needs)
6. Click **"Add"**
7. Redeploy your application

Your signature uploads will now persist between deployments! 📁

---

## Step 6: Verify Deployment

### Test Application Access

Visit your Railway-provided URL (found in your PHP service dashboard):

```
https://your-app-name.railway.app
```

### Test Admin Login

1. Navigate to: `https://your-app-name.railway.app/login.php`
2. Login with default credentials:
   - **Username**: `admin`
   - **Password**: `admin123` (change this immediately!)
3. You should be redirected to `/admin/dashboard.php`

### Test Faculty Portal

1. Navigate to: `https://your-app-name.railway.app/login.php`
2. Login with sample faculty account:
   - **Username**: `val.fabregas`
   - **Password**: `faculty123`
3. You should be redirected to `/faculty/faculty_dashboard.php`

### Test Evaluation Creation

1. Go to the root URL: `https://your-app-name.railway.app/`
2. Fill out an evaluation form
3. Upload a signature image
4. Submit the evaluation
5. Verify it appears in the admin dashboard

---

## Step 7: Post-Deployment Security

### Change Default Passwords

1. Login as admin
2. Go to admin dashboard
3. Navigate to user management
4. Change the default admin password immediately
5. Update or create secure faculty accounts

### Remove Setup/Migration Scripts (Optional)

For production security, consider removing these files:
- `railway-db-init.php` (if you created it)
- `setup/*.php` (setup scripts)
- `add_*.php` (migration scripts)
- `cleanup_*.php` (maintenance scripts)
- `fix_*.php` (fix scripts)

Or move them to a separate branch for maintenance access only.

### Update .gitignore

Add sensitive files to `.gitignore`:
```
signatures/*
!signatures/.gitkeep
*.log
.env
```

---

## 📋 Environment Variables Reference

Your application automatically detects and uses these Railway MySQL variables:

| Variable | Purpose | Auto-Generated by Railway |
|----------|---------|---------------------------|
| `MYSQLHOST` | Database server address | ✅ Yes |
| `MYSQLPORT` | Database port | ✅ Yes |
| `MYSQLUSER` | Database username | ✅ Yes |
| `MYSQLPASSWORD` | Database password | ✅ Yes |
| `MYSQLDATABASE` | Database name | ✅ Yes |

Alternative variables (if you prefer custom names):
- `DB_HOST`
- `DB_PORT`
- `DB_USER`
- `DB_PASSWORD`
- `DB_NAME`

The application checks Railway's default variables first, then falls back to custom variables, then falls back to localhost for local development.

---

## 🔧 Troubleshooting

### Issue: "Connection failed" Error

**Solution**: Verify environment variables are set correctly in Railway dashboard.

```bash
# In Railway PHP service → Variables tab, check:
MYSQLHOST → Should be internal MySQL hostname
MYSQLUSER → Should be provided by MySQL service
MYSQLPASSWORD → Should be provided by MySQL service
MYSQLDATABASE → Should be provided by MySQL service
```

### Issue: Blank Page or 500 Error

**Solution**: Check Railway deployment logs
1. Go to your PHP service in Railway
2. Click **"Deployments"** tab
3. Click on the latest deployment
4. Check **"Build Logs"** and **"Deploy Logs"** for errors

### Issue: Signature Uploads Not Persisting

**Solution**: Ensure Railway volume is properly mounted
1. Verify volume is attached at `/app/signatures`
2. Check volume size hasn't reached capacity
3. Redeploy after adding volume

### Issue: Database Tables Not Created

**Solution**: Manually import SQL schema
1. Use Railway's MySQL Query console
2. Copy contents of `sql/faculty_evaluation.sql`
3. Execute the SQL to create all tables

### Issue: Permission Denied on Signatures Directory

**Solution**: Railway should handle permissions automatically, but if needed:
1. The application creates the directory with proper permissions in code
2. Ensure volume mount path is exactly `/app/signatures`
3. Check deployment logs for file system errors

---

## 📊 Database Schema

The application uses these tables:

| Table | Purpose |
|-------|---------|
| `evaluations` | Main evaluation records with metadata |
| `evaluation_details` | Individual question ratings |
| `faculty` | Faculty member profiles |
| `users` | Login credentials (admin & faculty) |
| `settings` | System configuration settings |

Schema is located in: `sql/faculty_evaluation.sql`

---

## 🔄 Updates and Redeployment

Railway automatically redeploys when you push to your GitHub repository.

### Deployment Workflow

1. Make code changes locally
2. Commit and push to GitHub:
   ```bash
   git add .
   git commit -m "Your update message"
   git push origin main
   ```
3. Railway automatically detects the push and redeploys
4. Monitor deployment status in Railway dashboard

### Database Migrations

For schema changes:
1. Create a new migration script (e.g., `add_new_column.php`)
2. Run it once via browser after deployment: `https://your-app.railway.app/add_new_column.php`
3. Remove the script from the repository after execution

---

## 📱 Custom Domain (Optional)

To use your own domain instead of Railway's default:

1. In Railway dashboard → your PHP service → **Settings**
2. Scroll to **"Domains"** section
3. Click **"+ Add Domain"**
4. Enter your custom domain (e.g., `eval.ccs-uphsd.edu.ph`)
5. Configure DNS records as instructed by Railway:
   - Add CNAME record pointing to Railway's provided address
6. Wait for DNS propagation (can take up to 48 hours)

---

## 💰 Railway Pricing

- **Free Tier**: $5 monthly credit (enough for small projects)
- **Pro Plan**: $20/month with priority support
- MySQL Database: Included in both plans

### Estimated Monthly Cost

For a typical faculty evaluation system:
- PHP Application: ~$2-5/month
- MySQL Database: ~$3-5/month
- Total: Should fit within free tier credit! 🎉

---

## 🆘 Support Resources

- **Railway Documentation**: https://docs.railway.app/
- **Railway Discord**: https://discord.gg/railway
- **GitHub Issues**: Create an issue in your repository
- **PHP MySQL Documentation**: https://www.php.net/manual/en/book.mysqli.php

---

## ✅ Deployment Checklist

- [ ] Railway project created and connected to GitHub
- [ ] MySQL database service added
- [ ] Environment variables verified (auto-generated by Railway)
- [ ] Database schema imported successfully
- [ ] Volume configured for `/app/signatures` directory
- [ ] Application accessible via Railway URL
- [ ] Admin login tested successfully
- [ ] Faculty login tested successfully
- [ ] Evaluation submission tested
- [ ] Signature upload tested
- [ ] Default passwords changed
- [ ] Setup scripts removed or secured

---

## 🎓 Default Credentials

**Admin Account:**
- Username: `admin`
- Password: `admin123`
- **⚠️ CHANGE IMMEDIATELY AFTER FIRST LOGIN**

**Sample Faculty Account:**
- Username: `val.fabregas`
- Password: `faculty123`

---

## 📝 Notes

- This application uses PHP native sessions (file-based by default on Railway)
- All database credentials are sourced from environment variables
- File uploads (signatures) require persistent volume storage
- The application is compatible with PHP 8.0+ and MySQL 5.7+
- No additional composer dependencies required

---

**Congratulations! Your Faculty Evaluation System is now live on Railway! 🎉**

For questions or issues, refer to the troubleshooting section or consult Railway's documentation.

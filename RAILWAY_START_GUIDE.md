# Complete Railway Deployment Guide - Step by Step

## 🚀 Starting Your Faculty Evaluation System on Railway

Follow these steps exactly to get your application running on Railway.

---

## Part 1: Initial Setup (One-Time Setup)

### Step 1: Connect Repository to Railway

1. Go to [Railway.app](https://railway.app/) and login
2. Click **"New Project"**
3. Select **"Deploy from GitHub repo"**
4. Authorize Railway to access your GitHub
5. Select repository: **`Dean-Faculty-Evaluation-CCS`**
6. Railway will start deploying automatically

---

### Step 2: Add MySQL Database

1. In your Railway project dashboard, click **"+ New"** button
2. Select **"Database"**
3. Choose **"MySQL"**
4. Railway will provision the database (takes ~30 seconds)
5. Wait for the MySQL service to show **"Active"** status

---

### Step 3: Link Services Together

**IMPORTANT**: Your PHP service needs to know about the MySQL service.

1. Click on your **PHP service** (named `Dean-Faculty-Evaluation-CCS` or similar)
2. Go to **"Settings"** tab (gear icon)
3. Scroll down to **"Service Variables"** or **"Connect"** section
4. Look for an option to **"Reference MySQL service"** or **"Add service reference"**
5. Select your MySQL database service
6. This makes MySQL environment variables available to your PHP app

**Alternative method if above doesn't work:**
1. Go to **MySQL service** → **"Variables"** tab
2. Copy the connection variables
3. Go to **PHP service** → **"Variables"** tab
4. Click **"New Variable"** and add these (get values from MySQL service):
   ```
   MYSQLHOST = [your mysql internal host]
   MYSQLPORT = 3306
   MYSQLUSER = [your mysql username]
   MYSQLPASSWORD = [your mysql password]
   MYSQLDATABASE = railway
   ```

---

### Step 4: Configure Custom Start Command

Railway might not know how to start your PHP app. Let's fix that:

#### Option A: Using Railway Dashboard (Recommended)

1. Go to your **PHP service**
2. Click **"Settings"** tab
3. Scroll to **"Deploy"** section
4. Find **"Custom Start Command"** field
5. Enter this command:
   ```bash
   apache2-foreground
   ```
   OR if that doesn't work, try:
   ```bash
   php -S 0.0.0.0:$PORT -t .
   ```
6. Click **"Save"** or it saves automatically
7. Click **"Redeploy"** at the top

#### Option B: Using nixpacks.toml (Already done for you)

The `nixpacks.toml` file already contains:
```toml
[start]
cmd = 'apachectl -D FOREGROUND'
```

If the error persists, try editing it to:
```toml
[start]
cmd = 'php -S 0.0.0.0:$PORT -t .'
```

Then push changes to GitHub (Railway auto-redeploys).

---

### Step 5: Wait for Deployment

1. Go to **PHP service** → **"Deployments"** tab
2. Watch the latest deployment progress
3. Check **"Build Logs"** - should show successful build
4. Check **"Deploy Logs"** - should show server starting
5. Wait for status to change to **"Active"** (green)

---

### Step 6: Generate Public Domain

1. In your **PHP service**, go to **"Settings"** tab
2. Scroll to **"Networking"** or **"Domains"** section
3. Click **"Generate Domain"**
4. Railway creates a URL like: `https://dean-faculty-evaluation-ccs-production.up.railway.app`
5. Copy this URL

---

### Step 7: Test Your Deployment

Visit your diagnostic page first:
```
https://your-app.railway.app/test.php
```

This will show:
- ✓ PHP version and extensions
- ✓ Environment variables status
- ✓ Database connection test
- ✓ File system status

**If you see errors on test.php:**
- Red "Database connection failed" → Go back to Step 3 (link services)
- Red "Extensions missing" → Check nixpacks.toml configuration
- Can't load test.php → Check Deploy Logs for PHP errors

---

### Step 8: Initialize Database

Once `test.php` shows successful database connection:

1. Visit: `https://your-app.railway.app/railway-db-init.php`
2. This will:
   - Import all database tables
   - Create admin and faculty accounts
   - Set up sample data
3. Look for **"Database Initialization Complete!"** message
4. **IMPORTANT**: After success, delete `railway-db-init.php` for security

---

### Step 9: Test Login

1. Visit: `https://your-app.railway.app/login.php`
2. Test admin login:
   - Username: `admin`
   - Password: `admin123`
3. If login works → ✅ Success! Your app is running!
4. Go to admin dashboard and **change the admin password immediately**

---

## Part 2: Troubleshooting Common Issues

### Issue: HTTP 500 Error

**Cause**: Application crashes on startup

**Solutions**:
1. Check Deploy Logs in Railway dashboard
2. Look for PHP errors or database connection failures
3. Verify environment variables are set (Step 3)
4. Try changing start command (Step 4)

**Check Deploy Logs:**
```
Railway Dashboard → PHP Service → Deployments → Latest → Deploy Logs
```

Look for errors like:
- `Connection refused` → MySQL not linked (fix Step 3)
- `mysqli extension not loaded` → Check nixpacks.toml has php82Extensions.mysqli
- `Permission denied` → File permission issue

---

### Issue: "Connection failed" on test.php

**Cause**: PHP can't reach MySQL database

**Solution**:
1. Verify MySQL service is "Active" (not sleeping/crashed)
2. Re-link services (repeat Step 3)
3. In MySQL service → "Data" tab → verify database exists
4. Check if MySQL hostname is internal Railway address (not public)

---

### Issue: Blank page or white screen

**Cause**: PHP errors with display_errors disabled

**Solution**:
1. Check Deploy Logs for PHP errors
2. Add to PHP service Variables:
   ```
   PHP_DISPLAY_ERRORS = 1
   PHP_ERROR_REPORTING = E_ALL
   ```
3. Redeploy

---

### Issue: Application loads but can't login

**Cause**: Database not initialized or tables missing

**Solution**:
1. Visit `/test.php` to check database tables
2. If tables missing, run `/railway-db-init.php`
3. Check Deploy Logs for SQL import errors

---

### Issue: Signature uploads fail

**Cause**: No persistent storage configured

**Solution**:
1. Go to PHP service → Settings → Volumes
2. Click **"+ Add Volume"**
3. Set mount path: `/app/signatures`
4. Set size: `1GB`
5. Redeploy

---

## Part 3: Custom Start Commands Explained

Railway needs to know how to run your PHP application. Here are the options:

### Option 1: Apache (Recommended for Production)
```bash
apachectl -D FOREGROUND
```
or
```bash
apache2-foreground
```

**Pros**: Full Apache features, .htaccess support, better performance
**Cons**: More complex, requires Apache to be installed

---

### Option 2: PHP Built-in Server (Simpler)
```bash
php -S 0.0.0.0:$PORT -t .
```

**Pros**: Simple, always works, good for small apps
**Cons**: Not recommended for production, single-threaded

Railway provides `$PORT` automatically - your app listens on this port.

---

### Option 3: Using Docker/Nixpacks (Automatic)

If you don't set a custom start command, Railway uses `nixpacks.toml`:

```toml
[phases.setup]
nixPkgs = ['php82', 'php82Extensions.mysqli', 'php82Extensions.gd', 'apache2']

[start]
cmd = 'apachectl -D FOREGROUND'
```

This is already in your repository!

---

## Part 4: Quick Command Reference

### To Redeploy Manually:
1. PHP Service → Click **"Redeploy"** button at top
2. Or push new commit to GitHub (auto-deploys)

### To View Logs:
```
PHP Service → Deployments → Latest → Deploy Logs
PHP Service → Observability → View Logs (if available)
```

### To Restart Service:
```
PHP Service → Settings → Restart
```

### To Delete and Start Fresh:
1. Delete both services (PHP + MySQL)
2. Create new project
3. Start from Step 1

---

## Part 5: After Successful Deployment

### Security Checklist:
- [ ] Change admin password from `admin123`
- [ ] Delete `/railway-db-init.php`
- [ ] Delete `/test.php` (optional)
- [ ] Review user accounts and remove samples
- [ ] Set up faculty accounts with secure passwords

### Configure Volumes:
- [ ] Add volume for `/app/signatures` (1GB)
- [ ] Verify signature uploads work

### Custom Domain (Optional):
1. PHP Service → Settings → Domains
2. Click **"Custom Domain"**
3. Enter your domain (e.g., `eval.ccs-uphsd.edu.ph`)
4. Add CNAME record in your DNS: `your-domain → railway-provided-cname`
5. Wait for DNS propagation

---

## Part 6: Monitoring Your Application

### Check Application Health:
- Visit `/test.php` periodically to verify:
  - Database connection
  - PHP extensions
  - File system

### Monitor Usage:
- Railway Dashboard → Project → Usage tab
- Watch CPU, Memory, and Database size
- Free tier: $5 credit/month

### Check Logs for Errors:
```
PHP Service → Deployments → Deploy Logs
```
Look for warnings about:
- Session issues
- File upload failures
- Database query errors

---

## Quick Start Summary

**TL;DR - Fastest Path to Success:**

1. ✅ Deploy from GitHub
2. ✅ Add MySQL database  
3. ✅ Link MySQL to PHP service (Service Variables or Connect)
4. ✅ Set custom start command: `apache2-foreground` or `php -S 0.0.0.0:$PORT -t .`
5. ✅ Generate domain
6. ✅ Visit `/test.php` to verify setup
7. ✅ Visit `/railway-db-init.php` to initialize database
8. ✅ Test login at `/login.php`
9. ✅ Change admin password
10. ✅ Delete test/init files

---

## Need Help?

**Check these resources:**
- Railway Logs: Deployment → Deploy Logs tab
- Test page: `https://your-app.railway.app/test.php`
- Railway Docs: https://docs.railway.app
- Railway Discord: https://discord.gg/railway

**Common Commands to Try:**

If your deployment fails, try these start commands in order:

1. `apache2-foreground`
2. `apachectl -D FOREGROUND`  
3. `php -S 0.0.0.0:$PORT -t .`
4. `php -S 0.0.0.0:8080 -t .`

One of these should work!

---

**Your app should now be live at: `https://your-app.railway.app` 🎉**

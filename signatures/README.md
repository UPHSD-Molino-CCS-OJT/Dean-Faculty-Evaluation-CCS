# Signatures Directory

This directory stores uploaded signature images for evaluations.

## Purpose
- Faculty evaluation signatures (uploaded during evaluation submission)
- Dean/Admin signatures (uploaded via admin or faculty signature pages)

## Railway Deployment
For Railway.com deployment, this directory should be mounted as a persistent volume:
- **Mount Path**: `/app/signatures`
- **Recommended Size**: 1GB (adjust based on usage)

## Local Development
This directory is automatically created by the application when needed.
The application sets appropriate permissions (`0777`) for file uploads.

## File Structure
Signatures are stored with hash-based filenames to prevent duplicates:
- Format: `{hash}_{timestamp}.{extension}`
- Example: `abc123def456_1234567890.png`

## Permissions
Ensure this directory is writable by the web server:
```bash
chmod 755 signatures/
```

## .gitignore
Signature files should be excluded from version control.
Only this README and .gitkeep are tracked in git.

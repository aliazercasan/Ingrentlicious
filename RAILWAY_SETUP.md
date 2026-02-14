# Railway Deployment Setup

## Fix CORS and Asset Loading Issues

The CORS errors you're seeing are because the APP_URL doesn't match your Railway domain.

### Option 1: Set Environment Variable in Railway Dashboard (RECOMMENDED)

1. Go to your Railway project dashboard
2. Click on your service
3. Go to the "Variables" tab
4. Find or add `APP_URL` variable
5. Set it to: `https://ingrentlicious.up.railway.app`
6. Click "Deploy" or wait for automatic redeployment

### Option 2: Update and Redeploy

If you want to commit the changes:

1. Run `deploy-railway.bat` to push changes
2. After deployment, run these commands in Railway console:
   ```bash
   php artisan config:clear
   php artisan cache:clear
   php artisan view:clear
   ```

## Important Notes

- The `.env` file is in `.gitignore` so local changes won't be pushed
- Always set environment variables in Railway dashboard for production
- The app already forces HTTPS in production (configured in AppServiceProvider)
- After changing APP_URL, clear all caches

## Verify Deployment

After updating APP_URL, check:
- Assets load correctly (no CORS errors)
- All links use HTTPS
- Login/logout works properly
- Recipe pages load correctly

## Current Configuration

- Domain: `https://ingrentlicious.up.railway.app`
- Environment: `production`
- Database: SQLite
- Session Driver: database

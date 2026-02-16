# Railway Deployment Fix - Asset Loading Issue

## Problem
The app is trying to load assets that don't exist (404 errors on JS/CSS files), indicating a build cache or manifest mismatch.

## Root Cause
Railway is either:
1. Using cached build artifacts from a previous deployment
2. Not properly running the build process
3. Serving assets from the wrong URL

## Solution Steps

### Step 1: Clear All Caches in Railway
In your Railway dashboard:
1. Go to your service
2. Click "Settings" → "Danger Zone"
3. Click "Remove All Volumes" (this clears all cached data)
4. Confirm the action

### Step 2: Verify Environment Variables
Make sure these are set correctly in Railway Variables tab:
```
APP_ENV=production
APP_DEBUG=false
APP_URL=https://ingrentilicious-production.up.railway.app
ASSET_URL=https://ingrentilicious-production.up.railway.app
```

### Step 3: Force a Fresh Deployment
Option A - Via Dashboard:
1. Go to "Deployments" tab
2. Click on the latest deployment
3. Click "Redeploy"

Option B - Via Git (Recommended):
```bash
git add .
git commit -m "Fix asset loading and CORS issues"
git push
```

### Step 4: Verify Build Process
After deployment starts, check the build logs:
1. Go to "Deployments" tab
2. Click on the running deployment
3. Look for these lines in the logs:
   - `npm run build` should complete successfully
   - `vite build` should show "built in XXXms"
   - No errors about missing files

### Step 5: Check the Manifest
After deployment completes, the manifest should be regenerated. You can verify by:
1. Visiting: https://ingrentilicious-production.up.railway.app/build/manifest.json
2. The file should exist and show current asset hashes

## What I Changed

### 1. nixpacks.toml
Added cache clearing commands before caching to ensure fresh builds:
```toml
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

### 2. AppServiceProvider.php
Added force root URL to ensure assets use the correct domain:
```php
\Illuminate\Support\Facades\URL::forceRootUrl($appUrl);
```

### 3. CORS Configuration
- Updated HandleCors middleware
- Added CORS headers to .htaccess
- Registered middleware in bootstrap/app.php

## Troubleshooting

### If assets still don't load:
1. Check if `public/build/` directory exists in deployment
2. Verify `public/build/manifest.json` is present
3. Check Railway logs for build errors

### If CORS errors persist:
1. Clear browser cache (Ctrl+Shift+Delete)
2. Try incognito/private browsing mode
3. Check browser console for exact error message

### If nothing works:
1. Delete the service in Railway
2. Create a new service
3. Connect your GitHub repo
4. Set environment variables
5. Deploy fresh

## Railway CLI Commands (Alternative)
If you have Railway CLI installed:
```bash
# Login
railway login

# Link to your project
railway link

# Set variables
railway variables set APP_URL=https://ingrentilicious-production.up.railway.app
railway variables set ASSET_URL=https://ingrentilicious-production.up.railway.app

# Trigger deployment
railway up

# View logs
railway logs
```

## Expected Result
After following these steps:
- ✅ No CORS errors in browser console
- ✅ All CSS and JS files load successfully
- ✅ Page renders correctly with styling
- ✅ No 404 errors for assets

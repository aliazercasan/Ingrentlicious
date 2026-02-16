# Fix Railway CORS Issue

## Problem
Your Railway deployment is showing a CORS error because the app cannot load resources due to missing CORS headers.

## What I Fixed

### 1. CORS Middleware (app/Http/Middleware/HandleCors.php)
Added proper CORS headers to allow cross-origin requests.

### 2. Bootstrap Configuration (bootstrap/app.php)
Registered the CORS middleware to run on all web requests.

### 3. .htaccess (public/.htaccess)
Added CORS headers at the Apache level for static assets.

## What You Need to Do in Railway

### Step 1: Update Environment Variable
1. Go to your Railway project: https://railway.app/project/[your-project-id]
2. Click on your service
3. Go to the "Variables" tab
4. Find `APP_URL` and update it to:
   ```
   APP_URL=https://ingrentilicious-production.up.railway.app
   ```
   (Note: Use the exact domain shown in your browser error)

### Step 2: Redeploy
After updating the environment variable, Railway will automatically redeploy. If not:
1. Go to the "Deployments" tab
2. Click "Deploy" or trigger a new deployment

### Step 3: Clear Cache (Optional)
If the issue persists after deployment, you may need to clear Laravel's cache:
1. In Railway, go to your service
2. Click on "Settings" → "Deploy"
3. Add a deploy command or run these commands via Railway CLI:
   ```bash
   php artisan config:clear
   php artisan cache:clear
   php artisan view:clear
   ```

## Verification
After deployment, visit your Railway URL and check:
- The page loads without CORS errors
- Browser console shows no red errors
- All assets (CSS, JS) load properly

## Alternative: Use Railway CLI
If you have Railway CLI installed:
```bash
railway variables --set APP_URL=https://ingrentilicious-production.up.railway.app
railway up
```

## Notes
- The CORS middleware now allows all origins (`*`). For production, you may want to restrict this to your specific domain.
- Make sure your Railway deployment is using the latest code from your repository.

# Complete Railway Setup Guide

## Current Issue
URLs are changing from `https://ingrentilicious-production.up.railway.app/` to `https://ingrentilicious.up.railway.app/recipes`

## Root Cause
Railway environment variables are not set correctly, causing Laravel to generate URLs with the wrong domain.

## COMPLETE FIX - Follow ALL Steps

### Step 1: Set Railway Environment Variables

Go to Railway Dashboard → Your Service → Variables Tab

**DELETE these if they exist:**
- Any variable with `ingrentilicious.up.railway.app` (without -production)

**SET these variables (copy exactly):**

```
APP_NAME=Ingrentlicious
APP_ENV=production
APP_DEBUG=false
APP_URL=https://ingrentilicious-production.up.railway.app
ASSET_URL=https://ingrentilicious-production.up.railway.app

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=.ingrentilicious-production.up.railway.app
SESSION_SECURE_COOKIE=true
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=lax

DB_CONNECTION=sqlite

CACHE_STORE=database
QUEUE_CONNECTION=database

LOG_CHANNEL=stack
LOG_LEVEL=error
```

### Step 2: Clear Railway Cache

In Railway Dashboard:
1. Go to Settings → Danger Zone
2. Click "Remove All Volumes"
3. Confirm

### Step 3: Force Redeploy

Option A - Via Dashboard:
1. Go to Deployments tab
2. Click "Redeploy" on latest deployment

Option B - Via Git (Recommended):
```bash
git commit --allow-empty -m "Force Railway redeploy"
git push
```

### Step 4: Verify Deployment

After deployment completes:

1. Check deployment logs for errors
2. Look for these success messages:
   - "npm run build" completed
   - "vite build" completed
   - Migrations ran successfully
   - Server started on port 8000

### Step 5: Test the Application

1. Visit: `https://ingrentilicious-production.up.railway.app/`
2. Click "Recipes" - URL should stay as `https://ingrentilicious-production.up.railway.app/recipes`
3. Click "Login" - URL should be `https://ingrentilicious-production.up.railway.app/login`
4. Click "Get Started" - URL should be `https://ingrentilicious-production.up.railway.app/register`

### Step 6: Clear Browser Cache

If URLs still wrong:
1. Press Ctrl+Shift+Delete
2. Clear cached images and files
3. Clear cookies
4. Close and reopen browser
5. Try again in incognito/private mode

## Alternative: Use Railway CLI

If you have Railway CLI installed:

```bash
# Login
railway login

# Link to project
railway link

# Set all variables at once
railway variables set APP_URL=https://ingrentilicious-production.up.railway.app
railway variables set ASSET_URL=https://ingrentilicious-production.up.railway.app
railway variables set SESSION_DOMAIN=.ingrentilicious-production.up.railway.app
railway variables set SESSION_SECURE_COOKIE=true
railway variables set SESSION_SAME_SITE=lax

# Trigger deployment
railway up

# Watch logs
railway logs
```

## Troubleshooting

### If URLs still change domains:

1. Check Railway logs for the actual APP_URL being used:
   ```
   railway logs | grep APP_URL
   ```

2. Verify environment variables are set:
   - Go to Railway Dashboard → Variables
   - Confirm APP_URL shows: `https://ingrentilicious-production.up.railway.app`

3. Check if there's a custom domain configured:
   - Go to Railway Dashboard → Settings
   - Check "Domains" section
   - Make sure you're using the Railway-provided domain

### If login/register still shows "Not Found":

1. Check if Fortify is installed:
   ```bash
   composer show | grep fortify
   ```

2. Verify routes are registered:
   - Check Railway logs for route registration
   - Look for "Route [login] not defined" errors

3. Clear all caches again:
   - In Railway, remove volumes
   - Redeploy

## Expected Result

After following all steps:
- ✅ All URLs use `https://ingrentilicious-production.up.railway.app`
- ✅ Clicking any link stays on the correct domain
- ✅ Login/register pages load correctly
- ✅ No CORS errors
- ✅ All assets (CSS/JS) load properly
- ✅ Sessions work correctly

## Still Not Working?

If after following ALL steps above it still doesn't work:

1. Take a screenshot of:
   - Railway Variables tab
   - Railway deployment logs (last 50 lines)
   - Browser console errors (F12 → Console)
   - The exact URL that appears when you click a button

2. Check if Railway assigned a different domain:
   - Go to Railway Dashboard → Settings → Domains
   - Copy the EXACT domain shown there
   - Use that domain in APP_URL variable

3. Verify your Railway service is actually deployed:
   - Check Deployments tab
   - Latest deployment should show "Success" status
   - Click on it to see full logs

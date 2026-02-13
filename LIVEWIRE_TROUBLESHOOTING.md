# Livewire Troubleshooting Guide for Railway

## Quick Fixes Applied

### ✅ What We Fixed:

1. **Added Livewire Configuration** (`config/livewire.php`)
   - Proper asset URL handling
   - Production-ready settings

2. **Updated Build Process** (`nixpacks.toml`)
   - Added config, route, and view caching
   - Auto-run migrations on startup

3. **Fixed HTTPS Issues** (`AppServiceProvider.php`)
   - Force HTTPS in production
   - Ensures Livewire works with Railway's SSL

4. **Created Fix Scripts**
   - `fix-railway-deployment.bat` (Windows)
   - `fix-railway-deployment.sh` (Linux/Mac)

## Common Livewire Issues on Railway

### 🔴 Issue 1: Components Not Updating

**Symptoms:**
- Clicking buttons does nothing
- Forms don't submit
- No real-time updates

**Causes:**
- JavaScript not loading
- CSRF token issues
- Mixed content (HTTP/HTTPS)

**Solutions:**

1. **Check Browser Console** (F12):
   ```
   Look for errors like:
   - "Mixed Content"
   - "CSRF token mismatch"
   - "Livewire not defined"
   ```

2. **Verify Environment Variables on Railway**:
   ```
   APP_URL=https://ingrentlicious-production.up.railway.app
   APP_ENV=production
   APP_DEBUG=false
   ```

3. **Clear All Caches**:
   ```bash
   # Run locally then push
   php artisan config:clear
   php artisan route:clear
   php artisan view:clear
   php artisan cache:clear
   ```

### 🔴 Issue 2: 404 on Livewire Requests

**Symptoms:**
- Network tab shows 404 for `/livewire/update`
- Components load but don't update

**Solutions:**

1. **Check Route Caching**:
   ```bash
   # In Railway shell or locally
   php artisan route:clear
   php artisan route:cache
   ```

2. **Verify Livewire is Installed**:
   ```bash
   composer show livewire/livewire
   ```

3. **Check Middleware**:
   - Ensure `web` middleware is applied
   - Check `config/livewire.php` has `'middleware_group' => 'web'`

### 🔴 Issue 3: CSRF Token Mismatch

**Symptoms:**
- "CSRF token mismatch" error
- Forms fail to submit
- Session expires quickly

**Solutions:**

1. **Check Session Configuration**:
   ```env
   SESSION_DRIVER=database
   SESSION_DOMAIN=null
   SESSION_SECURE_COOKIE=true
   ```

2. **Verify Database Sessions Table Exists**:
   ```bash
   php artisan migrate --force
   ```

3. **Clear Browser Cookies**:
   - Open DevTools (F12)
   - Application → Cookies → Clear all

### 🔴 Issue 4: Assets Not Loading

**Symptoms:**
- Styles missing
- JavaScript errors
- Livewire scripts not found

**Solutions:**

1. **Rebuild Assets**:
   ```bash
   npm run build
   ```

2. **Check Asset URLs**:
   - Open browser DevTools → Network tab
   - Look for 404s on CSS/JS files
   - Verify `APP_URL` is correct

3. **Verify Build Output**:
   ```bash
   # Check if files exist
   ls -la public/build
   ```

### 🔴 Issue 5: Database Issues

**Symptoms:**
- "Database not found"
- "Table doesn't exist"
- Data not persisting

**Solutions:**

1. **Check Database File**:
   ```bash
   # In Railway shell
   ls -la database/database.sqlite
   ```

2. **Run Migrations**:
   ```bash
   php artisan migrate:fresh --force --seed
   ```

3. **Check Permissions**:
   ```bash
   chmod 664 database/database.sqlite
   chmod 775 database
   ```

## Step-by-Step Deployment Process

### Before Pushing to Railway:

1. **Run the fix script**:
   ```bash
   # Windows
   fix-railway-deployment.bat
   
   # Linux/Mac
   bash fix-railway-deployment.sh
   ```

2. **Test locally**:
   ```bash
   php artisan serve
   # Visit http://localhost:8000
   # Test all Livewire components
   ```

3. **Commit changes**:
   ```bash
   git add .
   git commit -m "Fix Railway deployment issues"
   git push
   ```

### After Deployment:

1. **Check Railway Logs**:
   - Go to Railway dashboard
   - Click your service
   - View deployment logs
   - Look for errors

2. **Test Live Site**:
   - Visit your Railway URL
   - Open browser console (F12)
   - Test each Livewire component:
     - Create recipe
     - Edit recipe
     - Delete recipe
     - View recipes

3. **Monitor Performance**:
   - Check response times
   - Verify database queries
   - Test under load

## Emergency Debugging

If nothing works, enable debug mode temporarily:

1. **In Railway Dashboard**:
   - Go to Variables
   - Set `APP_DEBUG=true`
   - Redeploy

2. **Check Error Messages**:
   - Visit your site
   - Read full error messages
   - Check stack traces

3. **Disable Debug**:
   - Set `APP_DEBUG=false`
   - Redeploy immediately

## Railway-Specific Commands

### Access Railway Shell:
```bash
# Install Railway CLI
npm i -g @railway/cli

# Login
railway login

# Link to project
railway link

# Open shell
railway run bash
```

### Run Commands in Railway:
```bash
# Clear caches
railway run php artisan cache:clear

# Run migrations
railway run php artisan migrate --force

# Check logs
railway logs
```

## Performance Optimization

After fixing issues:

1. **Enable OPcache** (usually automatic)
2. **Use Database Sessions** (already configured)
3. **Cache Everything**:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

## Still Having Issues?

### Check These Files:

1. **config/livewire.php** - Livewire configuration
2. **nixpacks.toml** - Build configuration
3. **app/Providers/AppServiceProvider.php** - HTTPS forcing
4. **.env** - Environment variables

### Get Help:

1. **Railway Logs**: Most errors show here
2. **Browser Console**: JavaScript errors
3. **Laravel Logs**: `storage/logs/laravel.log`
4. **Network Tab**: Failed requests

### Common Error Messages:

| Error | Solution |
|-------|----------|
| "Route not defined" | Clear route cache |
| "Class not found" | Run `composer dump-autoload` |
| "CSRF token mismatch" | Check session configuration |
| "Livewire not defined" | Rebuild assets |
| "Mixed content" | Force HTTPS in AppServiceProvider |

## Testing Checklist

- [ ] Homepage loads
- [ ] Can register/login
- [ ] Can create recipe
- [ ] Can edit recipe
- [ ] Can delete recipe
- [ ] Can view recipes
- [ ] Real-time updates work
- [ ] No console errors
- [ ] No network errors
- [ ] Sessions persist
- [ ] CSRF tokens work

## Success Indicators

✅ No errors in browser console
✅ No 404s in Network tab
✅ Livewire components update in real-time
✅ Forms submit successfully
✅ Data persists in database
✅ Sessions work correctly
✅ HTTPS everywhere

---

**Need more help?** Check the main deployment guide: `RAILWAY_DEPLOYMENT_FIX.md`

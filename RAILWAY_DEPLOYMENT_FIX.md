# Railway Deployment Fixes

## Issues Found and Fixed

### 1. Missing Route Cache
**Problem**: Routes not being cached in production, causing performance issues and potential route resolution problems.

**Fix**: Updated `nixpacks.toml` to cache routes, config, and views during build.

### 2. HTTPS/URL Issues
**Problem**: Livewire requires proper HTTPS URLs in production to work correctly.

**Fix**: Added `URL::forceScheme('https')` in `AppServiceProvider.php` for production environment.

### 3. Database Migrations
**Problem**: Database might not be migrated on deployment.

**Fix**: Added `php artisan migrate --force` to the start command.

## Deployment Checklist

### On Railway Dashboard:

1. **Environment Variables** - Ensure these are set:
   ```
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://your-app.up.railway.app
   SESSION_DRIVER=database
   CACHE_STORE=database
   QUEUE_CONNECTION=database
   ```

2. **Database Setup**:
   - Railway should automatically create `database.sqlite`
   - Migrations will run on startup

3. **Clear Caches** (if already deployed):
   - In Railway, go to your service
   - Click "Deploy" → "Redeploy"
   - Or run these commands in Railway shell:
     ```bash
     php artisan config:clear
     php artisan route:clear
     php artisan view:clear
     php artisan cache:clear
     ```

### Common Livewire Issues on Railway:

#### Issue: Livewire components not updating
**Causes**:
- Mixed content (HTTP/HTTPS)
- CSRF token issues
- Asset URL problems

**Solutions**:
1. Ensure `APP_URL` matches your Railway URL exactly
2. Clear browser cache and cookies
3. Check browser console for JavaScript errors

#### Issue: 404 on Livewire requests
**Causes**:
- Route caching issues
- Missing Livewire routes

**Solutions**:
1. Redeploy to rebuild caches
2. Check that Livewire is properly installed

#### Issue: CSRF token mismatch
**Causes**:
- Session driver issues
- Cookie domain problems

**Solutions**:
1. Use `SESSION_DRIVER=database` (already set)
2. Ensure `SESSION_DOMAIN=null` in .env

## Testing After Deployment

1. **Test Authentication**:
   - Register a new account
   - Login/Logout
   - Password reset

2. **Test Livewire Components**:
   - Create a recipe
   - Edit a recipe
   - Delete a recipe
   - Check real-time updates

3. **Check Browser Console**:
   - Open DevTools (F12)
   - Look for any JavaScript errors
   - Check Network tab for failed requests

## If Issues Persist

### Enable Debug Mode Temporarily:
1. Set `APP_DEBUG=true` in Railway environment variables
2. Redeploy
3. Check error messages
4. **IMPORTANT**: Set back to `false` after debugging

### Check Railway Logs:
```bash
# In Railway dashboard
Go to your service → Deployments → Click latest deployment → View logs
```

### Common Error Messages:

**"Livewire component not found"**
- Run: `php artisan livewire:discover`
- Redeploy

**"Class not found"**
- Run: `composer dump-autoload`
- Redeploy

**"Route not defined"**
- Check `routes/web.php` for missing routes
- Clear route cache

## Performance Optimization

After fixing issues, optimize for production:

1. **Enable OPcache** (usually enabled by default on Railway)
2. **Use CDN for assets** (optional)
3. **Enable compression** (Railway handles this)

## Need More Help?

Check Railway logs for specific error messages and search for the error in Laravel/Livewire documentation.

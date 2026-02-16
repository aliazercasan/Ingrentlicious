# FIX: URL Changes from -production to non-production

## THE PROBLEM
When you click buttons on https://ingrentilicious-production.up.railway.app/
The URL changes to: https://ingrentilicious.up.railway.app/recipes (WRONG!)

This happens because Laravel is using the wrong APP_URL from environment variables.

## THE SOLUTION

### Go to Railway Dashboard NOW:

1. Open: https://railway.app/
2. Select your "Ingrentlicious" project
3. Click on your service
4. Click "Variables" tab
5. Find `APP_URL` variable
6. Change it from:
   ```
   https://ingrentlicious.up.railway.app
   ```
   
   TO:
   ```
   https://ingrentilicious-production.up.railway.app
   ```

7. Also add/update these variables:
   ```
   ASSET_URL=https://ingrentilicious-production.up.railway.app
   SESSION_DOMAIN=.ingrentilicious-production.up.railway.app
   ```

8. Click "Deploy" or wait for automatic redeployment

## VERIFY THE FIX

After deployment completes:
1. Visit: https://ingrentilicious-production.up.railway.app/
2. Click "Recipes" button
3. URL should stay as: https://ingrentilicious-production.up.railway.app/recipes
4. Click "Login" button  
5. URL should be: https://ingrentilicious-production.up.railway.app/login

## WHY THIS HAPPENS

Laravel uses the `APP_URL` environment variable to generate all URLs in your application.
If `APP_URL` is set to the wrong domain, all generated links will use that wrong domain.

Railway gives you a domain like: `ingrentilicious-production.up.railway.app`
But your `APP_URL` was set to: `ingrentilicious.up.railway.app` (missing -production)

So every link Laravel generates uses the wrong domain.

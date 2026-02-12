# MySQL Setup Guide for Hosting

## Step 1: Update .env with Your MySQL Credentials

Replace these values in your `.env` file with your actual hosting MySQL credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1          # Replace with your MySQL host (from hosting panel)
DB_PORT=3306               # Usually 3306
DB_DATABASE=laravel        # Replace with your database name
DB_USERNAME=root           # Replace with your MySQL username
DB_PASSWORD=               # Add your MySQL password
```

## Step 2: Create the Database

If your hosting provider doesn't auto-create the database, create it manually:
- Log into your hosting control panel (cPanel, Plesk, etc.)
- Go to MySQL Databases
- Create a new database (e.g., `ingrentlicious_db`)
- Create a MySQL user and grant all privileges to that database

## Step 3: Run Migrations

Once your database credentials are set, run:

```bash
php artisan migrate
```

This will create all the necessary tables (users, recipes, ingredients, etc.)

## Step 4: Seed Dummy Data

To populate your database with sample recipes:

```bash
php artisan db:seed
```

This will create:
- 8 users (including Chef Maria)
- 15+ recipes with ingredients
- Sample data for testing

## Step 5: Clear Config Cache

After updating .env, clear the config cache:

```bash
php artisan config:clear
php artisan cache:clear
```

## Troubleshooting

### Connection Refused Error
- Check if MySQL service is running
- Verify host, port, username, and password are correct
- Ensure your IP is whitelisted (for remote databases)

### Access Denied Error
- Double-check username and password
- Verify the user has privileges on the database
- Check if the database exists

### Table Not Found Error
- Run migrations: `php artisan migrate`
- Check if migrations completed successfully

## For Production Deployment

Don't forget to:
1. Set `APP_ENV=production`
2. Set `APP_DEBUG=false`
3. Generate a new `APP_KEY` if not set: `php artisan key:generate`
4. Run `php artisan config:cache` for better performance
5. Run `php artisan route:cache`
6. Run `php artisan view:cache`

# Restore Original Database Structure

This guide will help you restore your database to its original structure.

## Option 1: Using the Batch Script (Windows)

1. Run the batch script:
   ```
   restore-original-db.bat
   ```

2. This will:
   - Drop all existing tables
   - Run the original migrations
   - Create an admin user

## Option 2: Manual Restoration

1. Wipe the database:
   ```
   php artisan db:wipe
   ```

2. Run the original migrations:
   ```
   php artisan migrate --path=database/migrations/2023_07_17_000000_recreate_original_users_table.php
   php artisan migrate --path=database/migrations/2023_07_17_000001_recreate_original_books_table.php
   php artisan migrate --path=database/migrations/2023_07_17_000002_recreate_original_members_table.php
   php artisan migrate --path=database/migrations/2023_07_17_000003_recreate_original_borrowings_table.php
   php artisan migrate --path=database/migrations/2023_07_17_000004_recreate_original_reservations_table.php
   ```

3. Create an admin user:
   ```
   php artisan db:seed --class=AdminUserSeeder
   ```

## Important Note

This process will restore the original database structure but **will not restore your data**. You will need to re-enter your data manually.

## Admin Login

After restoration, you can log in with:
- Email: admin@library.com
- Password: password
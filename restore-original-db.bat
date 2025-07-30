@echo off
echo Restoring original database structure...

echo Dropping all tables...
php artisan db:wipe

echo Running original migrations...
php artisan migrate --path=database/migrations/2023_07_17_000000_recreate_original_users_table.php
php artisan migrate --path=database/migrations/2023_07_17_000001_recreate_original_books_table.php
php artisan migrate --path=database/migrations/2023_07_17_000002_recreate_original_members_table.php
php artisan migrate --path=database/migrations/2023_07_17_000003_recreate_original_borrowings_table.php
php artisan migrate --path=database/migrations/2023_07_17_000004_recreate_original_reservations_table.php

echo Creating admin user...
php artisan db:seed --class=AdminUserSeeder

echo Database structure has been restored to original state.
echo You will need to re-enter your data manually.
pause
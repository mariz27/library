@echo off
echo Applying member table migrations...

php artisan migrate --path=database/migrations/2023_07_24_000002_modify_members_table.php
php artisan migrate --path=database/migrations/2023_07_24_000003_add_member_id_to_members_table.php
php artisan migrate --path=database/migrations/2023_07_24_000004_add_profile_picture_to_members_table.php

echo Migrations completed.
echo The members table has been updated with all required fields.
pause
@echo off
echo Fixing borrowings table structure...

php artisan migrate --path=database/migrations/2023_07_24_000008_fix_borrowings_table_structure.php

echo Migration completed.
echo The borrowings table has been updated with all required columns.
pause
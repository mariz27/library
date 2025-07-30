@echo off
echo Fixing borrow_date issue in borrowings table...

php artisan migrate --path=database/migrations/2023_07_24_000009_fix_borrow_date_issue.php

echo Migration completed.
echo The borrow_date column has been fixed.
pause
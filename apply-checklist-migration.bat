@echo off
echo Applying books table checklist migration...

php artisan migrate --path=database/migrations/2023_07_18_000000_modify_books_table_for_checklist.php

echo Migration completed.
echo You can now use the new book checklist functionality.
pause
@echo off
echo Updating member roles...

php artisan migrate --path=database/migrations/2023_07_25_000001_update_member_roles.php

echo Migration completed.
echo Member roles have been updated to librarian, chairperson, and professor.
pause
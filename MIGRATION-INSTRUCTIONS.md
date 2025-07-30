# Migration Instructions

To set up your database with all necessary tables and sample data, run:

```
php artisan db:reset
```

This command will:
1. Reset the database (migrate:fresh)
2. Seed it with sample data
3. Display login credentials

Alternatively, you can run these commands separately:

```
php artisan migrate
php artisan db:seed
```

## Login Credentials

### Admin User
- Email: admin@library.com
- Password: password

### Sample Members
- Student: student@example.com / password
- Faculty: faculty@example.com / password
- Staff: staff@example.com / password

## Database Structure

The system includes the following tables:

1. **users** - Admin users who manage the system
2. **members** - Library members (students, faculty, staff)
3. **books** - Library books with processing checklist
4. **borrowings** - Book borrowing records
5. **reservations** - Book reservation records

## Book Processing Checklist

The books table includes fields for tracking the processing workflow:

- Title, Accession No., Call No., Supplier, Quantity
- Processing steps with timestamps:
  - Date Received from Property
  - Date Collated
  - Date Stamped
  - Date Accessioned
  - Date Catalogued
  - Date Labeled
  - Tagging
  - Book Pocket
  - Book Card
  - Collation & Due Slip
  - Cover
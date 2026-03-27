# Business Listing & Rating System

A complete business directory with CRUD operations and rating functionality built with Core PHP, MySQL, jQuery, Bootstrap, and Raty plugin.

## MySQL Workbench Setup

### Step 1: Open MySQL Workbench
Launch MySQL Workbench on your computer.

### Step 2: Connect to Local Server
Connect to your local MySQL server (usually `localhost:3306`).

### Step 3: Open database.sql
- Click `File` → `Open SQL Script`
- Select the `database.sql` file from this project

### Step 4: Execute the Script
- Click the ⚡ (Execute) icon in the toolbar
- Or press `Ctrl+Shift+Enter`

### Step 5: Verify Database Creation
- Refresh the Schemas panel
- You should see `business_rating_system` database
- Expand it to see `businesses` and `ratings` tables with sample data

## Configuration

Edit `config/Database.php` if your MySQL credentials differ:

```php
private $host = 'localhost';
private $username = 'root';
private $password = '';  // Change if you have a password
private $database = 'business_rating_system';
```

## Running the Application

### Option 1: Using PHP Built-in Server
```bash
php -S localhost:8000
```
Then open: http://localhost:8000

### Option 2: Using XAMPP/WAMP
- Place project folder in `htdocs` or `www` directory
- Access via: http://localhost/your-project-folder

## Features

✅ Complete CRUD operations for businesses (Add, Edit, Delete)
✅ Bootstrap 5 modals for all operations
✅ jQuery & AJAX (no page refresh)
✅ Raty jQuery plugin for star ratings (https://github.com/wbotelhos/raty)
✅ Half-star support (0.5 increments, scale 0-5)
✅ Real-time table updates without refresh
✅ Rating update logic (same email/phone updates existing rating)
✅ Average rating calculation with LEFT JOIN + AVG()
✅ Clickable ratings to open rating modal
✅ SQL injection protection with prepared statements
✅ MVC architecture
✅ Font Awesome icons for stars

## MVC Project Structure

```
├── index.php                      # Main entry point
├── routes.php                     # Router - handles all API requests
├── database.sql                   # MySQL Workbench setup file
├── config/
│   └── Database.php              # Database connection class
├── models/
│   ├── Business.php              # Business model (CRUD)
│   └── Rating.php                # Rating model
├── controllers/
│   ├── BusinessController.php    # Business logic controller
│   └── RatingController.php      # Rating logic controller
├── views/
│   └── index.view.php            # Main view template (Bootstrap)
├── assets/
│   ├── css/
│   │   └── style.css             # Custom styling
│   ├── js/
│   │   └── script.js             # jQuery & AJAX logic
│   └── plugins/
│       └── raty/                 # Raty plugin files
└── README.md                      # This file
```

## Database Schema

### businesses table
- `id` - Primary key (AUTO_INCREMENT)
- `name` - Business name (VARCHAR 255, NOT NULL)
- `address` - Business address (TEXT)
- `phone` - Contact phone (VARCHAR 20)
- `email` - Contact email (VARCHAR 255)
- `created_at` - Timestamp (DEFAULT CURRENT_TIMESTAMP)

### ratings table
- `id` - Primary key (AUTO_INCREMENT)
- `business_id` - Foreign key to businesses (ON DELETE CASCADE)
- `name` - Reviewer name (VARCHAR 255)
- `email` - Reviewer email (VARCHAR 255)
- `phone` - Reviewer phone (VARCHAR 20)
- `rating` - Rating value (DECIMAL 2,1) - supports 0.5 increments
- `created_at` - Timestamp (DEFAULT CURRENT_TIMESTAMP)

## API Endpoints (routes.php)

### GET Requests
- `routes.php?action=businesses` - Get all businesses with average ratings
- `routes.php?action=business&id={id}` - Get single business details
- `routes.php?action=ratings&business_id={id}` - Get ratings for a business

### POST Requests
- `routes.php?action=add_business` - Add new business
- `routes.php?action=update_business` - Update existing business
- `routes.php?action=delete_business` - Delete business
- `routes.php?action=submit_rating` - Submit or update rating

## How It Works

### Business CRUD
1. **Add**: Click "Add Business" → Fill form → Submit via AJAX → Table updates
2. **Edit**: Click "Edit" → Modal pre-fills data → Update via AJAX → Table refreshes
3. **Delete**: Click "Delete" → Confirm → Delete via AJAX → Row fades out

### Rating System
1. Click on any star rating in the table
2. Modal opens with Raty plugin (half-star support)
3. Fill name, email/phone, select rating
4. Submit via AJAX
5. If email/phone exists → UPDATE rating
6. If new user → INSERT rating
7. Average recalculated and table updates instantly

## Technology Stack

- **Backend**: Core PHP (MVC Architecture)
- **Database**: MySQL with MySQLi (prepared statements)
- **Frontend**: Bootstrap 5
- **JavaScript**: jQuery 3.6
- **Rating Plugin**: Raty jQuery Plugin
- **Icons**: Font Awesome 6
- **AJAX**: All operations without page refresh

## Business CRUD Operations

### Add Business
- Click "Add Business" button
- Bootstrap modal opens
- Fill form fields (name required)
- Submit via AJAX
- Table updates dynamically
- No page refresh

### Edit Business
- Click "Edit" button on any business row
- Modal opens with pre-filled data
- Modify fields
- Submit via AJAX
- Table updates dynamically
- No page refresh

### Delete Business
- Click "Delete" button
- Confirmation dialog appears
- Delete via AJAX
- Row fades out and removes
- Ratings cascade delete automatically
- No page refresh

## Rating System

### Display
- Last column shows average rating using Raty plugin (read-only)
- Half-star support enabled
- Click on rating stars to open rating modal

### Submit Rating
- Modal opens with Raty plugin (interactive)
- Fill: Name (required), Email, Phone
- Select rating (0-5 with 0.5 increments)
- Submit via AJAX

### Rating Logic
- If email OR phone exists for that business → UPDATE existing rating
- If new user → INSERT new rating
- Average recalculated automatically
- Table updates instantly without refresh

## Security Features

- Prepared statements for all SQL queries
- XSS prevention with HTML escaping
- Input validation and sanitization
- Foreign key constraints with CASCADE delete

## Testing

The database includes 3 sample businesses and 5 sample ratings for immediate testing.

## Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx) or PHP built-in server
- MySQL Workbench (for database setup)
- Modern web browser with JavaScript enabled

## Troubleshooting

**Database connection error:**
- Check credentials in `config/Database.php`
- Ensure MySQL server is running
- Verify database was created via MySQL Workbench

**Raty plugin not working:**
- Check browser console for JavaScript errors
- Ensure jQuery loads before Raty plugin
- Verify plugin files exist in `assets/plugins/raty/`

**AJAX errors:**
- Check PHP error logs
- Verify routes.php is accessible
- Check browser network tab for failed requests

# Vanishing India 

A full-stack PHP/MySQL website replicating the Vanishing India cultural heritage platform.

## Tech Stack
- **Frontend**: HTML5, CSS3 (custom properties, animations), Vanilla JavaScript
- **Backend**: PHP 8.0+
- **Database**: MySQL 5.7+ / MariaDB 10.3+
- **Fonts**: Google Fonts (Cinzel Decorative, Cinzel, EB Garamond)

## Directory Structure
```
vanishing-india/
├── index.php                  ← Homepage
├── database.sql               ← DB schema & seed data
├── includes/
│   ├── config.php             ← DB config & helper functions
│   ├── header.php             ← Navigation header
│   └── footer.php             ← Stats footer
├── pages/
│   ├── about.php
│   ├── cultures.php
│   ├── festival-calendar.php
│   ├── support-communities.php
│   ├── contribute.php
│   └── tradition.php          ← Individual tradition detail
├── ajax/
│   └── newsletter.php         ← Newsletter subscription endpoint
└── assets/
    ├── css/style.css
    ├── js/main.js
    └── images/
        ├── favicon.svg
        └── (add your own tradition images here)
```

## Setup Instructions

### 1. Place files on your server
Copy the `vanishing-india/` folder to your web server's document root (e.g., `/var/www/html/` or `htdocs/`).

### 2. Create the database
```bash
mysql -u root -p < database.sql
```
Or import `database.sql` via phpMyAdmin.

### 3. Configure database connection
Edit `includes/config.php` and update:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'your_mysql_username');
define('DB_PASS', 'your_mysql_password');
define('DB_NAME', 'vanishing_india');
define('SITE_URL', 'http://yourdomain.com/vanishing-india');
```

### 4. Add images (optional)
Place tradition images in `assets/images/` and update the `image_url` column in the `traditions` table.

### 5. Visit the site
Open `http://localhost/vanishing-india/` in your browser.

## Features
- ✅ Responsive design (mobile, tablet, desktop)
- ✅ Interactive SVG India map with state hover
- ✅ Animated hero with particle effects and puppet SVG
- ✅ Dynamic culture cards from database
- ✅ Filter by category on Cultures page
- ✅ Festival Calendar grouped by month
- ✅ Community stories from database
- ✅ Contribute/Contact form with DB saving
- ✅ Newsletter subscription (AJAX)
- ✅ Smooth scroll-triggered animations
- ✅ Mobile hamburger menu
- ✅ Graceful DB fallback (works without DB configured)

## Adding Content
All content is managed through the MySQL database. Use phpMyAdmin or the MySQL CLI:
```sql
USE vanishing_india;

-- Add a tradition
INSERT INTO traditions (title, region, state, category, short_desc, full_desc, image_url, is_featured)
VALUES ('Pattachitra', 'Odisha', 'Odisha', 'folk_arts', 'Ancient scroll painting tradition', 'Full description...', 'assets/images/pattachitra.jpg', 0);

-- Add a festival
INSERT INTO festivals (name, state, month, description)
VALUES ('Rath Yatra', 'Odisha', 6, 'The grand chariot festival of Lord Jagannath in Puri.');
```

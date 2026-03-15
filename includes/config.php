<?php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');         // Change to your MySQL username
define('DB_PASS', '');             // Change to your MySQL password
define('DB_NAME', 'vanishing_india');
define('DB_CHARSET', 'utf8mb4');

// Site Configuration
define('SITE_NAME', 'Vanishing India');
define('SITE_URL', 'http://localhost/vanishing-india'); // Change to your domain
define('SITE_DESCRIPTION', 'Exploring the Lost Traditions of India');

// Create PDO connection
function getDB() {
    static $pdo = null;
    if ($pdo === null) {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            // Graceful fallback - return null if DB not available
            return null;
        }
    }
    return $pdo;
}

// Helper: Get traditions from DB or return static data
function getTraditions($limit = null, $featured = false) {
    $db = getDB();
    if ($db) {
        $sql = "SELECT * FROM traditions";
        if ($featured) $sql .= " WHERE is_featured = 1";
        $sql .= " ORDER BY created_at DESC";
        if ($limit) $sql .= " LIMIT " . (int)$limit;
        $stmt = $db->query($sql);
        return $stmt->fetchAll();
    }
    // Static fallback data
    return [
        ['id'=>1,'title'=>'Kathputli Puppetry','region'=>'Rajasthan','state'=>'Rajasthan','category'=>'folk_arts','short_desc'=>'The Dying Art of Rajasthan','image_url'=>'assets/images/kathputli.jpg','is_featured'=>1],
        ['id'=>2,'title'=>'Sacred Rituals','region'=>'Himachal Pradesh','state'=>'Himachal Pradesh','category'=>'rituals','short_desc'=>'Ancient Pooja of the Himalayas','image_url'=>'assets/images/sacred-rituals.jpg','is_featured'=>1],
        ['id'=>3,'title'=>'Chhath Puja','region'=>'Bihar','state'=>'Bihar','category'=>'festivals','short_desc'=>'The Sun Worship Festival','image_url'=>'assets/images/chhath-puja.jpg','is_featured'=>1],
    ];
}

function getFestivals($month = null) {
    $db = getDB();
    if ($db) {
        if ($month) {
            $stmt = $db->prepare("SELECT * FROM festivals WHERE month = ? ORDER BY name");
            $stmt->execute([$month]);
        } else {
            $stmt = $db->query("SELECT * FROM festivals ORDER BY month, name");
        }
        return $stmt->fetchAll();
    }
    return [];
}

function getStories($limit = 3) {
    $db = getDB();
    if ($db) {
        $stmt = $db->prepare("SELECT * FROM stories WHERE approved = 1 ORDER BY created_at DESC LIMIT ?");
        $stmt->execute([$limit]);
        return $stmt->fetchAll();
    }
    return [];
}
?>

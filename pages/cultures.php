<?php
require_once '../includes/config.php';
$page_title = 'Cultures';

$category_filter = $_GET['category'] ?? 'all';
$state_filter    = $_GET['state']    ?? '';

$db = getDB();
if ($db) {
    $sql = "SELECT * FROM traditions WHERE 1";
    $params = [];
    if ($category_filter !== 'all') {
        $sql .= " AND category = ?";
        $params[] = $category_filter;
    }
    if ($state_filter) {
        $sql .= " AND state LIKE ?";
        $params[] = '%' . $state_filter . '%';
    }
    $sql .= " ORDER BY is_featured DESC, title ASC";
    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    $traditions = $stmt->fetchAll();
} else {
    $traditions = getTraditions();
}

$tag_classes = [
    'Rajasthan'=>'rajasthan','Himachal Pradesh'=>'himachal','Bihar'=>'bihar',
    'Karnataka'=>'karnataka','Assam'=>'assam','Kerala'=>'kerala',
    'Gujarat'=>'gujarat','Madhya Pradesh'=>'mp',
];

$categories = [
    'all'       => 'All',
    'folk_arts' => 'Folk Arts',
    'festivals' => 'Festivals',
    'rituals'   => 'Rituals',
    'music'     => 'Music',
    'dance'     => 'Dance',
    'crafts'    => 'Crafts',
];
?>
<?php require_once '../includes/header.php'; ?>

<div class="page-hero">
    <div class="page-hero-content">
        <h1 class="page-title">Cultures of India</h1>
        <p class="page-subtitle">Explore 100+ vanishing traditions across every region</p>
        <div class="gold-divider"></div>
    </div>
</div>

<div class="container">
    <?php if ($state_filter): ?>
    <p style="text-align:center;color:var(--color-gold);font-family:var(--font-heading);font-size:14px;letter-spacing:0.1em;padding-top:20px;text-transform:uppercase;">
        Showing traditions from: <?= htmlspecialchars($state_filter) ?>
        <a href="cultures.php" style="color:var(--color-text-muted);margin-left:12px;font-size:12px;">Clear filter ×</a>
    </p>
    <?php endif; ?>

    <div class="filter-tabs">
        <?php foreach ($categories as $key => $label): ?>
        <button class="filter-tab <?= $category_filter === $key ? 'active' : '' ?>"
                data-filter="<?= $key ?>"
                onclick="window.location.href='cultures.php?category=<?= $key ?><?= $state_filter ? '&state='.urlencode($state_filter) : '' ?>'">
            <?= $label ?>
        </button>
        <?php endforeach; ?>
    </div>

    <?php if (empty($traditions)): ?>
    <div style="text-align:center;padding:60px 0;color:var(--color-text-muted);">
        <p style="font-family:var(--font-heading);font-size:18px;">No traditions found in this category yet.</p>
        <a href="cultures.php" style="color:var(--color-gold);font-size:14px;">Browse all →</a>
    </div>
    <?php else: ?>
    <div class="cultures-grid">
        <?php foreach ($traditions as $t):
            $tag = $tag_classes[$t['state']] ?? 'rajasthan';
        ?>
        <a href="tradition.php?id=<?= $t['id'] ?>" class="culture-card" data-category="<?= htmlspecialchars($t['category']) ?>">
            <div class="card-image">
                <?php if (!empty($t['image_url']) && file_exists('../' . $t['image_url'])): ?>
                    <img src="<?= SITE_URL ?>/<?= htmlspecialchars($t['image_url']) ?>" alt="<?= htmlspecialchars($t['title']) ?>" loading="lazy">
                <?php else: ?>
                    <div class="card-img-placeholder <?= $tag ?>" style="height:220px;">
                        <svg viewBox="0 0 200 160" width="160" xmlns="http://www.w3.org/2000/svg">
                            <text x="100" y="90" font-family="serif" font-size="48" text-anchor="middle" fill="#d4a032" opacity="0.4">🏛</text>
                            <text x="100" y="130" font-family="serif" font-size="13" text-anchor="middle" fill="#d4a032" opacity="0.5"><?= htmlspecialchars($t['category']) ?></text>
                        </svg>
                    </div>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <h3 class="card-title"><?= htmlspecialchars($t['title']) ?></h3>
                <span class="card-tag <?= $tag ?>"><?= htmlspecialchars($t['state']) ?></span>
                <p class="card-desc"><?= htmlspecialchars($t['short_desc'] ?? '') ?></p>
            </div>
        </a>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<?php require_once '../includes/footer.php'; ?>

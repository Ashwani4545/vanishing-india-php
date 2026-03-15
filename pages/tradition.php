<?php
require_once '../includes/config.php';

$id = (int)($_GET['id'] ?? 0);
$tradition = null;

$db = getDB();
if ($db && $id > 0) {
    $stmt = $db->prepare("SELECT * FROM traditions WHERE id = ?");
    $stmt->execute([$id]);
    $tradition = $stmt->fetch();
}

// Static fallback
if (!$tradition) {
    $static = [
        1 => ['id'=>1,'title'=>'Kathputli Puppetry','state'=>'Rajasthan','category'=>'folk_arts','short_desc'=>'The Dying Art of Rajasthan','full_desc'=>'Kathputli is a string puppet tradition of Rajasthan, India, and is the most popular form of traditional puppetry in India. The puppeteers, known as Nat, are itinerant performers who travel from village to village with their colourful puppets made of mango wood. These puppets are dressed in bright costumes and jewellery, and are manipulated by the puppeteer through strings attached to their head, hands, and torso. The art form is recognised by UNESCO as an intangible cultural heritage. Today, however, the community of Kathputli artisans in Jaipur faces constant pressure from urbanization and dwindling audiences, with younger generations often choosing other livelihoods.','image_url'=>null],
        2 => ['id'=>2,'title'=>'Sacred Rituals','state'=>'Himachal Pradesh','category'=>'rituals','short_desc'=>'Ancient Pooja of the Himalayas','full_desc'=>'The sacred rituals of the Himalayan region are deeply rooted in the ancient Vedic tradition and local folk beliefs. These ceremonies involve elaborate preparations, sacred fire rituals (yagnas), and offerings to mountain deities. The priests who perform these rituals carry generations of oral knowledge passed down through families. Many of the deities worshipped here are unique to specific valleys and are not found in mainstream Hindu traditions, making these rituals especially precious as living, localised expressions of faith.','image_url'=>null],
        3 => ['id'=>3,'title'=>'Chhath Puja','state'=>'Bihar','category'=>'festivals','short_desc'=>'The Sun Worship Festival','full_desc'=>'Chhath Puja is an ancient Hindu festival dedicated to the Sun God (Surya) and his consort Usha. It is celebrated with great fervor in Bihar, Jharkhand, and parts of Uttar Pradesh. Devotees stand in rivers at sunrise and sunset offering prayers and arghya to the Sun. The festival spans four days and involves rigorous fasting and rituals. While this festival has grown in urban popularity, many of its traditional village-based forms — including the unique folk songs sung specifically for Chhath — are being forgotten.','image_url'=>null],
    ];
    $tradition = $static[$id] ?? $static[1];
}

$page_title = $tradition['title'];
$tag_classes = ['Rajasthan'=>'rajasthan','Himachal Pradesh'=>'himachal','Bihar'=>'bihar','Karnataka'=>'karnataka','Assam'=>'assam','Kerala'=>'kerala','Gujarat'=>'gujarat','Madhya Pradesh'=>'mp'];
$tag = $tag_classes[$tradition['state']] ?? 'rajasthan';
?>
<?php require_once '../includes/header.php'; ?>

<div class="page-hero">
    <div class="page-hero-content">
        <h1 class="page-title"><?= htmlspecialchars($tradition['title']) ?></h1>
        <p class="page-subtitle"><?= htmlspecialchars($tradition['short_desc'] ?? '') ?></p>
        <div class="gold-divider"></div>
    </div>
</div>

<div class="container section-pad">
    <div class="tradition-meta">
        <span class="card-tag <?= $tag ?>"><?= htmlspecialchars($tradition['state']) ?></span>
        <?php if (!empty($tradition['category'])): ?>
        <span style="font-family:var(--font-heading);font-size:12px;letter-spacing:0.1em;text-transform:uppercase;color:var(--color-text-muted);">
            <?= ucfirst(str_replace('_',' ', $tradition['category'])) ?>
        </span>
        <?php endif; ?>
        <a href="cultures.php" style="margin-left:auto;font-family:var(--font-heading);font-size:12px;letter-spacing:0.08em;text-transform:uppercase;color:var(--color-gold);">← Back to Cultures</a>
    </div>

    <?php if (!empty($tradition['image_url']) && file_exists('../' . $tradition['image_url'])): ?>
    <img src="<?= SITE_URL ?>/<?= htmlspecialchars($tradition['image_url']) ?>"
         alt="<?= htmlspecialchars($tradition['title']) ?>"
         class="tradition-hero-img" loading="lazy">
    <?php else: ?>
    <!-- Illustrated placeholder -->
    <div style="height:350px;background:linear-gradient(135deg,var(--color-surface) 0%,var(--color-surface2) 100%);border-radius:var(--radius);border:var(--border-gold);display:flex;align-items:center;justify-content:center;margin:30px 0;">
        <svg viewBox="0 0 400 260" width="380" xmlns="http://www.w3.org/2000/svg">
            <text x="200" y="140" font-family="serif" font-size="80" text-anchor="middle" fill="#d4a032" opacity="0.25">OM</text>
            <text x="200" y="190" font-family="serif" font-size="16" text-anchor="middle" fill="#d4a032" opacity="0.4"><?= htmlspecialchars($tradition['title']) ?></text>
        </svg>
    </div>
    <?php endif; ?>

    <div class="tradition-body" style="max-width:800px;">
        <?php
        $paragraphs = explode("\n\n", $tradition['full_desc'] ?? $tradition['short_desc'] ?? '');
        foreach ($paragraphs as $para) {
            if (trim($para)) echo '<p>' . nl2br(htmlspecialchars(trim($para))) . '</p>';
        }
        ?>
    </div>

    <!-- Related traditions -->
    <?php
    $related = [];
    if ($db) {
        $stmt = $db->prepare("SELECT * FROM traditions WHERE id != ? AND (state = ? OR category = ?) LIMIT 3");
        $stmt->execute([$id, $tradition['state'], $tradition['category'] ?? '']);
        $related = $stmt->fetchAll();
    }
    if (!empty($related)):
    ?>
    <h2 style="font-family:var(--font-heading);font-size:24px;color:var(--color-white);margin:60px 0 30px;letter-spacing:0.05em;">Related Traditions</h2>
    <div class="culture-cards" style="padding:0;">
        <?php foreach ($related as $r):
            $rtag = $tag_classes[$r['state']] ?? 'rajasthan';
        ?>
        <a href="tradition.php?id=<?= $r['id'] ?>" class="culture-card">
            <div class="card-image">
                <div class="card-img-placeholder <?= $rtag ?>" style="height:180px;">
                    <svg viewBox="0 0 100 80" width="80" xmlns="http://www.w3.org/2000/svg"><text x="50" y="50" text-anchor="middle" font-size="30" fill="#d4a032" opacity="0.3">🏛</text></svg>
                </div>
            </div>
            <div class="card-body">
                <h3 class="card-title"><?= htmlspecialchars($r['title']) ?></h3>
                <span class="card-tag <?= $rtag ?>"><?= htmlspecialchars($r['state']) ?></span>
                <p class="card-desc"><?= htmlspecialchars($r['short_desc'] ?? '') ?></p>
            </div>
        </a>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<?php require_once '../includes/footer.php'; ?>

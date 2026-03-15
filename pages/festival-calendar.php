<?php
require_once '../includes/config.php';
$page_title = 'Festival Calendar';

$festivals = getFestivals();

// Static fallback
if (empty($festivals)) {
    $festivals = [
        ['id'=>1,'name'=>'Pushkar Camel Fair','state'=>'Rajasthan','month'=>11,'description'=>'One of the world\'s largest camel fairs with vibrant cultural events, folk music, and traditional crafts.'],
        ['id'=>2,'name'=>'Hornbill Festival','state'=>'Nagaland','month'=>12,'description'=>'A festival of festivals celebrating Naga heritage, tribal customs, and indigenous arts.'],
        ['id'=>3,'name'=>'Rann Utsav','state'=>'Gujarat','month'=>1,'description'=>'Cultural festival held in the vast white salt desert of Rann of Kutch.'],
        ['id'=>4,'name'=>'Thrissur Pooram','state'=>'Kerala','month'=>4,'description'=>'Grand elephant procession, traditional percussion ensembles, and spectacular fireworks.'],
        ['id'=>5,'name'=>'Hemis Festival','state'=>'Ladakh','month'=>6,'description'=>'Colorful two-day mask dance festival at Hemis Monastery celebrating Guru Padmasambhava.'],
        ['id'=>6,'name'=>'Onam','state'=>'Kerala','month'=>8,'description'=>'Harvest festival featuring snake boat races, floral carpets (pookalam), and traditional feasts.'],
        ['id'=>7,'name'=>'Navratri','state'=>'Gujarat','month'=>9,'description'=>'Nine nights of energetic Garba dance and celebration honouring the divine feminine.'],
        ['id'=>8,'name'=>'Diwali Mela','state'=>'Multiple States','month'=>10,'description'=>'The festival of lights celebrated across India with lamps, fireworks, and sweets.'],
        ['id'=>9,'name'=>'Bihu','state'=>'Assam','month'=>4,'description'=>'Three distinct Assamese festivals marking agricultural seasons with traditional dance and music.'],
        ['id'=>10,'name'=>'Pongal','state'=>'Tamil Nadu','month'=>1,'description'=>'Harvest festival celebrated over four days with thanksgiving to the Sun God.'],
        ['id'=>11,'name'=>'Chhath Puja','state'=>'Bihar','month'=>10,'description'=>'Four-day festival dedicated to the Sun God, featuring ritual bathing in rivers at sunrise and sunset.'],
        ['id'=>12,'name'=>'Gangaur','state'=>'Rajasthan','month'=>3,'description'=>'Festival honouring Goddess Gauri (Parvati), celebrated with processions, songs, and offerings.'],
    ];
}

$month_names = ['','January','February','March','April','May','June','July','August','September','October','November','December'];

// Group by month
$by_month = [];
foreach ($festivals as $f) {
    $by_month[$f['month']][] = $f;
}
ksort($by_month);
?>
<?php require_once '../includes/header.php'; ?>

<div class="page-hero">
    <div class="page-hero-content">
        <h1 class="page-title">Festival Calendar</h1>
        <p class="page-subtitle">India's living calendar of sacred celebrations</p>
        <div class="gold-divider"></div>
    </div>
</div>

<div class="container section-pad">
    <!-- Month tabs -->
    <div class="filter-tabs" style="flex-wrap:wrap;">
        <button class="filter-tab active" data-month="all" onclick="filterMonth('all', this)">All Months</button>
        <?php foreach ($month_names as $num => $name): ?>
        <?php if ($num > 0 && isset($by_month[$num])): ?>
        <button class="filter-tab" data-month="<?= $num ?>" onclick="filterMonth(<?= $num ?>, this)"><?= $name ?></button>
        <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <?php foreach ($by_month as $month => $fests): ?>
    <div class="month-group" data-month="<?= $month ?>">
        <h2 style="font-family:var(--font-heading);font-size:20px;color:var(--color-gold);letter-spacing:0.1em;text-transform:uppercase;margin:30px 0 20px;padding-left:4px;border-left:3px solid var(--color-gold);padding-left:16px;">
            <?= $month_names[$month] ?>
        </h2>
        <div class="calendar-grid">
            <?php foreach ($fests as $f): ?>
            <div class="festival-card">
                <div class="festival-month"><?= $month_names[$f['month']] ?></div>
                <div class="festival-name"><?= htmlspecialchars($f['name']) ?></div>
                <div class="festival-state">📍 <?= htmlspecialchars($f['state']) ?></div>
                <p class="festival-desc"><?= htmlspecialchars($f['description']) ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<script>
function filterMonth(month, btn) {
    document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('.month-group').forEach(g => {
        g.style.display = (month === 'all' || g.dataset.month == month) ? 'block' : 'none';
    });
}
</script>

<?php require_once '../includes/footer.php'; ?>

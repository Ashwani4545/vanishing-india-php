<?php
require_once 'includes/config.php';

$featured_traditions = getTraditions(3, true);
?>
<?php require_once 'includes/header.php'; ?>

<!-- ══ HERO ═════════════════════════════════════════════════ -->
<section class="hero" id="hero">
    <div class="hero-bg"></div>

    <!-- Puppet SVG (left) -->
    <div class="hero-puppet" aria-hidden="true">
        <svg viewBox="0 0 220 520" xmlns="http://www.w3.org/2000/svg" height="100%">
            <!-- Puppet strings -->
            <line x1="80" y1="0" x2="80" y2="80" stroke="#d4a032" stroke-width="1" opacity="0.7"/>
            <line x1="140" y1="0" x2="140" y2="80" stroke="#d4a032" stroke-width="1" opacity="0.7"/>
            <line x1="60" y1="0" x2="60" y2="200" stroke="#d4a032" stroke-width="1" opacity="0.5"/>
            <line x1="160" y1="0" x2="160" y2="200" stroke="#d4a032" stroke-width="1" opacity="0.5"/>
            <line x1="110" y1="0" x2="110" y2="360" stroke="#d4a032" stroke-width="1" opacity="0.4"/>

            <!-- Crown / head ornament -->
            <ellipse cx="110" cy="55" rx="28" ry="12" fill="#c87820" opacity="0.9"/>
            <polygon points="82,55 90,25 98,50 110,20 122,50 130,25 138,55" fill="#d4a032"/>
            <circle cx="110" cy="22" r="5" fill="#f0c060"/>
            <circle cx="90" cy="28" r="3" fill="#e08020"/>
            <circle cx="130" cy="28" r="3" fill="#e08020"/>

            <!-- Face -->
            <ellipse cx="110" cy="80" rx="26" ry="30" fill="#c87040"/>
            <circle cx="100" cy="74" r="5" fill="#fff" />
            <circle cx="120" cy="74" r="5" fill="#fff" />
            <circle cx="101" cy="75" r="3" fill="#3a1a00"/>
            <circle cx="121" cy="75" r="3" fill="#3a1a00"/>
            <!-- Smile -->
            <path d="M100,92 Q110,100 120,92" stroke="#8a3010" stroke-width="2" fill="none"/>
            <!-- Nose -->
            <ellipse cx="110" cy="85" rx="4" ry="3" fill="#b06030"/>
            <!-- Earrings -->
            <circle cx="84" cy="82" r="5" fill="#d4a032" stroke="#f0c060" stroke-width="1"/>
            <circle cx="136" cy="82" r="5" fill="#d4a032" stroke="#f0c060" stroke-width="1"/>

            <!-- Body / dress -->
            <path d="M85,110 L75,280 L110,300 L145,280 L135,110 Q110,120 85,110Z" fill="#c03010"/>
            <!-- Dress pattern -->
            <ellipse cx="110" cy="180" rx="18" ry="30" fill="#d04020" opacity="0.6"/>
            <circle cx="110" cy="150" r="6" fill="#f0c060" opacity="0.8"/>
            <circle cx="95" cy="165" r="4" fill="#f0c060" opacity="0.6"/>
            <circle cx="125" cy="165" r="4" fill="#f0c060" opacity="0.6"/>

            <!-- Gold border on dress -->
            <path d="M85,110 Q110,125 135,110" stroke="#d4a032" stroke-width="2" fill="none"/>
            <path d="M78,200 Q110,215 142,200" stroke="#d4a032" stroke-width="1.5" fill="none"/>
            <path d="M76,240 Q110,255 144,240" stroke="#d4a032" stroke-width="1.5" fill="none"/>

            <!-- Arms -->
            <path d="M85,130 Q50,170 45,210" stroke="#c87040" stroke-width="14" stroke-linecap="round" fill="none"/>
            <path d="M135,130 Q170,170 175,210" stroke="#c87040" stroke-width="14" stroke-linecap="round" fill="none"/>
            <!-- Hands -->
            <circle cx="44" cy="214" r="10" fill="#c87040"/>
            <circle cx="176" cy="214" r="10" fill="#c87040"/>

            <!-- Skirt expansion -->
            <path d="M75,280 Q50,360 60,440 L160,440 Q170,360 145,280 Q110,300 75,280Z" fill="#c03010"/>
            <!-- Skirt border -->
            <path d="M60,440 L160,440" stroke="#d4a032" stroke-width="3"/>
            <!-- Skirt dots -->
            <circle cx="90" cy="330" r="4" fill="#f0c060" opacity="0.7"/>
            <circle cx="110" cy="310" r="4" fill="#f0c060" opacity="0.7"/>
            <circle cx="130" cy="330" r="4" fill="#f0c060" opacity="0.7"/>
            <circle cx="100" cy="360" r="3" fill="#f0c060" opacity="0.6"/>
            <circle cx="120" cy="360" r="3" fill="#f0c060" opacity="0.6"/>

            <!-- Feet -->
            <ellipse cx="85" cy="445" rx="14" ry="8" fill="#c87040"/>
            <ellipse cx="135" cy="445" rx="14" ry="8" fill="#c87040"/>
        </svg>
    </div>

    <!-- Particles -->
    <div class="hero-particles" id="heroParticles"></div>

    <!-- Hero text -->
    <div class="hero-content">
        <h1 class="hero-title">Vanishing India</h1>
        <p class="hero-subtitle">Exploring the Lost Traditions</p>
    </div>
</section>

<!-- ══ DISCOVER HIDDEN CULTURES ═════════════════════════════ -->
<section class="featured-section">
    <div class="section-header">
        <h2 class="section-title">
            <span class="diamond">◆</span>
            Discover India's Hidden Cultures
            <span class="diamond">◆</span>
        </h2>
    </div>

    <div class="culture-cards">
        <?php
        // Use DB data if available, else static
        $cards = !empty($featured_traditions) ? $featured_traditions : [
            ['id'=>1, 'title'=>'Kathputli Puppetry', 'state'=>'Rajasthan', 'short_desc'=>'The Dying Art of Rajasthan', 'image_url'=>null],
            ['id'=>2, 'title'=>'Sacred Rituals',     'state'=>'Himachal Pradesh', 'short_desc'=>'Ancient Pooja of the Himalayas', 'image_url'=>null],
            ['id'=>3, 'title'=>'Chhath Puja',        'state'=>'Bihar', 'short_desc'=>'The Sun Worship Festival', 'image_url'=>null],
        ];
        $tag_classes = [
            'Rajasthan'=>'rajasthan', 'Himachal Pradesh'=>'himachal', 'Bihar'=>'bihar',
            'Karnataka'=>'karnataka', 'Assam'=>'assam', 'Kerala'=>'kerala',
            'Gujarat'=>'gujarat', 'Madhya Pradesh'=>'mp',
        ];
        foreach ($cards as $card):
            $tag = $tag_classes[$card['state']] ?? 'rajasthan';
            $img_placeholder_class = strtolower(str_replace(' ', '-', $card['state']));
            if (!isset($tag_classes[$card['state']])) $img_placeholder_class = 'rajasthan';
        ?>
        <a href="pages/tradition.php?id=<?= $card['id'] ?>" class="culture-card" data-category="<?= htmlspecialchars($card['category'] ?? 'folk_arts') ?>">
            <div class="card-image">
                <?php if (!empty($card['image_url']) && file_exists($card['image_url'])): ?>
                    <img src="<?= htmlspecialchars($card['image_url']) ?>" alt="<?= htmlspecialchars($card['title']) ?>" loading="lazy">
                <?php else: ?>
                    <!-- SVG illustration placeholder -->
                    <?php if ($card['id'] == 1 || $card['title'] === 'Kathputli Puppetry'): ?>
                    <div class="card-img-placeholder rajasthan">
                        <svg viewBox="0 0 200 160" width="180" xmlns="http://www.w3.org/2000/svg">
                            <!-- Puppet silhouettes -->
                            <line x1="60" y1="0" x2="60" y2="30" stroke="#d4a032" stroke-width="1.2" opacity="0.7"/>
                            <line x1="100" y1="0" x2="100" y2="25" stroke="#d4a032" stroke-width="1.2" opacity="0.7"/>
                            <line x1="140" y1="0" x2="140" y2="30" stroke="#d4a032" stroke-width="1.2" opacity="0.7"/>
                            <ellipse cx="60" cy="38" rx="12" ry="14" fill="#c87040"/>
                            <path d="M48,52 Q40,90 42,130 L78,130 Q80,90 72,52Z" fill="#c03010"/>
                            <ellipse cx="100" cy="33" rx="12" ry="14" fill="#c87040"/>
                            <path d="M88,47 Q80,85 82,125 L118,125 Q120,85 112,47Z" fill="#8a1a50"/>
                            <ellipse cx="140" cy="38" rx="12" ry="14" fill="#c87040"/>
                            <path d="M128,52 Q120,90 122,130 L158,130 Q160,90 152,52Z" fill="#1a4a8a"/>
                        </svg>
                    </div>
                    <?php elseif ($card['id'] == 2 || $card['title'] === 'Sacred Rituals'): ?>
                    <div class="card-img-placeholder himachal">
                        <svg viewBox="0 0 200 160" width="180" xmlns="http://www.w3.org/2000/svg">
                            <!-- Fire ritual -->
                            <ellipse cx="100" cy="140" rx="40" ry="8" fill="#1a0800" opacity="0.5"/>
                            <path d="M90,140 Q85,110 100,80 Q115,110 110,140Z" fill="#e05010" opacity="0.9"/>
                            <path d="M95,140 Q92,115 100,90 Q108,115 105,140Z" fill="#f08020" opacity="0.9"/>
                            <path d="M98,140 Q97,120 100,100 Q103,120 102,140Z" fill="#ffd040" opacity="0.9"/>
                            <!-- Priest silhouette -->
                            <circle cx="60" cy="70" r="15" fill="#c87040" opacity="0.8"/>
                            <rect x="48" y="85" width="24" height="60" rx="4" fill="#e8e0d0" opacity="0.7"/>
                            <path d="M55,90 Q60,95 65,90" stroke="#d4a032" stroke-width="1.5" fill="none"/>
                        </svg>
                    </div>
                    <?php else: ?>
                    <div class="card-img-placeholder bihar">
                        <svg viewBox="0 0 200 160" width="180" xmlns="http://www.w3.org/2000/svg">
                            <!-- Chhath river scene -->
                            <rect x="0" y="100" width="200" height="60" fill="#0a1e40" opacity="0.8"/>
                            <path d="M0,100 Q50,90 100,100 Q150,110 200,100" stroke="#3060a0" stroke-width="2" fill="none"/>
                            <!-- Sun -->
                            <circle cx="100" cy="50" r="28" fill="#f0a010" opacity="0.85"/>
                            <circle cx="100" cy="50" r="22" fill="#f8c030"/>
                            <!-- Sun rays -->
                            <?php for ($r = 0; $r < 8; $r++): ?>
                            <line x1="100" y1="50" x2="<?= 100 + 40*cos(deg2rad($r*45)) ?>" y2="<?= 50 + 40*sin(deg2rad($r*45)) ?>" stroke="#f0a010" stroke-width="2" opacity="0.4"/>
                            <?php endfor; ?>
                            <!-- Devotee silhouette -->
                            <circle cx="80" cy="95" r="8" fill="#c87040" opacity="0.7"/>
                            <ellipse cx="80" cy="108" rx="10" ry="8" fill="#c03050" opacity="0.7"/>
                            <!-- Offering plate -->
                            <ellipse cx="95" cy="98" rx="14" ry="5" fill="#d4a032" opacity="0.8"/>
                        </svg>
                    </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <h3 class="card-title"><?= htmlspecialchars($card['title']) ?></h3>
                <span class="card-tag <?= $tag ?>"><?= htmlspecialchars($card['state']) ?></span>
                <p class="card-desc"><?= htmlspecialchars($card['short_desc'] ?? '') ?></p>
            </div>
        </a>
        <?php endforeach; ?>
    </div>
</section>

<!-- ══ EXPLORE CULTURES MAP ══════════════════════════════════ -->
<section class="explore-section">
    <div class="section-header">
        <h2 class="section-title">
            <span class="diamond">◆</span>
            Explore Cultures of India
            <span class="diamond">◆</span>
        </h2>
    </div>

    <div class="explore-inner">
        <!-- Sidebar -->
        <aside class="explore-sidebar">
            <div class="sidebar-label">
                Select a Region<br>to Learn More
                <span class="arrow">↘</span>
            </div>
            <div class="sidebar-cards">
                <a href="pages/cultures.php?category=folk_arts" class="sidebar-card">
                    <div class="card-img-placeholder rajasthan sidebar-card-bg" style="position:absolute;inset:0;width:100%;height:100%;border-radius:6px;">
                        <svg viewBox="0 0 200 80" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice">
                            <rect width="200" height="80" fill="#4a1e08"/>
                            <circle cx="40" cy="40" r="20" fill="#c87040" opacity="0.6"/>
                            <circle cx="100" cy="35" r="18" fill="#c87040" opacity="0.5"/>
                            <circle cx="160" cy="40" r="20" fill="#c87040" opacity="0.6"/>
                        </svg>
                    </div>
                    <span class="sidebar-card-label">Folk Arts &amp; Music</span>
                </a>
                <a href="pages/cultures.php?category=festivals" class="sidebar-card">
                    <div style="position:absolute;inset:0;background:linear-gradient(135deg,#1a0a30,#3a1060,#1a0a30);border-radius:6px;"></div>
                    <span class="sidebar-card-label">Traditional Festivals</span>
                </a>
                <a href="pages/cultures.php?category=rituals" class="sidebar-card">
                    <div style="position:absolute;inset:0;background:linear-gradient(135deg,#1a0a00,#3a1800,#1a0a00);border-radius:6px;">
                        <svg viewBox="0 0 200 80" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice">
                            <circle cx="100" cy="60" r="30" fill="#e05010" opacity="0.3"/>
                            <circle cx="100" cy="55" r="15" fill="#f08020" opacity="0.4"/>
                        </svg>
                    </div>
                    <span class="sidebar-card-label">Ancient Rituals</span>
                </a>
            </div>
        </aside>

        <!-- Map -->
        <div class="map-area">
            <div class="india-map-wrapper">
                <div id="mapTooltip" class="map-tooltip"></div>
                <!-- India SVG Map — simplified political map with colored states -->
                <svg class="india-map-svg" viewBox="0 0 400 480" xmlns="http://www.w3.org/2000/svg">
                    <!-- Jammu & Kashmir -->
                    <path class="state-path" data-state="Jammu &amp; Kashmir" fill="#f5a623" d="M120,20 L180,15 L200,35 L190,55 L175,60 L155,50 L135,55 L115,45 Z"/>
                    <!-- Himachal Pradesh -->
                    <path class="state-path" data-state="Himachal Pradesh" fill="#7ed321" d="M140,60 L175,60 L185,80 L170,95 L145,90 L130,75 Z"/>
                    <!-- Punjab -->
                    <path class="state-path" data-state="Punjab" fill="#4a90d9" d="M105,65 L140,60 L130,75 L115,85 L98,80 Z"/>
                    <!-- Uttarakhand -->
                    <path class="state-path" data-state="Uttarakhand" fill="#50e3c2" d="M175,60 L210,60 L215,80 L200,95 L180,95 L170,80 Z"/>
                    <!-- Haryana -->
                    <path class="state-path" data-state="Haryana" fill="#b8e986" d="M100,80 L130,75 L145,90 L140,110 L115,115 L95,100 Z"/>
                    <!-- Delhi -->
                    <path class="state-path" data-state="Delhi" fill="#d0021b" d="M140,105 L148,100 L152,108 L144,114 Z"/>
                    <!-- Rajasthan -->
                    <path class="state-path" data-state="Rajasthan" fill="#f5a623" d="M60,90 L100,80 L95,100 L115,115 L110,160 L80,180 L50,175 L30,155 L35,120 L55,105 Z"/>
                    <!-- Uttar Pradesh -->
                    <path class="state-path" data-state="Uttar Pradesh" fill="#9b59b6" d="M140,110 L215,80 L240,100 L255,125 L235,150 L200,160 L160,155 L140,140 L115,115 Z"/>
                    <!-- Bihar -->
                    <path class="state-path" data-state="Bihar" fill="#e74c3c" d="M235,150 L270,140 L285,160 L265,180 L235,175 L215,165 Z"/>
                    <!-- Sikkim -->
                    <path class="state-path" data-state="Sikkim" fill="#27ae60" d="M275,125 L285,120 L290,132 L280,138 Z"/>
                    <!-- Arunachal Pradesh -->
                    <path class="state-path" data-state="Arunachal Pradesh" fill="#2ecc71" d="M285,120 L330,110 L345,130 L320,145 L295,140 L285,130 Z"/>
                    <!-- Assam -->
                    <path class="state-path" data-state="Assam" fill="#1abc9c" d="M285,138 L320,145 L330,162 L300,170 L275,165 L270,152 Z"/>
                    <!-- Nagaland -->
                    <path class="state-path" data-state="Nagaland" fill="#3498db" d="M320,145 L340,148 L338,168 L318,168 L312,158 Z"/>
                    <!-- Manipur -->
                    <path class="state-path" data-state="Manipur" fill="#9b59b6" d="M316,168 L336,168 L334,188 L314,188 Z"/>
                    <!-- Mizoram -->
                    <path class="state-path" data-state="Mizoram" fill="#e67e22" d="M312,188 L330,188 L328,210 L310,208 Z"/>
                    <!-- Tripura -->
                    <path class="state-path" data-state="Tripura" fill="#e74c3c" d="M298,180 L312,178 L314,196 L298,195 Z"/>
                    <!-- Meghalaya -->
                    <path class="state-path" data-state="Meghalaya" fill="#f39c12" d="M278,168 L310,168 L312,185 L295,188 L272,182 Z"/>
                    <!-- West Bengal -->
                    <path class="state-path" data-state="West Bengal" fill="#16a085" d="M260,175 L285,165 L295,185 L295,220 L275,235 L255,220 L248,195 Z"/>
                    <!-- Jharkhand -->
                    <path class="state-path" data-state="Jharkhand" fill="#d35400" d="M235,175 L265,180 L268,205 L245,215 L225,205 L220,185 Z"/>
                    <!-- Odisha -->
                    <path class="state-path" data-state="Odisha" fill="#8e44ad" d="M230,215 L268,208 L272,240 L255,260 L230,255 L215,235 Z"/>
                    <!-- Madhya Pradesh -->
                    <path class="state-path" data-state="Madhya Pradesh" fill="#27ae60" d="M100,175 L160,158 L200,160 L220,185 L215,235 L175,245 L140,240 L100,220 L80,195 Z"/>
                    <!-- Chhattisgarh -->
                    <path class="state-path" data-state="Chhattisgarh" fill="#c0392b" d="M200,165 L235,175 L220,185 L215,235 L195,245 L175,245 Z"/>
                    <!-- Gujarat -->
                    <path class="state-path" data-state="Gujarat" fill="#f1c40f" d="M30,155 L50,175 L60,215 L45,245 L25,250 L10,235 L15,205 L10,175 Z"/>
                    <!-- Maharashtra -->
                    <path class="state-path" data-state="Maharashtra" fill="#e74c3c" d="M60,215 L100,220 L140,240 L150,270 L130,295 L100,305 L70,290 L50,265 L45,245 Z"/>
                    <!-- Telangana -->
                    <path class="state-path" data-state="Telangana" fill="#3498db" d="M175,248 L215,238 L225,265 L205,285 L180,280 L165,265 Z"/>
                    <!-- Andhra Pradesh -->
                    <path class="state-path" data-state="Andhra Pradesh" fill="#2ecc71" d="M205,285 L255,260 L265,285 L248,310 L220,320 L200,305 Z"/>
                    <!-- Karnataka -->
                    <path class="state-path" data-state="Karnataka" fill="#9b59b6" d="M100,305 L130,295 L165,268 L180,280 L200,305 L195,340 L170,360 L140,355 L115,340 L95,320 Z"/>
                    <!-- Goa -->
                    <path class="state-path" data-state="Goa" fill="#1abc9c" d="M98,315 L112,312 L108,328 L95,325 Z"/>
                    <!-- Tamil Nadu -->
                    <path class="state-path" data-state="Tamil Nadu" fill="#e67e22" d="M140,358 L170,362 L195,345 L210,380 L195,415 L170,432 L148,430 L130,405 L128,375 Z"/>
                    <!-- Kerala -->
                    <path class="state-path" data-state="Kerala" fill="#27ae60" d="M115,342 L140,358 L128,375 L118,405 L108,420 L100,395 L105,365 Z"/>

                    <!-- North East small states -->
                    <!-- Daman & Diu (small) -->
                    <circle class="state-path" data-state="Daman &amp; Diu" cx="50" cy="248" r="4" fill="#e74c3c"/>
                    <!-- Puducherry (small) -->
                    <circle class="state-path" data-state="Puducherry" cx="195" cy="418" r="4" fill="#3498db"/>
                    <!-- Lakshadweep -->
                    <circle class="state-path" data-state="Lakshadweep" cx="65" cy="400" r="5" fill="#1abc9c"/>
                    <!-- Andaman & Nicobar -->
                    <ellipse class="state-path" data-state="Andaman &amp; Nicobar" cx="345" cy="330" rx="8" ry="30" fill="#f39c12"/>

                    <!-- Ladakh -->
                    <path class="state-path" data-state="Ladakh" fill="#bd10e0" d="M140,15 L185,12 L205,32 L200,55 L185,55 L170,40 L150,42 L138,30 Z"/>
                </svg>
            </div>

            <a href="pages/cultures.php" class="browse-btn">
                Browse More <span class="arrow">›</span>
            </a>
        </div>
    </div>
</section>

<!-- ══ NEWSLETTER ════════════════════════════════════════════ -->
<div class="newsletter-bar">
    <h3>Stay Connected with India's Living Heritage</h3>
    <p>Subscribe to receive stories, festival alerts, and updates on endangered traditions.</p>
    <p class="newsletter-msg" style="font-size:13px;margin-bottom:8px;min-height:18px;"></p>
    <form class="newsletter-form" id="newsletterForm" action="ajax/newsletter.php" method="POST">
        <input type="email" name="email" placeholder="Your email address" required>
        <button type="submit">Subscribe</button>
    </form>
</div>

<?php require_once 'includes/footer.php'; ?>

<?php
require_once '../includes/config.php';
$page_title = 'About Us';
?>
<?php require_once '../includes/header.php'; ?>

<div class="page-hero">
    <div class="page-hero-content">
        <h1 class="page-title">About Vanishing India</h1>
        <p class="page-subtitle">Our mission to preserve the soul of India</p>
        <div class="gold-divider"></div>
    </div>
</div>

<div class="container section-pad">
    <div class="about-grid">
        <div class="about-visual">
            <div class="about-visual-inner">
                <svg viewBox="0 0 300 300" width="260" xmlns="http://www.w3.org/2000/svg">
                    <!-- Om symbol -->
                    <circle cx="150" cy="150" r="130" fill="none" stroke="#d4a032" stroke-width="1" opacity="0.3"/>
                    <circle cx="150" cy="150" r="100" fill="none" stroke="#d4a032" stroke-width="0.5" opacity="0.2"/>
                    <text x="150" y="185" font-family="serif" font-size="100" text-anchor="middle" fill="#d4a032" opacity="0.7">ॐ</text>
                    <!-- Lotus petals -->
                    <?php for ($i = 0; $i < 8; $i++): ?>
                    <ellipse cx="150" cy="150" rx="12" ry="30"
                        fill="#c87820" opacity="0.15"
                        transform="rotate(<?= $i * 45 ?>,150,150) translate(0,-90)"/>
                    <?php endfor; ?>
                </svg>
            </div>
        </div>
        <div class="about-text">
            <h2>Preserving What Time Forgets</h2>
            <p>Vanishing India is a cultural documentation initiative dedicated to exploring, recording, and celebrating the rich tapestry of traditions across India's 30+ states and union territories. Many of these art forms, rituals, and practices are on the verge of extinction, known only to a handful of aging practitioners.</p>
            <p>Founded by a collective of ethnographers, photographers, and storytellers, we travel to remote corners of India — from the high Himalayan valleys to the coastal villages of Kerala — capturing traditions in their living context before they are lost forever.</p>
            <p>Through visual storytelling, community interviews, and collaborative documentation, we build a living archive that belongs to all of humanity.</p>
        </div>
    </div>

    <h2 style="font-family:var(--font-heading);font-size:28px;color:var(--color-white);text-align:center;margin:60px 0 30px;letter-spacing:0.05em;">Our Values</h2>
    <div class="about-values">
        <div class="value-item">
            <div class="value-icon">🏛️</div>
            <div class="value-title">Preservation</div>
            <div class="value-text">We document traditions before they disappear, creating a permanent record for future generations.</div>
        </div>
        <div class="value-item">
            <div class="value-icon">🤝</div>
            <div class="value-title">Community</div>
            <div class="value-text">We work with and uplift local communities, ensuring they benefit from and own their cultural narratives.</div>
        </div>
        <div class="value-item">
            <div class="value-icon">📖</div>
            <div class="value-title">Education</div>
            <div class="value-text">We make India's living heritage accessible to students, researchers, and curious minds worldwide.</div>
        </div>
        <div class="value-item">
            <div class="value-icon">🌿</div>
            <div class="value-title">Authenticity</div>
            <div class="value-text">We tell stories from the inside, with respect, depth, and fidelity to the communities we document.</div>
        </div>
    </div>

    <div style="text-align:center;margin-top:60px;">
        <h2 style="font-family:var(--font-heading);font-size:24px;color:var(--color-white);margin-bottom:20px;">Meet Our Team</h2>
        <p style="color:var(--color-text-muted);max-width:600px;margin:0 auto;">We are a team of ethnographers, videographers, writers, and activists united by a love for India's intangible heritage. <a href="contribute.php" style="color:var(--color-gold);">Join our mission →</a></p>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>

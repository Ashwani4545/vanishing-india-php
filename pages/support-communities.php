<?php
require_once '../includes/config.php';
$page_title = 'Support Communities';
$stories = getStories(6);
?>
<?php require_once '../includes/header.php'; ?>

<div class="page-hero">
    <div class="page-hero-content">
        <h1 class="page-title">Support Communities</h1>
        <p class="page-subtitle">Stories, voices, and livelihoods from the keepers of tradition</p>
        <div class="gold-divider"></div>
    </div>
</div>

<div class="container section-pad">
    <!-- How to support -->
    <div class="community-section">
        <h2 class="community-title">How You Can Help</h2>
        <p style="color:var(--color-text);margin-bottom:20px;">The traditions documented on Vanishing India are maintained by living communities — artisans, priests, musicians, and storytellers who often struggle economically. Here's how you can make a difference:</p>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:20px;margin-top:20px;">
            <?php
            $ways = [
                ['🎭','Attend Performances','Seek out local folk performances, fairs, and festivals. Your attendance matters.'],
                ['🛍️','Buy Authentic Crafts','Purchase directly from artisans. Every sale sustains a family and a tradition.'],
                ['📣','Share Stories','Use social media to amplify these traditions and the people behind them.'],
                ['💰','Donate','Support NGOs and collectives working directly with traditional communities.'],
                ['🎓','Learn','Take workshops, apprenticeships, or courses with traditional practitioners.'],
                ['📝','Document','Write about your experiences, photograph (with consent), and contribute your stories here.'],
            ];
            foreach ($ways as $w): ?>
            <div class="value-item">
                <div class="value-icon"><?= $w[0] ?></div>
                <div class="value-title"><?= $w[1] ?></div>
                <div class="value-text"><?= $w[2] ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Community Stories -->
    <h2 style="font-family:var(--font-heading);font-size:26px;color:var(--color-white);letter-spacing:0.05em;margin:50px 0 10px;">Community Stories</h2>
    <p style="color:var(--color-text-muted);margin-bottom:30px;">Voices from across India sharing their connection to living heritage.</p>

    <?php if (!empty($stories)): ?>
    <div class="stories-grid">
        <?php foreach ($stories as $s): ?>
        <div class="story-card">
            <div class="story-author">— <?= htmlspecialchars($s['author_name']) ?></div>
            <div class="story-title"><?= htmlspecialchars($s['title']) ?></div>
            <p class="story-text"><?= htmlspecialchars(substr($s['content'], 0, 200)) ?>...</p>
        </div>
        <?php endforeach; ?>
    </div>
    <?php else: ?>
    <!-- Static fallback stories -->
    <div class="stories-grid">
        <div class="story-card">
            <div class="story-author">— Priya Sharma, Jaipur</div>
            <div class="story-title">My Grandmother's Puppet Stories</div>
            <p class="story-text">Growing up in Jaipur, I watched my grandmother bring Kathputli puppets to life every evening. Her puppets were not just toys — they were characters from the Mahabharata and local folklore, each with its own voice and personality...</p>
        </div>
        <div class="story-card">
            <div class="story-author">— Rajesh Kumar, Patna</div>
            <div class="story-title">The Last Chhath of Our Village</div>
            <p class="story-text">Every year, our entire village would gather at the riverbank for Chhath Puja. The sight of hundreds of devotees standing in the river at sunrise, holding offerings to the Sun God, was a moment of profound collective grace...</p>
        </div>
        <div class="story-card">
            <div class="story-author">— Anita Devi, Dharamsala</div>
            <div class="story-title">Learning Sacred Himalayan Rituals</div>
            <p class="story-text">My father was a priest in Himachal Pradesh. From a young age, I would wake up at 4 AM to assist him. The chants echoing through the mountain valleys at dawn are a sound I carry in my heart wherever I go...</p>
        </div>
    </div>
    <?php endif; ?>

    <div style="text-align:center;margin-top:40px;">
        <a href="contribute.php" class="browse-btn" style="display:inline-flex;">
            Share Your Story <span class="arrow">›</span>
        </a>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>

<?php
require_once '../includes/config.php';
$page_title = 'Contribute';

$success = '';
$error   = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form_type'])) {
    $name    = trim($_POST['name']    ?? '');
    $email   = trim($_POST['email']   ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (!$name || !$email || !$message) {
        $error = 'Please fill in all required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } else {
        $db = getDB();
        if ($db) {
            $stmt = $db->prepare("INSERT INTO contributions (name, email, subject, message) VALUES (?,?,?,?)");
            $stmt->execute([$name, $email, $subject, $message]);
            $success = 'Thank you! Your message has been received. We\'ll be in touch soon.';
        } else {
            // No DB — just show success
            $success = 'Thank you, ' . htmlspecialchars($name) . '! We\'ve received your contribution. (Note: Configure your database to save messages permanently.)';
        }
    }
}
?>
<?php require_once '../includes/header.php'; ?>

<div class="page-hero">
    <div class="page-hero-content">
        <h1 class="page-title">Contribute</h1>
        <p class="page-subtitle">Add your voice, stories, and knowledge to the archive</p>
        <div class="gold-divider"></div>
    </div>
</div>

<div class="container section-pad">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:60px;align-items:start;">
        <!-- Left: Info -->
        <div>
            <h2 style="font-family:var(--font-heading);font-size:26px;color:var(--color-white);margin-bottom:20px;">How to Contribute</h2>
            <p style="color:var(--color-text);margin-bottom:20px;line-height:1.85;">
                Vanishing India grows through the contributions of researchers, practitioners, enthusiasts, and community members across India and the world. Here are ways you can add to the archive:
            </p>
            <?php
            $types = [
                ['📸','Submit Photographs','Share images of traditions, artisans, or performances (with appropriate permissions).'],
                ['🎥','Share Video Documentation','Raw footage of performances, interviews, or rituals is invaluable to the archive.'],
                ['✍️','Write an Article or Story','Write about a tradition you have witnessed, practiced, or researched.'],
                ['🗣️','Report an Endangered Tradition','Tell us about a tradition in your region that is disappearing.'],
                ['🤝','Partner with Us','Organisations and institutions can collaborate on documentation projects.'],
            ];
            foreach ($types as $t): ?>
            <div style="display:flex;gap:14px;align-items:flex-start;margin-bottom:18px;padding:14px;background:var(--color-surface);border:var(--border-gold);border-radius:var(--radius);">
                <span style="font-size:22px;flex-shrink:0;"><?= $t[0] ?></span>
                <div>
                    <div style="font-family:var(--font-heading);font-size:14px;color:var(--color-white);margin-bottom:4px;letter-spacing:0.05em;"><?= $t[1] ?></div>
                    <div style="font-size:13px;color:var(--color-text-muted);"><?= $t[2] ?></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Right: Form -->
        <div class="form-section" style="padding:0;">
            <h2 style="font-family:var(--font-heading);font-size:24px;color:var(--color-white);margin-bottom:24px;">Get in Touch</h2>

            <?php if ($success): ?>
            <div class="alert alert-success"><?= $success ?></div>
            <?php endif; ?>
            <?php if ($error): ?>
            <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST" action="contribute.php">
                <input type="hidden" name="form_type" value="contribution">
                <div class="form-group">
                    <label class="form-label" for="name">Full Name *</label>
                    <input class="form-input" type="text" id="name" name="name"
                           value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required
                           placeholder="Your full name">
                </div>
                <div class="form-group">
                    <label class="form-label" for="email">Email Address *</label>
                    <input class="form-input" type="email" id="email" name="email"
                           value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required
                           placeholder="you@example.com">
                </div>
                <div class="form-group">
                    <label class="form-label" for="subject">Subject / Type of Contribution</label>
                    <select class="form-select" id="subject" name="subject">
                        <option value="">Select a type</option>
                        <option value="story" <?= ($_POST['subject']??'') === 'story' ? 'selected' : '' ?>>Share a Story</option>
                        <option value="photograph" <?= ($_POST['subject']??'') === 'photograph' ? 'selected' : '' ?>>Submit Photographs</option>
                        <option value="video" <?= ($_POST['subject']??'') === 'video' ? 'selected' : '' ?>>Share Video Documentation</option>
                        <option value="report" <?= ($_POST['subject']??'') === 'report' ? 'selected' : '' ?>>Report Endangered Tradition</option>
                        <option value="partnership" <?= ($_POST['subject']??'') === 'partnership' ? 'selected' : '' ?>>Partnership / Collaboration</option>
                        <option value="other" <?= ($_POST['subject']??'') === 'other' ? 'selected' : '' ?>>Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="message">Your Message *</label>
                    <textarea class="form-textarea" id="message" name="message" required
                              placeholder="Tell us about the tradition, your story, or how you'd like to contribute..."><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
                </div>
                <button type="submit" class="submit-btn">
                    Send Message ›
                </button>
            </form>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>

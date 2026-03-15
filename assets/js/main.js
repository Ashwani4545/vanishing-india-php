/* ============================================================
   VANISHING INDIA — Main JavaScript
   ============================================================ */

document.addEventListener('DOMContentLoaded', function () {

    // ── Navbar scroll effect ──────────────────────────────────
    const navbar = document.getElementById('navbar');
    if (navbar) {
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 40);
        });
    }

    // ── Mobile hamburger ──────────────────────────────────────
    const hamburger = document.getElementById('hamburger');
    const mobileMenu = document.getElementById('mobileMenu');
    if (hamburger && mobileMenu) {
        hamburger.addEventListener('click', () => {
            mobileMenu.classList.toggle('open');
            hamburger.classList.toggle('open');
        });
        // Close on outside click
        document.addEventListener('click', (e) => {
            if (!hamburger.contains(e.target) && !mobileMenu.contains(e.target)) {
                mobileMenu.classList.remove('open');
            }
        });
    }

    // ── Hero particles ────────────────────────────────────────
    const particleContainer = document.getElementById('heroParticles');
    if (particleContainer) {
        for (let i = 0; i < 28; i++) {
            const p = document.createElement('div');
            p.className = 'particle';
            p.style.cssText = `
                left: ${Math.random() * 100}%;
                bottom: ${Math.random() * 30}%;
                --dur: ${6 + Math.random() * 8}s;
                --delay: ${Math.random() * 6}s;
                --drift: ${(Math.random() - 0.5) * 60}px;
                width: ${1 + Math.random() * 3}px;
                height: ${1 + Math.random() * 3}px;
                opacity: 0;
            `;
            particleContainer.appendChild(p);
        }
    }

    // ── Intersection Observer — fade in on scroll ─────────────
    const observerOptions = { threshold: 0.15, rootMargin: '0px 0px -50px 0px' };
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.culture-card, .festival-card, .story-card, .sidebar-card, .value-item').forEach((el, i) => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(24px)';
        el.style.transition = `opacity 0.5s ease ${i * 0.08}s, transform 0.5s ease ${i * 0.08}s`;
        observer.observe(el);
    });

    // Add visible class handler
    const visibilityObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                visibilityObserver.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.culture-card, .festival-card, .story-card, .sidebar-card, .value-item').forEach(el => {
        visibilityObserver.observe(el);
    });

    // ── India Map interactivity ───────────────────────────────
    const mapPaths = document.querySelectorAll('.state-path');
    const tooltip = document.getElementById('mapTooltip');

    if (tooltip) {
        mapPaths.forEach(path => {
            path.addEventListener('mouseenter', (e) => {
                const stateName = path.getAttribute('data-state') || 'India';
                tooltip.textContent = stateName;
                tooltip.classList.add('visible');
            });
            path.addEventListener('mousemove', (e) => {
                const rect = path.closest('.india-map-wrapper').getBoundingClientRect();
                tooltip.style.left = (e.clientX - rect.left + 12) + 'px';
                tooltip.style.top  = (e.clientY - rect.top - 30) + 'px';
            });
            path.addEventListener('mouseleave', () => {
                tooltip.classList.remove('visible');
            });
            path.addEventListener('click', () => {
                const state = path.getAttribute('data-state');
                if (state) {
                    window.location.href = `pages/cultures.php?state=${encodeURIComponent(state)}`;
                }
            });
        });
    }

    // ── Filter tabs (Cultures page) ───────────────────────────
    const filterTabs = document.querySelectorAll('.filter-tab');
    const cultureCards = document.querySelectorAll('.culture-card[data-category]');

    filterTabs.forEach(tab => {
        tab.addEventListener('click', () => {
            filterTabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
            const cat = tab.getAttribute('data-filter');
            cultureCards.forEach(card => {
                if (cat === 'all' || card.getAttribute('data-category') === cat) {
                    card.style.display = 'block';
                    card.style.animation = 'fadeIn 0.4s ease forwards';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    // ── Newsletter form ───────────────────────────────────────
    const newsletterForm = document.getElementById('newsletterForm');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value;
            if (!email) return;
            fetch('ajax/newsletter.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'email=' + encodeURIComponent(email)
            })
            .then(r => r.json())
            .then(data => {
                const msg = newsletterForm.parentElement.querySelector('.newsletter-msg');
                if (msg) {
                    msg.textContent = data.message;
                    msg.style.color = data.success ? '#80e090' : '#f08070';
                }
                if (data.success) newsletterForm.reset();
            })
            .catch(() => {});
        });
    }

    // ── Animate stat numbers ──────────────────────────────────
    const statNums = document.querySelectorAll('.stat-number[data-count]');
    const statObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const el = entry.target;
                const target = parseInt(el.getAttribute('data-count'));
                const suffix = el.getAttribute('data-suffix') || '';
                let current = 0;
                const step = Math.ceil(target / 60);
                const timer = setInterval(() => {
                    current = Math.min(current + step, target);
                    el.textContent = current + suffix;
                    if (current >= target) clearInterval(timer);
                }, 20);
                statObserver.unobserve(el);
            }
        });
    }, { threshold: 0.5 });
    statNums.forEach(el => statObserver.observe(el));

    // ── Smooth scroll for anchor links ───────────────────────
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

});

// CSS fade-in keyframe injection
const style = document.createElement('style');
style.textContent = `@keyframes fadeIn { from { opacity: 0; transform: scale(0.97); } to { opacity: 1; transform: scale(1); } }`;
document.head.appendChild(style);

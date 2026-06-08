// ── Navbar shadow on scroll ────────────────────────────────────────────────
const header = document.querySelector('header');
if (header) {
    window.addEventListener('scroll', () => {
        header.classList.toggle('scrolled', window.scrollY > 10);
    });
}

// ── Scroll-reveal (fade-in cards/sections as they enter viewport) ──────────
const revealEls = document.querySelectorAll('.article, .fackcards article, .sponsors, .articleplus, .detail-container');
const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry, i) => {
        if (entry.isIntersecting) {
            // stagger: each card waits a bit longer
            setTimeout(() => {
                entry.target.classList.add('visible');
            }, i * 80);
            observer.unobserve(entry.target);
        }
    });
}, { threshold: 0.1 });
revealEls.forEach(el => {
    el.classList.add('reveal');
    observer.observe(el);
});

// ── Active nav link highlight ──────────────────────────────────────────────
const navLinks = document.querySelectorAll('header nav a:not(.exit)');
navLinks.forEach(link => {
    if (link.href === location.href) link.classList.add('active');
});

// ── Toast notification ─────────────────────────────────────────────────────
function showToast(msg, type = 'success') {
    const t = document.createElement('div');
    t.className = `toast toast-${type}`;
    t.textContent = msg;
    document.body.appendChild(t);
    requestAnimationFrame(() => t.classList.add('show'));
    setTimeout(() => {
        t.classList.remove('show');
        setTimeout(() => t.remove(), 400);
    }, 3000);
}

// ── Copy-RIB button feedback ───────────────────────────────────────────────
window.copyRib = function(rib) {
    navigator.clipboard.writeText(rib).then(() => {
        showToast('RIB copié : ' + rib);
    });
};

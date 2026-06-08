// ── Password toggle ────────────────────────────────────────────────────────
document.querySelectorAll('.toggle-pw').forEach(btn => {
    btn.addEventListener('click', () => {
        const input = btn.previousElementSibling;
        const isText = input.type === 'text';
        input.type = isText ? 'password' : 'text';
        btn.innerHTML = isText
            ? '<i class="fa-regular fa-eye"></i>'
            : '<i class="fa-regular fa-eye-slash"></i>';
    });
});

// ── Input focus — animate label ────────────────────────────────────────────
document.querySelectorAll('.form-group input').forEach(input => {
    const label = input.previousElementSibling;
    if (!label) return;
    const check = () => label.classList.toggle('active', input.value.length > 0 || document.activeElement === input);
    input.addEventListener('focus', check);
    input.addEventListener('blur', check);
    input.addEventListener('input', check);
    check();
});

// ── Ripple on submit button ────────────────────────────────────────────────
document.querySelectorAll('.btn-login').forEach(btn => {
    btn.addEventListener('click', function(e) {
        const r = document.createElement('span');
        r.className = 'ripple';
        const rect = btn.getBoundingClientRect();
        r.style.left = (e.clientX - rect.left) + 'px';
        r.style.top  = (e.clientY - rect.top)  + 'px';
        btn.appendChild(r);
        setTimeout(() => r.remove(), 600);
    });
});

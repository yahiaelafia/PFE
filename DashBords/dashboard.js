// ── Sidebar active link ────────────────────────────────────────────────────
document.querySelectorAll('.menu a').forEach(link => {
    if (link.href === location.href) link.classList.add('active');
});

// ── Image preview before upload ────────────────────────────────────────────
const fileInput = document.querySelector('input[type="file"]');
if (fileInput) {
    fileInput.addEventListener('change', () => {
        const file = fileInput.files[0];
        if (!file) return;
        let preview = document.getElementById('img-preview');
        if (!preview) {
            preview = document.createElement('img');
            preview.id = 'img-preview';
            preview.style.cssText = 'width:100%;max-height:200px;object-fit:cover;border-radius:10px;margin-top:10px;';
            fileInput.parentNode.insertBefore(preview, fileInput.nextSibling);
        }
        preview.src = URL.createObjectURL(file);
    });
}

// ── Auto-hide success message ──────────────────────────────────────────────
const msg = document.querySelector('.success-msg');
if (msg && msg.textContent.trim()) {
    setTimeout(() => {
        msg.style.transition = 'opacity 0.5s';
        msg.style.opacity = '0';
        setTimeout(() => msg.remove(), 500);
    }, 3500);
}

// ── Confirm delete with nicer modal ───────────────────────────────────────
document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', e => {
        e.preventDefault();
        const href = btn.href;
        const overlay = document.createElement('div');
        overlay.className = 'confirm-overlay';
        overlay.innerHTML = `
          <div class="confirm-box">
            <i class="fa-solid fa-triangle-exclamation" style="font-size:2rem;color:#e53935;"></i>
            <p>Êtes-vous sûr de vouloir supprimer cet élément ?</p>
            <div class="confirm-btns">
              <button class="cb-cancel">Annuler</button>
              <button class="cb-ok">Supprimer</button>
            </div>
          </div>`;
        document.body.appendChild(overlay);
        overlay.querySelector('.cb-cancel').onclick = () => overlay.remove();
        overlay.querySelector('.cb-ok').onclick = () => { location.href = href; };
    });
});

// ============================================================
// ADMIN — Élégance Menuiseries
// ============================================================

const API = '/api';
let csrfToken = '';
let contentData = {};

// ── Helpers ──────────────────────────────────────────────────

function toast(msg, error = false) {
  const el = document.getElementById('toast');
  el.textContent = msg;
  el.className = error ? 'toast toast--error' : 'toast';
  el.hidden = false;
  setTimeout(() => { el.hidden = true; }, 3000);
}

async function api(endpoint, options = {}) {
  const res = await fetch(`${API}/${endpoint}`, options);
  const data = await res.json();
  if (!res.ok) throw new Error(data.error || 'Erreur serveur');
  return data;
}

// ── Auth ─────────────────────────────────────────────────────

async function checkAuth() {
  try {
    const res = await api('auth.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ action: 'status' })
    });
    if (res.authenticated) {
      csrfToken = res.csrf_token;
      await loadContent();
      renderSection('links');
    } else {
      window.location.href = 'index.html';
    }
  } catch (e) {
    window.location.href = 'index.html';
  }
}

document.getElementById('logout-btn').addEventListener('click', async () => {
  await api('auth.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ action: 'logout' })
  });
  window.location.href = 'index.html';
});

// ── Content Loading ─────────────────────────────────────────

async function loadContent() {
  contentData = await api('content.php');
}

// ── Save Section ────────────────────────────────────────────

async function saveSection(section, data) {
  try {
    await api('content.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-Token': csrfToken
      },
      body: JSON.stringify({ section, data })
    });
    contentData[section] = data;
    toast('Sauvegardé avec succès');
  } catch (err) {
    toast(err.message, true);
  }
}

// ── Image Upload ────────────────────────────────────────────

function compressImage(file, maxWidth = 1920, quality = 0.82) {
  return new Promise((resolve) => {
    // SVG : pas de compression
    if (file.type === 'image/svg+xml') { resolve(file); return; }

    const img = new Image();
    const url = URL.createObjectURL(file);
    img.onload = () => {
      URL.revokeObjectURL(url);
      let w = img.width, h = img.height;
      if (w > maxWidth) { h = Math.round(h * maxWidth / w); w = maxWidth; }

      const canvas = document.createElement('canvas');
      canvas.width = w;
      canvas.height = h;
      canvas.getContext('2d').drawImage(img, 0, 0, w, h);

      canvas.toBlob(
        (blob) => {
          const name = file.name.replace(/\.\w+$/, '.jpg');
          resolve(new File([blob], name, { type: 'image/jpeg' }));
        },
        'image/jpeg',
        quality
      );
    };
    img.src = url;
  });
}

async function uploadImage(file) {
  const compressed = await compressImage(file);
  const form = new FormData();
  form.append('image', compressed);

  const res = await fetch(`${API}/upload.php`, {
    method: 'POST',
    headers: { 'X-CSRF-Token': csrfToken },
    body: form
  });

  const data = await res.json();
  if (!res.ok) throw new Error(data.error);
  return data.path;
}

function imageUploadHTML(currentSrc, inputId) {
  return `
    <div class="image-upload">
      <img class="image-upload__preview" src="/${currentSrc}" alt="" id="preview-${inputId}">
      <div>
        <input type="file" id="file-${inputId}" accept="image/*" style="display:none">
        <button type="button" class="image-upload__btn" onclick="document.getElementById('file-${inputId}').click()">Choisir une image</button>
        <input type="hidden" id="${inputId}" value="${currentSrc}">
        <p class="form-hint">JPG, PNG, WEBP ou SVG — compression auto pour le web</p>
      </div>
    </div>
  `;
}

function initImageUploads() {
  document.querySelectorAll('[id^="file-"]').forEach(input => {
    input.addEventListener('change', async (e) => {
      const file = e.target.files[0];
      if (!file) return;

      const inputId = input.id.replace('file-', '');
      const preview = document.getElementById('preview-' + inputId);
      const hidden = document.getElementById(inputId);

      try {
        const path = await uploadImage(file);
        preview.src = '/' + path;
        hidden.value = path;
        toast('Image uploadée');
      } catch (err) {
        toast(err.message, true);
      }
    });
  });
}

// ── Tab Navigation ──────────────────────────────────────────

document.querySelectorAll('.dashboard__tab').forEach(tab => {
  tab.addEventListener('click', () => {
    document.querySelectorAll('.dashboard__tab').forEach(t => t.classList.remove('dashboard__tab--active'));
    tab.classList.add('dashboard__tab--active');
    renderSection(tab.dataset.section);
  });
});

// ── Section Renderers ───────────────────────────────────────

function renderSection(section) {
  const container = document.getElementById('dashboard-content');
  const renderers = {
    links: renderLinks,
    hero: renderHero,
    promesse: renderPromesse,
    gamme: renderGamme,
    atouts: renderAtouts,
    methode: renderMethode,
    temoignages: renderTemoignages,
    cta: renderCTA,
    footer: renderFooter,
    meta: renderMeta,
    page_volets: renderPageVolets,
    page_garage: renderPageGarage,
    page_portails: renderPagePortails,
    page_alu: renderPageALU,
    page_pvc: renderPagePVC
  };

  if (renderers[section]) {
    container.innerHTML = renderers[section]();
    initImageUploads();
  }
}

function renderLinks() {
  const d = contentData.links || {};
  return `
    <div class="form-section">
      <h2 class="form-section__title">Liens & URLs</h2>
      <div class="form-group">
        <label class="form-label">URL du bouton "Réserver" (hero + footer)</label>
        <input class="form-input" id="links-cta_url" value="${e(d.cta_url || '')}">
        <p class="form-hint">Ex: https://calendly.com/votre-lien ou #contact</p>
      </div>
      <div class="form-group">
        <label class="form-label">URL Facebook</label>
        <input class="form-input" id="links-facebook_url" value="${e(d.facebook_url || '')}">
      </div>
      <div class="form-group">
        <label class="form-label">URL Instagram</label>
        <input class="form-input" id="links-instagram_url" value="${e(d.instagram_url || '')}">
      </div>
      <button class="save-btn" onclick="saveLinks()">Sauvegarder</button>
    </div>
  `;
}

function renderHero() {
  const d = contentData.hero || {};
  return `
    <div class="form-section">
      <h2 class="form-section__title">Section Hero</h2>
      <div class="form-group">
        <label class="form-label">Titre principal</label>
        <textarea class="form-textarea" id="hero-title" rows="2">${e(d.title || '')}</textarea>
      </div>
      <div class="form-group">
        <label class="form-label">Texte du bouton CTA</label>
        <input class="form-input" id="hero-cta_label" value="${e(d.cta_label || '')}">
      </div>
      <div class="form-group">
        <label class="form-label">Tagline SEO (h1)</label>
        <textarea class="form-textarea" id="hero-tagline" rows="2">${e(d.tagline || '')}</textarea>
      </div>
      <div class="form-group">
        <label class="form-label">Image de fond</label>
        ${imageUploadHTML(d.background_image || '', 'hero-bg')}
      </div>
      <button class="save-btn" onclick="saveHero()">Sauvegarder</button>
    </div>
  `;
}

function renderPromesse() {
  const d = contentData.promesse || {};
  const photos = d.photos || [];
  return `
    <div class="form-section">
      <h2 class="form-section__title">La Promesse Élégance</h2>
      <p class="form-hint" style="margin-bottom:16px">Cette section est partagée entre la page d'accueil et toutes les pages produits.</p>
      <div class="form-group">
        <label class="form-label">Label de section</label>
        <input class="form-input" id="promesse-label" value="${e(d.label || '')}">
      </div>
      <div class="form-group">
        <label class="form-label">Texte</label>
        <textarea class="form-textarea" id="promesse-body" rows="3">${e(d.body || '')}</textarea>
      </div>
    </div>
    <div class="form-section">
      <h2 class="form-section__title">Photos Promesse (pages produits)</h2>
      <div class="form-group">
        <label class="form-label">Photo 1 — Grande (gauche)</label>
        ${imageUploadHTML(photos[0] || '', 'promesse-photo-0')}
      </div>
      <div class="form-group">
        <label class="form-label">Photo 2 — Petite (droite)</label>
        ${imageUploadHTML(photos[1] || '', 'promesse-photo-1')}
      </div>
      <div class="form-group">
        <label class="form-label">Photo 3 — Moyenne (centre-bas)</label>
        ${imageUploadHTML(photos[2] || '', 'promesse-photo-2')}
      </div>
    </div>
    <button class="save-btn" onclick="savePromesse()">Sauvegarder</button>
  `;
}

function renderGamme() {
  const d = contentData.gamme || {};
  const produits = d.produits || [];
  let html = `
    <div class="form-section">
      <h2 class="form-section__title">Gamme de menuiseries</h2>
      <div class="form-group">
        <label class="form-label">Label de section</label>
        <input class="form-input" id="gamme-label" value="${e(d.label || '')}">
      </div>
      <div class="form-group">
        <label class="form-label">Description</label>
        <textarea class="form-textarea" id="gamme-description" rows="2">${e(d.description || '')}</textarea>
      </div>
    </div>
  `;

  produits.forEach((p, i) => {
    html += `
      <div class="form-section repeater-item">
        <div class="repeater-item__header">Produit ${i + 1} — ${p.label.replace(/<br>/g, ' ')}</div>
        <div class="form-group">
          <label class="form-label">Nom du produit</label>
          <input class="form-input" id="gamme-prod-${i}-label" value="${e(p.label || '')}">
          <p class="form-hint">Utiliser &lt;br&gt; pour un retour à la ligne</p>
        </div>
        <div class="form-group">
          <label class="form-label">Image</label>
          ${imageUploadHTML(p.image || '', `gamme-prod-${i}-img`)}
        </div>
      </div>
    `;
  });

  html += `<button class="save-btn" onclick="saveGamme()">Sauvegarder</button>`;
  return html;
}

function renderAtouts() {
  const atouts = contentData.atouts || [];
  let html = '';

  atouts.forEach((a, i) => {
    html += `
      <div class="form-section repeater-item">
        <div class="repeater-item__header">Atout ${i + 1}</div>
        <div class="form-group">
          <label class="form-label">Titre</label>
          <input class="form-input" id="atout-${i}-titre" value="${e(a.titre || '')}">
        </div>
        <div class="form-group">
          <label class="form-label">Texte</label>
          <textarea class="form-textarea" id="atout-${i}-texte" rows="3">${e(a.texte || '')}</textarea>
        </div>
        <div class="form-group">
          <label class="form-label">Image</label>
          ${imageUploadHTML(a.image || '', `atout-${i}-img`)}
        </div>
        <div class="form-group">
          <label class="form-label">Texte alternatif image</label>
          <input class="form-input" id="atout-${i}-alt" value="${e(a.alt || '')}">
        </div>
        ${a.logo ? `
        <div class="form-group">
          <label class="form-label">Logo (atout 3 uniquement)</label>
          ${imageUploadHTML(a.logo, `atout-${i}-logo`)}
        </div>` : ''}
      </div>
    `;
  });

  html += `<button class="save-btn" onclick="saveAtouts()">Sauvegarder</button>`;
  return html;
}

function renderMethode() {
  const d = contentData.methode || {};
  const etapes = d.etapes || [];

  let html = `
    <div class="form-section">
      <h2 class="form-section__title">Notre méthode</h2>
      <div class="form-group">
        <label class="form-label">Label de section</label>
        <input class="form-input" id="methode-label" value="${e(d.label || '')}">
      </div>
      <div class="form-group">
        <label class="form-label">Introduction</label>
        <textarea class="form-textarea" id="methode-intro" rows="2">${e(d.intro || '')}</textarea>
      </div>
    </div>
  `;

  etapes.forEach((et, i) => {
    html += `
      <div class="form-section repeater-item">
        <div class="repeater-item__header">Étape ${i + 1}</div>
        <div class="form-group">
          <label class="form-label">Titre</label>
          <input class="form-input" id="etape-${i}-titre" value="${e(et.titre || '')}">
        </div>
        <div class="form-group">
          <label class="form-label">Description</label>
          <textarea class="form-textarea" id="etape-${i}-desc" rows="2">${e(et.description || '')}</textarea>
        </div>
      </div>
    `;
  });

  html += `<button class="save-btn" onclick="saveMethode()">Sauvegarder</button>`;
  return html;
}

function renderTemoignages() {
  const temoignages = contentData.temoignages || [];
  let html = '';

  temoignages.forEach((t, i) => {
    html += `
      <div class="form-section repeater-item">
        <div class="repeater-item__header">Témoignage ${i + 1}</div>
        <div class="form-group">
          <label class="form-label">Citation</label>
          <textarea class="form-textarea" id="temo-${i}-quote" rows="2">${e(t.quote || '')}</textarea>
        </div>
        <div class="form-group">
          <label class="form-label">Auteur</label>
          <input class="form-input" id="temo-${i}-author" value="${e(t.author || '')}">
        </div>
        <div class="form-group">
          <label class="form-label">Ville</label>
          <input class="form-input" id="temo-${i}-location" value="${e(t.location || '')}">
        </div>
        <div class="form-group">
          <label class="form-label">Photo</label>
          ${imageUploadHTML(t.photo || '', `temo-${i}-photo`)}
        </div>
      </div>
    `;
  });

  html += `<button class="save-btn" onclick="saveTemoignages()">Sauvegarder</button>`;
  return html;
}

function renderCTA() {
  const d = contentData.cta || {};
  return `
    <div class="form-section">
      <h2 class="form-section__title">Section CTA / Contact</h2>
      <div class="form-group">
        <label class="form-label">Texte d'accroche</label>
        <textarea class="form-textarea" id="cta-texte" rows="3">${e(d.texte || '')}</textarea>
      </div>
      <button class="save-btn" onclick="saveCTA()">Sauvegarder</button>
    </div>
  `;
}

function renderFooter() {
  const d = contentData.footer || {};
  const links = d.legal_links || [];

  return `
    <div class="form-section">
      <h2 class="form-section__title">Footer</h2>
      <div class="form-group">
        <label class="form-label">Nom de l'entreprise</label>
        <input class="form-input" id="footer-nom" value="${e(d.nom || '')}">
      </div>
      <div class="form-group">
        <label class="form-label">Adresse 1</label>
        <input class="form-input" id="footer-adresse" value="${e(d.adresse || '')}">
      </div>
      <div class="form-group">
        <label class="form-label">Adresse 2</label>
        <input class="form-input" id="footer-adresse2" value="${e(d.adresse2 || '')}">
      </div>
      <div class="form-group">
        <label class="form-label">Téléphone</label>
        <input class="form-input" id="footer-telephone" value="${e(d.telephone || '')}">
      </div>
      <div class="form-group">
        <label class="form-label">Email</label>
        <input class="form-input" id="footer-email" value="${e(d.email || '')}">
      </div>
      <div class="form-group">
        <label class="form-label">Texte bouton CTA</label>
        <input class="form-input" id="footer-cta_label" value="${e(d.cta_label || '')}">
      </div>
      <div class="form-group">
        <label class="form-label">Crédit</label>
        <input class="form-input" id="footer-credit" value="${e(d.credit || '')}">
      </div>
      <div class="form-group">
        <label class="form-label">URL du crédit</label>
        <input class="form-input" id="footer-credit_url" value="${e(d.credit_url || '')}">
        <p class="form-hint">Ex: https://www.tymeo.com</p>
      </div>
      ${links.map((l, i) => `
      <div class="form-group">
        <label class="form-label">Lien légal ${i + 1} — Texte</label>
        <input class="form-input" id="footer-legal-${i}-label" value="${e(l.label || '')}">
        <label class="form-label" style="margin-top:8px">URL</label>
        <input class="form-input" id="footer-legal-${i}-url" value="${e(l.url || '')}">
      </div>
      `).join('')}
      <button class="save-btn" onclick="saveFooter()">Sauvegarder</button>
    </div>
  `;
}

function renderMeta() {
  const d = contentData.meta || {};
  return `
    <div class="form-section">
      <h2 class="form-section__title">SEO / Meta</h2>
      <div class="form-group">
        <label class="form-label">Titre de la page (balise title)</label>
        <input class="form-input" id="meta-title" value="${e(d.title || '')}">
      </div>
      <div class="form-group">
        <label class="form-label">Meta description</label>
        <textarea class="form-textarea" id="meta-description" rows="2">${e(d.description || '')}</textarea>
      </div>
      <button class="save-btn" onclick="saveMeta()">Sauvegarder</button>
    </div>
  `;
}

function renderPageVolets() {
  const d = contentData.page_volets || {};
  const meta = d.meta || {};
  const hero = d.hero || {};
  const blocs = d.blocs || [];
  const pf = d.points_forts || [];

  let html = `
    <div class="form-section">
      <h2 class="form-section__title">Page Volets — SEO</h2>
      <div class="form-group"><label class="form-label">Titre de la page</label><input class="form-input" id="vol-meta-title" value="${e(meta.title || '')}"></div>
      <div class="form-group"><label class="form-label">Meta description</label><textarea class="form-textarea" id="vol-meta-desc" rows="2">${e(meta.description || '')}</textarea></div>
    </div>
    <div class="form-section">
      <h2 class="form-section__title">Page Volets — Hero</h2>
      <div class="form-group"><label class="form-label">Titre (\\n pour retour à la ligne)</label><textarea class="form-textarea" id="vol-hero-title" rows="3">${e(hero.title || '')}</textarea></div>
      <div class="form-group"><label class="form-label">Tagline SEO (h1)</label><input class="form-input" id="vol-hero-tagline" value="${e(hero.tagline || '')}"></div>
      <div class="form-group"><label class="form-label">Image de fond</label>${imageUploadHTML(hero.background_image || '', 'vol-hero-bg')}</div>
    </div>
    <div class="form-section">
      <h2 class="form-section__title">Page Volets — Introduction</h2>
      <div class="form-group"><label class="form-label">Texte d'introduction</label><textarea class="form-textarea" id="vol-intro" rows="3">${e(d.intro || '')}</textarea></div>
    </div>`;

  blocs.forEach((b, i) => {
    html += `<div class="form-section repeater-item"><div class="repeater-item__header">Bloc ${i + 1} — ${b.titre}</div>
      <div class="form-group"><label class="form-label">Titre</label><input class="form-input" id="vol-bloc-${i}-titre" value="${e(b.titre || '')}"></div>
      <div class="form-group"><label class="form-label">Texte</label><textarea class="form-textarea" id="vol-bloc-${i}-texte" rows="3">${e(b.texte || '')}</textarea></div>
      <div class="form-group"><label class="form-label">Image</label>${imageUploadHTML(b.image || '', `vol-bloc-${i}-img`)}</div>
      <div class="form-group"><label class="form-label">Texte alternatif image</label><input class="form-input" id="vol-bloc-${i}-alt" value="${e(b.alt || '')}"></div>
    </div>`;
  });

  html += `<div class="form-section"><h2 class="form-section__title">Points forts</h2>`;
  pf.forEach((label, i) => {
    html += `<div class="form-group"><label class="form-label">Point fort ${i + 1}</label><input class="form-input" id="vol-pf-${i}" value="${e(label.replace(/\n/g, ' '))}"></div>`;
  });
  html += `</div><button class="save-btn" onclick="savePageVolets()">Sauvegarder</button>`;
  return html;
}

function renderPageGarage() {
  const d = contentData.page_garage || {};
  const meta = d.meta || {};
  const hero = d.hero || {};
  const blocs = d.blocs || [];
  const pf = d.points_forts || [];

  let html = `
    <div class="form-section">
      <h2 class="form-section__title">Page Garage — SEO</h2>
      <div class="form-group"><label class="form-label">Titre de la page</label><input class="form-input" id="gar-meta-title" value="${e(meta.title || '')}"></div>
      <div class="form-group"><label class="form-label">Meta description</label><textarea class="form-textarea" id="gar-meta-desc" rows="2">${e(meta.description || '')}</textarea></div>
    </div>
    <div class="form-section">
      <h2 class="form-section__title">Page Garage — Hero</h2>
      <div class="form-group"><label class="form-label">Titre (\\n pour retour à la ligne)</label><textarea class="form-textarea" id="gar-hero-title" rows="3">${e(hero.title || '')}</textarea></div>
      <div class="form-group"><label class="form-label">Tagline SEO (h1)</label><input class="form-input" id="gar-hero-tagline" value="${e(hero.tagline || '')}"></div>
      <div class="form-group"><label class="form-label">Image de fond</label>${imageUploadHTML(hero.background_image || '', 'gar-hero-bg')}</div>
    </div>
    <div class="form-section">
      <h2 class="form-section__title">Page Garage — Introduction</h2>
      <div class="form-group"><label class="form-label">Texte d'introduction</label><textarea class="form-textarea" id="gar-intro" rows="3">${e(d.intro || '')}</textarea></div>
    </div>`;

  blocs.forEach((b, i) => {
    html += `<div class="form-section repeater-item"><div class="repeater-item__header">Bloc ${i + 1} — ${b.titre}</div>
      <div class="form-group"><label class="form-label">Titre</label><input class="form-input" id="gar-bloc-${i}-titre" value="${e(b.titre || '')}"></div>
      <div class="form-group"><label class="form-label">Texte</label><textarea class="form-textarea" id="gar-bloc-${i}-texte" rows="3">${e(b.texte || '')}</textarea></div>
      <div class="form-group"><label class="form-label">Image</label>${imageUploadHTML(b.image || '', `gar-bloc-${i}-img`)}</div>
      <div class="form-group"><label class="form-label">Texte alternatif image</label><input class="form-input" id="gar-bloc-${i}-alt" value="${e(b.alt || '')}"></div>
    </div>`;
  });

  html += `<div class="form-section"><h2 class="form-section__title">Points forts</h2>`;
  pf.forEach((label, i) => {
    html += `<div class="form-group"><label class="form-label">Point fort ${i + 1}</label><input class="form-input" id="gar-pf-${i}" value="${e(label.replace(/\n/g, ' '))}"></div>`;
  });
  html += `</div><button class="save-btn" onclick="savePageGarage()">Sauvegarder</button>`;
  return html;
}

function renderPagePortails() {
  const d = contentData.page_portails || {};
  const meta = d.meta || {};
  const hero = d.hero || {};
  const blocs = d.blocs || [];
  const pf = d.points_forts || [];

  let html = `
    <div class="form-section">
      <h2 class="form-section__title">Page Portails — SEO</h2>
      <div class="form-group"><label class="form-label">Titre de la page</label><input class="form-input" id="port-meta-title" value="${e(meta.title || '')}"></div>
      <div class="form-group"><label class="form-label">Meta description</label><textarea class="form-textarea" id="port-meta-desc" rows="2">${e(meta.description || '')}</textarea></div>
    </div>
    <div class="form-section">
      <h2 class="form-section__title">Page Portails — Hero</h2>
      <div class="form-group"><label class="form-label">Titre (\\n pour retour à la ligne)</label><textarea class="form-textarea" id="port-hero-title" rows="3">${e(hero.title || '')}</textarea></div>
      <div class="form-group"><label class="form-label">Tagline SEO (h1)</label><input class="form-input" id="port-hero-tagline" value="${e(hero.tagline || '')}"></div>
      <div class="form-group"><label class="form-label">Image de fond</label>${imageUploadHTML(hero.background_image || '', 'port-hero-bg')}</div>
    </div>
    <div class="form-section">
      <h2 class="form-section__title">Page Portails — Introduction</h2>
      <div class="form-group"><label class="form-label">Texte d'introduction</label><textarea class="form-textarea" id="port-intro" rows="3">${e(d.intro || '')}</textarea></div>
    </div>`;

  blocs.forEach((b, i) => {
    html += `<div class="form-section repeater-item"><div class="repeater-item__header">Bloc ${i + 1} — ${b.titre}</div>
      <div class="form-group"><label class="form-label">Titre</label><input class="form-input" id="port-bloc-${i}-titre" value="${e(b.titre || '')}"></div>
      <div class="form-group"><label class="form-label">Texte</label><textarea class="form-textarea" id="port-bloc-${i}-texte" rows="3">${e(b.texte || '')}</textarea></div>
      <div class="form-group"><label class="form-label">Image</label>${imageUploadHTML(b.image || '', `port-bloc-${i}-img`)}</div>
      <div class="form-group"><label class="form-label">Texte alternatif image</label><input class="form-input" id="port-bloc-${i}-alt" value="${e(b.alt || '')}"></div>
    </div>`;
  });

  html += `<div class="form-section"><h2 class="form-section__title">Points forts</h2>`;
  pf.forEach((label, i) => {
    html += `<div class="form-group"><label class="form-label">Point fort ${i + 1}</label><input class="form-input" id="port-pf-${i}" value="${e(label.replace(/\n/g, ' '))}"></div>`;
  });
  html += `</div><button class="save-btn" onclick="savePagePortails()">Sauvegarder</button>`;
  return html;
}

function renderPageALU() {
  const d = contentData.page_alu || {};
  const meta = d.meta || {};
  const hero = d.hero || {};
  const blocs = d.blocs || [];
  const pf = d.points_forts || [];

  let html = `
    <div class="form-section">
      <h2 class="form-section__title">Page ALU — SEO</h2>
      <div class="form-group">
        <label class="form-label">Titre de la page</label>
        <input class="form-input" id="alu-meta-title" value="${e(meta.title || '')}">
      </div>
      <div class="form-group">
        <label class="form-label">Meta description</label>
        <textarea class="form-textarea" id="alu-meta-desc" rows="2">${e(meta.description || '')}</textarea>
      </div>
    </div>

    <div class="form-section">
      <h2 class="form-section__title">Page ALU — Hero</h2>
      <div class="form-group">
        <label class="form-label">Titre (\\n pour retour à la ligne)</label>
        <textarea class="form-textarea" id="alu-hero-title" rows="3">${e(hero.title || '')}</textarea>
      </div>
      <div class="form-group">
        <label class="form-label">Tagline SEO (h1)</label>
        <input class="form-input" id="alu-hero-tagline" value="${e(hero.tagline || '')}">
      </div>
      <div class="form-group">
        <label class="form-label">Image de fond</label>
        ${imageUploadHTML(hero.background_image || '', 'alu-hero-bg')}
      </div>
    </div>

    <div class="form-section">
      <h2 class="form-section__title">Page ALU — Introduction</h2>
      <div class="form-group">
        <label class="form-label">Texte d'introduction</label>
        <textarea class="form-textarea" id="alu-intro" rows="3">${e(d.intro || '')}</textarea>
      </div>
    </div>
  `;

  blocs.forEach((b, i) => {
    html += `
      <div class="form-section repeater-item">
        <div class="repeater-item__header">Bloc ${i + 1} — ${b.titre}</div>
        <div class="form-group">
          <label class="form-label">Titre</label>
          <input class="form-input" id="alu-bloc-${i}-titre" value="${e(b.titre || '')}">
        </div>
        <div class="form-group">
          <label class="form-label">Texte</label>
          <textarea class="form-textarea" id="alu-bloc-${i}-texte" rows="3">${e(b.texte || '')}</textarea>
        </div>
        <div class="form-group">
          <label class="form-label">Image</label>
          ${imageUploadHTML(b.image || '', `alu-bloc-${i}-img`)}
        </div>
        <div class="form-group">
          <label class="form-label">Texte alternatif image</label>
          <input class="form-input" id="alu-bloc-${i}-alt" value="${e(b.alt || '')}">
        </div>
      </div>
    `;
  });

  html += `<div class="form-section"><h2 class="form-section__title">Points forts (légendes icônes)</h2>`;
  pf.forEach((label, i) => {
    html += `
      <div class="form-group">
        <label class="form-label">Point fort ${i + 1}</label>
        <input class="form-input" id="alu-pf-${i}" value="${e(label.replace(/\n/g, ' '))}">
      </div>
    `;
  });
  html += `</div><button class="save-btn" onclick="savePageALU()">Sauvegarder</button>`;
  return html;
}

function renderPagePVC() {
  const d = contentData.page_pvc || {};
  const meta = d.meta || {};
  const hero = d.hero || {};
  const blocs = d.blocs || [];
  const pf = d.points_forts || [];

  let html = `
    <div class="form-section">
      <h2 class="form-section__title">Page PVC — SEO</h2>
      <div class="form-group">
        <label class="form-label">Titre de la page</label>
        <input class="form-input" id="pvc-meta-title" value="${e(meta.title || '')}">
      </div>
      <div class="form-group">
        <label class="form-label">Meta description</label>
        <textarea class="form-textarea" id="pvc-meta-desc" rows="2">${e(meta.description || '')}</textarea>
      </div>
    </div>

    <div class="form-section">
      <h2 class="form-section__title">Page PVC — Hero</h2>
      <div class="form-group">
        <label class="form-label">Titre (\\n pour retour à la ligne)</label>
        <textarea class="form-textarea" id="pvc-hero-title" rows="3">${e(hero.title || '')}</textarea>
      </div>
      <div class="form-group">
        <label class="form-label">Tagline SEO (h1)</label>
        <input class="form-input" id="pvc-hero-tagline" value="${e(hero.tagline || '')}">
      </div>
      <div class="form-group">
        <label class="form-label">Image de fond</label>
        ${imageUploadHTML(hero.background_image || '', 'pvc-hero-bg')}
      </div>
    </div>

    <div class="form-section">
      <h2 class="form-section__title">Page PVC — Introduction</h2>
      <div class="form-group">
        <label class="form-label">Texte d'introduction</label>
        <textarea class="form-textarea" id="pvc-intro" rows="3">${e(d.intro || '')}</textarea>
      </div>
    </div>
  `;

  blocs.forEach((b, i) => {
    html += `
      <div class="form-section repeater-item">
        <div class="repeater-item__header">Bloc ${i + 1} — ${b.titre}</div>
        <div class="form-group">
          <label class="form-label">Titre</label>
          <input class="form-input" id="pvc-bloc-${i}-titre" value="${e(b.titre || '')}">
        </div>
        <div class="form-group">
          <label class="form-label">Texte</label>
          <textarea class="form-textarea" id="pvc-bloc-${i}-texte" rows="3">${e(b.texte || '')}</textarea>
        </div>
        <div class="form-group">
          <label class="form-label">Image</label>
          ${imageUploadHTML(b.image || '', `pvc-bloc-${i}-img`)}
        </div>
        <div class="form-group">
          <label class="form-label">Texte alternatif image</label>
          <input class="form-input" id="pvc-bloc-${i}-alt" value="${e(b.alt || '')}">
        </div>
      </div>
    `;
  });

  html += `
    <div class="form-section">
      <h2 class="form-section__title">Points forts (légendes icônes)</h2>
  `;
  pf.forEach((label, i) => {
    html += `
      <div class="form-group">
        <label class="form-label">Point fort ${i + 1}</label>
        <input class="form-input" id="pvc-pf-${i}" value="${e(label.replace(/\n/g, ' '))}">
        <p class="form-hint">Utilisez un espace pour séparer les lignes (le retour à la ligne est automatique)</p>
      </div>
    `;
  });

  html += `
    </div>
    <button class="save-btn" onclick="savePagePVC()">Sauvegarder</button>
  `;
  return html;
}

// ── Save Functions ──────────────────────────────────────────

function v(id) { return document.getElementById(id).value; }

function saveLinks() {
  saveSection('links', {
    cta_url: v('links-cta_url'),
    facebook_url: v('links-facebook_url'),
    instagram_url: v('links-instagram_url')
  });
}

function saveHero() {
  saveSection('hero', {
    title: v('hero-title'),
    cta_label: v('hero-cta_label'),
    tagline: v('hero-tagline'),
    background_image: v('hero-bg')
  });
}

function savePromesse() {
  saveSection('promesse', {
    label: v('promesse-label'),
    body: v('promesse-body'),
    photos: [
      v('promesse-photo-0'),
      v('promesse-photo-1'),
      v('promesse-photo-2')
    ]
  });
}

function saveGamme() {
  const produits = (contentData.gamme?.produits || []).map((p, i) => ({
    id: p.id,
    label: v(`gamme-prod-${i}-label`),
    image: v(`gamme-prod-${i}-img`)
  }));

  saveSection('gamme', {
    label: v('gamme-label'),
    description: v('gamme-description'),
    produits
  });
}

function saveAtouts() {
  const atouts = (contentData.atouts || []).map((a, i) => {
    const data = {
      titre: v(`atout-${i}-titre`),
      texte: v(`atout-${i}-texte`),
      image: v(`atout-${i}-img`),
      alt: v(`atout-${i}-alt`)
    };
    const logoEl = document.getElementById(`atout-${i}-logo`);
    if (logoEl) data.logo = logoEl.value;
    return data;
  });

  saveSection('atouts', atouts);
}

function saveMethode() {
  const etapes = (contentData.methode?.etapes || []).map((_, i) => ({
    titre: v(`etape-${i}-titre`),
    description: v(`etape-${i}-desc`)
  }));

  saveSection('methode', {
    label: v('methode-label'),
    intro: v('methode-intro'),
    etapes
  });
}

function saveTemoignages() {
  const temoignages = (contentData.temoignages || []).map((_, i) => ({
    quote: v(`temo-${i}-quote`),
    author: v(`temo-${i}-author`),
    location: v(`temo-${i}-location`),
    photo: v(`temo-${i}-photo`)
  }));

  saveSection('temoignages', temoignages);
}

function saveCTA() {
  saveSection('cta', { texte: v('cta-texte') });
}

function saveFooter() {
  const legal_links = (contentData.footer?.legal_links || []).map((_, i) => ({
    label: v(`footer-legal-${i}-label`),
    url: v(`footer-legal-${i}-url`)
  }));

  saveSection('footer', {
    nom: v('footer-nom'),
    adresse: v('footer-adresse'),
    adresse2: v('footer-adresse2'),
    telephone: v('footer-telephone'),
    email: v('footer-email'),
    cta_label: v('footer-cta_label'),
    credit: v('footer-credit'),
    credit_url: v('footer-credit_url'),
    legal_links
  });
}

function saveMeta() {
  saveSection('meta', {
    title: v('meta-title'),
    description: v('meta-description')
  });
}

function savePageVolets() {
  const blocs = (contentData.page_volets?.blocs || []).map((_, i) => ({
    titre: v(`vol-bloc-${i}-titre`),
    texte: v(`vol-bloc-${i}-texte`),
    image: v(`vol-bloc-${i}-img`),
    alt: v(`vol-bloc-${i}-alt`)
  }));
  const points_forts = (contentData.page_volets?.points_forts || []).map((_, i) => v(`vol-pf-${i}`));
  saveSection('page_volets', {
    meta: { title: v('vol-meta-title'), description: v('vol-meta-desc') },
    hero: { title: v('vol-hero-title'), tagline: v('vol-hero-tagline'), background_image: v('vol-hero-bg') },
    intro: v('vol-intro'),
    blocs,
    points_forts
  });
}

function savePageGarage() {
  const blocs = (contentData.page_garage?.blocs || []).map((_, i) => ({
    titre: v(`gar-bloc-${i}-titre`),
    texte: v(`gar-bloc-${i}-texte`),
    image: v(`gar-bloc-${i}-img`),
    alt: v(`gar-bloc-${i}-alt`)
  }));
  const points_forts = (contentData.page_garage?.points_forts || []).map((_, i) => v(`gar-pf-${i}`));
  saveSection('page_garage', {
    meta: { title: v('gar-meta-title'), description: v('gar-meta-desc') },
    hero: { title: v('gar-hero-title'), tagline: v('gar-hero-tagline'), background_image: v('gar-hero-bg') },
    intro: v('gar-intro'),
    blocs,
    points_forts
  });
}

function savePagePortails() {
  const blocs = (contentData.page_portails?.blocs || []).map((_, i) => ({
    titre: v(`port-bloc-${i}-titre`),
    texte: v(`port-bloc-${i}-texte`),
    image: v(`port-bloc-${i}-img`),
    alt: v(`port-bloc-${i}-alt`)
  }));
  const points_forts = (contentData.page_portails?.points_forts || []).map((_, i) => v(`port-pf-${i}`));
  saveSection('page_portails', {
    meta: { title: v('port-meta-title'), description: v('port-meta-desc') },
    hero: { title: v('port-hero-title'), tagline: v('port-hero-tagline'), background_image: v('port-hero-bg') },
    intro: v('port-intro'),
    blocs,
    points_forts
  });
}

function savePageALU() {
  const blocs = (contentData.page_alu?.blocs || []).map((_, i) => ({
    titre: v(`alu-bloc-${i}-titre`),
    texte: v(`alu-bloc-${i}-texte`),
    image: v(`alu-bloc-${i}-img`),
    alt: v(`alu-bloc-${i}-alt`)
  }));

  const points_forts = (contentData.page_alu?.points_forts || []).map((_, i) => v(`alu-pf-${i}`));

  saveSection('page_alu', {
    meta: {
      title: v('alu-meta-title'),
      description: v('alu-meta-desc')
    },
    hero: {
      title: v('alu-hero-title'),
      tagline: v('alu-hero-tagline'),
      background_image: v('alu-hero-bg')
    },
    intro: v('alu-intro'),
    blocs,
    points_forts
  });
}

function savePagePVC() {
  const blocs = (contentData.page_pvc?.blocs || []).map((_, i) => ({
    titre: v(`pvc-bloc-${i}-titre`),
    texte: v(`pvc-bloc-${i}-texte`),
    image: v(`pvc-bloc-${i}-img`),
    alt: v(`pvc-bloc-${i}-alt`)
  }));

  const points_forts = (contentData.page_pvc?.points_forts || []).map((_, i) => v(`pvc-pf-${i}`));

  saveSection('page_pvc', {
    meta: {
      title: v('pvc-meta-title'),
      description: v('pvc-meta-desc')
    },
    hero: {
      title: v('pvc-hero-title'),
      tagline: v('pvc-hero-tagline'),
      background_image: v('pvc-hero-bg')
    },
    intro: v('pvc-intro'),
    blocs,
    points_forts
  });
}

// ── HTML escape helper ──────────────────────────────────────

function e(str) {
  const div = document.createElement('div');
  div.textContent = str;
  return div.innerHTML;
}

// ── Init ────────────────────────────────────────────────────

checkAuth();

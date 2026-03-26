<?php
$content = json_decode(file_get_contents(__DIR__ . '/content.json'), true);
$links = $content['links'];
$footer = $content['footer'];
$page = $content['page_pvc'];
$meta = $page['meta'];
$hero = $page['hero'];
$blocs = $page['blocs'];
$points_forts = $page['points_forts'];

function e($str) { return htmlspecialchars($str, ENT_QUOTES, 'UTF-8'); }
function nl2br_title($str) { return str_replace("\n", '<br>', e($str)); }

// Icônes SVG pour les points forts
$icons_svg = [
  '<svg width="40" height="40" viewBox="0 0 40 40" fill="none"><path d="M20 4L22.5 14.5H33L24.5 21L27.5 32L20 25L12.5 32L15.5 21L7 14.5H17.5L20 4Z" stroke="#9E8C7D" stroke-width="2" fill="none"/></svg>',
  '<svg width="40" height="40" viewBox="0 0 40 40" fill="none"><circle cx="12" cy="20" r="5" stroke="#9E8C7D" stroke-width="2"/><circle cx="20" cy="12" r="5" stroke="#9E8C7D" stroke-width="2"/><circle cx="28" cy="20" r="5" stroke="#9E8C7D" stroke-width="2"/><circle cx="20" cy="28" r="5" stroke="#9E8C7D" stroke-width="2"/></svg>',
  '<svg width="40" height="40" viewBox="0 0 40 40" fill="none"><rect x="8" y="6" width="24" height="28" rx="2" stroke="#9E8C7D" stroke-width="2"/><path d="M14 20L18 24L26 16" stroke="#9E8C7D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
  '<svg width="40" height="40" viewBox="0 0 40 40" fill="none"><rect x="6" y="10" width="28" height="20" rx="1" stroke="#9E8C7D" stroke-width="2"/><line x1="20" y1="10" x2="20" y2="30" stroke="#9E8C7D" stroke-width="2"/><line x1="6" y1="20" x2="34" y2="20" stroke="#9E8C7D" stroke-width="2"/></svg>',
  '<svg width="40" height="40" viewBox="0 0 40 40" fill="none"><path d="M8 32V12L20 6L32 12V32" stroke="#9E8C7D" stroke-width="2" stroke-linejoin="round"/><path d="M14 32V22H26V32" stroke="#9E8C7D" stroke-width="2"/><line x1="8" y1="32" x2="32" y2="32" stroke="#9E8C7D" stroke-width="2"/></svg>',
  '<svg width="40" height="40" viewBox="0 0 40 40" fill="none"><path d="M12 28C12 28 14 24 20 24C26 24 28 28 28 28" stroke="#9E8C7D" stroke-width="2" stroke-linecap="round"/><circle cx="20" cy="16" r="6" stroke="#9E8C7D" stroke-width="2"/><path d="M16 16L18.5 18.5L24 13" stroke="#9E8C7D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
  '<svg width="40" height="40" viewBox="0 0 40 40" fill="none"><path d="M10 20C10 20 14 14 20 14C26 14 30 20 30 20" stroke="#9E8C7D" stroke-width="2" stroke-linecap="round"/><path d="M10 26C10 26 14 20 20 20C26 20 30 26 30 26" stroke="#9E8C7D" stroke-width="2" stroke-linecap="round"/><path d="M10 32C10 32 14 26 20 26C26 26 30 32 30 32" stroke="#9E8C7D" stroke-width="2" stroke-linecap="round"/></svg>',
  '<svg width="40" height="40" viewBox="0 0 40 40" fill="none"><path d="M20 6C14.5 6 10 10.5 10 16C10 24 20 34 20 34C20 34 30 24 30 16C30 10.5 25.5 6 20 6Z" stroke="#9E8C7D" stroke-width="2" stroke-linejoin="round"/><circle cx="20" cy="16" r="4" stroke="#9E8C7D" stroke-width="2"/></svg>'
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= e($meta['title']) ?></title>
  <meta name="description" content="<?= e($meta['description']) ?>">
  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://elegancemenuiseries.com/fenetres-portes-pvc.html">
  <meta property="og:title" content="<?= e($meta['title']) ?>">
  <meta property="og:description" content="<?= e($meta['description']) ?>">
  <meta property="og:image" content="https://elegancemenuiseries.com/<?= e($links['og_image'] ?? 'assets/images/og-elegance-menuiseries.jpg') ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css?v=63">
  <link rel="stylesheet" href="css/page-produit.css?v=4">
</head>
<body>

  <!-- HERO PAGE PRODUIT -->
  <section class="hero-produit" aria-label="<?= e($meta['title']) ?>">
    <div class="hero-produit__panel" aria-hidden="true"></div>
    <div class="hero-produit__bg" style="background-image: linear-gradient(rgba(0,0,0,0.40)), url('<?= e($hero['background_image'] ?? 'assets/images/baie-vitree-moderne+elegance-menuiseries.jpg') ?>');" aria-hidden="true"></div>
    <img class="hero-produit__logo" src="assets/icons/logo-elegance.svg" alt="Élégance Menuiseries" width="241" height="188">
    <p class="hero-produit__title"><?= nl2br_title($hero['title']) ?></p>
    <h1 class="hero-produit__tagline"><?= e($hero['tagline']) ?></h1>
  </section>

  <!-- NAVIGATION PRINCIPALE -->
  <nav class="main-nav" id="main-nav" aria-label="Navigation principale">
    <a href="/" class="main-nav__brand-mobile">
      <img class="main-nav__brand-logo" src="assets/icons/logo-em.svg" alt="" width="24" height="24" aria-hidden="true">
      Élégance Menuiseries
    </a>
    <button class="main-nav__burger" id="nav-burger" aria-label="Ouvrir le menu" aria-expanded="false">
      <span></span><span></span><span></span>
    </button>
    <ul class="main-nav__list" id="nav-list">
      <li class="main-nav__item">
        <a href="/" class="main-nav__link main-nav__link--brand">
          <span class="main-nav__dot" aria-hidden="true"></span> Élégance Menuiseries
        </a>
      </li>
      <li class="main-nav__item">
        <a href="/fenetres-portes-alu.html" class="main-nav__link"><span class="main-nav__dot" aria-hidden="true"></span> Fenêtres / Portes Alu</a>
      </li>
      <li class="main-nav__item">
        <a href="/fenetres-portes-pvc.html" class="main-nav__link main-nav__link--active"><span class="main-nav__dot" aria-hidden="true"></span> Fenêtres / Portes PVC</a>
      </li>
      <li class="main-nav__item">
        <a href="/volets-roulants.html" class="main-nav__link"><span class="main-nav__dot" aria-hidden="true"></span> Volets roulants</a>
      </li>
      <li class="main-nav__item">
        <a href="/portes-garage.html" class="main-nav__link"><span class="main-nav__dot" aria-hidden="true"></span> Portes de garage</a>
      </li>
      <li class="main-nav__item">
        <a href="/portails-clotures.html" class="main-nav__link"><span class="main-nav__dot" aria-hidden="true"></span> Clôtures et portails</a>
      </li>
    </ul>
    <hr class="main-nav__separator">
  </nav>

  <!-- MENU LATÉRAL STICKY -->
  <aside class="side-menu" aria-label="Contact et réseaux sociaux">
    <div class="side-menu__socials">
      <a href="<?= e($links['facebook_url']) ?>" class="side-menu__social" aria-label="Facebook" target="_blank" rel="noopener">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3V2z" fill="#fff"/></svg>
      </a>
      <a href="<?= e($links['instagram_url']) ?>" class="side-menu__social" aria-label="Instagram" target="_blank" rel="noopener">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><rect x="2" y="2" width="20" height="20" rx="5" stroke="#fff" stroke-width="2"/><circle cx="12" cy="12" r="5" stroke="#fff" stroke-width="2"/><circle cx="17.5" cy="6.5" r="1.5" fill="#fff"/></svg>
      </a>
    </div>
    <a href="#contact" class="side-menu__contact">
      <img src="assets/icons/arrow-right.svg" alt="" width="16" height="10" aria-hidden="true">
      <span>CONTACT</span>
    </a>
  </aside>

  <!-- SECTION INTRO PRODUIT -->
  <section class="section-intro-produit" id="fenetres-pvc">
    <p class="intro-produit__body"><?= e($page['intro']) ?></p>
    <a href="<?= e($links['cta_url']) ?>" class="intro-produit__cta">
      <img src="assets/icons/arrow-right.svg" alt="" width="20" height="12" aria-hidden="true">
      <span>RÉSERVER UN APPEL DE DÉCOUVERTE</span>
    </a>
  </section>

  <!-- SECTION GAMME PRODUIT -->
  <section class="section-gamme-produit">
    <?php foreach ($blocs as $i => $bloc):
      $isLeft = ($i % 2 === 0);
    ?>
    <div class="gamme-bloc gamme-bloc--<?= $isLeft ? 'left' : 'right' ?>">
      <?php if ($isLeft): ?>
      <div class="gamme-bloc__text">
        <h2 class="gamme-bloc__title"><?= e($bloc['titre']) ?></h2>
        <p class="gamme-bloc__desc"><?= e($bloc['texte']) ?></p>
      </div>
      <div class="gamme-bloc__visual">
        <img src="<?= e($bloc['image']) ?>" alt="<?= e($bloc['alt']) ?>" loading="lazy">
      </div>
      <?php else: ?>
      <div class="gamme-bloc__visual">
        <img src="<?= e($bloc['image']) ?>" alt="<?= e($bloc['alt']) ?>" loading="lazy">
      </div>
      <div class="gamme-bloc__text">
        <h2 class="gamme-bloc__title"><?= e($bloc['titre']) ?></h2>
        <p class="gamme-bloc__desc"><?= e($bloc['texte']) ?></p>
      </div>
      <?php endif; ?>
    </div>
    <?php endforeach; ?>
  </section>

  <!-- SECTION POINTS FORTS -->
  <section class="section-points-forts">
    <div class="points-forts__grid">
      <?php foreach ($points_forts as $i => $pf): ?>
      <div class="point-fort">
        <div class="point-fort__icon"><?= $icons_svg[$i] ?? '' ?></div>
        <p class="point-fort__label"><?= nl2br(e($pf)) ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- SECTION PROMESSE -->
  <section class="section-promesse-produit">
    <div class="promesse-produit__top">
      <div class="section-label section-label--center">
        <span class="section-label__dot" aria-hidden="true"></span>
        <span class="section-label__text">La promesse Élégance</span>
      </div>
      <p class="promesse-produit__body">
        <?= e($content['promesse']['body'] ?? 'Nous réunissons l\'exigence de fabrication d\'un grand groupe français avec la proximité et les services d\'un acteur local implanté en Saône-et-Loire.') ?>
      </p>
      <a href="/" class="promesse-produit__cta">
        <img src="assets/icons/arrow-right.svg" alt="" width="20" height="12" aria-hidden="true">
        <span>ÉLÉGANCE MENUISERIES</span>
      </a>
    </div>
    <div class="promesse-produit__photos">
      <?php $photos = $content['promesse']['photos'] ?? []; ?>
      <div class="promesse-produit__photo-wrap promesse-produit__photo-wrap--1">
        <img src="<?= e($photos[0] ?? 'assets/images/product-placeholder.jpg') ?>" alt="Menuiseries Élégance" loading="lazy">
      </div>
      <div class="promesse-produit__photo-wrap promesse-produit__photo-wrap--2">
        <img src="<?= e($photos[1] ?? 'assets/images/product-placeholder.jpg') ?>" alt="Élégance Menuiseries" loading="lazy">
      </div>
      <div class="promesse-produit__photo-wrap promesse-produit__photo-wrap--3">
        <img src="<?= e($photos[2] ?? 'assets/images/product-placeholder.jpg') ?>" alt="Fabrication française" loading="lazy">
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="site-footer">
    <div class="site-footer__bg" aria-hidden="true"></div>
    <div class="site-footer__hero">
      <img class="site-footer__logo" src="assets/icons/logo-elegance.svg" alt="Élégance Menuiseries" width="308" height="240">
      <a href="<?= e($links['cta_url']) ?>" class="site-footer__cta">
        <img src="assets/icons/arrow-right.svg" alt="" width="20" height="12" aria-hidden="true">
        <span><?= e($footer['cta_label']) ?></span>
      </a>
    </div>
    <address class="site-footer__address">
      <?= e($footer['nom']) ?><br>
      <br>
      <?= e($footer['adresse']) ?><br>
      <?= e($footer['adresse2'] ?? '') ?><br>
      <br>
      <a href="tel:<?= preg_replace('/\s/', '', $footer['telephone']) ?>" style="color:inherit;text-decoration:none;"><?= e($footer['telephone']) ?></a><br>
      <a href="mailto:<?= e($footer['email']) ?>" style="color:inherit;text-decoration:none;"><?= e($footer['email']) ?></a>
    </address>
    <nav class="site-footer__legal" aria-label="Liens légaux">
      <?php foreach ($footer['legal_links'] as $link): ?>
      <a href="<?= e($link['url']) ?>"><?= e($link['label']) ?></a>
      <?php endforeach; ?>
      <span class="site-footer__credit"><?= e($footer['credit']) ?></span>
    </nav>
  </footer>

  <script>
    // Sticky nav
    const nav = document.getElementById('main-nav');
    const sentinel = document.createElement('div');
    sentinel.style.cssText = 'position:absolute;top:0;height:1px;width:1px;pointer-events:none;';
    nav.parentElement.insertBefore(sentinel, nav);
    const observer = new IntersectionObserver(
      ([entry]) => nav.classList.toggle('is-sticky', !entry.isIntersecting),
      { threshold: 0, rootMargin: '0px' }
    );
    observer.observe(sentinel);
  </script>

  <script>
    // Menu burger
    const burger = document.getElementById('nav-burger');
    const navList = document.getElementById('nav-list');
    burger.addEventListener('click', () => {
      const isOpen = navList.classList.toggle('is-open');
      burger.classList.toggle('is-open', isOpen);
      burger.setAttribute('aria-expanded', isOpen);
      burger.setAttribute('aria-label', isOpen ? 'Fermer le menu' : 'Ouvrir le menu');
    });
    navList.querySelectorAll('.main-nav__link').forEach(link => {
      link.addEventListener('click', () => {
        navList.classList.remove('is-open');
        burger.classList.remove('is-open');
        burger.setAttribute('aria-expanded', 'false');
        burger.setAttribute('aria-label', 'Ouvrir le menu');
      });
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/gsap@3/dist/gsap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/gsap@3/dist/ScrollTrigger.min.js"></script>

  <script>
    gsap.registerPlugin(ScrollTrigger);

    const heroTl = gsap.timeline({ defaults: { ease: 'power3.out' } });
    heroTl
      .from('.hero-produit__panel', { x: '-100%', duration: 0.8 })
      .from('.hero-produit__logo', { opacity: 0, scale: 0.8, duration: 1 }, '-=0.4')
      .from('.hero-produit__title', { opacity: 0, x: -60, duration: 0.8 }, '-=0.5')
      .from('.hero-produit__tagline', { opacity: 0, duration: 0.8 }, '-=0.3');

    gsap.from('.intro-produit__body', {
      opacity: 0, y: 50, duration: 0.8,
      scrollTrigger: { trigger: '.intro-produit__body', start: 'top 80%' }
    });
    gsap.from('.intro-produit__cta', {
      opacity: 0, y: 30, duration: 0.6,
      scrollTrigger: { trigger: '.intro-produit__cta', start: 'top 90%' }
    });

    document.querySelectorAll('.gamme-bloc').forEach((bloc) => {
      const isLeft = bloc.classList.contains('gamme-bloc--left');
      gsap.from(bloc.querySelector('.gamme-bloc__visual'), {
        opacity: 0, x: isLeft ? 80 : -80, duration: 0.9,
        scrollTrigger: { trigger: bloc, start: 'top 75%' }
      });
      gsap.from(bloc.querySelector('.gamme-bloc__text'), {
        opacity: 0, y: 40, duration: 0.7,
        scrollTrigger: { trigger: bloc, start: 'top 70%' }
      });
    });

    gsap.from('.point-fort', {
      opacity: 0, y: 30, duration: 0.5, stagger: 0.1,
      scrollTrigger: { trigger: '.section-points-forts', start: 'top 80%' }
    });

    gsap.from('.section-promesse-produit .section-label', { opacity: 0, y: 30, duration: 0.6, scrollTrigger: { trigger: '.section-promesse-produit', start: 'top 80%' } });
    gsap.from('.promesse-produit__body', { opacity: 0, y: 50, duration: 0.8, scrollTrigger: { trigger: '.promesse-produit__body', start: 'top 80%' } });
    gsap.from('.promesse-produit__cta', { opacity: 0, y: 30, duration: 0.6, scrollTrigger: { trigger: '.promesse-produit__cta', start: 'top 90%' } });
    gsap.from('.promesse-produit__photo-wrap--1', { opacity: 0, x: -60, duration: 0.8, scrollTrigger: { trigger: '.promesse-produit__photos', start: 'top 80%' } });
    gsap.from('.promesse-produit__photo-wrap--2', { opacity: 0, scale: 0.8, duration: 0.7, scrollTrigger: { trigger: '.promesse-produit__photos', start: 'top 75%' } });
    gsap.from('.promesse-produit__photo-wrap--3', { opacity: 0, y: 60, duration: 0.9, scrollTrigger: { trigger: '.promesse-produit__photos', start: 'top 70%' } });

    gsap.from('.site-footer__logo', { opacity: 0, scale: 0.85, duration: 0.8, scrollTrigger: { trigger: '.site-footer', start: 'top 80%' } });
    gsap.from('.site-footer__cta', { opacity: 0, y: 30, duration: 0.6, scrollTrigger: { trigger: '.site-footer__cta', start: 'top 90%' } });
    gsap.from('.site-footer__address', { opacity: 0, y: 20, duration: 0.6, scrollTrigger: { trigger: '.site-footer__address', start: 'top 90%' } });
    gsap.from('.site-footer__legal', { opacity: 0, duration: 0.5, scrollTrigger: { trigger: '.site-footer__legal', start: 'top 95%' } });
  </script>

  <img src="/api/track.php?p=pvc" alt="" style="position:absolute;width:1px;height:1px;opacity:0;" aria-hidden="true">
</body>
</html>

<?php
$content = json_decode(file_get_contents(__DIR__ . '/content.json'), true);
$meta = $content['meta'];
$links = $content['links'];
$hero = $content['hero'];
$promesse = $content['promesse'];
$gamme = $content['gamme'];
$atouts = $content['atouts'];
$methode = $content['methode'];
$temoignages = $content['temoignages'];
$cta = $content['cta'];
$footer = $content['footer'];

function e($str) { return htmlspecialchars($str, ENT_QUOTES, 'UTF-8'); }
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
  <meta property="og:url" content="https://elegancemenuiseries.com/">
  <meta property="og:title" content="<?= e($meta['title']) ?>">
  <meta property="og:description" content="<?= e($meta['description']) ?>">
  <meta property="og:image" content="https://elegancemenuiseries.com/<?= e($links['og_image'] ?? 'assets/images/og-elegance-menuiseries.jpg') ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css?v=59">
</head>
<body>

  <!-- SECTION HERO -->
  <section class="hero" aria-label="Accueil Élégance Menuiseries">
    <div class="hero__bg" aria-hidden="true"></div>
    <img class="hero__logo" src="assets/icons/logo-elegance.svg" alt="Élégance Menuiseries" width="206" height="162">
    <div class="hero__main">
      <p class="hero__title"><?= e($hero['title']) ?></p>
      <a href="<?= e($links['cta_url']) ?>" class="hero__cta">
        <img class="hero__cta-arrow" src="assets/icons/arrow-right.svg" alt="" width="22" height="14" aria-hidden="true">
        <span class="hero__cta-label"><?= e($hero['cta_label']) ?></span>
      </a>
    </div>
    <h1 class="hero__tagline"><?= e($hero['tagline']) ?></h1>
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
        <a href="#" class="main-nav__link main-nav__link--brand main-nav__link--active">
          <span class="main-nav__dot" aria-hidden="true"></span>
          Élégance Menuiseries
        </a>
      </li>
      <li class="main-nav__item">
        <a href="/fenetres-portes-alu.html" class="main-nav__link"><span class="main-nav__dot" aria-hidden="true"></span> Fenêtres / Portes Alu</a>
      </li>
      <li class="main-nav__item">
        <a href="/fenetres-portes-pvc.html" class="main-nav__link"><span class="main-nav__dot" aria-hidden="true"></span> Fenêtres / Portes PVC</a>
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
    <a href="<?= e($links['cta_url']) ?>" class="side-menu__contact">
      <img src="assets/icons/arrow-right.svg" alt="" width="16" height="10" aria-hidden="true">
      <span>CONTACT</span>
    </a>
  </aside>

  <!-- SECTION "LA PROMESSE ÉLÉGANCE" -->
  <section class="section-promesse" id="promesse">
    <div class="section-label section-label--center">
      <span class="section-label__dot" aria-hidden="true"></span>
      <span class="section-label__text"><?= e($promesse['label']) ?></span>
    </div>
    <p class="promesse__body"><?= $promesse['body'] ?></p>
    <hr class="section-rule">
  </section>

  <!-- SECTION "NOTRE GAMME DE MENUISERIES" -->
  <section class="section-gamme" id="fenetres-alu">
    <div class="section-label section-label--left">
      <span class="section-label__dot" aria-hidden="true"></span>
      <span class="section-label__text"><?= e($gamme['label']) ?></span>
    </div>

    <?php
    $produit_urls = [
      '/fenetres-portes-alu.html',
      '/fenetres-portes-pvc.html',
      '/volets-roulants.html',
      '/portes-garage.html',
      '/portails-clotures.html'
    ];
    ?>
    <div class="gamme-intro">
      <a href="<?= $produit_urls[0] ?>" class="gamme-card gamme-card--large" id="fenetres-alu-card">
        <div class="gamme-card__bg" style="background-image: linear-gradient(rgba(0,0,0,0.20)), url('<?= e($gamme['produits'][0]['image']) ?>');"></div>
        <span class="gamme-card__label"><?= $gamme['produits'][0]['label'] ?></span>
      </a>
      <p class="gamme-intro__desc"><?= e($gamme['description']) ?></p>
      <a href="<?= $produit_urls[1] ?>" class="gamme-card gamme-card--small gamme-card--offset" id="fenetres-pvc-card">
        <div class="gamme-card__bg" style="background-image: linear-gradient(rgba(0,0,0,0.20)), url('<?= e($gamme['produits'][1]['image']) ?>');"></div>
        <span class="gamme-card__label"><?= $gamme['produits'][1]['label'] ?></span>
      </a>
    </div>

    <div class="gamme-row" id="volets">
      <a href="<?= $produit_urls[2] ?>" class="gamme-card gamme-card--small">
        <div class="gamme-card__bg" style="background-image: linear-gradient(rgba(0,0,0,0.20)), url('<?= e($gamme['produits'][2]['image']) ?>');"></div>
        <span class="gamme-card__label"><?= $gamme['produits'][2]['label'] ?></span>
      </a>
      <a href="<?= $produit_urls[3] ?>" class="gamme-card gamme-card--small" id="portes-garage">
        <div class="gamme-card__bg" style="background-image: linear-gradient(rgba(0,0,0,0.20)), url('<?= e($gamme['produits'][3]['image']) ?>');"></div>
        <span class="gamme-card__label"><?= $gamme['produits'][3]['label'] ?></span>
      </a>
      <a href="<?= $produit_urls[4] ?>" class="gamme-card gamme-card--large" id="clotures">
        <div class="gamme-card__bg" style="background-image: linear-gradient(rgba(0,0,0,0.20)), url('<?= e($gamme['produits'][4]['image']) ?>');"></div>
        <span class="gamme-card__label"><?= $gamme['produits'][4]['label'] ?></span>
      </a>
    </div>
  </section>

  <!-- SECTION "NOS ATOUTS" -->
  <section class="section-atouts">
    <?php foreach ($atouts as $i => $atout): $num = $i + 1; ?>
    <div class="atout atout--<?= $num ?>">
      <?php if (!empty($atout['logo'])): ?>
      <img class="atout__logo" src="<?= e($atout['logo']) ?>" alt="Élégance Menuiseries" width="160" height="160">
      <?php endif; ?>
      <div class="atout__visual">
        <img class="atout__img" src="<?= e($atout['image']) ?>" alt="<?= e($atout['alt']) ?>" width="560" height="560">
        <h2 class="atout__heading"><?= $atout['titre'] ?></h2>
      </div>
      <p class="atout__body"><?= $atout['texte'] ?></p>
    </div>
    <?php endforeach; ?>
  </section>

  <!-- SECTION "NOTRE MÉTHODE" -->
  <section class="section-methode" id="methode">
    <hr class="section-rule">
    <div class="section-label section-label--left">
      <span class="section-label__dot" aria-hidden="true"></span>
      <span class="section-label__text"><?= e($methode['label']) ?></span>
    </div>
    <p class="methode__intro"><?= e($methode['intro']) ?></p>
    <ol class="methode__list">
      <?php foreach ($methode['etapes'] as $i => $etape): ?>
      <li class="methode__step">
        <span class="methode__step-num"><?= str_pad($i + 1, 2, '0', STR_PAD_LEFT) ?></span>
        <strong class="methode__step-title"><?= e($etape['titre']) ?></strong>
        <p class="methode__step-desc"><?= e($etape['description']) ?></p>
      </li>
      <?php endforeach; ?>
    </ol>
  </section>

  <!-- SECTION "TÉMOIGNAGES CLIENTS" -->
  <section class="section-temoignages" id="temoignages">
    <hr class="section-rule">
    <div class="section-label section-label--left">
      <span class="section-label__dot" aria-hidden="true"></span>
      <span class="section-label__text">Témoignages clients</span>
    </div>
    <div class="temoignages__content">
      <img class="temoignages__photo" src="<?= e($temoignages[0]['photo']) ?>" alt="" width="240" height="240">
      <div class="temoignages__right">
        <blockquote class="temoignages__quote"></blockquote>
        <p class="temoignages__author"></p>
        <div class="temoignages__dots" role="tablist" aria-label="Témoignages clients">
          <?php foreach ($temoignages as $i => $t): ?>
          <button class="temoignages__dot<?= $i === 0 ? ' temoignages__dot--active' : '' ?>" data-index="<?= $i ?>" aria-label="Témoignage <?= $i + 1 ?>" aria-selected="<?= $i === 0 ? 'true' : 'false' ?>"></button>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <!-- BANDE DÉCORATIVE -->
  <div class="divider-em" aria-hidden="true"></div>

  <!-- SECTION CTA -->
  <section class="section-cta" id="contact">
    <p class="cta__text"><?= $cta['texte'] ?></p>
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
      <a href="<?= e($footer['credit_url'] ?? 'https://www.tymeo.com') ?>" class="site-footer__credit" target="_blank" rel="noopener"><?= e($footer['credit']) ?></a>
    </nav>
  </footer>

  <script>
    // Données témoignages depuis le CMS
    const TEMOIGNAGES = <?= json_encode($temoignages, JSON_UNESCAPED_UNICODE) ?>;

    (function initSlider() {
      const content   = document.querySelector('.temoignages__content');
      const photo     = content.querySelector('.temoignages__photo');
      const quote     = content.querySelector('.temoignages__quote');
      const author    = content.querySelector('.temoignages__author');
      const right     = content.querySelector('.temoignages__right');
      const dots      = content.querySelectorAll('.temoignages__dot');
      let current     = 0;
      let animating   = false;

      function setRightHeight() {
        right.style.height = right.scrollHeight + 'px';
      }

      function render(index) {
        const t = TEMOIGNAGES[index];
        photo.src = t.photo;
        photo.alt = t.author + ', ' + t.location;
        quote.textContent = t.quote;
        author.innerHTML  = t.author + '<br>' + t.location;
        dots.forEach((d, i) => {
          d.classList.toggle('temoignages__dot--active', i === index);
          d.setAttribute('aria-selected', i === index ? 'true' : 'false');
        });
      }

      function goTo(index) {
        if (animating || index === current) return;
        animating = true;
        right.style.height = right.scrollHeight + 'px';
        content.classList.add('is-fading');
        setTimeout(() => {
          current = index;
          render(current);
          right.style.height = right.scrollHeight + 'px';
          content.classList.remove('is-fading');
          setTimeout(() => { animating = false; }, 400);
        }, 300);
      }

      dots.forEach(dot => {
        dot.addEventListener('click', () => goTo(+dot.dataset.index));
      });

      render(0);
      requestAnimationFrame(setRightHeight);
    })();
  </script>

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

  <!-- GSAP + ScrollTrigger -->
  <script src="https://cdn.jsdelivr.net/npm/gsap@3/dist/gsap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/gsap@3/dist/ScrollTrigger.min.js"></script>

  <script>
    gsap.registerPlugin(ScrollTrigger);

    const heroTl = gsap.timeline({ defaults: { ease: 'power3.out' } });
    heroTl
      .from('.hero__logo', { opacity: 0, scale: 0.8, duration: 1 })
      .from('.hero__title', { opacity: 0, y: 60, duration: 0.8 }, '-=0.5')
      .from('.hero__cta', { opacity: 0, y: 40, duration: 0.6 }, '-=0.4')
      .from('.hero__tagline', { opacity: 0, duration: 0.8 }, '-=0.3');

    gsap.from('.section-promesse .section-label', {
      opacity: 0, y: 30, duration: 0.6,
      scrollTrigger: { trigger: '.section-promesse', start: 'top 80%' }
    });
    gsap.from('.promesse__body', {
      opacity: 0, y: 50, duration: 0.8,
      scrollTrigger: { trigger: '.promesse__body', start: 'top 80%' }
    });

    gsap.from('.section-gamme .section-label', {
      opacity: 0, y: 30, duration: 0.6,
      scrollTrigger: { trigger: '.section-gamme', start: 'top 80%' }
    });
    gsap.from('.gamme-card--large:first-child', {
      opacity: 0, x: -80, duration: 0.8,
      scrollTrigger: { trigger: '.gamme-intro', start: 'top 75%' }
    });
    gsap.from('.gamme-intro__desc', {
      opacity: 0, y: 30, duration: 0.6,
      scrollTrigger: { trigger: '.gamme-intro__desc', start: 'top 80%' }
    });
    gsap.from('.gamme-card--offset', {
      opacity: 0, x: 80, duration: 0.8,
      scrollTrigger: { trigger: '.gamme-card--offset', start: 'top 85%' }
    });
    gsap.from('.gamme-row .gamme-card', {
      opacity: 0, y: 60, duration: 0.6, stagger: 0.15,
      scrollTrigger: { trigger: '.gamme-row', start: 'top 80%' }
    });

    document.querySelectorAll('.atout').forEach((atout, i) => {
      const fromX = (i % 2 === 0) ? -80 : 80;
      gsap.from(atout.querySelector('.atout__visual'), {
        opacity: 0, x: fromX, duration: 0.9,
        scrollTrigger: { trigger: atout, start: 'top 75%' }
      });
      const heading = atout.querySelector('.atout__heading');
      if (heading) {
        gsap.from(heading, {
          opacity: 0, x: fromX * 0.5, duration: 0.7,
          scrollTrigger: { trigger: atout, start: 'top 70%' }
        });
      }
      gsap.from(atout.querySelector('.atout__body'), {
        opacity: 0, y: 30, duration: 0.6,
        scrollTrigger: { trigger: atout.querySelector('.atout__body'), start: 'top 85%' }
      });
    });

    gsap.from('.section-methode .section-label', {
      opacity: 0, y: 30, duration: 0.6,
      scrollTrigger: { trigger: '.section-methode', start: 'top 80%' }
    });
    gsap.from('.methode__intro', {
      opacity: 0, y: 40, duration: 0.7,
      scrollTrigger: { trigger: '.methode__intro', start: 'top 80%' }
    });
    gsap.from('.methode__step', {
      opacity: 0, x: -50, duration: 0.6, stagger: 0.2,
      scrollTrigger: { trigger: '.methode__list', start: 'top 75%' }
    });

    gsap.from('.temoignages__photo', {
      opacity: 0, scale: 0.85, duration: 0.8,
      scrollTrigger: { trigger: '.section-temoignages', start: 'top 75%' }
    });
    gsap.from('.temoignages__right', {
      opacity: 0, y: 40, duration: 0.7,
      scrollTrigger: { trigger: '.temoignages__right', start: 'top 80%' }
    });

    gsap.from('.cta__text', {
      opacity: 0, scale: 0.95, y: 30, duration: 0.8,
      scrollTrigger: { trigger: '.section-cta', start: 'top 75%' }
    });

    gsap.from('.site-footer__logo', {
      opacity: 0, scale: 0.85, duration: 0.8,
      scrollTrigger: { trigger: '.site-footer', start: 'top 80%' }
    });
    gsap.from('.site-footer__cta', {
      opacity: 0, y: 30, duration: 0.6,
      scrollTrigger: { trigger: '.site-footer__cta', start: 'top 90%' }
    });
    gsap.from('.site-footer__address', {
      opacity: 0, y: 20, duration: 0.6,
      scrollTrigger: { trigger: '.site-footer__address', start: 'top 90%' }
    });
    gsap.from('.site-footer__legal', {
      opacity: 0, duration: 0.5,
      scrollTrigger: { trigger: '.site-footer__legal', start: 'top 95%' }
    });
  </script>

  <img src="/api/track.php?p=accueil" alt="" style="position:absolute;width:1px;height:1px;opacity:0;" aria-hidden="true">
</body>
</html>

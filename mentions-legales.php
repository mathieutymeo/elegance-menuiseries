<?php
$content = json_decode(file_get_contents(__DIR__ . '/content.json'), true);
$links = $content['links'];
$footer = $content['footer'];

function e($str) { return htmlspecialchars($str, ENT_QUOTES, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mentions légales — Élégance Menuiseries</title>
  <meta name="description" content="Mentions légales et crédits du site Élégance Menuiseries.">
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://elegancemenuiseries.com/mentions-legales.html">
  <meta property="og:title" content="Mentions légales — Élégance Menuiseries">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css?v=63">
  <link rel="stylesheet" href="css/page-legale.css?v=1">
</head>
<body>

  <!-- NAVIGATION PRINCIPALE -->
  <nav class="main-nav is-sticky" id="main-nav" aria-label="Navigation principale">
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

  <!-- CONTENU LÉGAL -->
  <main class="legal-page">
    <h1 class="legal-page__title">Crédits & mentions légales</h1>

    <section class="legal-page__section">
      <h2>Éditeur du site</h2>
      <p>
        Le site <strong>elegancemenuiseries.com</strong> est édité par la société <strong>Bourgogne Maîtrise</strong>, exerçant sous la marque commerciale <strong>Élégance Menuiseries</strong>.
      </p>
      <ul>
        <li><strong>Raison sociale :</strong> Bourgogne Maîtrise</li>
        <li><strong>Forme juridique :</strong> Société par Actions Simplifiée (SAS)</li>
        <li><strong>Capital social :</strong> 2 500 €</li>
        <li><strong>Siège social :</strong> 8 Rue de la Poissonnerie, 71100 Chalon-sur-Saône</li>
        <li><strong>Établissement secondaire :</strong> 26 Av. de la République, 21200 Beaune</li>
        <li><strong>SIRET :</strong> 829 831 239 00027</li>
        <li><strong>RCS :</strong> Chalon-sur-Saône 829 831 239</li>
        <li><strong>N° TVA intracommunautaire :</strong> FR 78 829831239</li>
        <li><strong>Téléphone :</strong> <a href="tel:0610931299">06 10 93 12 99</a></li>
        <li><strong>E-mail :</strong> <a href="mailto:contact@elegancemenuiseries.com">contact@elegancemenuiseries.com</a></li>
        <li><strong>Directeur de la publication :</strong> Christophe Henry, Président</li>
      </ul>
    </section>

    <section class="legal-page__section">
      <h2>Hébergeur</h2>
      <ul>
        <li><strong>Raison sociale :</strong> Hostinger International Ltd.</li>
        <li><strong>Adresse :</strong> 61 Lordou Vironos Street, 6023 Larnaca, Chypre</li>
        <li><strong>Site web :</strong> <a href="https://www.hostinger.fr" target="_blank" rel="noopener">www.hostinger.fr</a></li>
      </ul>
    </section>

    <section class="legal-page__section">
      <h2>Conception et réalisation du site</h2>
      <p>
        Ce site a été conçu et réalisé par l'<strong>Agence Tyméo</strong>.<br>
        <a href="https://www.tymeo.com" target="_blank" rel="noopener">www.tymeo.com</a>
      </p>
    </section>

    <section class="legal-page__section">
      <h2>Crédits photographiques</h2>
      <p>
        Les photographies et visuels présentés sur ce site sont la propriété de Bourgogne Maîtrise / Élégance Menuiseries ou sont utilisés avec l'autorisation de leurs auteurs. Toute reproduction est interdite sans accord préalable.
      </p>
    </section>

    <section class="legal-page__section">
      <h2>Propriété intellectuelle</h2>
      <p>
        L'ensemble du contenu de ce site (textes, images, logos, icônes, mise en page, charte graphique) est protégé par le droit de la propriété intellectuelle. Toute reproduction, représentation, modification, publication ou adaptation, totale ou partielle, de ces éléments est interdite sans l'autorisation écrite préalable de Bourgogne Maîtrise.
      </p>
    </section>

    <section class="legal-page__section">
      <h2>Responsabilité</h2>
      <p>
        Les informations diffusées sur ce site sont présentées à titre indicatif et n'ont pas de valeur contractuelle. Bourgogne Maîtrise s'efforce de fournir des informations exactes et à jour, mais ne garantit pas l'exactitude, la complétude ou l'actualité des informations diffusées. L'éditeur se réserve le droit de modifier le contenu du site à tout moment et sans préavis.
      </p>
      <p>
        La responsabilité de l'éditeur ne saurait être engagée en cas d'erreur, d'inexactitude ou d'omission dans les informations disponibles sur le site.
      </p>
    </section>

    <section class="legal-page__section">
      <h2>Liens hypertextes</h2>
      <p>
        Le site peut contenir des liens vers d'autres sites internet. Bourgogne Maîtrise ne dispose d'aucun contrôle sur le contenu de ces sites tiers et décline toute responsabilité quant à leur contenu.
      </p>
    </section>

    <section class="legal-page__section">
      <h2>Droit applicable</h2>
      <p>
        Les présentes mentions légales sont régies par le droit français. En cas de litige, et après tentative de résolution amiable, les tribunaux français seront seuls compétents.
      </p>
    </section>
  </main>

  <!-- FOOTER -->
  <footer class="site-footer">
    <div class="site-footer__bg" aria-hidden="true"></div>
    <div class="site-footer__hero">
      <img class="site-footer__logo" src="assets/icons/logo-elegance.svg" alt="Élégance Menuiseries" width="308" height="240">
      <a href="<?= e($links['cta_url']) ?>" class="site-footer__cta" target="_blank" rel="noopener">
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

  <img src="/api/track.php?p=mentions-legales" alt="" style="position:absolute;width:1px;height:1px;opacity:0;" aria-hidden="true">
</body>
</html>

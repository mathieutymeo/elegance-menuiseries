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
  <title>Politique de cookies — Élégance Menuiseries</title>
  <meta name="description" content="Politique de cookies du site Élégance Menuiseries. Gestion de vos préférences de cookies.">
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://elegancemenuiseries.com/politique-cookies.html">
  <meta property="og:title" content="Politique de cookies — Élégance Menuiseries">
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
    <h1 class="legal-page__title">Politique de cookies</h1>

    <p class="legal-page__intro">
      Lors de votre navigation sur le site <strong>elegancemenuiseries.com</strong>, des cookies peuvent être déposés sur votre terminal (ordinateur, tablette, smartphone). Cette page vous informe sur l'utilisation de ces cookies et sur les moyens dont vous disposez pour les gérer.
    </p>

    <section class="legal-page__section">
      <h2>1. Qu'est-ce qu'un cookie ?</h2>
      <p>
        Un cookie est un petit fichier texte déposé sur votre terminal lors de la visite d'un site web. Il permet au site de mémoriser certaines informations relatives à votre navigation, afin de faciliter vos visites ultérieures et de rendre le site plus convivial.
      </p>
    </section>

    <section class="legal-page__section">
      <h2>2. Les cookies que nous utilisons</h2>

      <h3>Cookies strictement nécessaires</h3>
      <p>
        Ces cookies sont indispensables au fonctionnement du site. Ils ne peuvent pas être désactivés. Ils sont généralement définis en réponse à des actions que vous effectuez (ex. : préférences de confidentialité, connexion).
      </p>

      <h3>Cookies de mesure d'audience</h3>
      <p>
        Nous utilisons un pixel de suivi interne pour comptabiliser les visites et les pages consultées. Ce dispositif ne dépose aucun cookie tiers et les données collectées sont anonymes. Elles nous permettent d'améliorer le contenu et l'ergonomie du site.
      </p>

      <h3>Cookies tiers</h3>
      <p>
        À ce jour, le site <strong>elegancemenuiseries.com</strong> n'utilise pas de cookies publicitaires ni de cookies de réseaux sociaux. Si cela devait évoluer, cette politique sera mise à jour et votre consentement sera recueilli au préalable.
      </p>
    </section>

    <section class="legal-page__section">
      <h2>3. Durée de conservation des cookies</h2>
      <p>
        Les cookies déposés sur votre terminal sont conservés pour une durée maximale de 13 mois conformément aux recommandations de la CNIL. Au-delà de cette période, votre consentement sera à nouveau sollicité.
      </p>
    </section>

    <section class="legal-page__section">
      <h2>4. Gérer vos préférences</h2>
      <p>
        Vous pouvez à tout moment choisir d'accepter ou de refuser les cookies en configurant votre navigateur. Voici les liens vers les pages d'aide des principaux navigateurs :
      </p>
      <ul>
        <li><strong>Google Chrome :</strong> Paramètres → Confidentialité et sécurité → Cookies</li>
        <li><strong>Mozilla Firefox :</strong> Paramètres → Vie privée et sécurité → Cookies</li>
        <li><strong>Safari :</strong> Préférences → Confidentialité → Cookies</li>
        <li><strong>Microsoft Edge :</strong> Paramètres → Cookies et autorisations de site</li>
      </ul>
      <p>
        La désactivation de certains cookies peut altérer votre expérience de navigation sur le site.
      </p>
    </section>

    <section class="legal-page__section">
      <h2>5. Base légale</h2>
      <p>
        Le dépôt de cookies non essentiels est soumis à votre consentement préalable, conformément à l'article 82 de la loi Informatique et Libertés et aux lignes directrices de la CNIL du 1er octobre 2020.
      </p>
    </section>

    <section class="legal-page__section">
      <h2>6. Nous contacter</h2>
      <p>
        Pour toute question relative à notre politique de cookies, vous pouvez nous contacter :
      </p>
      <ul>
        <li>Par e-mail : <a href="mailto:contact@elegancemenuiseries.com">contact@elegancemenuiseries.com</a></li>
        <li>Par téléphone : <a href="tel:0610931299">06 10 93 12 99</a></li>
        <li>Par courrier : Bourgogne Maîtrise — 9 Rue de la Citadelle, 71100 Chalon-sur-Saône</li>
      </ul>
      <p><strong>Dernière mise à jour :</strong> 25 mars 2026</p>
    </section>
  </main>

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

  <img src="/api/track.php?p=politique-cookies" alt="" style="position:absolute;width:1px;height:1px;opacity:0;" aria-hidden="true">
</body>
</html>

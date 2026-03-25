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
  <title>Politique de confidentialité — Élégance Menuiseries</title>
  <meta name="description" content="Politique de confidentialité du site Élégance Menuiseries. Protection de vos données personnelles.">
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://elegancemenuiseries.com/politique-confidentialite.html">
  <meta property="og:title" content="Politique de confidentialité — Élégance Menuiseries">
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
    <h1 class="legal-page__title">Politique de confidentialité</h1>

    <p class="legal-page__intro">
      La société <strong>Bourgogne Maîtrise</strong>, exerçant sous la marque <strong>Élégance Menuiseries</strong>, accorde une grande importance à la protection de vos données personnelles. La présente politique décrit les données que nous collectons, pourquoi nous les collectons et comment nous les utilisons, conformément au Règlement Général sur la Protection des Données (RGPD) et à la loi Informatique et Libertés.
    </p>

    <section class="legal-page__section">
      <h2>1. Responsable du traitement</h2>
      <p>
        Le responsable du traitement des données est :
      </p>
      <ul>
        <li><strong>Bourgogne Maîtrise</strong> (marque Élégance Menuiseries)</li>
        <li>9 Rue de la Citadelle, 71100 Chalon-sur-Saône</li>
        <li>E-mail : <a href="mailto:contact@elegancemenuiseries.com">contact@elegancemenuiseries.com</a></li>
        <li>Téléphone : <a href="tel:0610931299">06 10 93 12 99</a></li>
      </ul>
    </section>

    <section class="legal-page__section">
      <h2>2. Données collectées</h2>
      <p>Nous pouvons collecter les données suivantes :</p>
      <ul>
        <li><strong>Données de contact :</strong> nom, prénom, adresse e-mail, numéro de téléphone, adresse postale — lorsque vous nous contactez via le formulaire, par téléphone ou par e-mail.</li>
        <li><strong>Données de navigation :</strong> adresse IP, type de navigateur, pages consultées, date et heure de visite — collectées automatiquement lors de votre navigation sur le site.</li>
        <li><strong>Données relatives à votre projet :</strong> type de menuiseries souhaitées, dimensions, configuration — lorsque vous effectuez une demande de devis.</li>
      </ul>
    </section>

    <section class="legal-page__section">
      <h2>3. Finalités du traitement</h2>
      <p>Vos données sont collectées pour les finalités suivantes :</p>
      <ul>
        <li>Répondre à vos demandes de contact et de devis</li>
        <li>Assurer le suivi commercial de votre projet</li>
        <li>Améliorer notre site web et votre expérience de navigation</li>
        <li>Établir des statistiques anonymes de fréquentation</li>
        <li>Respecter nos obligations légales et réglementaires</li>
      </ul>
    </section>

    <section class="legal-page__section">
      <h2>4. Base légale du traitement</h2>
      <p>Le traitement de vos données repose sur :</p>
      <ul>
        <li><strong>Votre consentement</strong> — pour les cookies non essentiels et l'envoi de communications commerciales</li>
        <li><strong>L'exécution d'un contrat ou de mesures précontractuelles</strong> — pour le traitement de vos demandes de devis</li>
        <li><strong>L'intérêt légitime</strong> — pour l'amélioration de nos services et les statistiques de fréquentation</li>
      </ul>
    </section>

    <section class="legal-page__section">
      <h2>5. Durée de conservation</h2>
      <p>Vos données personnelles sont conservées pendant une durée proportionnée à la finalité pour laquelle elles sont traitées :</p>
      <ul>
        <li><strong>Données de contact et de projet :</strong> 3 ans à compter du dernier contact</li>
        <li><strong>Données de navigation :</strong> 13 mois maximum</li>
        <li><strong>Données contractuelles :</strong> durée du contrat + 5 ans (prescription légale)</li>
      </ul>
    </section>

    <section class="legal-page__section">
      <h2>6. Destinataires des données</h2>
      <p>
        Vos données sont destinées aux personnels habilités de Bourgogne Maîtrise. Elles ne sont jamais vendues ni cédées à des tiers à des fins commerciales.
      </p>
      <p>
        Elles peuvent être communiquées, le cas échéant, à nos sous-traitants techniques (hébergeur, prestataire e-mail) dans le cadre strict de l'exécution de leurs missions. Ces sous-traitants sont tenus au respect du RGPD.
      </p>
    </section>

    <section class="legal-page__section">
      <h2>7. Vos droits</h2>
      <p>Conformément au RGPD, vous disposez des droits suivants :</p>
      <ul>
        <li><strong>Droit d'accès :</strong> obtenir la confirmation que des données vous concernant sont traitées et en obtenir une copie</li>
        <li><strong>Droit de rectification :</strong> demander la correction de données inexactes ou incomplètes</li>
        <li><strong>Droit à l'effacement :</strong> demander la suppression de vos données</li>
        <li><strong>Droit à la limitation :</strong> demander la suspension du traitement</li>
        <li><strong>Droit à la portabilité :</strong> recevoir vos données dans un format structuré</li>
        <li><strong>Droit d'opposition :</strong> vous opposer au traitement de vos données</li>
      </ul>
      <p>
        Pour exercer vos droits, contactez-nous à : <a href="mailto:contact@elegancemenuiseries.com">contact@elegancemenuiseries.com</a>
      </p>
      <p>
        Vous pouvez également introduire une réclamation auprès de la CNIL : <a href="https://www.cnil.fr" target="_blank" rel="noopener">www.cnil.fr</a>
      </p>
    </section>

    <section class="legal-page__section">
      <h2>8. Sécurité</h2>
      <p>
        Nous mettons en œuvre les mesures techniques et organisationnelles appropriées pour protéger vos données contre tout accès non autorisé, modification, divulgation ou destruction.
      </p>
    </section>

    <section class="legal-page__section">
      <h2>9. Modification de la politique</h2>
      <p>
        La présente politique de confidentialité peut être mise à jour à tout moment. La date de dernière mise à jour est indiquée ci-dessous.
      </p>
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

  <img src="/api/track.php?p=politique-confidentialite" alt="" style="position:absolute;width:1px;height:1px;opacity:0;" aria-hidden="true">
</body>
</html>

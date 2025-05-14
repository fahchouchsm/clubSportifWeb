// script.js - Version complète et corrigée

document.addEventListener('DOMContentLoaded', function () {
  //Gestion du menu 
  const menuToggle = document.querySelector('.menu-toggle');
  const navList = document.querySelector('.nav-list');

  if (menuToggle) {
    menuToggle.addEventListener('click', function () {
      navList.classList.toggle('active');
      this.classList.toggle('open');
    });
  }

  //Smooth scroll pour les liens de navigation
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      const targetId = this.getAttribute('href');
      const target = document.querySelector(targetId);

      if (target) {
        window.scrollTo({
          top: target.offsetTop - 80,
          behavior: 'smooth'
        });

        // Fermer le menu mobile si ouvert
        if (navList.classList.contains('active')) {
          navList.classList.remove('active');
          menuToggle.classList.remove('open');
        }
      }
    });
  });

  //Bouton "Retour en haut"
  const scrollBtn = document.querySelector('.scroll-to-top');

  function toggleScrollButton() {
    if (window.scrollY > 300) {
      scrollBtn.style.opacity = '1';
      scrollBtn.style.visibility = 'visible';
    } else {
      scrollBtn.style.opacity = '0';
      scrollBtn.style.visibility = 'hidden';
    }
  }

  if (scrollBtn) {
    window.addEventListener('scroll', toggleScrollButton);
    scrollBtn.addEventListener('click', function () {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });
  }

  //Effet de header au scroll
  const header = document.querySelector('.custom-header');

  if (header) {
    window.addEventListener('scroll', function () {
      if (window.scrollY > 100) {
        header.style.backgroundColor = 'rgba(30, 30, 30, 0.9)';
        header.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.1)';
      } else {
        header.style.backgroundColor = 'transparent';
        header.style.boxShadow = 'none';
      }
    });
  }

  //Animation au scroll (Scroll Reveal) - Version améliorée
  const animateElements = () => {
    const elements = document.querySelectorAll(
      '.program, .abonnement, .blog-post, .testimonial, .gallery-item, section'
    );

    const windowHeight = window.innerHeight;
    const revealPoint = 150;

    elements.forEach(element => {
      const elementTop = element.getBoundingClientRect().top;

      if (elementTop < windowHeight - revealPoint) {
        element.classList.add('visible');
      } else {
        element.classList.remove('visible');
      }
    });
  };

  // Initial check
  animateElements();

  // Check on scroll and resize
  window.addEventListener('scroll', animateElements);
  window.addEventListener('resize', animateElements);

  //Effets hover pour les programmes
  const programs = document.querySelectorAll('.program');

  programs.forEach(program => {
    program.addEventListener('mouseenter', function () {
      const desc = this.querySelector('.program-description');
      if (desc) {
        desc.style.maxHeight = desc.scrollHeight + 'px';
        desc.style.opacity = '1';
      }
    });

    program.addEventListener('mouseleave', function () {
      const desc = this.querySelector('.program-description');
      if (desc) {
        desc.style.maxHeight = '0';
        desc.style.opacity = '0';
      }
    });
  });

  //nitialisation des animations au chargement
  setTimeout(() => {
    document.body.classList.add('loaded');
  }, 500);

  // Ajouter des écouteurs d'événements pour les images des programmes
  console.log('DOM chargé, initialisation des écouteurs d\'événements...');
  const programImages = document.querySelectorAll('.program-img');
  console.log('Nombre d\'images trouvées:', programImages.length);

  programImages.forEach(img => {
    img.addEventListener('click', function () {
      console.log('Image cliquée');
      const modalId = this.getAttribute('data-modal');
      console.log('ID du modal à ouvrir:', modalId);
      if (modalId) {
        openModal(modalId);
      }
    });
  });

  // Gestion du filtrage de la galerie
  const categoryButtons = document.querySelectorAll('.category-btn');
  const galleryItems = document.querySelectorAll('.gallery-item');

  categoryButtons.forEach(button => {
    button.addEventListener('click', function () {
      // Retirer la classe active de tous les boutons
      categoryButtons.forEach(btn => btn.classList.remove('active'));
      // Ajouter la classe active au bouton cliqué
      this.classList.add('active');

      const category = this.getAttribute('data-category');

      galleryItems.forEach(item => {
        if (category === 'all' || item.getAttribute('data-category') === category) {
          item.style.display = 'block';
          setTimeout(() => {
            item.style.opacity = '1';
            item.style.transform = 'scale(1)';
          }, 10);
        } else {
          item.style.opacity = '0';
          item.style.transform = 'scale(0.8)';
          setTimeout(() => {
            item.style.display = 'none';
          }, 300);
        }
      });
    });
  });

  // Gestion des cartes de programmes
  const programCards = document.querySelectorAll('.program-card');

  programCards.forEach(card => {
    card.addEventListener('click', function () {
      // Animation de clic
      this.style.transform = 'scale(0.98)';
      setTimeout(() => {
        this.style.transform = '';
      }, 200);

      // Récupération des informations du programme
      const programType = this.dataset.program;
      const programTitle = this.querySelector('h3').textContent;
      const programDescription = this.querySelector('.program-info p').textContent;
      const programFeatures = Array.from(this.querySelectorAll('.program-features li'))
        .map(li => li.textContent);

      // Création du modal avec les informations détaillées
      showProgramDetails(programType, programTitle, programDescription, programFeatures);
    });
  });
});

// Fonctions pour gérer les modals
function openModal(modalId) {
  console.log('Tentative d\'ouverture du modal:', modalId);
  const modal = document.getElementById(modalId);
  if (modal) {
    console.log('Modal trouvé, ouverture...');
    modal.style.display = "block";
    document.body.style.overflow = "hidden";
    // Ajouter une classe pour l'animation
    setTimeout(() => {
      modal.classList.add('modal-open');
    }, 10);
  } else {
    console.error('Modal non trouvé:', modalId);
  }
}

function showProgramDetails(type, title, description, features) {
  // Création du modal
  const modal = document.createElement('div');
  modal.className = 'modal';
  modal.id = `${type}-modal`;

  // Contenu du modal
  modal.innerHTML = `
    <div class="modal-content">
      <span class="close" onclick="closeModal('${type}-modal')">&times;</span>
      <h2>${title}</h2>
      <p>${description}</p>
      <div class="modal-features">
        <h3>Caractéristiques</h3>
        <ul>
          ${features.map(feature => `<li>${feature}</li>`).join('')}
        </ul>
      </div>
      <div class="modal-benefits">
        <h3>Bénéfices</h3>
        <ul>
          ${getBenefitsForProgram(type)}
        </ul>
      </div>
      <button  class="inscription-btn" onclick="window.location.href='../pages/inscription.html'">
         S'inscrire à ce programme
      </button>
    </div>
  `;

  // Ajout du modal au body
  document.body.appendChild(modal);

  // Animation d'ouverture
  setTimeout(() => {
    modal.style.display = 'block';
    modal.querySelector('.modal-content').style.opacity = '1';
  }, 10);

  // Empêcher le défilement du body
  document.body.style.overflow = 'hidden';
}

function getBenefitsForProgram(type) {
  const benefits = {
    yoga: [
      'Amélioration de la flexibilité et de la posture',
      'Réduction du stress et de l\'anxiété',
      'Renforcement musculaire en douceur',
      'Meilleure concentration et clarté mentale'
    ],
    strength: [
      'Augmentation de la masse musculaire',
      'Amélioration de la force et de la puissance',
      'Renforcement des os et des articulations',
      'Augmentation du métabolisme'
    ],
    cycle: [
      'Amélioration de l\'endurance cardiovasculaire',
      'Brûlage efficace des calories',
      'Renforcement des jambes',
      'Entraînement à faible impact'
    ],
    combat: [
      'Développement de la confiance en soi',
      'Amélioration de la condition physique',
      'Apprentissage des techniques d\'auto-défense',
      'Gestion du stress et de l\'agressivité'
    ]
  };

  return benefits[type].map(benefit => `<li>${benefit}</li>`).join('');
}

function closeModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.querySelector('.modal-content').style.opacity = '0';
    setTimeout(() => {
      modal.remove();
      document.body.style.overflow = '';
    }, 300);
  }
}

// Fermeture du modal en cliquant en dehors
window.addEventListener('click', function (event) {
  if (event.target.classList.contains('modal')) {
    closeModal(event.target.id);
  }
});

// Fermer le modal avec la touche Echap
document.addEventListener('keydown', function (event) {
  if (event.key === "Escape") {
    const modals = document.getElementsByClassName('modal');
    for (let modal of modals) {
      if (modal.style.display === "block") {
        closeModal(modal.id);
      }
    }
  }
});

// Fonction pour envoyer le message via WhatsApp
function sendWhatsApp(event) {
  event.preventDefault();

  // Récupérer les valeurs du formulaire
  const name = document.getElementById('name').value;
  const email = document.getElementById('email').value;
  const message = document.getElementById('message').value;

  // Numéro de téléphone WhatsApp (à remplacer par votre numéro)
  const phoneNumber = "212600422374"; // Remplacez par votre numéro WhatsApp

  // Créer le message formaté
  const whatsappMessage = `*Nouveau message de contact*\n\n*Nom:* ${name}\n*Email:* ${email}\n\n*Message:*\n${message}`;

  // Encoder le message pour l'URL
  const encodedMessage = encodeURIComponent(whatsappMessage);

  // Créer le lien WhatsApp
  const whatsappUrl = `https://wa.me/${phoneNumber}?text=${encodedMessage}`;

  // Ouvrir WhatsApp dans un nouvel onglet
  window.open(whatsappUrl, '_blank');

  // Réinitialiser le formulaire
  document.getElementById('whatsappForm').reset();
}
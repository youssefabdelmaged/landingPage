/**
 * Landing Page - Main JavaScript
 * Handles interactivity and animations
 */

class LandingPage {
  constructor() {
    this.initCarousels();
    this.initFilterTabs();
    this.initFAQ();
    this.initPlayButtons();
    this.initFormSubmission();
    this.initSmoothScroll();
  }

  /**
   * Initialize all carousels on the page
   */
  initCarousels() {
    document.querySelectorAll('.carousel-container').forEach((container) => {
      this.setupCarousel(container);
    });
  }

  /**
   * Setup individual carousel
   */
  setupCarousel(container) {
    const carousel = container.querySelector('.carousel');
    if (!carousel) return;

    let currentIndex = 0;
    const slides = () => carousel.querySelectorAll('.slide');
    const prevBtn = container.querySelector('.carousel-btn.prev');
    const nextBtn = container.querySelector('.carousel-btn.next');

    const getGap = () => {
      const computed = window.getComputedStyle(carousel);
      return parseFloat(computed.gap) || 22;
    };

    const calculate = () => {
      const slideElements = slides();
      if (!slideElements.length) return { slideWidth: 0, visible: 1, maxIndex: 0 };

      const gap = getGap();
      const slideWidth = slideElements[0].offsetWidth + gap;
      const containerWidth = container.offsetWidth;
      const visible = Math.max(1, Math.floor(containerWidth / slideWidth));
      const maxIndex = Math.max(0, slideElements.length - visible);

      if (currentIndex > maxIndex) currentIndex = maxIndex;

      return { slideWidth, visible, maxIndex };
    };

    const updateTransform = () => {
      const { slideWidth } = calculate();
      const translateX = -currentIndex * slideWidth;
      carousel.style.transform = `translateX(${translateX}px)`;
    };

    // Event listeners
    prevBtn?.addEventListener('click', () => {
      const { maxIndex } = calculate();
      currentIndex = currentIndex <= 0 ? maxIndex : currentIndex - 1;
      updateTransform();
    });

    nextBtn?.addEventListener('click', () => {
      const { maxIndex } = calculate();
      currentIndex = currentIndex >= maxIndex ? 0 : currentIndex + 1;
      updateTransform();
    });

    window.addEventListener('resize', () => {
      setTimeout(updateTransform, 120);
    });

    setTimeout(updateTransform, 100);
  }

  /**
   * Initialize filter tabs
   */
  initFilterTabs() {
    document.querySelectorAll('.filter-tab').forEach((tab) => {
      tab.addEventListener('click', function () {
        const container = this.closest('.filter-tabs');
        if (!container) return;

        container.querySelectorAll('.filter-tab').forEach((t) => {
          t.classList.remove('active');
        });

        this.classList.add('active');
      });
    });
  }

  /**
   * Initialize FAQ accordion
   */
  initFAQ() {
    const faqItems = document.querySelectorAll('.faq-item');

    faqItems.forEach((item) => {
      const question = item.querySelector('.faq-question');
      const icon = item.querySelector('.faq-icon');

      if (!question) return;

      question.addEventListener('click', () => {
        const isOpen = item.classList.contains('expanded');

        // Close all items
        faqItems.forEach((other) => {
          other.classList.remove('expanded');
          const otherIcon = other.querySelector('.faq-icon');
          if (otherIcon) otherIcon.textContent = '+';
        });

        // Open selected
        if (!isOpen) {
          item.classList.add('expanded');
          if (icon) icon.textContent = '−';
        }
      });

      // Accessibility
      question.setAttribute('tabindex', '0');
      question.setAttribute('role', 'button');

      question.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ' ') {
          e.preventDefault();
          question.click();
        }
      });
    });
  }

  /**
   * Initialize play button for video
   */
  initPlayButtons() {
    const videoContainers = document.querySelectorAll('.about-image-stack');

    videoContainers.forEach((container) => {
      const video = container.querySelector('video');
      const playBtn = container.querySelector('.about-play-btn');

      if (!video || !playBtn) return;

      const showBtn = () => {
        playBtn.style.display = 'flex';
      };

      const hideBtn = () => {
        playBtn.style.display = 'none';
      };

      playBtn.addEventListener('click', (e) => {
        e.preventDefault();
        if (video.paused) {
          video.play();
        } else {
          video.pause();
        }
      });

      video.addEventListener('play', hideBtn);
      video.addEventListener('pause', showBtn);
      video.addEventListener('ended', showBtn);
    });
  }

  /**
   * Initialize form submission with validation
   */
  initFormSubmission() {
    document.querySelectorAll('form').forEach((form) => {
      form.addEventListener('submit', (e) => {
        e.preventDefault();

        const isValid = this.validateForm(form);

        if (isValid) {
          this.submitForm(form);
        } else {
          this.showError('يرجى ملء جميع الحقول المطلوبة');
        }
      });
    });
  }

  /**
   * Validate form fields
   */
  validateForm(form) {
    const requiredInputs = form.querySelectorAll('[required]');
    let isValid = true;

    requiredInputs.forEach((input) => {
      const value = input.value.trim();

      if (!value) {
        isValid = false;
        input.style.borderColor = '#ff0000';
      } else {
        input.style.borderColor = '';
      }
    });

    return isValid;
  }

  /**
   * Submit form via AJAX
   */
  async submitForm(form) {
    try {
      const formData = new FormData(form);
      const response = await fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
        },
      });

      if (response.ok) {
        this.showSuccess('تم إرسال النموذج بنجاح');
        form.reset();
      } else {
        this.showError('حدث خطأ أثناء إرسال النموذج');
      }
    } catch (error) {
      console.error('Form submission error:', error);
      this.showError('حدث خطأ في الاتصال');
    }
  }

  /**
   * Initialize smooth scrolling for anchor links
   */
  initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach((link) => {
      link.addEventListener('click', (e) => {
        const href = link.getAttribute('href');
        if (href === '#') return;

        const target = document.querySelector(href);
        if (!target) return;

        e.preventDefault();
        target.scrollIntoView({
          behavior: 'smooth',
          block: 'start',
        });
      });
    });
  }

  /**
   * Show success message
   */
  showSuccess(message) {
    this.showNotification(message, 'success');
  }

  /**
   * Show error message
   */
  showError(message) {
    this.showNotification(message, 'error');
  }

  /**
   * Show notification
   */
  showNotification(message, type) {
    // Create toast element
    const toast = document.createElement('div');
    toast.className = `alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show`;
    toast.setAttribute('role', 'alert');
    toast.innerHTML = `
      ${message}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;

    // Add to page
    const container = document.body;
    container.appendChild(toast);

    // Auto remove after 5 seconds
    setTimeout(() => {
      toast.remove();
    }, 5000);
  }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
  new LandingPage();

  // Initialize animations with IntersectionObserver
  const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px',
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.style.opacity = '1';
        entry.target.style.transform = 'translateY(0)';
      }
    });
  }, observerOptions);

  // Observe cards for animation
  document
    .querySelectorAll(
      '.course-card, .team-card, .service-card, .testimonial-card, .blog-card'
    )
    .forEach((el) => {
      el.style.opacity = '0';
      el.style.transform = 'translateY(20px)';
      el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
      observer.observe(el);
    });

  // Animate stats
  const statsSection = document.querySelector('.stats-section');
  if (statsSection) {
    observer.observe(statsSection);
    statsSection.addEventListener('scroll-into-view', () => {
      document.querySelectorAll('.stat-value').forEach((el) => {
        const target = parseInt(el.textContent, 10);
        if (target) {
          animateCounter(el, target);
        }
      });
    });
  }
});

/**
 * Animate counter function
 */
function animateCounter(element, target) {
  let current = 0;
  const increment = Math.ceil(target / 30);
  const timer = setInterval(() => {
    current += increment;
    if (current >= target) {
      element.textContent = target;
      clearInterval(timer);
    } else {
      element.textContent = current;
    }
  }, 50);
}

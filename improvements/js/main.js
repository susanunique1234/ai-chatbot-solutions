/* =====================================
   MODERN AI-SOLUTIONS - MAIN JAVASCRIPT
===================================== */

// DOM Elements
const navbar = document.querySelector('.navbar');
const navToggler = document.querySelector('.navbar-toggler');
const navMenu = document.querySelector('.navbar-menu');
const navLinks = document.querySelectorAll('.nav-link');
const chatbotToggle = document.getElementById('chatbotToggle');
const chatbotContainer = document.getElementById('chatbotContainer');
const chatClose = document.getElementById('chatClose');
const chatInput = document.querySelector('.chat-input');
const chatMessages = document.querySelector('.chat-messages');
const chatFooterBtn = document.querySelector('.chat-footer button');
const contactForm = document.querySelector('.contact-form');
const newsletterForm = document.querySelector('.newsletter-form');

// =====================================
// NAVBAR SCROLL & FUNCTIONALITY
// =====================================

window.addEventListener('scroll', () => {
    if (window.scrollY > 100) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});

// Mobile Menu Toggle
if (navToggler) {
    navToggler.addEventListener('click', () => {
        navMenu.classList.toggle('active');
        
        // Animate toggler
        const icons = navToggler.querySelectorAll('.toggler-icon');
        if (navMenu.classList.contains('active')) {
            icons[0].style.transform = 'rotate(45deg) translateY(12px)';
            icons[1].style.opacity = '0';
            icons[2].style.transform = 'rotate(-45deg) translateY(-12px)';
        } else {
            icons[0].style.transform = 'none';
            icons[1].style.opacity = '1';
            icons[2].style.transform = 'none';
        }
    });
}

// Close mobile menu when link is clicked
navLinks.forEach(link => {
    link.addEventListener('click', () => {
        navMenu.classList.remove('active');
        const icons = navToggler.querySelectorAll('.toggler-icon');
        icons[0].style.transform = 'none';
        icons[1].style.opacity = '1';
        icons[2].style.transform = 'none';
    });
});

// Update active nav link based on scroll position
window.addEventListener('scroll', () => {
    let current = '';
    
    const sections = document.querySelectorAll('section');
    sections.forEach(section => {
        const sectionTop = section.offsetTop;
        const sectionHeight = section.clientHeight;
        if (scrollY >= sectionTop - 200) {
            current = section.getAttribute('id');
        }
    });

    navLinks.forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href').slice(1) === current) {
            link.classList.add('active');
        }
    });
});

// =====================================
// SMOOTH SCROLLING
// =====================================

document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// =====================================
// CHATBOT FUNCTIONALITY
// =====================================

// Toggle chatbot visibility
chatbotToggle.addEventListener('click', () => {
    chatbotContainer.classList.toggle('active');
    if (chatbotContainer.classList.contains('active')) {
        chatInput.focus();
    }
});

// Close chatbot
chatClose.addEventListener('click', () => {
    chatbotContainer.classList.remove('active');
});

// Close chatbot when clicking outside
document.addEventListener('click', (e) => {
    if (!e.target.closest('.chatbot-container') && !e.target.closest('.chatbot-toggle')) {
        chatbotContainer.classList.remove('active');
    }
});

// Send message function
function sendMessage() {
    const message = chatInput.value.trim();
    
    if (message === '') return;

    // Add user message
    const userMessageDiv = document.createElement('div');
    userMessageDiv.classList.add('user-message');
    userMessageDiv.innerHTML = `<p>${escapeHtml(message)}</p>`;
    chatMessages.appendChild(userMessageDiv);

    // Clear input
    chatInput.value = '';

    // Scroll to bottom
    chatMessages.scrollTop = chatMessages.scrollHeight;

    // Simulate bot response
    setTimeout(() => {
        const botMessageDiv = document.createElement('div');
        botMessageDiv.classList.add('bot-message');
        const responses = [
            "That's a great question! How can I help you further?",
            "I'm here to assist you 24/7. What would you like to know?",
            "Thanks for reaching out! Is there anything else I can help with?",
            "I appreciate your interest. Let me provide more information.",
            "Absolutely! We're committed to providing excellent service.",
            "That's an interesting point. Would you like more details?"
        ];
        const randomResponse = responses[Math.floor(Math.random() * responses.length)];
        botMessageDiv.innerHTML = `<p>${randomResponse}</p>`;
        chatMessages.appendChild(botMessageDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }, 600);
}

// Chat input events
chatInput.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') {
        sendMessage();
    }
});

chatFooterBtn.addEventListener('click', sendMessage);

// =====================================
// FORM HANDLING
// =====================================

// Contact Form Submission
if (contactForm) {
    contactForm.addEventListener('submit', (e) => {
        e.preventDefault();
        
        const formData = new FormData(contactForm);
        const data = Object.fromEntries(formData);
        
        // Validate form
        const inputs = contactForm.querySelectorAll('.form-control');
        let isValid = true;
        
        inputs.forEach(input => {
            if (!input.value.trim()) {
                isValid = false;
                input.style.borderColor = '#EF4444';
            } else {
                input.style.borderColor = '#E2E8F0';
            }
        });

        if (isValid) {
            // Simulate form submission
            const submitBtn = contactForm.querySelector('.custom-btn');
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'Sending...';
            submitBtn.disabled = true;

            setTimeout(() => {
                submitBtn.textContent = '✓ Message Sent!';
                submitBtn.style.background = 'linear-gradient(45deg, #10B981, #34D399)';
                
                // Reset form
                contactForm.reset();
                inputs.forEach(input => {
                    input.style.borderColor = '#E2E8F0';
                });

                // Restore button after 3 seconds
                setTimeout(() => {
                    submitBtn.textContent = originalText;
                    submitBtn.style.background = '';
                    submitBtn.disabled = false;
                }, 3000);
            }, 1500);
        }
    });
}

// Newsletter Form Submission
if (newsletterForm) {
    newsletterForm.addEventListener('submit', (e) => {
        e.preventDefault();
        
        const emailInput = newsletterForm.querySelector('input[type="email"]');
        const email = emailInput.value.trim();

        // Validate email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (!emailRegex.test(email)) {
            emailInput.style.borderColor = '#EF4444';
            return;
        }

        emailInput.style.borderColor = '#E2E8F0';
        
        const submitBtn = newsletterForm.querySelector('button');
        const originalText = submitBtn.textContent;
        submitBtn.textContent = 'Subscribing...';
        submitBtn.disabled = true;

        setTimeout(() => {
            submitBtn.textContent = '✓ Subscribed!';
            emailInput.value = '';
            
            setTimeout(() => {
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            }, 3000);
        }, 1000);
    });
}

// =====================================
// SCROLL ANIMATIONS
// =====================================

const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -100px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.animation = 'fadeInUp 0.8s ease forwards';
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

// Observe all cards
document.querySelectorAll('.custom-card, .feedback-card, .dashboard-card, .service-card, .gallery-card').forEach(card => {
    card.style.opacity = '0';
    observer.observe(card);
});

// =====================================
// UTILITY FUNCTIONS
// =====================================

// Escape HTML to prevent XSS
function escapeHtml(text) {
    const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return text.replace(/[&<>"']/g, m => map[m]);
}

// =====================================
// NUMBER COUNTER ANIMATION
// =====================================

function animateCounter(element, target, duration = 2000) {
    let current = 0;
    const increment = target / (duration / 16);
    
    const counter = setInterval(() => {
        current += increment;
        if (current >= target) {
            element.textContent = target;
            clearInterval(counter);
        } else {
            element.textContent = Math.floor(current);
        }
    }, 16);
}

// Animate counters when section comes into view
const statsSection = document.querySelector('.hero-stats');
if (statsSection) {
    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const stats = entry.target.querySelectorAll('h3');
                stats.forEach(stat => {
                    const number = parseInt(stat.textContent);
                    animateCounter(stat, number);
                });
                statsObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });
    
    statsObserver.observe(statsSection);
}

// =====================================
// SCROLL TO TOP BUTTON (Optional)
// =====================================

// Create scroll to top button
const scrollTopBtn = document.createElement('button');
scrollTopBtn.innerHTML = '↑';
scrollTopBtn.style.cssText = `
    position: fixed;
    bottom: 30px;
    left: 30px;
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #7C3AED, #EC4899);
    color: white;
    border: none;
    border-radius: 50%;
    cursor: pointer;
    font-size: 24px;
    display: none;
    z-index: 998;
    box-shadow: 0 10px 25px rgba(124, 58, 237, 0.4);
    transition: all 0.3s ease;
`;

document.body.appendChild(scrollTopBtn);

// Show/hide scroll to top button
window.addEventListener('scroll', () => {
    if (window.scrollY > 300) {
        scrollTopBtn.style.display = 'flex';
        scrollTopBtn.style.alignItems = 'center';
        scrollTopBtn.style.justifyContent = 'center';
    } else {
        scrollTopBtn.style.display = 'none';
    }
});

// Scroll to top when clicked
scrollTopBtn.addEventListener('click', () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});

scrollTopBtn.addEventListener('mouseenter', () => {
    scrollTopBtn.style.transform = 'translateY(-5px)';
    scrollTopBtn.style.boxShadow = '0 15px 35px rgba(124, 58, 237, 0.5)';
});

scrollTopBtn.addEventListener('mouseleave', () => {
    scrollTopBtn.style.transform = 'translateY(0)';
    scrollTopBtn.style.boxShadow = '0 10px 25px rgba(124, 58, 237, 0.4)';
});

// =====================================
// LAZY LOADING IMAGES (Performance)
// =====================================

if ('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src || img.src;
                img.classList.add('loaded');
                observer.unobserve(img);
            }
        });
    });

    document.querySelectorAll('img[data-src]').forEach(img => imageObserver.observe(img));
}

// =====================================
// KEYBOARD SHORTCUTS
// =====================================

document.addEventListener('keydown', (e) => {
    // Press '?' to toggle chatbot (optional feature)
    if (e.key === '?') {
        e.preventDefault();
        chatbotContainer.classList.toggle('active');
    }
    
    // Press 'Escape' to close chatbot
    if (e.key === 'Escape') {
        chatbotContainer.classList.remove('active');
    }
});

// =====================================
// PERFORMANCE MONITORING (Optional)
// =====================================

window.addEventListener('load', () => {
    if (window.performance && window.performance.timing) {
        const perfData = window.performance.timing;
        const pageLoadTime = perfData.loadEventEnd - perfData.navigationStart;
        console.log('Page load time:', pageLoadTime + 'ms');
    }
});

// =====================================
// INITIALIZATION
// =====================================

document.addEventListener('DOMContentLoaded', () => {
    console.log('Modern AI Solutions website loaded successfully!');
    
    // Initialize any additional features
    initializeAnimations();
});

function initializeAnimations() {
    // Add any initialization code here
    const cards = document.querySelectorAll('.custom-card, .service-card');
    cards.forEach((card, index) => {
        card.style.animationDelay = (index * 0.1) + 's';
    });
}

// =====================================
// SERVICE WORKER (PWA Support - Optional)
// =====================================

if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        // Uncomment to enable service worker
        // navigator.serviceWorker.register('/sw.js');
    });
}

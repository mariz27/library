class DashboardManager {
    constructor() { this.init(); }

    init() {
        this.setupIntersectionObserver();
        this.setupScrollEvents();
        this.setupNavigationEvents();
        this.initializeAnimations();
    }

    setupIntersectionObserver() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('show');
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.neumorphic').forEach(el => observer.observe(el));
    }

    setupScrollEvents() {
        const scrollTopBtn = document.getElementById('scrollTop');
        window.addEventListener('scroll', () => {
            this.handleScrollToTopButton(scrollTopBtn);
            this.updateBackgroundColor();
        });
        scrollTopBtn.addEventListener('click', () => this.scrollToTop());
    }

    handleScrollToTopButton(button) {
        button.classList.toggle('show', window.pageYOffset > 300);
    }

    scrollToTop() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    setupNavigationEvents() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', (e) => {
                e.preventDefault();
                const targetId = anchor.getAttribute('href');
                if (targetId === '#') return;
                const targetElement = document.querySelector(targetId);
                if (targetElement) targetElement.scrollIntoView({ behavior: 'smooth' });
            });
        });
    }

    initializeAnimations() {
        setTimeout(() => {
            document.querySelectorAll('.neumorphic').forEach(el => {
                const rect = el.getBoundingClientRect();
                if (rect.top < window.innerHeight) el.classList.add('show');
            });
            this.updateBackgroundColor();
        }, 300);
    }

    updateBackgroundColor() {
        const sections = document.querySelectorAll('.section');
        const windowHeight = window.innerHeight;
        let activeSection = 0;
        
        sections.forEach((section, index) => {
            const rect = section.getBoundingClientRect();
            if (rect.top <= windowHeight/2 && rect.bottom >= windowHeight/2) {
                activeSection = index;
            }
        });
        
        const colors = ['var(--section1-color)', 'var(--section2-color)', 'var(--section3-color)', 'var(--section4-color)'];
        document.body.style.backgroundColor = colors[activeSection];
    }
}

document.addEventListener('DOMContentLoaded', () => new DashboardManager());
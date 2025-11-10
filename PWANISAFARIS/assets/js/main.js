/**
 * Main JavaScript file for Pwani Safaris
 * Handles navigation, mobile menu, and interactive elements
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // Mobile Menu Toggle
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
    
    if (mobileMenuButton && mobileMenu && mobileMenuOverlay) {
        // Toggle mobile menu
        function toggleMobileMenu() {
            const isOpen = !mobileMenu.classList.contains('-translate-x-full');
            
            if (isOpen) {
                // Close menu
                mobileMenu.classList.add('-translate-x-full');
                mobileMenuOverlay.classList.add('opacity-0', 'invisible');
                document.body.classList.remove('overflow-hidden');
            } else {
                // Open menu
                mobileMenu.classList.remove('-translate-x-full');
                mobileMenuOverlay.classList.remove('opacity-0', 'invisible');
                document.body.classList.add('overflow-hidden');
            }
        }
        
        // Event listeners
        mobileMenuButton.addEventListener('click', toggleMobileMenu);
        mobileMenuOverlay.addEventListener('click', toggleMobileMenu);
        
        // Close menu when clicking on navigation links
        const mobileNavLinks = mobileMenu.querySelectorAll('a[href]');
        mobileNavLinks.forEach(link => {
            link.addEventListener('click', () => {
                setTimeout(toggleMobileMenu, 100);
            });
        });
    }
    
    // Mobile Dropdown Toggle
    const mobileDropdownToggles = document.querySelectorAll('.mobile-dropdown-toggle');
    
    mobileDropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const targetElement = document.getElementById(targetId);
            const arrow = this.querySelector('svg');
            
            if (targetElement) {
                const isHidden = targetElement.classList.contains('hidden');
                
                // Close all other dropdowns
                mobileDropdownToggles.forEach(otherToggle => {
                    if (otherToggle !== this) {
                        const otherId = otherToggle.getAttribute('data-target');
                        const otherElement = document.getElementById(otherId);
                        const otherArrow = otherToggle.querySelector('svg');
                        
                        if (otherElement && !otherElement.classList.contains('hidden')) {
                            otherElement.classList.add('hidden');
                            otherArrow.classList.remove('rotate-180');
                        }
                    }
                });
                
                // Toggle current dropdown
                if (isHidden) {
                    targetElement.classList.remove('hidden');
                    arrow.classList.add('rotate-180');
                } else {
                    targetElement.classList.add('hidden');
                    arrow.classList.remove('rotate-180');
                }
            }
        });
    });
    
    // Smooth scroll for anchor links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href === '#') return;
            
            const target = document.querySelector(href);
            if (target) {
                e.preventDefault();
                const headerHeight = document.querySelector('header').offsetHeight;
                const targetPosition = target.offsetTop - headerHeight - 20;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // Header scroll effect (optional enhancement)
    let lastScrollTop = 0;
    const header = document.querySelector('header');
    
    window.addEventListener('scroll', function() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        // Add shadow on scroll
        if (scrollTop > 10) {
            header.classList.add('shadow-lg');
        } else {
            header.classList.remove('shadow-lg');
        }
        
        lastScrollTop = scrollTop;
    });
    
    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        const isDropdownClick = e.target.closest('.group') || e.target.closest('.mobile-dropdown-toggle');
        
        if (!isDropdownClick) {
            // Close mobile dropdowns
            mobileDropdownToggles.forEach(toggle => {
                const targetId = toggle.getAttribute('data-target');
                const targetElement = document.getElementById(targetId);
                const arrow = toggle.querySelector('svg');
                
                if (targetElement && !targetElement.classList.contains('hidden')) {
                    targetElement.classList.add('hidden');
                    arrow.classList.remove('rotate-180');
                }
            });
        }
    });
    
    // Handle window resize
    window.addEventListener('resize', function() {
        // Close mobile menu on desktop
        if (window.innerWidth >= 1024) {
            if (!mobileMenu.classList.contains('-translate-x-full')) {
                mobileMenu.classList.add('-translate-x-full');
                mobileMenuOverlay.classList.add('opacity-0', 'invisible');
                document.body.classList.remove('overflow-hidden');
            }
            
            // Close mobile dropdowns
            mobileDropdownToggles.forEach(toggle => {
                const targetId = toggle.getAttribute('data-target');
                const targetElement = document.getElementById(targetId);
                const arrow = toggle.querySelector('svg');
                
                if (targetElement && !targetElement.classList.contains('hidden')) {
                    targetElement.classList.add('hidden');
                    arrow.classList.remove('rotate-180');
                }
            });
        }
    });
    
    // WhatsApp integration
    const whatsappLinks = document.querySelectorAll('a[href*="wa.me"]');
    whatsappLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Track WhatsApp clicks (for analytics if needed)
            console.log('WhatsApp link clicked');
        });
    });
    
    // Book Now button functionality
    const bookNowButtons = document.querySelectorAll('a[href="booking.php"]');
    bookNowButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            // Add any special booking tracking or behavior here
            console.log('Book Now button clicked');
        });
    });
    
    // Quick Booking Form Validation
    const quickBookingForm = document.getElementById('quick-booking-form');
    if (quickBookingForm) {
        quickBookingForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const tour = document.getElementById('tour-select').value;
            const date = document.getElementById('date-select').value;
            const people = document.getElementById('people-select').value;
            
            // Validate form fields
            if (!tour || !date || !people) {
                alert('Please fill in all fields before searching.');
                return;
            }
            
            // Redirect to booking page with parameters
            const params = new URLSearchParams({
                tour: tour,
                date: date,
                people: people
            });
            
            window.location.href = `booking.php?${params.toString()}`;
        });
    }
    
    // Testimonial Slider
    const testimonialTrack = document.getElementById('testimonial-track');
    const testimonialDots = document.querySelectorAll('.testimonial-dot');
    let currentSlide = 0;
    const totalSlides = testimonialDots.length;
    
    function updateSlider() {
        if (testimonialTrack) {
            testimonialTrack.style.transform = `translateX(-${currentSlide * 100}%)`;
            
            // Update dots
            testimonialDots.forEach((dot, index) => {
                if (index === currentSlide) {
                    dot.classList.remove('bg-white/50');
                    dot.classList.add('bg-white');
                } else {
                    dot.classList.remove('bg-white');
                    dot.classList.add('bg-white/50');
                }
            });
        }
    }
    
    // Dot navigation
    testimonialDots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            currentSlide = index;
            updateSlider();
        });
    });
    
    // Auto-advance testimonials
    if (testimonialTrack) {
        setInterval(() => {
            currentSlide = (currentSlide + 1) % totalSlides;
            updateSlider();
        }, 5000);
        
        // Initialize first slide
        updateSlider();
    }
    
    // Lightbox functionality for gallery images
    function initLightbox() {
        // Create lightbox element
        const lightbox = document.createElement('div');
        lightbox.className = 'lightbox';
        lightbox.innerHTML = `
            <span class="lightbox-close">&times;</span>
            <img src="" alt="">
        `;
        document.body.appendChild(lightbox);
        
        const lightboxImg = lightbox.querySelector('img');
        const lightboxClose = lightbox.querySelector('.lightbox-close');
        
        // Add click handlers to gallery images
        const galleryImages = document.querySelectorAll('.gallery-image');
        galleryImages.forEach(img => {
            img.addEventListener('click', () => {
                lightboxImg.src = img.src;
                lightboxImg.alt = img.alt;
                lightbox.classList.add('active');
                document.body.classList.add('overflow-hidden');
            });
        });
        
        // Close lightbox
        function closeLightbox() {
            lightbox.classList.remove('active');
            document.body.classList.remove('overflow-hidden');
        }
        
        lightboxClose.addEventListener('click', closeLightbox);
        lightbox.addEventListener('click', (e) => {
            if (e.target === lightbox) {
                closeLightbox();
            }
        });
        
        // Close with escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && lightbox.classList.contains('active')) {
                closeLightbox();
            }
        });
    }
    
    // Initialize lightbox if gallery images exist
    if (document.querySelectorAll('.gallery-image').length > 0) {
        initLightbox();
    }
    
    // Newsletter subscription form
    const newsletterForm = document.getElementById('newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = this.querySelector('input[type="email"]').value;
            const button = this.querySelector('button[type="submit"]');
            const originalText = button.textContent;
            
            // Simple email validation
            if (!email || !email.includes('@')) {
                alert('Please enter a valid email address.');
                return;
            }
            
            // Show loading state
            button.textContent = 'Subscribing...';
            button.disabled = true;
            
            // Simulate API call (replace with actual implementation)
            setTimeout(() => {
                alert('Thank you for subscribing to our newsletter!');
                this.reset();
                button.textContent = originalText;
                button.disabled = false;
            }, 1500);
        });
    }
    
    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in-up');
            }
        });
    }, observerOptions);
    
    // Observe elements for animation
    const animateElements = document.querySelectorAll('.card-hover, .testimonial-slide');
    animateElements.forEach(el => {
        observer.observe(el);
    });
    
    // Tour Category Filters (for tours.php)
    const filterButtons = document.querySelectorAll('.filter-btn');
    const tourCards = document.querySelectorAll('.tour-card');
    
    if (filterButtons.length > 0 && tourCards.length > 0) {
        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                const filter = button.getAttribute('data-filter');
                
                // Update active button
                filterButtons.forEach(btn => {
                    btn.classList.remove('active', 'bg-primary', 'text-white');
                    btn.classList.add('bg-white', 'text-charcoal', 'border-2', 'border-gray-200');
                });
                
                button.classList.add('active', 'bg-primary', 'text-white');
                button.classList.remove('bg-white', 'text-charcoal', 'border-2', 'border-gray-200');
                
                // Filter tour cards
                tourCards.forEach(card => {
                    const cardCategory = card.getAttribute('data-category');
                    
                    if (filter === 'all' || cardCategory === filter) {
                        card.style.display = 'block';
                        // Add fade-in animation
                        card.style.opacity = '0';
                        card.style.transform = 'translateY(20px)';
                        
                        setTimeout(() => {
                            card.style.transition = 'all 0.3s ease';
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0)';
                        }, 100);
                    } else {
                        card.style.transition = 'all 0.3s ease';
                        card.style.opacity = '0';
                        card.style.transform = 'translateY(-20px)';
                        
                        setTimeout(() => {
                            card.style.display = 'none';
                        }, 300);
                    }
                });
            });
        });
    }
    
    // URL parameter handling for tours page
    const urlParams = new URLSearchParams(window.location.search);
    const categoryParam = urlParams.get('category');
    
    if (categoryParam && filterButtons.length > 0) {
        const targetButton = document.querySelector(`[data-filter="${categoryParam}"]`);
        if (targetButton) {
            targetButton.click();
        }
    }
    
    // Accordion functionality for tour details page
    const accordionButtons = document.querySelectorAll('.accordion-btn');
    
    accordionButtons.forEach(button => {
        button.addEventListener('click', () => {
            const target = button.getAttribute('data-target');
            const content = document.getElementById(target);
            const icon = button.querySelector('.accordion-icon');
            
            if (content && icon) {
                const isOpen = !content.classList.contains('hidden');
                
                // Close all accordions first
                accordionButtons.forEach(btn => {
                    const btnTarget = btn.getAttribute('data-target');
                    const btnContent = document.getElementById(btnTarget);
                    const btnIcon = btn.querySelector('.accordion-icon');
                    
                    if (btnContent && btnIcon) {
                        btnContent.classList.add('hidden');
                        btnIcon.textContent = '+';
                        btnIcon.style.transform = 'rotate(0deg)';
                    }
                });
                
                // If this accordion wasn't open, open it
                if (isOpen) {
                    content.classList.add('hidden');
                    icon.textContent = '+';
                    icon.style.transform = 'rotate(0deg)';
                } else {
                    content.classList.remove('hidden');
                    icon.textContent = '−';
                    icon.style.transform = 'rotate(180deg)';
                }
            }
        });
    });
    
    // Booking form validation and submission
    const bookingForm = document.getElementById('bookingForm');
    const successMessage = document.getElementById('success-message');
    const errorMessage = document.getElementById('error-message');
    
    if (bookingForm) {
        bookingForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Hide previous messages
            if (successMessage) successMessage.classList.add('hidden');
            if (errorMessage) errorMessage.classList.add('hidden');
            
            // Get form data
            const formData = new FormData(bookingForm);
            const fullname = formData.get('fullname')?.trim();
            const email = formData.get('email')?.trim();
            const phone = formData.get('phone')?.trim();
            const tour = formData.get('tour');
            const date = formData.get('date');
            const travelers = formData.get('travelers');
            
            // Validation
            let isValid = true;
            const errors = [];
            
            if (!fullname || fullname.length < 2) {
                errors.push('Please enter your full name');
                isValid = false;
            }
            
            if (!email || !isValidEmail(email)) {
                errors.push('Please enter a valid email address');
                isValid = false;
            }
            
            if (!phone || phone.length < 10) {
                errors.push('Please enter a valid phone number');
                isValid = false;
            }
            
            if (!tour) {
                errors.push('Please select a tour');
                isValid = false;
            }
            
            if (!date) {
                errors.push('Please select a travel date');
                isValid = false;
            } else {
                const selectedDate = new Date(date);
                const tomorrow = new Date();
                tomorrow.setDate(tomorrow.getDate() + 1);
                
                if (selectedDate < tomorrow) {
                    errors.push('Travel date must be at least one day in the future');
                    isValid = false;
                }
            }
            
            if (!travelers) {
                errors.push('Please select number of travelers');
                isValid = false;
            }
            
            if (!isValid) {
                // Show error message
                if (errorMessage) {
                    const errorText = errorMessage.querySelector('span');
                    if (errorText) {
                        errorText.textContent = errors.join('. ');
                    }
                    errorMessage.classList.remove('hidden');
                    
                    // Scroll to error message
                    errorMessage.scrollIntoView({ 
                        behavior: 'smooth', 
                        block: 'center' 
                    });
                }
                return;
            }
            
            // If validation passes, show success message
            if (successMessage) {
                successMessage.classList.remove('hidden');
                successMessage.scrollIntoView({ 
                    behavior: 'smooth', 
                    block: 'center' 
                });
            }
            
            // Reset form
            bookingForm.reset();
            
            // In a real application, you would send the data to a server here
            console.log('Booking form submitted:', {
                fullname,
                email,
                phone,
                tour,
                date,
                travelers,
                message: formData.get('message')
            });
        });
        
        // Real-time validation feedback
        const inputs = bookingForm.querySelectorAll('input[required], select[required]');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                validateField(this);
            });
            
            input.addEventListener('input', function() {
                // Remove error styling when user starts typing
                this.classList.remove('border-red-500', 'ring-red-500');
                this.classList.add('border-gray-300');
            });
        });
    }
    
    // Contact form validation and submission
    const contactForm = document.getElementById('contactForm');
    const contactSuccessMessage = document.getElementById('contact-success-message');
    const contactErrorMessage = document.getElementById('contact-error-message');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Hide previous messages
            if (contactSuccessMessage) contactSuccessMessage.classList.add('hidden');
            if (contactErrorMessage) contactErrorMessage.classList.add('hidden');
            
            // Get form data
            const formData = new FormData(contactForm);
            const fullname = formData.get('fullname')?.trim();
            const email = formData.get('email')?.trim();
            const phone = formData.get('phone')?.trim();
            const subject = formData.get('subject');
            const message = formData.get('message')?.trim();
            
            // Validation
            let isValid = true;
            const errors = [];
            
            // Clear previous field errors
            clearFieldErrors();
            
            if (!fullname || fullname.length < 2) {
                showFieldError('fullname', 'Please enter your full name');
                errors.push('Full name is required');
                isValid = false;
            }
            
            if (!email || !isValidEmail(email)) {
                showFieldError('email', 'Please enter a valid email address');
                errors.push('Valid email is required');
                isValid = false;
            }
            
            if (phone && phone.length > 0 && phone.length < 10) {
                showFieldError('phone', 'Please enter a valid phone number');
                errors.push('Valid phone number required');
                isValid = false;
            }
            
            if (!subject) {
                showFieldError('subject', 'Please select a subject');
                errors.push('Subject is required');
                isValid = false;
            }
            
            if (!message || message.length < 10) {
                showFieldError('message', 'Please enter a message (at least 10 characters)');
                errors.push('Message must be at least 10 characters');
                isValid = false;
            }
            
            if (!isValid) {
                // Show error message
                if (contactErrorMessage) {
                    const errorText = contactErrorMessage.querySelector('span');
                    if (errorText) {
                        errorText.textContent = errors.join('. ');
                    }
                    contactErrorMessage.classList.remove('hidden');
                    
                    // Scroll to error message
                    contactErrorMessage.scrollIntoView({ 
                        behavior: 'smooth', 
                        block: 'center' 
                    });
                }
                return;
            }
            
            // If validation passes, show success message (in real app, submit to server)
            if (contactSuccessMessage) {
                contactSuccessMessage.classList.remove('hidden');
                contactSuccessMessage.scrollIntoView({ 
                    behavior: 'smooth', 
                    block: 'center' 
                });
            }
            
            // Reset form
            contactForm.reset();
            
            // In a real application, you would send the data to process-contact.php here
            console.log('Contact form submitted:', {
                fullname,
                email,
                phone,
                subject,
                message
            });
        });
        
        // Real-time validation feedback for contact form
        const contactInputs = contactForm.querySelectorAll('input, select, textarea');
        contactInputs.forEach(input => {
            input.addEventListener('blur', function() {
                validateContactField(this);
            });
            
            input.addEventListener('input', function() {
                // Remove error styling when user starts typing
                clearFieldError(this.id);
            });
        });
    }
    
    // Gallery filtering functionality
    const galleryFilterBtns = document.querySelectorAll('.gallery-filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');
    
    if (galleryFilterBtns.length > 0) {
        galleryFilterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const filter = btn.getAttribute('data-filter');
                
                // Update active button
                galleryFilterBtns.forEach(b => {
                    b.classList.remove('active', 'bg-primary', 'text-white');
                    b.classList.add('bg-white', 'text-charcoal', 'border-2', 'border-gray-200');
                });
                
                btn.classList.add('active', 'bg-primary', 'text-white');
                btn.classList.remove('bg-white', 'text-charcoal', 'border-2', 'border-gray-200');
                
                // Filter gallery items
                galleryItems.forEach(item => {
                    const category = item.getAttribute('data-category');
                    
                    if (filter === 'all' || category === filter) {
                        item.style.display = 'block';
                        item.style.opacity = '0';
                        setTimeout(() => {
                            item.style.opacity = '1';
                        }, 100);
                    } else {
                        item.style.opacity = '0';
                        setTimeout(() => {
                            item.style.display = 'none';
                        }, 300);
                    }
                });
            });
        });
    }
    
    // Lightbox functionality
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    const lightboxTitle = document.getElementById('lightbox-title');
    const lightboxDescription = document.getElementById('lightbox-description');
    const closeLightbox = document.getElementById('close-lightbox');
    const prevImage = document.getElementById('prev-image');
    const nextImage = document.getElementById('next-image');
    
    let currentImageIndex = 0;
    let galleryImages = [];
    
    // Collect all gallery images
    function updateGalleryImages() {
        galleryImages = [];
        const visibleItems = document.querySelectorAll('.gallery-item[style*="display: block"], .gallery-item:not([style*="display: none"])');
        visibleItems.forEach(item => {
            const img = item.querySelector('img');
            const title = item.querySelector('h3')?.textContent || '';
            const description = item.querySelector('p')?.textContent || '';
            
            if (img) {
                galleryImages.push({
                    src: img.src,
                    alt: img.alt,
                    title: title,
                    description: description
                });
            }
        });
    }
    
    // Open lightbox function (called from HTML onclick)
    window.openLightbox = function(imageSrc, imageTitle) {
        updateGalleryImages();
        
        // Find current image index
        currentImageIndex = galleryImages.findIndex(img => img.src.includes(imageSrc.split('/').pop()));
        if (currentImageIndex === -1) currentImageIndex = 0;
        
        showLightboxImage(currentImageIndex);
        lightbox.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    };
    
    // Show image in lightbox
    function showLightboxImage(index) {
        if (galleryImages.length === 0) return;
        
        const image = galleryImages[index];
        lightboxImg.src = image.src;
        lightboxImg.alt = image.alt;
        lightboxTitle.textContent = image.title;
        lightboxDescription.textContent = image.description;
    }
    
    // Close lightbox
    if (closeLightbox) {
        closeLightbox.addEventListener('click', () => {
            lightbox.classList.add('hidden');
            document.body.style.overflow = '';
        });
    }
    
    // Previous image
    if (prevImage) {
        prevImage.addEventListener('click', () => {
            currentImageIndex = (currentImageIndex - 1 + galleryImages.length) % galleryImages.length;
            showLightboxImage(currentImageIndex);
        });
    }
    
    // Next image
    if (nextImage) {
        nextImage.addEventListener('click', () => {
            currentImageIndex = (currentImageIndex + 1) % galleryImages.length;
            showLightboxImage(currentImageIndex);
        });
    }
    
    // Close lightbox on background click
    if (lightbox) {
        lightbox.addEventListener('click', (e) => {
            if (e.target === lightbox) {
                lightbox.classList.add('hidden');
                document.body.style.overflow = '';
            }
        });
    }
    
    // Keyboard navigation for lightbox
    document.addEventListener('keydown', (e) => {
        if (!lightbox.classList.contains('hidden')) {
            switch(e.key) {
                case 'Escape':
                    lightbox.classList.add('hidden');
                    document.body.style.overflow = '';
                    break;
                case 'ArrowLeft':
                    currentImageIndex = (currentImageIndex - 1 + galleryImages.length) % galleryImages.length;
                    showLightboxImage(currentImageIndex);
                    break;
                case 'ArrowRight':
                    currentImageIndex = (currentImageIndex + 1) % galleryImages.length;
                    showLightboxImage(currentImageIndex);
                    break;
            }
        }
    });
    
    // Load more functionality (placeholder)
    const loadMoreBtn = document.getElementById('load-more-btn');
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', () => {
            // In a real application, this would load more images from the server
            loadMoreBtn.textContent = 'Loading...';
            loadMoreBtn.disabled = true;
            
            setTimeout(() => {
                loadMoreBtn.textContent = 'No More Photos';
                loadMoreBtn.classList.add('opacity-50', 'cursor-not-allowed');
            }, 1000);
        });
    }
    
});

// Utility functions
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Email validation function
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Field validation function
function validateField(field) {
    const value = field.value.trim();
    let isValid = true;
    
    // Remove previous error styling
    field.classList.remove('border-red-500', 'ring-red-500');
    field.classList.add('border-gray-300');
    
    // Check if required field is empty
    if (field.hasAttribute('required') && !value) {
        isValid = false;
    }
    
    // Specific validation based on field type
    if (value) {
        switch (field.type) {
            case 'email':
                if (!isValidEmail(value)) {
                    isValid = false;
                }
                break;
            case 'tel':
                if (value.length < 10) {
                    isValid = false;
                }
                break;
            case 'date':
                const selectedDate = new Date(value);
                const tomorrow = new Date();
                tomorrow.setDate(tomorrow.getDate() + 1);
                if (selectedDate < tomorrow) {
                    isValid = false;
                }
                break;
        }
    }
    
    // Apply error styling if invalid
    if (!isValid) {
        field.classList.remove('border-gray-300');
        field.classList.add('border-red-500', 'ring-red-500');
    }
    
    return isValid;
}

// Contact form field validation functions
function validateContactField(field) {
    const value = field.value.trim();
    let isValid = true;
    let errorMessage = '';
    
    // Clear previous error
    clearFieldError(field.id);
    
    // Check if required field is empty
    if (field.hasAttribute('required') && !value) {
        isValid = false;
        errorMessage = 'This field is required';
    }
    
    // Specific validation based on field type and id
    if (value) {
        switch (field.id) {
            case 'fullname':
                if (value.length < 2) {
                    isValid = false;
                    errorMessage = 'Name must be at least 2 characters';
                }
                break;
            case 'email':
                if (!isValidEmail(value)) {
                    isValid = false;
                    errorMessage = 'Please enter a valid email address';
                }
                break;
            case 'phone':
                if (value.length > 0 && value.length < 10) {
                    isValid = false;
                    errorMessage = 'Phone number must be at least 10 digits';
                }
                break;
            case 'message':
                if (value.length < 10) {
                    isValid = false;
                    errorMessage = 'Message must be at least 10 characters';
                }
                break;
        }
    }
    
    // Show error if invalid
    if (!isValid) {
        showFieldError(field.id, errorMessage);
    }
    
    return isValid;
}

function showFieldError(fieldId, message) {
    const field = document.getElementById(fieldId);
    const errorDiv = document.getElementById(fieldId + '-error');
    
    if (field) {
        field.classList.remove('border-gray-300');
        field.classList.add('border-red-500', 'ring-red-500');
    }
    
    if (errorDiv && message) {
        errorDiv.textContent = message;
        errorDiv.classList.remove('hidden');
    }
}

function clearFieldError(fieldId) {
    const field = document.getElementById(fieldId);
    const errorDiv = document.getElementById(fieldId + '-error');
    
    if (field) {
        field.classList.remove('border-red-500', 'ring-red-500');
        field.classList.add('border-gray-300');
    }
    
    if (errorDiv) {
        errorDiv.classList.add('hidden');
        errorDiv.textContent = '';
    }
}

function clearFieldErrors() {
    const errorDivs = document.querySelectorAll('[id$="-error"]');
    errorDivs.forEach(errorDiv => {
        errorDiv.classList.add('hidden');
        errorDiv.textContent = '';
    });
    
    const fields = document.querySelectorAll('input, select, textarea');
    fields.forEach(field => {
        field.classList.remove('border-red-500', 'ring-red-500');
        field.classList.add('border-gray-300');
    });
}

// Export functions for use in other scripts if needed
window.PwaniSafaris = {
    toggleMobileMenu: function() {
        const event = new Event('click');
        document.getElementById('mobile-menu-button').dispatchEvent(event);
    }
};
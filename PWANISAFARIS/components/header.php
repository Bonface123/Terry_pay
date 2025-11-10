<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - Pwani Safaris' : 'Pwani Safaris - Coastal Adventures in Kenya'; ?></title>
    <meta name="description" content="<?php echo isset($page_description) ? $page_description : 'Discover authentic coastal adventures in Kenya with Pwani Safaris. Cultural tours, beach experiences, and community-first travel.'; ?>">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              primary: '#0077B6',     // Ocean Blue
              accent: '#2A9D8F',      // Palm Green
              cta: '#F77F00',         // Sunset Orange
              altcta: '#E63946',      // Coral Red
              base: '#F4E1C1',        // Sandy Beige
              textdark: '#3D3D3D',    // Swahili Charcoal
              lightbg: '#F8F9FA',     // White Smoke
              darkfooter: '#023E8A',  // Deep Navy
            },
            fontFamily: {
              heading: ['Playfair Display', 'serif'],
              body: ['Inter', 'sans-serif'],
            },
            container: {
              center: true,
              padding: '1rem',
            },
          },
        },
      };
    </script>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/styles.css">
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="assets/img/logo/pwanisafaris-logo.svg">
</head>
<body class="font-body text-textdark">

<?php
// Header component for Pwani Safaris
// Responsive navigation with coastal theme
?>

<header class="fixed top-0 w-full z-50 bg-white shadow-md">
    <!-- Top Info Bar -->
    <div class="hidden lg:block bg-gradient-to-r from-primary to-accent text-white py-2">
        <div class="container mx-auto px-4 flex justify-between items-center text-sm">
            <div class="flex items-center space-x-2">
                <span class="text-yellow-300">🌊</span>
                <span>Welcome to Pwani Safaris – Explore Kenya's Coastal Treasures</span>
            </div>
            <div class="flex items-center space-x-4">
                <a href="tel:+254700000000" class="flex items-center space-x-1 hover:text-yellow-300 transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                    </svg>
                    <span>+254 700 000 000</span>
                </a>
                <a href="mailto:info@pwanisafaris.com" class="flex items-center space-x-1 hover:text-yellow-300 transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                    </svg>
                    <span>info@pwanisafaris.com</span>
                </a>
                <a href="https://wa.me/254700000000" target="_blank" class="bg-green-500 hover:bg-green-600 px-3 py-1 rounded-full text-xs font-medium transition-colors">
                    WhatsApp
                </a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <nav class="bg-white border-b border-gray-100">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16 lg:h-20">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="index.php" class="flex items-center">
                        <img src="assets/img/logo/pwanisafaris-logo.svg" alt="Pwani Safaris" class="h-10 lg:h-12 w-auto">
                        <div class="ml-3 hidden sm:block">
                            <h1 class="text-xl lg:text-2xl font-bold text-primary font-heading">Pwani Safaris</h1>
                            <p class="text-xs text-textdark font-body">Coastal Adventures</p>
                        </div>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="index.php" class="text-textdark hover:text-cta font-medium font-body transition-colors">
                        HOME
                    </a>
                    
                    <!-- Tours Dropdown -->
                    <div class="relative group">
                        <button class="flex items-center text-textdark hover:text-cta font-medium font-body transition-colors">
                            TOURS
                            <svg class="ml-1 w-4 h-4 transition-transform group-hover:rotate-180" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                        <div class="absolute top-full left-0 mt-2 w-56 bg-white rounded-lg shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                            <div class="py-2">
                                <a href="tours.php?category=cultural" class="block px-4 py-3 text-textdark hover:bg-primary/10 hover:text-primary transition-colors">
                                    <div class="font-medium">Cultural Tours</div>
                                    <div class="text-sm text-gray-500">Traditional experiences</div>
                                </a>
                                <a href="tours.php?category=coastal" class="block px-4 py-3 text-textdark hover:bg-primary/10 hover:text-primary transition-colors">
                                    <div class="font-medium">Coastal Experiences</div>
                                    <div class="text-sm text-gray-500">Beach & marine adventures</div>
                                </a>
                                <a href="tours.php?category=custom" class="block px-4 py-3 text-textdark hover:bg-primary/10 hover:text-primary transition-colors">
                                    <div class="font-medium">Custom Packages</div>
                                    <div class="text-sm text-gray-500">Tailored experiences</div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Shop Dropdown -->
                    <div class="relative group">
                        <button class="flex items-center text-textdark hover:text-cta font-medium font-body transition-colors">
                            SHOP
                            <svg class="ml-1 w-4 h-4 transition-transform group-hover:rotate-180" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                        <div class="absolute top-full left-0 mt-2 w-56 bg-white rounded-lg shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                            <div class="py-2">
                                <a href="shop.php?category=jewelry" class="block px-4 py-3 text-textdark hover:bg-primary/10 hover:text-primary transition-colors">
                                    <div class="font-medium">Jewelry</div>
                                    <div class="text-sm text-gray-500">Handcrafted pieces</div>
                                </a>
                                <a href="shop.php?category=carvings" class="block px-4 py-3 text-textdark hover:bg-primary/10 hover:text-primary transition-colors">
                                    <div class="font-medium">Carvings</div>
                                    <div class="text-sm text-gray-500">Traditional art</div>
                                </a>
                                <a href="shop.php?category=apparel" class="block px-4 py-3 text-textdark hover:bg-primary/10 hover:text-primary transition-colors">
                                    <div class="font-medium">Apparel</div>
                                    <div class="text-sm text-gray-500">Cultural clothing</div>
                                </a>
                                <a href="shop.php?category=accessories" class="block px-4 py-3 text-textdark hover:bg-primary/10 hover:text-primary transition-colors">
                                    <div class="font-medium">Accessories</div>
                                    <div class="text-sm text-gray-500">Bags, crafts & more</div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <a href="gallery.php" class="text-textdark hover:text-cta font-medium font-body transition-colors">
                        GALLERY
                    </a>
                    <a href="blog.php" class="text-textdark hover:text-cta font-medium font-body transition-colors">
                        BLOG
                    </a>
                    <a href="about.php" class="text-textdark hover:text-cta font-medium font-body transition-colors">
                        ABOUT
                    </a>
                    <a href="contact.php" class="text-textdark hover:text-cta font-medium font-body transition-colors">
                        CONTACT
                    </a>
                </div>

                <!-- Right Side Buttons -->
                <div class="hidden lg:flex items-center space-x-4">
                    <a href="https://wa.me/254700000000" target="_blank" class="flex items-center space-x-2 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                        </svg>
                        <span>Chat</span>
                    </a>
                    <a href="booking.php" class="bg-cta hover:bg-altcta text-white px-6 py-3 rounded-full font-semibold font-body transition-all transform hover:scale-105 shadow-lg">
                        Book Now
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="lg:hidden">
                    <button id="mobile-menu-button" class="text-textdark hover:text-cta focus:outline-none focus:text-cta">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div id="mobile-menu" class="lg:hidden fixed inset-0 top-16 bg-white z-40 transform -translate-x-full transition-transform duration-300 ease-in-out">
            <div class="h-full overflow-y-auto">
                <!-- Mobile Top Info -->
                <div class="bg-gradient-to-r from-primary to-accent text-white p-4">
                    <div class="flex items-center justify-center space-x-4 text-sm">
                        <a href="tel:+254700000000" class="flex items-center space-x-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                            </svg>
                            <span>Call Us</span>
                        </a>
                        <a href="https://wa.me/254700000000" target="_blank" class="bg-green-500 px-3 py-1 rounded-full text-xs">
                            WhatsApp
                        </a>
                    </div>
                </div>

                <!-- Mobile Navigation Links -->
                <div class="p-4 space-y-4">
                    <a href="index.php" class="block text-textdark hover:text-cta font-medium py-2 border-b border-gray-100">
                        HOME
                    </a>
                    
                    <!-- Mobile Tours Section -->
                    <div class="border-b border-gray-100">
                        <button class="mobile-dropdown-toggle flex items-center justify-between w-full text-textdark hover:text-cta font-medium py-2" data-target="tours-mobile">
                            TOURS
                            <svg class="w-4 h-4 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                        <div id="tours-mobile" class="hidden pl-4 pb-2 space-y-2">
                            <a href="tours.php?category=cultural" class="block text-gray-600 hover:text-cta py-1">Cultural Tours</a>
                            <a href="tours.php?category=coastal" class="block text-gray-600 hover:text-cta py-1">Coastal Experiences</a>
                            <a href="tours.php?category=custom" class="block text-gray-600 hover:text-cta py-1">Custom Packages</a>
                        </div>
                    </div>

                    <!-- Mobile Shop Section -->
                    <div class="border-b border-gray-100">
                        <button class="mobile-dropdown-toggle flex items-center justify-between w-full text-textdark hover:text-cta font-medium py-2" data-target="shop-mobile">
                            SHOP
                            <svg class="w-4 h-4 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                        <div id="shop-mobile" class="hidden pl-4 pb-2 space-y-2">
                            <a href="shop.php?category=jewelry" class="block text-gray-600 hover:text-cta py-1">Jewelry</a>
                            <a href="shop.php?category=carvings" class="block text-gray-600 hover:text-cta py-1">Carvings</a>
                            <a href="shop.php?category=apparel" class="block text-gray-600 hover:text-cta py-1">Apparel</a>
                            <a href="shop.php?category=accessories" class="block text-gray-600 hover:text-cta py-1">Accessories</a>
                        </div>
                    </div>

                    <a href="gallery.php" class="block text-textdark hover:text-cta font-medium py-2 border-b border-gray-100">
                        GALLERY
                    </a>
                    <a href="blog.php" class="block text-textdark hover:text-cta font-medium py-2 border-b border-gray-100">
                        BLOG
                    </a>
                    <a href="about.php" class="block text-textdark hover:text-cta font-medium py-2 border-b border-gray-100">
                        ABOUT
                    </a>
                    <a href="contact.php" class="block text-textdark hover:text-cta font-medium py-2 border-b border-gray-100">
                        CONTACT
                    </a>

                    <!-- Mobile Action Buttons -->
                    <div class="pt-4 space-y-3">
                        <a href="https://wa.me/254700000000" target="_blank" class="flex items-center justify-center space-x-2 bg-green-500 hover:bg-green-600 text-white px-4 py-3 rounded-lg font-medium w-full">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                            </svg>
                            <span>WhatsApp Chat</span>
                        </a>
                        <a href="booking.php" class="block bg-cta hover:bg-altcta text-white px-6 py-3 rounded-full font-semibold font-body text-center transition-colors">
                            Book Now
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Overlay -->
        <div id="mobile-menu-overlay" class="lg:hidden fixed inset-0 bg-black bg-opacity-50 z-30 opacity-0 invisible transition-all duration-300"></div>
    </nav>
</header>

<!-- Add padding to body to account for fixed header -->
<div class="h-16 lg:h-20"></div>
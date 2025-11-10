<?php 
$page_title = "Tours & Experiences";
$page_description = "Discover authentic coastal adventures with Pwani Safaris. Cultural tours, coastal experiences, and custom packages in Kilifi, Diani, and Watamu.";
include('components/header.php'); 
?>

<!-- Hero Banner -->
<section class="relative h-[60vh] bg-center bg-cover" style="background-image: url('assets/img/tours/hero-tours.jpg');">
    <!-- Fallback gradient if image doesn't load -->
    <div class="absolute inset-0 bg-gradient-to-br from-primary via-accent to-primary opacity-90"></div>
    
    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/50 flex flex-col items-center justify-center text-white text-center px-4">
        <h1 class="text-4xl md:text-6xl font-bold font-sans mb-4 leading-tight">
            Discover Our Safari Adventures
        </h1>
        <p class="text-lg md:text-xl max-w-2xl font-body leading-relaxed">
            Choose from our cultural, coastal, and custom tour experiences along Kenya's magnificent coast.
        </p>
    </div>
</section>

<!-- Category Filters -->
<section class="py-8 bg-base/20">
    <div class="container mx-auto px-6">
        <div class="flex flex-wrap justify-center gap-4">
            <button class="filter-btn active bg-primary text-white px-6 py-3 rounded-full hover:bg-accent transition-all duration-300 font-semibold font-sans" data-filter="all">
                All Tours
            </button>
            <button class="filter-btn bg-white text-charcoal border-2 border-gray-200 px-6 py-3 rounded-full hover:border-primary hover:text-primary transition-all duration-300 font-semibold font-sans" data-filter="cultural">
                Cultural Tours
            </button>
            <button class="filter-btn bg-white text-charcoal border-2 border-gray-200 px-6 py-3 rounded-full hover:border-primary hover:text-primary transition-all duration-300 font-semibold font-sans" data-filter="coastal">
                Coastal Experiences
            </button>
            <button class="filter-btn bg-white text-charcoal border-2 border-gray-200 px-6 py-3 rounded-full hover:border-primary hover:text-primary transition-all duration-300 font-semibold font-sans" data-filter="custom">
                Custom Packages
            </button>
        </div>
    </div>
</section>

<!-- Tours Grid -->
<section class="py-16">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="tours-grid">
            
            <!-- Cultural Tour 1 -->
            <div class="tour-card bg-white shadow-lg rounded-xl overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2" data-category="cultural">
                <div class="relative">
                    <img src="assets/img/tours/kaya-kauma.jpg" class="w-full aspect-[4/3] object-cover" alt="Kaya Kauma Cultural Tour">
                    <div class="absolute top-4 left-4">
                        <span class="bg-accent text-white px-3 py-1 rounded-full text-sm font-semibold">Cultural</span>
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="text-xl font-semibold mb-2 text-primary font-sans">Kaya Kauma Sacred Forest</h3>
                    <p class="text-gray-600 mb-3 font-body">Explore sacred Mijikenda heritage sites and traditional homesteads with local elders.</p>
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-4 font-body">
                        <span>2 Days / 1 Night</span>
                        <span class="font-semibold text-cta">From KSh 15,000</span>
                    </div>
                    <a href="tour-details.php?tour=kaya-kauma" class="inline-block px-5 py-2 bg-primary text-white rounded-full hover:bg-accent transition-all duration-300 font-semibold font-sans">
                        View Details
                    </a>
                </div>
            </div>

            <!-- Cultural Tour 2 -->
            <div class="tour-card bg-white shadow-lg rounded-xl overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2" data-category="cultural">
                <div class="relative">
                    <img src="assets/img/tours/gede-ruins.jpg" class="w-full aspect-[4/3] object-cover" alt="Gede Ruins Historical Tour">
                    <div class="absolute top-4 left-4">
                        <span class="bg-accent text-white px-3 py-1 rounded-full text-sm font-semibold">Cultural</span>
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="text-xl font-semibold mb-2 text-primary font-sans">Gede Ruins Discovery</h3>
                    <p class="text-gray-600 mb-3 font-body">Uncover the mysteries of this 13th-century Swahili town hidden in the coastal forest.</p>
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-4 font-body">
                        <span>1 Day</span>
                        <span class="font-semibold text-cta">From KSh 8,500</span>
                    </div>
                    <a href="tour-details.php?tour=gede-ruins" class="inline-block px-5 py-2 bg-primary text-white rounded-full hover:bg-accent transition-all duration-300 font-semibold font-sans">
                        View Details
                    </a>
                </div>
            </div>

            <!-- Coastal Experience 1 -->
            <div class="tour-card bg-white shadow-lg rounded-xl overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2" data-category="coastal">
                <div class="relative">
                    <img src="assets/img/tours/sunset-cruise.jpg" class="w-full aspect-[4/3] object-cover" alt="Beach Sunset Cruise">
                    <div class="absolute top-4 left-4">
                        <span class="bg-cta text-white px-3 py-1 rounded-full text-sm font-semibold">Coastal</span>
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="text-xl font-semibold mb-2 text-primary font-sans">Beach Sunset Cruise</h3>
                    <p class="text-gray-600 mb-3 font-body">Sail along pristine coastlines while enjoying traditional music and fresh seafood.</p>
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-4 font-body">
                        <span>Half Day</span>
                        <span class="font-semibold text-cta">From KSh 12,000</span>
                    </div>
                    <a href="tour-details.php?tour=sunset-cruise" class="inline-block px-5 py-2 bg-primary text-white rounded-full hover:bg-accent transition-all duration-300 font-semibold font-sans">
                        View Details
                    </a>
                </div>
            </div>

            <!-- Coastal Experience 2 -->
            <div class="tour-card bg-white shadow-lg rounded-xl overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2" data-category="coastal">
                <div class="relative">
                    <img src="assets/img/tours/snorkeling-adventure.jpg" class="w-full aspect-[4/3] object-cover" alt="Coral Reef Snorkeling">
                    <div class="absolute top-4 left-4">
                        <span class="bg-cta text-white px-3 py-1 rounded-full text-sm font-semibold">Coastal</span>
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="text-xl font-semibold mb-2 text-primary font-sans">Coral Reef Snorkeling</h3>
                    <p class="text-gray-600 mb-3 font-body">Discover vibrant marine life in protected coral reef areas with expert guides.</p>
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-4 font-body">
                        <span>Full Day</span>
                        <span class="font-semibold text-cta">From KSh 18,000</span>
                    </div>
                    <a href="tour-details.php?tour=snorkeling-adventure" class="inline-block px-5 py-2 bg-primary text-white rounded-full hover:bg-accent transition-all duration-300 font-semibold font-sans">
                        View Details
                    </a>
                </div>
            </div>

            <!-- Coastal Experience 3 -->
            <div class="tour-card bg-white shadow-lg rounded-xl overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2" data-category="coastal">
                <div class="relative">
                    <img src="assets/img/tours/mangrove-exploration.jpg" class="w-full aspect-[4/3] object-cover" alt="Mangrove Forest Exploration">
                    <div class="absolute top-4 left-4">
                        <span class="bg-cta text-white px-3 py-1 rounded-full text-sm font-semibold">Coastal</span>
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="text-xl font-semibold mb-2 text-primary font-sans">Mangrove Forest Exploration</h3>
                    <p class="text-gray-600 mb-3 font-body">Navigate through ancient mangrove forests and learn about coastal conservation.</p>
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-4 font-body">
                        <span>Half Day</span>
                        <span class="font-semibold text-cta">From KSh 9,500</span>
                    </div>
                    <a href="tour-details.php?tour=mangrove-exploration" class="inline-block px-5 py-2 bg-primary text-white rounded-full hover:bg-accent transition-all duration-300 font-semibold font-sans">
                        View Details
                    </a>
                </div>
            </div>

            <!-- Custom Package -->
            <div class="tour-card bg-white shadow-lg rounded-xl overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2" data-category="custom">
                <div class="relative">
                    <img src="assets/img/tours/custom-package.jpg" class="w-full aspect-[4/3] object-cover" alt="Custom Coastal Adventure">
                    <div class="absolute top-4 left-4">
                        <span class="bg-altcta text-white px-3 py-1 rounded-full text-sm font-semibold">Custom</span>
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="text-xl font-semibold mb-2 text-primary font-sans">Custom Coastal Adventure</h3>
                    <p class="text-gray-600 mb-3 font-body">Design your perfect coastal journey with our local experts and community partners.</p>
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-4 font-body">
                        <span>Flexible Duration</span>
                        <span class="font-semibold text-cta">From KSh 25,000</span>
                    </div>
                    <a href="tour-details.php?tour=custom-package" class="inline-block px-5 py-2 bg-primary text-white rounded-full hover:bg-accent transition-all duration-300 font-semibold font-sans">
                        View Details
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Pagination -->
<section class="py-8">
    <div class="container mx-auto px-6">
        <div class="flex justify-center items-center space-x-2">
            <button class="px-4 py-2 text-gray-400 hover:text-primary transition-colors" disabled>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <button class="px-4 py-2 bg-primary text-white rounded-lg font-semibold">1</button>
            <button class="px-4 py-2 text-charcoal hover:bg-primary hover:text-white rounded-lg transition-colors font-semibold">2</button>
            <button class="px-4 py-2 text-charcoal hover:bg-primary hover:text-white rounded-lg transition-colors font-semibold">3</button>
            <button class="px-4 py-2 text-primary hover:text-accent transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        </div>
    </div>
</section>

<!-- CTA Footer Banner -->
<section class="py-16 bg-gradient-to-r from-primary to-accent text-white">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl md:text-4xl font-bold font-sans mb-4">
            Ready for Your Next Adventure?
        </h2>
        <p class="text-lg font-body mb-8 max-w-2xl mx-auto">
            Join us for an authentic coastal experience that connects you with Kenya's rich heritage and stunning natural beauty.
        </p>
        <a href="booking.php" class="inline-block bg-cta hover:bg-altcta text-white px-8 py-4 rounded-full font-bold font-sans uppercase tracking-wide transition-all duration-300 transform hover:scale-105 shadow-lg">
            Book Your Safari
        </a>
    </div>
</section>

<?php include('components/footer.php'); ?>

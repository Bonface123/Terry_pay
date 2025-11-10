<?php 
$page_title = "Gallery";
$page_description = "Explore stunning photos from Pwani Safaris adventures. Browse our collection of safari, beach, cultural tours, and wildlife experiences along Kenya's beautiful coast.";
include('components/header.php'); 
?>


<!-- HERO SECTION -->
<section class="relative bg-gradient-to-br from-primary via-accent to-primary opacity-90text-white py-24">
     
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-white md:text-6xl font-bold font-sans mb-6 leading-tight">Explore Our Adventures</h1>
 <p class="text-white md:text-2xl font-body leading-relaxed opacity-90">
            Memories from our happy travelers
        </p>
    </div>
</section>

<!-- Filter Tabs -->
<section class="py-12 bg-base/30">
    <div class="max-w-6xl mx-auto px-6">
        <div class="flex flex-wrap justify-center gap-4 mb-8">
            <button class="gallery-filter-btn active bg-primary text-white px-8 py-3 rounded-full font-semibold font-sans transition-all duration-300 hover:bg-accent transform hover:scale-105" data-filter="all">
                All Photos
            </button>
            <button class="gallery-filter-btn bg-white text-charcoal px-8 py-3 rounded-full font-semibold font-sans border-2 border-gray-200 transition-all duration-300 hover:border-primary hover:text-primary transform hover:scale-105" data-filter="safari">
                Safari
            </button>
            <button class="gallery-filter-btn bg-white text-charcoal px-8 py-3 rounded-full font-semibold font-sans border-2 border-gray-200 transition-all duration-300 hover:border-primary hover:text-primary transform hover:scale-105" data-filter="beach">
                Beach
            </button>
            <button class="gallery-filter-btn bg-white text-charcoal px-8 py-3 rounded-full font-semibold font-sans border-2 border-gray-200 transition-all duration-300 hover:border-primary hover:text-primary transform hover:scale-105" data-filter="cultural">
                Cultural Tours
            </button>
            <button class="gallery-filter-btn bg-white text-charcoal px-8 py-3 rounded-full font-semibold font-sans border-2 border-gray-200 transition-all duration-300 hover:border-primary hover:text-primary transform hover:scale-105" data-filter="wildlife">
                Wildlife
            </button>
        </div>
    </div>
</section>

<!-- Gallery Grid -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6" id="gallery-grid">
            
            <!-- Safari Photos -->
            <div class="gallery-item safari" data-category="safari">
                <div class="relative overflow-hidden rounded-xl shadow-lg group cursor-pointer" onclick="openLightbox('assets/img/gallery/safari-elephants.jpg', 'Elephant Family Safari')">
                    <img src="assets/img/gallery/safari-elephants.jpg" alt="Elephant Family Safari" class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy">
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="text-center">
                            <h3 class="text-lg font-bold font-sans mb-2">Elephant Family Safari</h3>
                            <p class="text-sm font-body">Tsavo East National Park</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="gallery-item safari" data-category="safari">
                <div class="relative overflow-hidden rounded-xl shadow-lg group cursor-pointer" onclick="openLightbox('assets/img/gallery/safari-lions.jpg', 'Lion Pride Encounter')">
                    <img src="assets/img/gallery/safari-lions.jpg" alt="Lion Pride Encounter" class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy">
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="text-center">
                            <h3 class="text-lg font-bold font-sans mb-2">Lion Pride Encounter</h3>
                            <p class="text-sm font-body">Masai Mara Reserve</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Beach Photos -->
            <div class="gallery-item beach" data-category="beach">
                <div class="relative overflow-hidden rounded-xl shadow-lg group cursor-pointer" onclick="openLightbox('assets/img/gallery/diani-beach.jpg', 'Diani Beach Paradise')">
                    <img src="assets/img/gallery/diani-beach.jpg" alt="Diani Beach Paradise" class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy">
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="text-center">
                            <h3 class="text-lg font-bold font-sans mb-2">Diani Beach Paradise</h3>
                            <p class="text-sm font-body">South Coast Kenya</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="gallery-item beach" data-category="beach">
                <div class="relative overflow-hidden rounded-xl shadow-lg group cursor-pointer" onclick="openLightbox('assets/img/gallery/watamu-sunset.jpg', 'Watamu Sunset Cruise')">
                    <img src="assets/img/gallery/watamu-sunset.jpg" alt="Watamu Sunset Cruise" class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy">
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="text-center">
                            <h3 class="text-lg font-bold font-sans mb-2">Watamu Sunset Cruise</h3>
                            <p class="text-sm font-body">Watamu Marine Park</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cultural Tours -->
            <div class="gallery-item cultural" data-category="cultural">
                <div class="relative overflow-hidden rounded-xl shadow-lg group cursor-pointer" onclick="openLightbox('assets/img/gallery/kaya-forest.jpg', 'Sacred Kaya Forest')">
                    <img src="assets/img/gallery/kaya-forest.jpg" alt="Sacred Kaya Forest" class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy">
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="text-center">
                            <h3 class="text-lg font-bold font-sans mb-2">Sacred Kaya Forest</h3>
                            <p class="text-sm font-body">Mijikenda Heritage</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="gallery-item cultural" data-category="cultural">
                <div class="relative overflow-hidden rounded-xl shadow-lg group cursor-pointer" onclick="openLightbox('assets/img/gallery/gede-ruins.jpg', 'Ancient Gede Ruins')">
                    <img src="assets/img/gallery/gede-ruins.jpg" alt="Ancient Gede Ruins" class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy">
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="text-center">
                            <h3 class="text-lg font-bold font-sans mb-2">Ancient Gede Ruins</h3>
                            <p class="text-sm font-body">Swahili Civilization</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Wildlife Photos -->
            <div class="gallery-item wildlife" data-category="wildlife">
                <div class="relative overflow-hidden rounded-xl shadow-lg group cursor-pointer" onclick="openLightbox('assets/img/gallery/coral-reef.jpg', 'Coral Reef Snorkeling')">
                    <img src="assets/img/gallery/coral-reef.jpg" alt="Coral Reef Snorkeling" class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy">
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="text-center">
                            <h3 class="text-lg font-bold font-sans mb-2">Coral Reef Snorkeling</h3>
                            <p class="text-sm font-body">Marine Life Experience</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="gallery-item wildlife" data-category="wildlife">
                <div class="relative overflow-hidden rounded-xl shadow-lg group cursor-pointer" onclick="openLightbox('assets/img/gallery/dolphins.jpg', 'Dolphin Watching')">
                    <img src="assets/img/gallery/dolphins.jpg" alt="Dolphin Watching" class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy">
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="text-center">
                            <h3 class="text-lg font-bold font-sans mb-2">Dolphin Watching</h3>
                            <p class="text-sm font-body">Kisite Marine Park</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- More Safari Photos -->
            <div class="gallery-item safari" data-category="safari">
                <div class="relative overflow-hidden rounded-xl shadow-lg group cursor-pointer" onclick="openLightbox('assets/img/gallery/zebras.jpg', 'Zebra Migration')">
                    <img src="assets/img/gallery/zebras.jpg" alt="Zebra Migration" class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy">
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="text-center">
                            <h3 class="text-lg font-bold font-sans mb-2">Zebra Migration</h3>
                            <p class="text-sm font-body">Amboseli National Park</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- More Beach Photos -->
            <div class="gallery-item beach" data-category="beach">
                <div class="relative overflow-hidden rounded-xl shadow-lg group cursor-pointer" onclick="openLightbox('assets/img/gallery/malindi-beach.jpg', 'Malindi Coastal Walk')">
                    <img src="assets/img/gallery/malindi-beach.jpg" alt="Malindi Coastal Walk" class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy">
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="text-center">
                            <h3 class="text-lg font-bold font-sans mb-2">Malindi Coastal Walk</h3>
                            <p class="text-sm font-body">Historic Coastal Town</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- More Cultural Photos -->
            <div class="gallery-item cultural" data-category="cultural">
                <div class="relative overflow-hidden rounded-xl shadow-lg group cursor-pointer" onclick="openLightbox('assets/img/gallery/traditional-dance.jpg', 'Traditional Dance Performance')">
                    <img src="assets/img/gallery/traditional-dance.jpg" alt="Traditional Dance Performance" class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy">
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="text-center">
                            <h3 class="text-lg font-bold font-sans mb-2">Traditional Dance Performance</h3>
                            <p class="text-sm font-body">Mijikenda Culture</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- More Wildlife Photos -->
            <div class="gallery-item wildlife" data-category="wildlife">
                <div class="relative overflow-hidden rounded-xl shadow-lg group cursor-pointer" onclick="openLightbox('assets/img/gallery/mangroves.jpg', 'Mangrove Exploration')">
                    <img src="assets/img/gallery/mangroves.jpg" alt="Mangrove Exploration" class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy">
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="text-center">
                            <h3 class="text-lg font-bold font-sans mb-2">Mangrove Exploration</h3>
                            <p class="text-sm font-body">Mida Creek Boardwalk</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Load More Button -->
        <div class="text-center mt-12">
            <button id="load-more-btn" class="bg-accent hover:bg-primary text-white px-8 py-3 rounded-full font-semibold font-sans transition-all duration-300 transform hover:scale-105">
                Load More Photos
            </button>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-primary to-accent text-white">
    <div class="max-w-4xl mx-auto text-center px-6">
        <h2 class="text-3xl md:text-4xl font-bold font-sans mb-6">Ready to Create Your Own Memories?</h2>
        <p class="text-lg md:text-xl font-body mb-8 opacity-90 leading-relaxed">
            Join thousands of happy travelers who have experienced the magic of Kenya's coast with Pwani Safaris.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="booking.php" class="bg-cta hover:bg-altcta text-white px-10 py-4 rounded-full font-bold font-sans text-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                Book Your Adventure
            </a>
            <a href="tours.php" class="border-2 border-white hover:bg-white hover:text-primary text-white px-10 py-4 rounded-full font-semibold font-sans transition-all duration-300">
                View All Tours
            </a>
        </div>
    </div>
</section>

<!-- Lightbox Modal -->
<div id="lightbox" class="fixed inset-0 bg-black bg-opacity-95 z-50 hidden flex items-center justify-center p-4">
    <div class="relative max-w-5xl max-h-full">
        <!-- Close Button -->
        <button id="close-lightbox" class="absolute -top-12 right-0 text-white text-4xl hover:text-gray-300 transition-colors z-10">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        
        <!-- Image Container -->
        <div class="bg-white rounded-lg overflow-hidden shadow-2xl">
            <img id="lightbox-img" src="" alt="" class="max-w-full max-h-[80vh] object-contain">
            <div class="p-6">
                <h3 id="lightbox-title" class="text-2xl font-bold text-primary font-sans mb-2"></h3>
                <p id="lightbox-description" class="text-charcoal font-body"></p>
            </div>
        </div>
        
        <!-- Navigation Arrows -->
        <button id="prev-image" class="absolute left-4 top-1/2 transform -translate-y-1/2 text-white text-4xl hover:text-gray-300 transition-colors">
            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>
        <button id="next-image" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white text-4xl hover:text-gray-300 transition-colors">
            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </button>
    </div>
</div>

<?php include('components/footer.php'); ?>
<?php 
$page_title = "Kaya Kauma Cultural Tour";
$page_description = "Experience the soul of the Mijikenda through sacred forests and age-old traditions. 2-day cultural immersion in Kilifi County with local guides.";
include('components/header.php'); 

// Get tour parameter from URL (default to kaya-kauma)
$tour = $_GET['tour'] ?? 'kaya-kauma';
?>

<!-- Hero Banner -->
<section class="relative h-[70vh] bg-center bg-cover" style="background-image: url('assets/img/tours/kaya-kauma-hero.jpg');">
    <!-- Fallback gradient if image doesn't load -->
    <div class="absolute inset-0 bg-gradient-to-br from-primary via-accent to-primary opacity-90"></div>
    
    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/50 flex flex-col justify-center items-center text-white text-center px-4">
        <!-- Breadcrumb Navigation -->
        <nav class="absolute top-6 left-6 text-sm text-gray-200 font-body">
            <a href="index.php" class="hover:text-base transition-colors">Home</a> →
            <a href="tours.php" class="hover:text-base transition-colors">Tours</a> →
            <span class="text-white">Kaya Kauma Cultural Tour</span>
        </nav>
        
        <h1 class="text-4xl md:text-5xl font-bold font-sans mb-4 leading-tight">Kaya Kauma Cultural Tour</h1>
        <p class="max-w-2xl text-lg font-body leading-relaxed">Experience the soul of the Mijikenda through sacred forests and age-old traditions.</p>
    </div>
</section>

<!-- Tour Overview -->
<section class="py-16 px-6 bg-base/20">
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="md:col-span-2">
            <h2 class="text-3xl font-bold text-primary mb-6 font-sans">Tour Overview</h2>
            <p class="text-charcoal leading-relaxed mb-6 font-body">
                The Kaya Kauma Cultural Tour immerses you in the Mijikenda way of life — exploring traditional homesteads, 
                sacred forests, and authentic coastal cuisine. This intimate journey connects you with one of Kenya's most 
                ancient communities, whose traditions have been preserved for over 500 years.
            </p>
            <p class="text-charcoal leading-relaxed mb-6 font-body">
                Perfect for history lovers, nature enthusiasts, and cultural explorers seeking authentic experiences beyond 
                typical tourist attractions. Our local Mijikenda guides share stories passed down through generations, 
                offering insights into traditional medicine, forest conservation, and spiritual practices.
            </p>
            
            <!-- Key Features -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                <div class="flex items-start space-x-3">
                    <div class="bg-accent/20 p-2 rounded-lg">
                        <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-primary font-sans">Local Community Guides</h3>
                        <p class="text-sm text-charcoal font-body">Authentic stories from Mijikenda elders</p>
                    </div>
                </div>
                
                <div class="flex items-start space-x-3">
                    <div class="bg-primary/20 p-2 rounded-lg">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-primary font-sans">Sacred Forest Access</h3>
                        <p class="text-sm text-charcoal font-body">Exclusive entry to protected Kaya sites</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Facts Sidebar -->
        <div class="bg-white shadow-lg rounded-xl p-6">
            <h3 class="text-xl font-bold text-primary mb-6 font-sans">Quick Facts</h3>
            <ul class="space-y-4 text-charcoal font-body">
                <li class="flex items-center space-x-3">
                    <span class="text-2xl">📍</span>
                    <div>
                        <strong>Location:</strong><br>
                        <span class="text-sm">Kilifi County</span>
                    </div>
                </li>
                <li class="flex items-center space-x-3">
                    <span class="text-2xl">🕒</span>
                    <div>
                        <strong>Duration:</strong><br>
                        <span class="text-sm">2 Days / 1 Night</span>
                    </div>
                </li>
                <li class="flex items-center space-x-3">
                    <span class="text-2xl">💰</span>
                    <div>
                        <strong>Price:</strong><br>
                        <span class="text-sm text-cta font-semibold">From KSh 15,000</span>
                    </div>
                </li>
                <li class="flex items-center space-x-3">
                    <span class="text-2xl">⭐</span>
                    <div>
                        <strong>Rating:</strong><br>
                        <span class="text-sm">★★★★☆ (4.8/5)</span>
                    </div>
                </li>
            </ul>
            <a href="booking.php?tour=kaya-kauma" class="mt-6 inline-block w-full text-center bg-cta text-white font-semibold py-3 rounded-full hover:bg-altcta transition-all duration-300 font-sans">
                Book Now
            </a>
        </div>
    </div>
</section>

<!-- Itinerary (Accordion) -->
<section class="py-16 px-6 bg-white">
    <div class="max-w-4xl mx-auto">
        <h2 class="text-3xl font-bold text-primary mb-8 text-center font-sans">Tour Itinerary</h2>
        <div class="space-y-4">
            <!-- Day 1 -->
            <div class="border rounded-xl overflow-hidden shadow-sm">
                <button class="accordion-btn w-full flex justify-between items-center bg-base p-6 font-semibold text-charcoal hover:bg-base/80 transition-colors" data-target="day1">
                    <span class="font-sans">Day 1 - Arrival & Cultural Introduction</span>
                    <span class="accordion-icon text-2xl transition-transform">+</span>
                </button>
                <div id="day1" class="accordion-content p-6 text-charcoal bg-white border-t hidden">
                    <div class="font-body leading-relaxed">
                        <p class="mb-4"><strong>Morning (9:00 AM):</strong> Welcome briefing at the community center with traditional chai and local snacks.</p>
                        <p class="mb-4"><strong>Late Morning:</strong> Meet your Mijikenda guide and visit the Kaya Kauma cultural village for an introduction to local customs, traditional crafts, and the significance of the sacred forest.</p>
                        <p class="mb-4"><strong>Afternoon:</strong> Hands-on workshop in traditional crafts - learn to weave baskets or carve wooden items alongside local artisans.</p>
                        <p><strong>Evening:</strong> Traditional dinner with local families, followed by storytelling around the fire with community elders.</p>
                    </div>
                </div>
            </div>
            
            <!-- Day 2 -->
            <div class="border rounded-xl overflow-hidden shadow-sm">
                <button class="accordion-btn w-full flex justify-between items-center bg-base p-6 font-semibold text-charcoal hover:bg-base/80 transition-colors" data-target="day2">
                    <span class="font-sans">Day 2 - Forest Tour & Farewell Ceremony</span>
                    <span class="accordion-icon text-2xl transition-transform">+</span>
                </button>
                <div id="day2" class="accordion-content p-6 text-charcoal bg-white border-t hidden">
                    <div class="font-body leading-relaxed">
                        <p class="mb-4"><strong>Early Morning (6:30 AM):</strong> Sunrise meditation and blessing ceremony at the forest entrance.</p>
                        <p class="mb-4"><strong>Morning:</strong> Guided nature walk through the sacred Kaya forest, learning about medicinal plants, conservation efforts, and spiritual significance of different areas.</p>
                        <p class="mb-4"><strong>Late Morning:</strong> Traditional dance performances by local youth groups, with opportunity to participate.</p>
                        <p><strong>Afternoon:</strong> Farewell lunch featuring authentic Mijikenda cuisine, followed by departure with handmade souvenirs from the community.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Inclusions & Exclusions -->
<section class="py-16 bg-primary/5 px-6">
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-10">
        <!-- Included -->
        <div class="bg-white rounded-xl p-8 shadow-lg">
            <h3 class="text-2xl font-bold text-primary mb-6 font-sans">What's Included</h3>
            <ul class="space-y-3 text-charcoal font-body">
                <li class="flex items-start space-x-3">
                    <span class="text-accent text-xl">✅</span>
                    <span>Traditional accommodation in community guesthouse</span>
                </li>
                <li class="flex items-start space-x-3">
                    <span class="text-accent text-xl">✅</span>
                    <span>All meals (Breakfast, Lunch, Dinner) featuring local cuisine</span>
                </li>
                <li class="flex items-start space-x-3">
                    <span class="text-accent text-xl">✅</span>
                    <span>Experienced Mijikenda cultural guide</span>
                </li>
                <li class="flex items-start space-x-3">
                    <span class="text-accent text-xl">✅</span>
                    <span>Sacred forest entry fees & permits</span>
                </li>
                <li class="flex items-start space-x-3">
                    <span class="text-accent text-xl">✅</span>
                    <span>Traditional craft workshop materials</span>
                </li>
                <li class="flex items-start space-x-3">
                    <span class="text-accent text-xl">✅</span>
                    <span>Cultural performances and ceremonies</span>
                </li>
                <li class="flex items-start space-x-3">
                    <span class="text-accent text-xl">✅</span>
                    <span>Handmade souvenir from the community</span>
                </li>
            </ul>
        </div>
        
        <!-- Not Included -->
        <div class="bg-white rounded-xl p-8 shadow-lg">
            <h3 class="text-2xl font-bold text-altcta mb-6 font-sans">Not Included</h3>
            <ul class="space-y-3 text-charcoal font-body">
                <li class="flex items-start space-x-3">
                    <span class="text-altcta text-xl">❌</span>
                    <span>Transportation to/from Kilifi (can be arranged separately)</span>
                </li>
                <li class="flex items-start space-x-3">
                    <span class="text-altcta text-xl">❌</span>
                    <span>Personal expenses and additional shopping</span>
                </li>
                <li class="flex items-start space-x-3">
                    <span class="text-altcta text-xl">❌</span>
                    <span>Travel insurance (highly recommended)</span>
                </li>
                <li class="flex items-start space-x-3">
                    <span class="text-altcta text-xl">❌</span>
                    <span>Tips and gratuities for guides (optional)</span>
                </li>
                <li class="flex items-start space-x-3">
                    <span class="text-altcta text-xl">❌</span>
                    <span>Alcoholic beverages</span>
                </li>
                <li class="flex items-start space-x-3">
                    <span class="text-altcta text-xl">❌</span>
                    <span>Airport transfers (available on request)</span>
                </li>
            </ul>
        </div>
    </div>
</section>

<!-- Image Gallery -->
<section class="py-16 px-6 bg-white">
    <div class="max-w-6xl mx-auto text-center">
        <h2 class="text-3xl font-bold text-primary mb-8 font-sans">Gallery</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            <img src="assets/img/tours/gallery/kaya-forest.jpg" alt="Sacred Kaya Forest" class="gallery-image w-full h-56 object-cover rounded-lg hover:scale-105 transition-transform duration-300 cursor-pointer shadow-lg">
            <img src="assets/img/tours/gallery/traditional-crafts.jpg" alt="Traditional Crafts Workshop" class="gallery-image w-full h-56 object-cover rounded-lg hover:scale-105 transition-transform duration-300 cursor-pointer shadow-lg">
            <img src="assets/img/tours/gallery/cultural-dance.jpg" alt="Cultural Dance Performance" class="gallery-image w-full h-56 object-cover rounded-lg hover:scale-105 transition-transform duration-300 cursor-pointer shadow-lg">
            <img src="assets/img/tours/gallery/community-meal.jpg" alt="Community Meal" class="gallery-image w-full h-56 object-cover rounded-lg hover:scale-105 transition-transform duration-300 cursor-pointer shadow-lg">
            <img src="assets/img/tours/gallery/forest-walk.jpg" alt="Guided Forest Walk" class="gallery-image w-full h-56 object-cover rounded-lg hover:scale-105 transition-transform duration-300 cursor-pointer shadow-lg">
            <img src="assets/img/tours/gallery/elders-storytelling.jpg" alt="Elders Storytelling" class="gallery-image w-full h-56 object-cover rounded-lg hover:scale-105 transition-transform duration-300 cursor-pointer shadow-lg">
        </div>
    </div>
</section>

<!-- CTA Banner -->
<section class="py-16 bg-gradient-to-r from-primary to-accent text-white text-center">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl md:text-4xl font-bold mb-6 font-sans">Ready to Begin Your Cultural Adventure?</h2>
        <p class="mb-8 text-lg max-w-2xl mx-auto font-body leading-relaxed">
            Book your spot now or contact us for a customized experience. Join us in supporting the Mijikenda community 
            while discovering their incredible heritage.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="booking.php?tour=kaya-kauma" class="bg-cta hover:bg-altcta text-white px-8 py-4 rounded-full font-semibold transition-all duration-300 transform hover:scale-105 font-sans">
                Book This Tour
            </a>
            <a href="contact.php" class="border-2 border-white hover:bg-white hover:text-primary text-white px-8 py-4 rounded-full font-semibold transition-all duration-300 font-sans">
                Ask Questions
            </a>
        </div>
    </div>
</section>

<?php include('components/footer.php'); ?>

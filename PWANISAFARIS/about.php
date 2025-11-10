<?php 
$page_title = "About Us";
$page_description = "Learn about Pwani Safaris' story, mission, and vision. Discover how we connect travelers to Kenya's coastal beauty, culture, and wildlife through authentic experiences.";
include('components/header.php'); 
?>

<!-- HERO SECTION -->
<section class="relative bg-gradient-to-br from-primary via-accent to-primary opacity-90text-white py-24">
     
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-white md:text-5xl font-bold font-sans mb-4">About Pwani Safaris</h1>
        <p class="text-white max-w-2xl mx-auto opacity-90 font-body leading-relaxed">
            Connecting travelers to the beauty, culture, and wildlife of Kenya's coast.
        </p>
    </div>
</section>

<!-- MISSION & VISION SECTION -->
<section class="py-20 bg-base/30">
    <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-12">
        
        <!-- Mission -->
        <div class="flex flex-col justify-center">
            <div class="bg-white rounded-2xl p-8 shadow-lg h-full">
                <div class="flex items-center mb-6">
                    <div class="bg-primary/10 p-3 rounded-full mr-4">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-primary font-sans">Our Mission</h2>
                </div>
                <p class="text-charcoal leading-relaxed font-body">
                    To provide authentic, safe, and memorable safari experiences along Kenya's coastline and inland destinations,
                    fostering appreciation for wildlife and cultural heritage while supporting local communities.
                </p>
            </div>
        </div>
        
        <!-- Vision -->
        <div class="flex flex-col justify-center">
            <div class="bg-white rounded-2xl p-8 shadow-lg h-full">
                <div class="flex items-center mb-6">
                    <div class="bg-accent/10 p-3 rounded-full mr-4">
                        <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-primary font-sans">Our Vision</h2>
                </div>
                <p class="text-charcoal leading-relaxed font-body">
                    To become the leading coastal safari provider in Kenya, known for sustainability, exceptional service, and unforgettable journeys
                    that celebrate the authentic spirit of the Swahili coast.
                </p>
            </div>
        </div>
        
    </div>
</section>

<!-- HISTORY / STORY SECTION -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-6 flex flex-col md:flex-row items-center gap-12">
        
        <!-- Image -->
        <div class="md:w-1/2">
            <img src="assets/img/gallery/coastal-community3.png" alt="Pwani Safaris Story" class="w-full rounded-2xl shadow-lg">
        </div>
        
        <!-- Text -->
        <div class="md:w-1/2">
            <h2 class="text-3xl font-bold text-primary mb-6 font-sans">Our Story</h2>
            <p class="text-charcoal leading-relaxed mb-6 font-body">
                Founded in 2010, Pwani Safaris started with a passion to showcase Kenya's stunning coastline and wildlife. 
                What began as a small family business has grown into a trusted name in coastal tourism, yet we've never lost 
                sight of our core values: authenticity, sustainability, and community partnership.
            </p>
            <p class="text-charcoal leading-relaxed mb-6 font-body">
                Our dedicated team ensures each traveler enjoys an immersive journey, whether it's exploring sacred Kaya forests, 
                diving in Watamu's coral reefs, discovering Diani's pristine beaches, or spotting elephants in nearby Tsavo. 
                Every experience is crafted to connect you with the true spirit of Kenya's coast.
            </p>
            
            <!-- Stats -->
            <div class="grid grid-cols-2 gap-6 mt-8">
                <div class="text-center bg-base/50 rounded-xl p-4">
                    <h3 class="text-3xl font-bold text-cta font-sans">1000+</h3>
                    <p class="text-charcoal font-body">Happy Travelers</p>
                </div>
                <div class="text-center bg-base/50 rounded-xl p-4">
                    <h3 class="text-3xl font-bold text-cta font-sans">15+</h3>
                    <p class="text-charcoal font-body">Years Experience</p>
                </div>
            </div>
        </div>
        
    </div>
</section>

<!-- VALUES SECTION -->
<section class="py-20 bg-base/20">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4 font-sans">Our Values</h2>
            <p class="text-lg text-charcoal max-w-2xl mx-auto font-body">
                The principles that guide every journey we create
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Authenticity -->
            <div class="bg-white rounded-2xl p-8 shadow-lg text-center">
                <div class="bg-accent/10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-primary mb-4 font-sans">Authenticity</h3>
                <p class="text-charcoal font-body leading-relaxed">
                    Real cultural exchanges with local communities, not tourist performances. Every experience tells a genuine story.
                </p>
            </div>
            
            <!-- Sustainability -->
            <div class="bg-white rounded-2xl p-8 shadow-lg text-center">
                <div class="bg-primary/10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-primary mb-4 font-sans">Sustainability</h3>
                <p class="text-charcoal font-body leading-relaxed">
                    Responsible tourism that protects coastal ecosystems and supports conservation efforts for future generations.
                </p>
            </div>
            
            <!-- Community -->
            <div class="bg-white rounded-2xl p-8 shadow-lg text-center">
                <div class="bg-cta/10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-cta" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-primary mb-4 font-sans">Community-First</h3>
                <p class="text-charcoal font-body leading-relaxed">
                    Every tour directly supports local families and conservation efforts, creating positive impact beyond tourism.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- TEAM PHILOSOPHY SECTION -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold text-primary mb-8 font-sans">Our Team Philosophy</h2>
        <p class="text-charcoal max-w-3xl mx-auto leading-relaxed mb-12 font-body text-lg">
            At Pwani Safaris, our team is more than guides and staff — we are storytellers, cultural ambassadors, and wildlife enthusiasts. 
            Every interaction is rooted in hospitality, safety, and personalized attention to detail. We believe that the best journeys 
            happen when local knowledge meets genuine passion for sharing our coastal heritage.
        </p>
        
        <div class="relative">
            <img src="assets/img/gallery/dhow-sailing.png" alt="Pwani Safaris Team" class="w-full rounded-2xl shadow-lg">
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent rounded-2xl flex items-end">
                <div class="text-white p-8">
                    <p class="italic text-lg font-body">
                        "Our greatest joy comes from seeing travelers connect with the soul of our coast — 
                        the warmth of our people, the beauty of our traditions, and the wonder of our natural world."
                    </p>
                    <p class="mt-4 font-semibold font-sans">— The Pwani Safaris Team</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA SECTION -->
<section class="py-20 bg-primary text-white">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-6 font-sans">Ready for Your Coastal Adventure?</h2>
        <p class="text-lg max-w-2xl mx-auto mb-8 opacity-90 font-body leading-relaxed">
            Explore our curated tours and book your dream safari along Kenya's beautiful coastline today. 
            Let us share the magic of our home with you.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="tours.php" class="bg-cta hover:bg-altcta text-white font-semibold px-8 py-4 rounded-xl transition-all duration-300 transform hover:scale-105 font-sans">
                View Tours
            </a>
            <a href="contact.php" class="border-2 border-white hover:bg-white hover:text-primary text-white font-semibold px-8 py-4 rounded-xl transition-all duration-300 font-sans">
                Contact Us
            </a>
        </div>
    </div>
</section>

<?php include('components/footer.php'); ?>

<?php 
$page_title = "Home";
$page_description = "Discover authentic coastal adventures in Kenya with Pwani Safaris. Cultural tours, beach experiences, and community-first travel in Kilifi, Diani, and Watamu.";
include('components/header.php'); 
?>

<!-- Hero Section -->
<section class="relative h-screen flex items-center justify-center overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('assets/img/tours/kaya-kauma.png');">
        <!-- Softer gradient overlay for better image visibility -->
        <div class="absolute inset-0 bg-gradient-to-br from-primary/50 via-accent/40 to-primary/50 bg-blend-overlay"></div>
    </div>

    <!-- Content -->
    <div class="relative z-10 text-center text-white px-4 max-w-4xl mx-auto animate-fade-in-up">
        <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold font-sans mb-6 leading-tight drop-shadow-lg">
            Discover the Spirit of the Coast
        </h1>
        <p class="text-lg md:text-xl lg:text-2xl font-body mb-8 leading-relaxed max-w-3xl mx-auto drop-shadow-md">
            Authentic cultural journeys across Kilifi, Diani, and Watamu. Small groups. Local guides. Community-first experiences.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="booking.php" 
               class="bg-cta hover:bg-altcta text-white px-8 py-4 rounded-lg font-bold font-sans uppercase tracking-wide transition-all transform hover:scale-105 btn-glow shadow-lg">
                Book a Tour
            </a>
            <a href="tours.php" 
               class="border-2 border-white hover:bg-white hover:text-primary text-white px-8 py-4 rounded-lg font-bold font-sans uppercase tracking-wide transition-all shadow-lg">
                View Tours
            </a>
        </div>
    </div>

    <!-- Scroll indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-pulse-slow">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
        </svg>
    </div>
</section>

<!-- Featured Tours Section -->
<section class="relative py-16 lg:py-24 bg-fixed bg-center bg-cover bg-no-repeat" 
         style="background-image: url('assets/img/bg/coastal_bg.png');">
    
    <!-- Overlay -->
    <div class="absolute inset-0 bg-white/70 backdrop-blur-sm"></div>

    <div class="relative container mx-auto px-4">
        <!-- Section Heading -->
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold font-sans text-primary mb-4 drop-shadow-md">
                Featured Tours
            </h2>
            <p class="text-lg text-charcoal font-body max-w-2xl mx-auto drop-shadow-sm">
                Handpicked experiences that showcase the authentic beauty and culture of Kenya's coast
            </p>
        </div>
        
        <!-- Tours Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Tour Card 1 -->
            <div class="bg-white/90 backdrop-blur rounded-xl shadow-lg overflow-hidden transition transform hover:scale-105 hover:shadow-2xl duration-300">
                <div class="relative">
                    <img src="assets/img/tours/kaya-kauma.png" alt="Kaya Kauma Cultural Tour" class="w-full h-64 object-cover transition-transform duration-300 hover:scale-110">
                    <div class="absolute top-4 left-4">
                        <span class="bg-accent text-white px-3 py-1 rounded-full text-sm font-semibold">Cultural</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold font-sans text-charcoal mb-2">Kaya Kauma Sacred Forest</h3>
                    <p class="text-gray-700 font-body mb-4">Explore ancient Mijikenda sacred forests with traditional elders and learn ancestral wisdom.</p>
                    <div class="flex justify-between items-center">
                        <span class="text-2xl font-bold text-cta">KSh 8,500</span>
                        <a href="tour-details.php?tour=kaya-kauma" class="bg-primary hover:bg-accent text-white px-6 py-2 rounded-lg font-semibold transition-colors">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Tour Card 2 -->
            <div class="bg-white/90 backdrop-blur rounded-xl shadow-lg overflow-hidden transition transform hover:scale-105 hover:shadow-2xl duration-300">
                <div class="relative">
                    <img src="assets/img/tours/gede-ruins.png" alt="Gede Ruins Historical Tour" class="w-full h-64 object-cover transition-transform duration-300 hover:scale-110">
                    <div class="absolute top-4 left-4">
                        <span class="bg-primary text-white px-3 py-1 rounded-full text-sm font-semibold">Historical</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold font-sans text-charcoal mb-2">Gede Ruins Discovery</h3>
                    <p class="text-gray-700 font-body mb-4">Uncover the mysteries of this 13th-century Swahili town hidden in the coastal forest.</p>
                    <div class="flex justify-between items-center">
                        <span class="text-2xl font-bold text-cta">KSh 6,500</span>
                        <a href="tour-details.php?tour=gede-ruins" class="bg-primary hover:bg-accent text-white px-6 py-2 rounded-lg font-semibold transition-colors">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Tour Card 3 -->
            <div class="bg-white/90 backdrop-blur rounded-xl shadow-lg overflow-hidden transition transform hover:scale-105 hover:shadow-2xl duration-300">
                <div class="relative">
                    <img src="assets/img/tours/sunset-cruise.png" alt="Beach Sunset Cruise" class="w-full h-64 object-cover transition-transform duration-300 hover:scale-110">
                    <div class="absolute top-4 left-4">
                        <span class="bg-cta text-white px-3 py-1 rounded-full text-sm font-semibold">Coastal</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold font-sans text-charcoal mb-2">Beach Sunset Cruise</h3>
                    <p class="text-gray-700 font-body mb-4">Sail along pristine coastlines while enjoying traditional music and fresh seafood.</p>
                    <div class="flex justify-between items-center">
                        <span class="text-2xl font-bold text-cta">KSh 12,000</span>
                        <a href="tour-details.php?tour=sunset-cruise" class="bg-primary hover:bg-accent text-white px-6 py-2 rounded-lg font-semibold transition-colors">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- CTA Button -->
        <div class="text-center mt-12">
            <a href="tours.php" 
               class="inline-flex items-center space-x-2 bg-gradient-to-r from-primary to-accent hover:from-accent hover:to-primary text-white px-8 py-3 rounded-lg font-bold font-sans transition-all shadow-lg hover:shadow-xl">
                <span>View All Tours</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>


<!-- Quick Booking Search Form -->
<section class="relative py-20 bg-fixed bg-center bg-cover bg-no-repeat" 
         style="background-image: url('assets/img/bg/dhow-sailing.png');">
    
    <!-- Overlay -->
    <div class="absolute inset-0 bg-gradient-to-br from-primary/40 via-black/30 to-accent/40 backdrop-blur-sm"></div>

    <div class="relative container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Section Header -->
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold font-sans text-white drop-shadow-lg mb-4">
                    Plan Your Adventure
                </h2>
                <p class="text-lg text-white font-body drop-shadow-sm">
                    Find the perfect coastal experience for your journey
                </p>
            </div>
            
            <!-- Booking Form -->
            <form id="quick-booking-form" class="bg-white/90 backdrop-blur-xl rounded-2xl shadow-2xl p-8 transition hover:shadow-3xl duration-300">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    
                    <!-- Tour Type -->
                    <div class="space-y-2">
                        <label for="tour-select" class="block text-sm font-semibold text-charcoal font-body">
                            Tour Type
                        </label>
                        <select id="tour-select" name="tour" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent transition">
                            <option value="">Select a tour</option>
                            <option value="cultural">Cultural Tours</option>
                            <option value="coastal">Coastal Experiences</option>
                            <option value="custom">Custom Packages</option>
                        </select>
                    </div>
                    
                    <!-- Date -->
                    <div class="space-y-2">
                        <label for="date-select" class="block text-sm font-semibold text-charcoal font-body">
                            Date
                        </label>
                        <input type="date" id="date-select" name="date" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent transition">
                    </div>
                    
                    <!-- People -->
                    <div class="space-y-2">
                        <label for="people-select" class="block text-sm font-semibold text-charcoal font-body">
                            People
                        </label>
                        <select id="people-select" name="people" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent transition">
                            <option value="1">1 Person</option>
                            <option value="2">2 People</option>
                            <option value="3">3 People</option>
                            <option value="4">4 People</option>
                            <option value="5+">5+ People</option>
                        </select>
                    </div>
                    
                    <!-- Search Button -->
                    <div class="flex items-end">
                        <button type="submit" 
                                class="w-full bg-cta hover:bg-altcta text-white px-6 py-3 rounded-lg font-bold font-sans transition-all transform hover:scale-105 btn-glow">
                            Search Tours
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>


<!-- 🌊 About Summary Section -->
<section 
    class="py-16 lg:py-24 relative overflow-hidden bg-fixed bg-center bg-cover"
    style="background-image: url('assets/img/about/bg_coastline.png');"
>
    <!-- Overlay -->
    <div class="absolute inset-0 bg-gradient-to-br from-white/90 to-white/80 backdrop-blur-sm"></div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- 📸 Left: Image -->
            <div class="scroll-animate opacity-0 translate-y-8 relative">
                <div class="absolute -top-6 -left-6 w-24 h-24 bg-gradient-to-br from-accent/30 to-primary/30 rounded-3xl blur-2xl"></div>
                <img 
                    src="assets/img/about/coastal-community3.png" 
                    alt="Local coastal community" 
                    class="rounded-2xl shadow-xl w-full h-96 object-cover relative z-10"
                >
            </div>

            <!-- 📝 Right: Content -->
            <div class="scroll-animate opacity-0 translate-y-8">
                <h2 class="text-3xl md:text-4xl font-bold font-sans text-primary mb-6 leading-tight">
                    Authentic Coastal Experiences
                </h2>
                <p class="text-lg text-charcoal font-body mb-8 leading-relaxed max-w-lg">
                    We connect travelers to the authentic rhythm of Kenya's coast — celebrating culture, nature, and community through meaningful experiences that benefit local people.
                </p>

                <!-- 🌿 Key Points -->
                <div class="space-y-6 mb-10">
                    <!-- Authenticity -->
                    <div class="flex items-start space-x-4">
                        <div class="bg-accent/20 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold font-sans text-charcoal mb-2">Authenticity</h3>
                            <p class="text-gray-600 font-body">Real cultural exchanges with local communities, not staged tourist shows.</p>
                        </div>
                    </div>

                    <!-- Community First -->
                    <div class="flex items-start space-x-4">
                        <div class="bg-primary/20 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold font-sans text-charcoal mb-2">Community-First</h3>
                            <p class="text-gray-600 font-body">Every tour directly supports local families and conservation initiatives.</p>
                        </div>
                    </div>

                    <!-- Sustainability -->
                    <div class="flex items-start space-x-4">
                        <div class="bg-cta/20 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-cta" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold font-sans text-charcoal mb-2">Sustainability</h3>
                            <p class="text-gray-600 font-body">Responsible tourism that protects ecosystems for future generations.</p>
                        </div>
                    </div>
                </div>

                <!-- CTA Button -->
                <a href="about.php" 
                   class="inline-flex items-center space-x-2 bg-primary hover:bg-accent text-white px-8 py-3 rounded-lg font-bold font-sans transition-all transform hover:scale-105 shadow-md">
                    <span>Learn More</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- 🌟 Scroll Animation Script -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const elements = document.querySelectorAll('.scroll-animate');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in-up');
                entry.target.classList.remove('opacity-0', 'translate-y-8');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.2 });

    elements.forEach(el => observer.observe(el));
});
</script>

<!-- ✨ Extra Tailwind Animations (add in your global CSS file or Tailwind config) -->
<style>
@keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translateY(30px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}
.animate-fade-in-up {
    animation: fadeInUp 1s ease-out forwards;
}
</style>


<!-- Top Experiences Section -->
<section class="py-16 lg:py-24 bg-base/30">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold font-sans text-charcoal mb-4">
                Top Experiences
            </h2>
            <p class="text-lg text-charcoal font-body max-w-2xl mx-auto">
                Choose your perfect coastal adventure from our curated experience categories
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Cultural Tours -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover group">
                <div class="relative h-64 bg-gradient-to-br from-accent to-primary flex items-center justify-center">
                    <svg class="w-20 h-20 text-white group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <div class="p-8">
                    <h3 class="text-2xl font-bold font-sans text-charcoal mb-4">Cultural Tours</h3>
                    <p class="text-gray-600 font-body mb-6 leading-relaxed">
                        Immerse yourself in ancient traditions, sacred forests, and authentic Swahili culture with local community guides.
                    </p>
                    <a href="tours.php?category=cultural" class="inline-flex items-center space-x-2 text-accent hover:text-primary font-bold font-sans transition-colors">
                        <span>Explore</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>
            
            <!-- Coastal Experiences -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover group">
                <div class="relative h-64 bg-gradient-to-br from-primary to-cta flex items-center justify-center">
                    <svg class="w-20 h-20 text-white group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"/>
                    </svg>
                </div>
                <div class="p-8">
                    <h3 class="text-2xl font-bold font-sans text-charcoal mb-4">Coastal Experiences</h3>
                    <p class="text-gray-600 font-body mb-6 leading-relaxed">
                        Discover pristine beaches, coral reefs, and marine life through snorkeling, sailing, and sunset cruises.
                    </p>
                    <a href="tours.php?category=coastal" class="inline-flex items-center space-x-2 text-accent hover:text-primary font-bold font-sans transition-colors">
                        <span>Explore</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>
            
            <!-- Custom Packages -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover group">
                <div class="relative h-64 bg-gradient-to-br from-cta to-altcta flex items-center justify-center">
                    <svg class="w-20 h-20 text-white group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"/>
                    </svg>
                </div>
                <div class="p-8">
                    <h3 class="text-2xl font-bold font-sans text-charcoal mb-4">Custom Packages</h3>
                    <p class="text-gray-600 font-body mb-6 leading-relaxed">
                        Tailored experiences designed around your interests, schedule, and group size for the perfect coastal journey.
                    </p>
                    <a href="tours.php?category=custom" class="inline-flex items-center space-x-2 text-accent hover:text-primary font-bold font-sans transition-colors">
                        <span>Explore</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ✨ Enhanced Testimonials Section with Left Image & Right Text Layout -->
<section 
  class="relative py-20 lg:py-28 bg-center bg-cover bg-fixed text-white overflow-hidden"
  style="background-image: url('assets/img/gallery/Testimonial.png');"
>
  <!-- Dark Overlay -->
  <div class="absolute inset-0 bg-gradient-to-br from-black/70 via-primary/80 to-accent/70"></div>

  <div class="container relative z-10 mx-auto px-4">
    <!-- Section Heading -->
    <div class="text-center mb-16">
      <h2 class="text-3xl md:text-4xl font-bold font-sans mb-4">
        What Our Travelers Say
      </h2>
      <p class="text-lg text-blue-100 font-body max-w-2xl mx-auto">
        Real stories from explorers who discovered the magic of Kenya's coast with us
      </p>
    </div>

    <!-- Testimonial Carousel -->
    <div class="relative max-w-5xl mx-auto overflow-hidden">
      <div class="testimonial-track flex transition-transform duration-500 ease-out" id="testimonial-track">

        <!-- Slide 1 -->
        <div class="testimonial-slide min-w-full flex justify-center px-4">
          <div class="relative bg-white/10 backdrop-blur-lg rounded-2xl p-6 md:p-10 shadow-2xl border border-white/20 hover:bg-white/15 transition-all duration-300 max-w-4xl w-full mx-auto aspect-auto flex flex-col md:flex-row items-center gap-6">
            <!-- Left: Avatar -->
            <div class="flex-shrink-0">
              <img src="https://i.pravatar.cc/150?img=12" alt="Sarah Mitchell" 
                   class="w-28 h-28 md:w-36 md:h-36 rounded-full ring-4 ring-white/30 shadow-lg object-cover mx-auto md:mx-0">
            </div>

            <!-- Right: Text -->
            <div class="flex flex-col justify-center text-center md:text-left">
              <!-- Stars -->
              <div class="flex justify-center md:justify-start mb-4 space-x-1">
                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><use href="#stars"/></svg>
                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><use href="#stars"/></svg>
                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><use href="#stars"/></svg>
                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><use href="#stars"/></svg>
              </div>

              <!-- Quote -->
              <blockquote class="text-lg md:text-xl font-body italic mb-4 leading-relaxed max-w-2xl">
                “The Kaya Kauma tour was absolutely magical. Our guide shared stories passed down through generations. I felt truly connected to the coastal culture.”
              </blockquote>

              <!-- Author -->
              <div class="font-bold font-sans text-lg">Sarah Mitchell</div>
              <div class="text-blue-200 font-body text-sm">London, UK</div>
            </div>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="testimonial-slide min-w-full flex justify-center px-4">
          <div class="relative bg-white/10 backdrop-blur-lg rounded-2xl p-6 md:p-10 shadow-2xl border border-white/20 hover:bg-white/15 transition-all duration-300 max-w-4xl w-full mx-auto aspect-auto flex flex-col md:flex-row items-center gap-6">
            <div class="flex-shrink-0">
              <img src="https://i.pravatar.cc/150?img=45" alt="Marcus Johnson" 
                   class="w-28 h-28 md:w-36 md:h-36 rounded-full ring-4 ring-white/30 shadow-lg object-cover mx-auto md:mx-0">
            </div>
            <div class="flex flex-col justify-center text-center md:text-left">
              <div class="flex justify-center md:justify-start mb-4 space-x-1">
                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><use href="#stars"/></svg>
                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><use href="#stars"/></svg>
                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><use href="#stars"/></svg>
                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><use href="#stars"/></svg>
                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><use href="#stars"/></svg>
              </div>
              <blockquote class="text-lg md:text-xl font-body italic mb-4 leading-relaxed max-w-2xl">
                “Pwani Safaris exceeded all expectations. The sunset cruise was breathtaking, and knowing our visit supported local families made it even more meaningful.”
              </blockquote>
              <div class="font-bold font-sans text-lg">Marcus Johnson</div>
              <div class="text-blue-200 font-body text-sm">Toronto, Canada</div>
            </div>
          </div>
        </div>

        <!-- Slide 3 -->
        <div class="testimonial-slide min-w-full flex justify-center px-4">
          <div class="relative bg-white/10 backdrop-blur-lg rounded-2xl p-6 md:p-10 shadow-2xl border border-white/20 hover:bg-white/15 transition-all duration-300 max-w-4xl w-full mx-auto aspect-auto flex flex-col md:flex-row items-center gap-6">
            <div class="flex-shrink-0">
              <img src="https://i.pravatar.cc/150?img=68" alt="Elena Rodriguez" 
                   class="w-28 h-28 md:w-36 md:h-36 rounded-full ring-4 ring-white/30 shadow-lg object-cover mx-auto md:mx-0">
            </div>
            <div class="flex flex-col justify-center text-center md:text-left">
              <div class="flex justify-center md:justify-start mb-4 space-x-1">
                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><use href="#stars"/></svg>
                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><use href="#stars"/></svg>
                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><use href="#stars"/></svg>
                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><use href="#stars"/></svg>
                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><use href="#stars"/></svg>
              </div>
              <blockquote class="text-lg md:text-xl font-body italic mb-4 leading-relaxed max-w-2xl">
                “An incredible journey through Gede Ruins with passionate local guides. The small group made it intimate and personal. Highly recommended.”
              </blockquote>
              <div class="font-bold font-sans text-lg">Elena Rodriguez</div>
              <div class="text-blue-200 font-body text-sm">Barcelona, Spain</div>
            </div>
          </div>
        </div>

      </div>

      <!-- Dots Navigation -->
      <div class="flex justify-center mt-10 space-x-3">
        <button class="testimonial-dot w-3 h-3 rounded-full bg-white/50 hover:bg-white transition-colors" data-slide="0"></button>
        <button class="testimonial-dot w-3 h-3 rounded-full bg-white/50 hover:bg-white transition-colors" data-slide="1"></button>
        <button class="testimonial-dot w-3 h-3 rounded-full bg-white/50 hover:bg-white transition-colors" data-slide="2"></button>
      </div>
    </div>
  </div>
</section>

<!-- ✅ Auto Slider Script -->
<script>
  const track = document.getElementById('testimonial-track');
  const dots = document.querySelectorAll('.testimonial-dot');
  let index = 0;

  function showSlide(i) {
    track.style.transform = `translateX(-${i * 100}%)`;
    dots.forEach(dot => dot.classList.remove('bg-white'));
    dots[i].classList.add('bg-white');
  }

  dots.forEach((dot, i) => dot.addEventListener('click', () => {
    index = i;
    showSlide(index);
  }));

  setInterval(() => {
    index = (index + 1) % dots.length;
    showSlide(index);
  }, 6000);

  showSlide(index);
</script>


<!-- Gallery Preview Grid -->
<section class="py-16 lg:py-24 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold font-sans text-primary mb-4">
                Explore the Coast
            </h2>
            <p class="text-lg text-charcoal font-body max-w-2xl mx-auto">
                Immerse yourself in the stunning beauty of Kenya's coastal landscapes and cultural heritage
            </p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 lg:gap-6">
            <div class="relative group overflow-hidden rounded-xl card-hover cursor-pointer">
                <img src="assets/img/gallery/SacredKayaForest.png" alt="Sacred Kaya Forest" class="gallery-image w-full h-64 md:h-80 object-cover transition-transform group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                    <div class="absolute bottom-4 left-4 text-white">
                        <h3 class="font-bold font-sans">Sacred Kaya Forest</h3>
                        <p class="text-sm font-body">Ancient Mijikenda heritage</p>
                    </div>
                </div>
            </div>
            
            <div class="relative group overflow-hidden rounded-xl card-hover cursor-pointer">
                <img src="assets/img/gallery/Coastal_Sunset.png" alt="Coastal Sunset" class="gallery-image w-full h-64 md:h-80 object-cover transition-transform group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                    <div class="absolute bottom-4 left-4 text-white">
                        <h3 class="font-bold font-sans">Coastal Sunset</h3>
                        <p class="text-sm font-body">Diani Beach evening</p>
                    </div>
                </div>
            </div>
            
            <div class="relative group overflow-hidden rounded-xl card-hover cursor-pointer">
                <img src="assets/img/gallery/Traditional_Dhow.png" alt="Traditional Dhow" class="gallery-image w-full h-64 md:h-80 object-cover transition-transform group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                    <div class="absolute bottom-4 left-4 text-white">
                        <h3 class="font-bold font-sans">Traditional Dhow</h3>
                        <p class="text-sm font-body">Swahili sailing culture</p>
                    </div>
                </div>
            </div>
            
            <div class="relative group overflow-hidden rounded-xl card-hover cursor-pointer">
                <img src="assets/img/gallery/Gede_Ruins.png" alt="Gede Ruins" class="gallery-image w-full h-64 md:h-80 object-cover transition-transform group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                    <div class="absolute bottom-4 left-4 text-white">
                        <h3 class="font-bold font-sans">Gede Ruins</h3>
                        <p class="text-sm font-body">13th century history</p>
                    </div>
                </div>
            </div>
            
            <div class="relative group overflow-hidden rounded-xl card-hover cursor-pointer">
                <img src="assets/img/gallery/LocalArtisan.png" alt="Local Artisan" class="gallery-image w-full h-64 md:h-80 object-cover transition-transform group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                    <div class="absolute bottom-4 left-4 text-white">
                        <h3 class="font-bold font-sans">Local Artisan</h3>
                        <p class="text-sm font-body">Traditional craftsmanship</p>
                    </div>
                </div>
            </div>
            
            <div class="relative group overflow-hidden rounded-xl card-hover cursor-pointer">
                <img src="assets/img/gallery/Carol_Reef.png" alt="Coral Reef" class="gallery-image w-full h-64 md:h-80 object-cover transition-transform group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                    <div class="absolute bottom-4 left-4 text-white">
                        <h3 class="font-bold font-sans">Coral Reef</h3>
                        <p class="text-sm font-body">Marine conservation</p>
                    </div>
                </div>
            </div>
        </div>
        echo "";
        <div class="text-center mt-12">
            <a href="gallery.php" class="inline-flex items-center space-x-2 bg-primary hover:bg-accent text-white px-8 py-3 rounded-lg font-bold font-sans transition-colors">
                <span>View Full Gallery</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>



<!-- Footer CTA Banner -->
<section class="py-16 bg-accent text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold font-sans mb-4">
            Plan Your Coastal Journey
        </h2>
        <p class="text-lg font-body mb-8 max-w-2xl mx-auto">
            Ready to discover the authentic spirit of Kenya's coast? Contact us to start planning your unforgettable cultural adventure.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="booking.php" class="bg-white hover:bg-primary hover:text-white text-accent px-8 py-4 rounded-lg font-bold font-sans uppercase tracking-wide transition-all transform hover:scale-105">
                Book Now
            </a>
            <a href="contact.php" class="border-2 border-white hover:bg-white hover:text-accent text-white px-8 py-4 rounded-lg font-bold font-sans uppercase tracking-wide transition-all">
                Contact Us
            </a>
        </div>
    </div>
</section>

<?php include('components/footer.php'); ?>

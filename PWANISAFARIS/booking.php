<?php 
$page_title = "Book Your Adventure";
$page_description = "Secure your spot on an authentic coastal adventure with Pwani Safaris. Easy booking process with instant confirmation and 24/7 support.";
include('components/header.php'); 

// Get tour parameter from URL if available
$selected_tour = $_GET['tour'] ?? '';
$selected_date = $_GET['date'] ?? '';
$selected_people = $_GET['people'] ?? '';
?>

<!-- Hero Banner -->
<section class="relative h-[60vh] bg-center bg-cover flex items-center justify-center" style="background-image: url('assets/img/tours/booking-hero.jpg');">
    <!-- Fallback gradient if image doesn't load -->
    <div class="absolute inset-0 bg-gradient-to-br from-primary via-accent to-primary opacity-90"></div>
    
    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/50"></div>
    <div class="relative text-center text-white px-6 z-10 max-w-4xl mx-auto">
        <h1 class="text-4xl md:text-5xl font-bold font-sans mb-6 leading-tight">Book Your Coastal Adventure</h1>
        <p class="text-lg md:text-xl font-body leading-relaxed">Secure your spot in just a few minutes — authentic experiences await!</p>
    </div>
</section>

<!-- Booking Form -->
<section class="py-20 bg-base/30">
    <div class="max-w-4xl mx-auto px-6">
        <div class="bg-white shadow-xl rounded-2xl p-8 md:p-12">
            <h2 class="text-3xl md:text-4xl font-bold text-primary mb-8 text-center font-sans">Booking Details</h2>
            
            <!-- Success Message (Hidden by default) -->
            <div id="success-message" class="hidden bg-accent/10 border border-accent text-accent px-6 py-4 rounded-lg mb-8">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="font-semibold">Thank you! Your booking request has been submitted successfully. We'll contact you within 24 hours to confirm your adventure.</span>
                </div>
            </div>
            
            <!-- Error Message (Hidden by default) -->
            <div id="error-message" class="hidden bg-altcta/10 border border-altcta text-altcta px-6 py-4 rounded-lg mb-8">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="font-semibold">Please fill in all required fields correctly.</span>
                </div>
            </div>
            
            <form id="bookingForm" class="space-y-8">
                <!-- Personal Information -->
                <div class="space-y-6">
                    <h3 class="text-xl font-semibold text-charcoal font-sans border-b border-gray-200 pb-2">Personal Information</h3>
                    
                    <div>
                        <label for="fullname" class="block font-medium text-charcoal mb-2 font-body">Full Name *</label>
                        <input type="text" id="fullname" name="fullname" required 
                               class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-colors font-body"
                               placeholder="Enter your full name">
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="email" class="block font-medium text-charcoal mb-2 font-body">Email Address *</label>
                            <input type="email" id="email" name="email" required 
                                   class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-colors font-body"
                                   placeholder="your@email.com">
                        </div>
                        <div>
                            <label for="phone" class="block font-medium text-charcoal mb-2 font-body">Phone Number *</label>
                            <input type="tel" id="phone" name="phone" required 
                                   class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-colors font-body"
                                   placeholder="+254 700 000 000">
                        </div>
                    </div>
                </div>
                
                <!-- Tour Information -->
                <div class="space-y-6">
                    <h3 class="text-xl font-semibold text-charcoal font-sans border-b border-gray-200 pb-2">Tour Information</h3>
                    
                    <div>
                        <label for="tour" class="block font-medium text-charcoal mb-2 font-body">Select Tour *</label>
                        <select id="tour" name="tour" required 
                                class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-colors font-body">
                            <option value="">Choose a Tour</option>
                            <option value="kaya-kauma" <?php echo $selected_tour === 'kaya-kauma' ? 'selected' : ''; ?>>Kaya Kauma Cultural Tour - KSh 15,000</option>
                            <option value="gede-ruins" <?php echo $selected_tour === 'gede-ruins' ? 'selected' : ''; ?>>Gede Ruins Discovery - KSh 8,500</option>
                            <option value="sunset-cruise" <?php echo $selected_tour === 'sunset-cruise' ? 'selected' : ''; ?>>Beach Sunset Cruise - KSh 12,000</option>
                            <option value="snorkeling-adventure" <?php echo $selected_tour === 'snorkeling-adventure' ? 'selected' : ''; ?>>Coral Reef Snorkeling - KSh 18,000</option>
                            <option value="mangrove-exploration" <?php echo $selected_tour === 'mangrove-exploration' ? 'selected' : ''; ?>>Mangrove Forest Exploration - KSh 9,500</option>
                            <option value="custom-package" <?php echo $selected_tour === 'custom-package' ? 'selected' : ''; ?>>Custom Coastal Adventure - From KSh 25,000</option>
                        </select>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="date" class="block font-medium text-charcoal mb-2 font-body">Preferred Travel Date *</label>
                            <input type="date" id="date" name="date" required 
                                   value="<?php echo htmlspecialchars($selected_date); ?>"
                                   min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>"
                                   class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-colors font-body">
                        </div>
                        <div>
                            <label for="travelers" class="block font-medium text-charcoal mb-2 font-body">Number of Travelers *</label>
                            <select id="travelers" name="travelers" required 
                                    class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-colors font-body">
                                <option value="">Select number</option>
                                <option value="1" <?php echo $selected_people === '1' ? 'selected' : ''; ?>>1 Person</option>
                                <option value="2" <?php echo $selected_people === '2' ? 'selected' : ''; ?>>2 People</option>
                                <option value="3" <?php echo $selected_people === '3' ? 'selected' : ''; ?>>3 People</option>
                                <option value="4" <?php echo $selected_people === '4' ? 'selected' : ''; ?>>4 People</option>
                                <option value="5" <?php echo $selected_people === '5' ? 'selected' : ''; ?>>5 People</option>
                                <option value="6+" <?php echo $selected_people === '6+' ? 'selected' : ''; ?>>6+ People (Group)</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Additional Information -->
                <div class="space-y-6">
                    <h3 class="text-xl font-semibold text-charcoal font-sans border-b border-gray-200 pb-2">Additional Information</h3>
                    
                    <div>
                        <label for="message" class="block font-medium text-charcoal mb-2 font-body">Special Requests or Notes</label>
                        <textarea id="message" name="message" rows="5" 
                                  class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-colors font-body resize-vertical" 
                                  placeholder="Any dietary restrictions, pickup details, accessibility needs, or special occasions we should know about..."></textarea>
                    </div>
                    
                    <div class="bg-base/50 rounded-lg p-6">
                        <h4 class="font-semibold text-charcoal mb-3 font-sans">What happens next?</h4>
                        <ul class="space-y-2 text-sm text-charcoal font-body">
                            <li class="flex items-start">
                                <span class="text-accent mr-2">1.</span>
                                <span>We'll review your booking request within 24 hours</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-accent mr-2">2.</span>
                                <span>Our team will contact you to confirm details and availability</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-accent mr-2">3.</span>
                                <span>Once confirmed, we'll send payment instructions and tour details</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-accent mr-2">4.</span>
                                <span>Get ready for your authentic coastal adventure!</span>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="text-center pt-6">
                    <button type="submit" 
                            class="bg-cta hover:bg-altcta text-white px-12 py-4 rounded-full font-bold font-sans text-lg shadow-lg transition-all duration-300 transform hover:scale-105">
                        Submit Booking Request
                    </button>
                    <p class="text-sm text-gray-500 mt-4 font-body">
                        By submitting this form, you agree to our terms and conditions. No payment required at this stage.
                    </p>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Why Book With Us -->
<section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-primary mb-12 font-sans">Why Book With Pwani Safaris?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Local Community Impact -->
            <div class="p-8 border border-gray-200 rounded-2xl shadow-sm hover:shadow-lg transition-shadow duration-300">
                <div class="bg-accent/10 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-4 text-charcoal font-sans">Local Community Impact</h3>
                <p class="text-gray-600 font-body leading-relaxed">Every booking supports local guides, artisans, and conservation efforts. Your adventure creates positive change in coastal communities.</p>
            </div>
            
            <!-- Trusted Coastal Experts -->
            <div class="p-8 border border-gray-200 rounded-2xl shadow-sm hover:shadow-lg transition-shadow duration-300">
                <div class="bg-primary/10 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-4 text-charcoal font-sans">Trusted Coastal Experts</h3>
                <p class="text-gray-600 font-body leading-relaxed">Over 15 years of crafting personalized Kenyan coastal experiences. Our local expertise ensures authentic, safe adventures.</p>
            </div>
            
            <!-- 24/7 Support -->
            <div class="p-8 border border-gray-200 rounded-2xl shadow-sm hover:shadow-lg transition-shadow duration-300">
                <div class="bg-cta/10 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-cta" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 2.944a11.955 11.955 0 00-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-4 text-charcoal font-sans">24/7 Support</h3>
                <p class="text-gray-600 font-body leading-relaxed">Friendly support before, during, and after your journey. We're always here to help make your coastal adventure perfect.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Banner -->
<section class="py-16 bg-gradient-to-r from-primary to-accent text-white text-center">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl md:text-4xl font-bold mb-6 font-sans">Need Help With Your Booking?</h2>
        <p class="mb-8 text-lg font-body max-w-2xl mx-auto leading-relaxed">
            Call or WhatsApp our team anytime for quick assistance, custom packages, or any questions about your coastal adventure.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="tel:+254700000000" 
               class="bg-cta hover:bg-altcta text-white px-8 py-4 rounded-full font-semibold transition-all duration-300 transform hover:scale-105 font-sans flex items-center space-x-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                </svg>
                <span>Call Now</span>
            </a>
            <a href="https://wa.me/254700000000" target="_blank"
               class="border-2 border-white hover:bg-white hover:text-primary text-white px-8 py-4 rounded-full font-semibold transition-all duration-300 font-sans flex items-center space-x-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                </svg>
                <span>WhatsApp</span>
            </a>
        </div>
    </div>
</section>

<?php include('components/footer.php'); ?>
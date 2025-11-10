<?php 
$page_title = "Contact Us";
$page_description = "Get in touch with Pwani Safaris for bookings, inquiries, or feedback. Located in Kilifi, Kenya. Call +254 740900798 or email info@pwanisafaris.com";
include('components/header.php'); 
?>

<!-- HERO SECTION -->
<section class="relative bg-gradient-to-br from-primary via-accent to-primary opacity-90text-white py-24">
    <div class="container mx-auto px-6 text-center">
<h1 class="text-white md:text-5xl font-bold font-sans mb-6 leading-tight">Get in Touch with Us</h1>
        <p class="text-white md:text-xl font-body leading-relaxed mb-8">
            We'd love to hear from you — questions, bookings, or feedback
        </p>
        <a href="booking.php" 
           class="inline-block bg-cta hover:bg-altcta text-white px-8 py-4 rounded-full font-semibold transition-all duration-300 transform hover:scale-105 font-sans">
            Book a Tour
        </a>
    </div>
</section>


<!-- Main Content Section -->
<section class="py-20 bg-base/20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            
            <!-- Left Column: Contact Form -->
            <div class="bg-white rounded-2xl shadow-xl p-8 md:p-10">
                <h2 class="text-3xl font-bold text-primary mb-8 font-sans">Send us a Message</h2>
                
                <!-- Success Message (Hidden by default) -->
                <div id="contact-success-message" class="hidden bg-accent/10 border border-accent text-accent px-6 py-4 rounded-lg mb-8">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="font-semibold">Thank you! Your message has been sent successfully. We'll get back to you within 24 hours.</span>
                    </div>
                </div>
                
                <!-- Error Message (Hidden by default) -->
                <div id="contact-error-message" class="hidden bg-altcta/10 border border-altcta text-altcta px-6 py-4 rounded-lg mb-8">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="font-semibold">Please fill in all required fields correctly.</span>
                    </div>
                </div>
                
                <form id="contactForm" action="process-contact.php" method="POST" class="space-y-6">
                    <!-- Full Name -->
                    <div>
                        <label for="fullname" class="block font-medium text-charcoal mb-2 font-body">Full Name *</label>
                        <input type="text" id="fullname" name="fullname" required 
                               class="w-full p-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-colors font-body"
                               placeholder="Enter your full name"
                               aria-describedby="fullname-error">
                        <div id="fullname-error" class="text-altcta text-sm mt-1 hidden" role="alert"></div>
                    </div>
                    
                    <!-- Email and Phone -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="email" class="block font-medium text-charcoal mb-2 font-body">Email Address *</label>
                            <input type="email" id="email" name="email" required 
                                   class="w-full p-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-colors font-body"
                                   placeholder="your@email.com"
                                   aria-describedby="email-error">
                            <div id="email-error" class="text-altcta text-sm mt-1 hidden" role="alert"></div>
                        </div>
                        <div>
                            <label for="phone" class="block font-medium text-charcoal mb-2 font-body">Phone Number</label>
                            <input type="tel" id="phone" name="phone" 
                                   class="w-full p-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-colors font-body"
                                   placeholder="+254 700 000 000"
                                   aria-describedby="phone-error">
                            <div id="phone-error" class="text-altcta text-sm mt-1 hidden" role="alert"></div>
                        </div>
                    </div>
                    
                    <!-- Subject -->
                    <div>
                        <label for="subject" class="block font-medium text-charcoal mb-2 font-body">Subject *</label>
                        <select id="subject" name="subject" required 
                                class="w-full p-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-colors font-body"
                                aria-describedby="subject-error">
                            <option value="">Select a subject</option>
                            <option value="general">General Inquiry</option>
                            <option value="booking">Booking</option>
                            <option value="feedback">Feedback</option>
                            <option value="partnership">Partnership</option>
                            <option value="support">Support</option>
                        </select>
                        <div id="subject-error" class="text-altcta text-sm mt-1 hidden" role="alert"></div>
                    </div>
                    
                    <!-- Message -->
                    <div>
                        <label for="message" class="block font-medium text-charcoal mb-2 font-body">Message *</label>
                        <textarea id="message" name="message" rows="6" required 
                                  class="w-full p-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-colors font-body resize-vertical" 
                                  placeholder="Tell us how we can help you..."
                                  aria-describedby="message-error"></textarea>
                        <div id="message-error" class="text-altcta text-sm mt-1 hidden" role="alert"></div>
                    </div>
                    
                    <!-- reCAPTCHA Placeholder -->
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 text-center">
                        <div class="flex items-center justify-center space-x-2 text-gray-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            <span class="text-sm font-body">reCAPTCHA verification (placeholder)</span>
                        </div>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="text-center pt-4">
                        <button type="submit" 
                                class="w-full md:w-auto bg-primary hover:bg-accent text-white px-12 py-4 rounded-lg font-bold font-sans text-lg shadow-lg transition-all duration-300 transform hover:scale-105">
                            Send Message
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Right Column: Business Information -->
            <div class="space-y-8">
                <!-- Contact Information Card -->
                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <h3 class="text-2xl font-bold text-primary mb-6 font-sans">Contact Information</h3>
                    
                    <div class="space-y-6">
                        <!-- Address -->
                        <div class="flex items-start space-x-4">
                            <div class="bg-primary/10 p-3 rounded-full">
                                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-charcoal font-sans">Address</h4>
                                <p class="text-gray-600 font-body">Kilifi, Kenya</p>
                                <p class="text-sm text-gray-500 font-body">Coastal Region, East Africa</p>
                            </div>
                        </div>
                        
                        <!-- Phone -->
                        <div class="flex items-start space-x-4">
                            <div class="bg-accent/10 p-3 rounded-full">
                                <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-charcoal font-sans">Phone</h4>
                                <a href="tel:+254740900798" class="text-accent hover:text-primary transition-colors font-body">
                                    +254 740900798
                                </a>
                                <p class="text-sm text-gray-500 font-body">Click to call</p>
                            </div>
                        </div>
                        
                        <!-- Email -->
                        <div class="flex items-start space-x-4">
                            <div class="bg-cta/10 p-3 rounded-full">
                                <svg class="w-6 h-6 text-cta" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-charcoal font-sans">Email</h4>
                                <a href="mailto:info@pwanisafaris.com" class="text-cta hover:text-primary transition-colors font-body">
                                    info@pwanisafaris.com
                                </a>
                                <p class="text-sm text-gray-500 font-body">Send us an email</p>
                            </div>
                        </div>
                        
                        <!-- WhatsApp -->
                        <div class="flex items-start space-x-4">
                            <div class="bg-green-100 p-3 rounded-full">
                                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-charcoal font-sans">WhatsApp</h4>
                                <a href="https://wa.me/254740900798?text=Hello%20Pwani%20Safaris%2C%20I%27d%20like%20to%20inquire%20about%20your%20tours." 
                                   target="_blank" 
                                   class="text-green-600 hover:text-green-700 transition-colors font-body">
                                    Chat with us
                                </a>
                                <p class="text-sm text-gray-500 font-body">Instant messaging</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Business Hours Card -->
                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <h3 class="text-2xl font-bold text-primary mb-6 font-sans">Business Hours</h3>
                    
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="font-medium text-charcoal font-body">Monday - Friday</span>
                            <span class="text-gray-600 font-body">8:00 AM - 6:00 PM</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="font-medium text-charcoal font-body">Saturday</span>
                            <span class="text-gray-600 font-body">9:00 AM - 5:00 PM</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="font-medium text-charcoal font-body">Sunday</span>
                            <span class="text-gray-600 font-body">10:00 AM - 4:00 PM</span>
                        </div>
                        <div class="border-t pt-3 mt-4">
                            <p class="text-sm text-accent font-body">
                                <strong>Emergency Contact:</strong> Available 24/7 for tour emergencies
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Links Card -->
                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <h3 class="text-2xl font-bold text-primary mb-6 font-sans">Quick Links</h3>
                    
                    <div class="space-y-4">
                        <a href="tours.php" class="flex items-center space-x-3 text-charcoal hover:text-primary transition-colors group">
                            <svg class="w-5 h-5 text-accent group-hover:text-primary transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                            <span class="font-body">Browse Our Tours</span>
                        </a>
                        <a href="booking.php" class="flex items-center space-x-3 text-charcoal hover:text-primary transition-colors group">
                            <svg class="w-5 h-5 text-accent group-hover:text-primary transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                            <span class="font-body">Book a Tour</span>
                        </a>
                        <a href="about.php" class="flex items-center space-x-3 text-charcoal hover:text-primary transition-colors group">
                            <svg class="w-5 h-5 text-accent group-hover:text-primary transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                            <span class="font-body">About Us</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4 font-sans">Find Us</h2>
            <p class="text-lg text-charcoal max-w-2xl mx-auto font-body">
                Located in the beautiful coastal town of Kilifi, Kenya. Visit us or let us come to you for your coastal adventure.
            </p>
        </div>
        
        <!-- Google Map Embed -->
        <div class="bg-gray-200 rounded-2xl overflow-hidden shadow-lg">
            <div class="aspect-w-16 aspect-h-9 md:aspect-h-6">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3979.8234567890123!2d39.8456789!3d-3.6345678!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zM8KwMzgnMDQuNCJTIDM5wrA1MCc0NC40IkU!5e0!3m2!1sen!2ske!4v1234567890123!5m2!1sen!2ske"
                    width="100%" 
                    height="450" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade"
                    class="w-full h-96 md:h-[450px]"
                    title="Pwani Safaris Location in Kilifi, Kenya">
                </iframe>
            </div>
        </div>
        
        <div class="text-center mt-8">
            <p class="text-gray-600 font-body mb-4">
                Can't find us? No problem! We offer pickup services from major hotels and locations along the coast.
            </p>
            <a href="tel:+254740900798" 
               class="inline-block bg-accent hover:bg-primary text-white px-8 py-3 rounded-full font-semibold transition-all duration-300 font-sans">
                Call for Directions
            </a>
        </div>
    </div>
</section>

<?php include('components/footer.php'); ?>
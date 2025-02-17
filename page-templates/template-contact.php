<?php
/**
 * Template Name: Contact
 */

get_header();
?>

<div class="bg-background min-h-screen">
    <!-- Hero Section -->
    <section class="relative h-[60vh] bg-primary overflow-hidden">
        <div class="absolute inset-0 bg-black/50 z-10">
            <div class="absolute bottom-0 left-0 right-0 h-16 bg-background" style="clip-path: ellipse(75% 100% at 50% 100%);"></div>
        </div>
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('full', ['class' => 'w-full h-full object-cover']); ?>
            <?php else : ?>
                <img src="<?php echo get_theme_file_uri('assets/images/contact-banner.jpg'); ?>" 
                     alt="Contact Hero" 
                     class="w-full h-full object-cover">
            <?php endif; ?>
        </div>
        <div class="relative z-20 container mx-auto px-4 h-full flex flex-col justify-center items-center text-center">
            <h1 class="font-secondary text-4xl md:text-5xl lg:text-6xl text-white mb-6">
                <?php echo get_the_title(); ?>
            </h1>
            <?php if (get_the_excerpt()) : ?>
                <p class="text-lg md:text-xl text-white/90 max-w-2xl leading-relaxed">
                    <?php echo get_the_excerpt(); ?>
                </p>
            <?php else : ?>
                <p class="text-lg md:text-xl text-white/90 max-w-2xl leading-relaxed">
                    Get in touch with us to discuss your photography needs
                </p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Quick Contact Buttons -->
    <section class="py-16 md:py-20">
        <div class="container mx-auto px-4 md:px-6">
            <div class="max-w-5xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Call -->
                    <a href="tel:+919876543210" class="group bg-white p-8 rounded-xl shadow-lg text-center hover:shadow-xl transition-shadow duration-300">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-accent/10 mb-6 group-hover:bg-accent/20 transition-colors duration-300">
                            <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-primary mb-2">Call Us</h3>
                        <p class="text-text-light mb-4">Available 9 AM - 7 PM</p>
                        <span class="text-accent font-medium">+91 98765 43210</span>
                    </a>

                    <!-- WhatsApp -->
                    <a href="https://wa.me/+919876543210" target="_blank" class="group bg-white p-8 rounded-xl shadow-lg text-center hover:shadow-xl transition-shadow duration-300">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-[#25D366]/10 mb-6 group-hover:bg-[#25D366]/20 transition-colors duration-300">
                            <svg class="w-8 h-8 text-[#25D366]" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-primary mb-2">WhatsApp</h3>
                        <p class="text-text-light mb-4">Quick Response</p>
                        <span class="text-[#25D366] font-medium">Message Us</span>
                    </a>

                    <!-- Email -->
                    <a href="mailto:info@yourphotography.com" class="group bg-white p-8 rounded-xl shadow-lg text-center hover:shadow-xl transition-shadow duration-300">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-accent/10 mb-6 group-hover:bg-accent/20 transition-colors duration-300">
                            <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-primary mb-2">Email</h3>
                        <p class="text-text-light mb-4">24/7 Support</p>
                        <span class="text-accent font-medium">info@yourphotography.com</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section id="contact-form" class="py-16 md:py-20 bg-background-alt scroll-mt-20">
        <div class="container mx-auto px-4 md:px-6">
            <div class="max-w-3xl mx-auto">
                <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12">
                    <div class="text-center mb-12">
                        <h2 class="font-secondary text-3xl md:text-4xl text-primary mb-4">Send Us a Message</h2>
                        <p class="text-text-light">Fill out the form below and we'll get back to you within 24 hours</p>
                    </div>
                    
                    <form class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-text-light mb-2">Your Name</label>
                                <input type="text" id="name" name="name" class="w-full px-4 py-3 rounded-lg border border-border focus:border-accent focus:ring-1 focus:ring-accent outline-none transition-colors duration-300" required>
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-text-light mb-2">Email Address</label>
                                <input type="email" id="email" name="email" class="w-full px-4 py-3 rounded-lg border border-border focus:border-accent focus:ring-1 focus:ring-accent outline-none transition-colors duration-300" required>
                            </div>
                        </div>
                        
                        <div>
                            <label for="phone" class="block text-sm font-medium text-text-light mb-2">Phone Number</label>
                            <input type="tel" id="phone" name="phone" class="w-full px-4 py-3 rounded-lg border border-border focus:border-accent focus:ring-1 focus:ring-accent outline-none transition-colors duration-300" required>
                        </div>

                        <div>
                            <label for="service" class="block text-sm font-medium text-text-light mb-2">Service Interested In</label>
                            <select id="service" name="service" class="w-full px-4 py-3 rounded-lg border border-border focus:border-accent focus:ring-1 focus:ring-accent outline-none transition-colors duration-300 bg-white">
                                <option value="">Select a Service</option>
                                <option value="wedding">Wedding Photography</option>
                                <option value="pre-wedding">Pre-Wedding Shoot</option>
                                <option value="maternity">Maternity Shoot</option>
                                <option value="newborn">Newborn Photography</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-text-light mb-2">Your Message</label>
                            <textarea id="message" name="message" rows="4" class="w-full px-4 py-3 rounded-lg border border-border focus:border-accent focus:ring-1 focus:ring-accent outline-none transition-colors duration-300" required></textarea>
                        </div>

                        <div class="flex justify-center">
                            <button type="submit" class="inline-flex items-center justify-center px-8 py-3 bg-accent hover:bg-accent-hover text-white rounded-lg transition-colors duration-300 min-w-[200px]">
                                <span>Send Message</span>
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Location Section -->
    <section class="py-16 md:py-20">
        <div class="container mx-auto px-4 md:px-6">
            <div class="max-w-6xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">
                    <div class="md:sticky md:top-24">
                        <h2 class="font-secondary text-3xl md:text-4xl text-primary mb-8">Visit Our Studio</h2>
                        <div class="space-y-6 text-text-light">
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-accent mr-4 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <div>
                                    <p class="leading-relaxed">
                                        123 Photography Lane,<br>
                                        Creative District,<br>
                                        City, State 123456
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-accent mr-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <p>Mon - Sat: 9:00 AM - 7:00 PM</p>
                            </div>
                        </div>
                        <div class="mt-8">
                            <a href="https://maps.google.com" target="_blank" class="inline-flex items-center px-6 py-3 bg-accent text-white rounded-lg hover:bg-accent-hover transition-colors duration-300">
                                <span>Get Directions</span>
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="h-[450px] rounded-xl overflow-hidden shadow-lg">
                        <!-- Replace src with your actual Google Maps embed URL -->
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d..." 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/+919876543210" 
       target="_blank" 
       class="fixed bottom-6 right-6 bg-[#25D366] text-white p-4 rounded-full shadow-lg hover:bg-[#22BF5B] transition-colors duration-300 z-50">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/>
        </svg>
    </a>
</div>

<?php get_footer(); ?>

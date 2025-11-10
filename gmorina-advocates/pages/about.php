<?php
$pageTitle = "About Us - G.M. Orina & Co. Advocates";
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';
?>

<main>
  <!-- Hero -->
  <section class="relative w-full h-[45vh] md:h-[55vh] overflow-hidden">
    <div class="absolute inset-0"
         style="background-image: linear-gradient(rgba(11,23,66,0.65), rgba(11,23,66,0.65)), url('/assets/images/about-hero.jpg'); background-size: cover; background-position: center;">
    </div>
    <div class="relative z-10 h-full flex flex-col items-center justify-center text-center text-white px-4">
      <h1 class="text-3xl md:text-5xl font-extrabold">About Us</h1>
      <p class="mt-3 md:mt-4 text-sm md:text-lg text-gray-200">Who We Are & What We Stand For</p>
    </div>
  </section>

  <!-- Firm Profile & History -->
  <section class="py-16">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
      <div>
        <h2 class="text-2xl md:text-3xl font-bold text-[#0b1742]">Firm Profile & History</h2>
        <p class="mt-4 text-gray-700">
          G.M. Orina & Co. Advocates is a full-service law firm based in Westlands, Nairobi, Kenya.
          We are situated at Krishna Centre, 6th Floor, Woodvale Groove. Our reputation is built on
          integrity, legal excellence, and unwavering dedication to our clients' success. We serve
          individuals, startups, SMEs, and multinational corporations across litigation, corporate
          and commercial law, real estate, technology, procurement, and aviation, among other areas.
        </p>
        <p class="mt-3 text-gray-700">
          Over the years, we have earned the trust of clients by delivering practical, business-focused
          solutions and robust representation in complex disputes. Our approach combines deep expertise,
          rigorous analysis, and a client-centered mindset.
        </p>
      </div>
      <div>
        <img src="/assets/images/about-profile.jpg" alt="G.M. Orina & Co. Advocates"
             class="w-full h-72 md:h-96 object-cover rounded-lg shadow" />
      </div>
    </div>
  </section>

  <!-- Mission, Vision, Core Values -->
  <section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="p-6 bg-white rounded-lg border">
          <h3 class="text-xl font-semibold text-[#0b1742]">Our Mission</h3>
          <p class="mt-3 text-gray-700">
            To deliver ethical, excellent, and impactful legal solutions that safeguard our clients’ interests
            and empower their growth.
          </p>
        </div>
        <div class="p-6 bg-white rounded-lg border">
          <h3 class="text-xl font-semibold text-[#0b1742]">Our Vision</h3>
          <p class="mt-3 text-gray-700">
            To be a leading African law firm recognized for integrity, innovation, and client success.
          </p>
        </div>
        <div class="p-6 bg-white rounded-lg border">
          <h3 class="text-xl font-semibold text-[#0b1742]">Core Values</h3>
          <div class="mt-4 grid grid-cols-1 sm:grid-cols-3 gap-3">
            <div class="p-3 bg-gray-50 rounded">
              <div class="text-2xl">⚖️</div>
              <div class="mt-1 font-medium text-[#0b1742]">Integrity</div>
            </div>
            <div class="p-3 bg-gray-50 rounded">
              <div class="text-2xl">🏆</div>
              <div class="mt-1 font-medium text-[#0b1742]">Excellence</div>
            </div>
            <div class="p-3 bg-gray-50 rounded">
              <div class="text-2xl">🤝</div>
              <div class="mt-1 font-medium text-[#0b1742]">Client Focus</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Why Choose Us -->
  <section class="py-16 bg-[#0b1742] text-white">
    <div class="max-w-7xl mx-auto px-4">
      <h2 class="text-2xl md:text-3xl font-bold text-center">Why Choose Us</h2>
      <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="p-6 bg-white/5 rounded-lg border border-white/10">
          <div class="text-2xl">✔️</div>
          <h3 class="mt-2 font-semibold">Proven Expertise</h3>
          <p class="mt-2 text-gray-200 text-sm">Seasoned advocates across litigation and corporate advisory.</p>
        </div>
        <div class="p-6 bg-white/5 rounded-lg border border-white/10">
          <div class="text-2xl">✔️</div>
          <h3 class="mt-2 font-semibold">Client Trust</h3>
          <p class="mt-2 text-gray-200 text-sm">Transparent, ethical, and responsive representation.</p>
        </div>
        <div class="p-6 bg-white/5 rounded-lg border border-white/10">
          <div class="text-2xl">✔️</div>
          <h3 class="mt-2 font-semibold">Business-Focused</h3>
          <p class="mt-2 text-gray-200 text-sm">Practical solutions that protect and advance your interests.</p>
        </div>
        <div class="p-6 bg-white/5 rounded-lg border border-white/10">
          <div class="text-2xl">✔️</div>
          <h3 class="mt-2 font-semibold">Innovative</h3>
          <p class="mt-2 text-gray-200 text-sm">Modern approach across technology, data, and IP.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Call to Action -->
  <section class="py-16">
    <div class="max-w-3xl mx-auto px-4 text-center">
      <h2 class="text-2xl md:text-3xl font-bold text-[#0b1742]">Ready to speak with our team?</h2>
      <p class="mt-3 text-gray-700">We’re here to help with your legal needs in Kenya, Africa, and beyond.</p>
      <div class="mt-6 flex items-center justify-center gap-3">
        <a href="/pages/contact.php" class="bg-[#0b1742] text-white px-5 py-2 rounded hover:bg-[#0a153a]">📩 Contact Us</a>
        <a href="mailto:info@gmorinaadvocates.org" class="border border-[#0b1742] text-[#0b1742] px-5 py-2 rounded hover:bg-[#0b1742] hover:text-white">📧 Email Us</a>
      </div>
    </div>
  </section>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
<?php
$pageTitle = "Home - G.M. Orina & Co. Advocates";
include 'includes/header.php';
include 'includes/navbar.php';


// Load DB and fetch latest articles (graceful fallback if DB not available)
$articles = [];
$practiceHighlights = [];
try {
    require_once __DIR__ . '/includes/db.php';
    if (isset($pdo)) {
        // Articles
        $stmt = $pdo->query("SELECT id, title, image, description, `date` FROM articles ORDER BY `date` DESC LIMIT 3");
        $rows = $stmt->fetchAll();
        foreach ($rows as $r) {
            $img = trim($r['image'] ?? '');
            if ($img === '' ) {
                $imageUrl = '/assets/images/article-placeholder.jpg';
            } else {
                $imageUrl = (str_starts_with($img, '/')) ? $img : '/uploads/' . $img;
            }
            $descHtml = (string)($r['description'] ?? '');
            $descText = trim(strip_tags(html_entity_decode($descHtml)));
            if (mb_strlen($descText) > 180) {
                $descText = mb_substr($descText, 0, 177) . '...';
            }
            $createdAt = $r['date'] ?? null;
            $articles[] = [
                'id' => $r['id'],
                'title' => $r['title'],
                'image_url' => $imageUrl,
                'excerpt' => $descText,
                'created_at' => $createdAt,
            ];
        }

        // Practice Highlights (from practice_areas)
        try {
            $stmtPA = $pdo->query("SELECT id, title, image, description, created_at FROM practice_areas ORDER BY id DESC LIMIT 4");
            $practiceHighlights = $stmtPA->fetchAll();
        } catch (Throwable $e) {
            // Log for troubleshooting if table/columns differ from schema
            if (function_exists('error_log')) {
                error_log('Practice highlights query failed: ' . $e->getMessage());
            }
            $practiceHighlights = [];
        }
    }
} catch (Throwable $e) {
    // Fallback: leave arrays empty; do not break homepage
}
?>

<main>
  <!-- Hero Slideshow -->
  <section class="relative w-full h-[70vh] overflow-hidden">
    <div id="hero-slides" class="h-full w-full relative">
      <div class="absolute inset-0 slide opacity-100 transition-opacity duration-700 ease-in-out" style="background-image: linear-gradient(rgba(11,23,66,0.6), rgba(11,23,66,0.6)), url('/assets/images/slide1.jpg'); background-size: cover; background-position: center;">
        <div class="h-full w-full flex flex-col items-center justify-center text-center text-white px-4">
          <p class="uppercase tracking-widest text-sm md:text-base">Your Trusted Legal Partner</p>
          <h1 class="mt-3 text-3xl md:text-5xl font-extrabold">Integrity. Excellence. Results.</h1>
          <p class="mt-4 max-w-2xl text-sm md:text-lg text-gray-200">Professional legal counsel in Kenya, Africa, and beyond.</p>
          <div class="mt-6 flex gap-3">
            <a href="/pages/contact.php" class="bg-white text-[#0b1742] px-5 py-2 rounded font-medium hover:bg-gray-100">Contact Us</a>
            <a href="mailto:info@gmorinaadvocates.org" class="border border-white px-5 py-2 rounded font-medium hover:bg-white hover:text-[#0b1742]">Email Us</a>
          </div>
        </div>
      </div>
      <div class="absolute inset-0 slide opacity-0 transition-opacity duration-700 ease-in-out" style="background-image: linear-gradient(rgba(11,23,66,0.6), rgba(11,23,66,0.6)), url('/assets/images/slide2.jpg'); background-size: cover; background-position: center;">
        <div class="h-full w-full flex flex-col items-center justify-center text-center text-white px-4">
          <p class="uppercase tracking-widest text-sm md:text-base">Business-Focused Counsel</p>
          <h2 class="mt-3 text-3xl md:text-5xl font-extrabold">Corporate, Real Estate, Technology</h2>
          <p class="mt-4 max-w-2xl text-sm md:text-lg text-gray-200">Tailored solutions that protect and advance your interests.</p>
          <div class="mt-6 flex gap-3">
            <a href="/pages/practice-areas.php" class="bg-white text-[#0b1742] px-5 py-2 rounded font-medium hover:bg-gray-100">Practice Areas</a>
            <a href="/pages/contact.php" class="border border-white px-5 py-2 rounded font-medium hover:bg-white hover:text-[#0b1742]">Get Started</a>
          </div>
        </div>
      </div>
      <div class="absolute inset-0 slide opacity-0 transition-opacity duration-700 ease-in-out" style="background-image: linear-gradient(rgba(11,23,66,0.6), rgba(11,23,66,0.6)), url('/assets/images/slide3.jpg'); background-size: cover; background-position: center;">
        <div class="h-full w-full flex flex-col items-center justify-center text-center text-white px-4">
          <p class="uppercase tracking-widest text-sm md:text-base">Litigation & Dispute Resolution</p>
          <h2 class="mt-3 text-3xl md:text-5xl font-extrabold">Experienced. Strategic. Effective.</h2>
          <p class="mt-4 max-w-2xl text-sm md:text-lg text-gray-200">We advocate relentlessly to achieve favorable outcomes.</p>
          <div class="mt-6 flex gap-3">
            <a href="/pages/contact.php" class="bg-white text-[#0b1742] px-5 py-2 rounded font-medium hover:bg-gray-100">Consult Now</a>
            <a href="mailto:info@gmorinaadvocates.org" class="border border-white px-5 py-2 rounded font-medium hover:bg-white hover:text-[#0b1742]">Email Us</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Dots -->
    <div class="absolute bottom-5 left-0 right-0 flex justify-center gap-2">
      <button class="h-2 w-2 rounded-full bg-white/60" data-dot="0"></button>
      <button class="h-2 w-2 rounded-full bg-white/30" data-dot="1"></button>
      <button class="h-2 w-2 rounded-full bg-white/30" data-dot="2"></button>
    </div>
  </section>

  <!-- Practice Highlights -->
  <section class="py-16">
    <div class="max-w-7xl mx-auto px-4">
      <h2 class="text-2xl md:text-3xl font-bold text-[#0b1742] text-center">Practice Highlights</h2>
      <p class="mt-3 text-center text-gray-600 max-w-3xl mx-auto">A snapshot of our core capabilities across disputes, corporate, real estate, technology, and more.</p>
      <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <?php if (!empty($practiceHighlights)): ?>
          <?php foreach ($practiceHighlights as $ph): ?>
            <?php
              $phImg = !empty($ph['image']) ? $ph['image'] : '/assets/images/practice-placeholder.jpg';
              $phDesc = trim(strip_tags((string)($ph['description'] ?? '')));
              if (mb_strlen($phDesc) > 90) { $phDesc = mb_substr($phDesc, 0, 87) . '...'; }
            ?>
            <div class="group border rounded-lg overflow-hidden hover:shadow-md transition-shadow bg-white">
              <div class="h-32 bg-gray-200" style="background-image:url('<?= htmlspecialchars($phImg) ?>'); background-size:cover; background-position:center;"></div>
              <div class="p-5">
                <h3 class="text-lg font-semibold text-[#0b1742] group-hover:underline"><?= htmlspecialchars($ph['title'] ?? 'Practice Area') ?></h3>
                <p class="mt-2 text-sm text-gray-700 line-clamp-3"><?= htmlspecialchars($phDesc) ?></p>
                <div class="mt-4">
                  <a href="/pages/practice-areas.php" class="inline-flex items-center text-sm text-[#0b1742] hover:underline">Explore →</a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <?php for ($i=0; $i<4; $i++): ?>
            <div class="border rounded-lg overflow-hidden bg-white">
              <div class="h-32 bg-gray-200"></div>
              <div class="p-5">
                <h3 class="text-lg font-semibold text-[#0b1742]">Practice Area</h3>
                <p class="mt-2 text-sm text-gray-700">An overview of our services in this domain. Details coming soon.</p>
              </div>
            </div>
          <?php endfor; ?>
        <?php endif; ?>
      </div>
      <div class="mt-8 text-center">
        <a href="/pages/practice-areas.php" class="inline-block bg-[#0b1742] text-white px-5 py-2 rounded hover:bg-[#0a153a]">View All Practice Areas</a>
      </div>
    </div>
  </section>

  <!-- Credibility Stats -->
  <section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-2 md:grid-cols-4 gap-8">
      <div class="flex flex-col items-center bg-white rounded-xl shadow-lg p-6">
        <div class="h-12 w-12 flex items-center justify-center rounded-full bg-gradient-to-br from-blue-500 to-blue-300 mb-3">
          <span class="text-2xl">⏳</span>
        </div>
        <div class="text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-br from-blue-700 to-blue-400" data-counter target="15">0</div>
        <div class="mt-2 text-gray-700 font-semibold text-center">Years of Service</div>
      </div>
      <div class="flex flex-col items-center bg-white rounded-xl shadow-lg p-6">
        <div class="h-12 w-12 flex items-center justify-center rounded-full bg-gradient-to-br from-green-500 to-green-300 mb-3">
          <span class="text-2xl">🏆</span>
        </div>
        <div class="text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-br from-green-700 to-green-400" data-counter target="500">0</div>
        <div class="mt-2 text-gray-700 font-semibold text-center">Successful Cases</div>
      </div>
      <div class="flex flex-col items-center bg-white rounded-xl shadow-lg p-6">
        <div class="h-12 w-12 flex items-center justify-center rounded-full bg-gradient-to-br from-purple-500 to-purple-300 mb-3">
          <span class="text-2xl">💼</span>
        </div>
        <div class="text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-br from-purple-700 to-purple-400" data-counter target="120">0</div>
        <div class="mt-2 text-gray-700 font-semibold text-center">Corporate Clients</div>
      </div>
      <div class="flex flex-col items-center bg-white rounded-xl shadow-lg p-6">
        <div class="h-12 w-12 flex items-center justify-center rounded-full bg-gradient-to-br from-yellow-500 to-yellow-300 mb-3">
          <span class="text-2xl">👥</span>
        </div>
        <div class="text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-br from-yellow-700 to-yellow-400" data-counter target="20">0</div>
        <div class="mt-2 text-gray-700 font-semibold text-center">Team Members</div>
      </div>
    </div>
  </section>

  <!-- Why Choose Us -->
  <section class="py-16 bg-gradient-to-b from-white to-gray-50">
    <div class="max-w-7xl mx-auto px-4">
      <h2 class="text-2xl md:text-3xl font-bold text-[#0b1742] text-center">Why Choose Us</h2>
      <p class="mt-3 text-center text-gray-600 max-w-3xl mx-auto">We combine deep legal expertise with business-first thinking to deliver outcomes that matter.</p>
      <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="p-6 border rounded-xl bg-white shadow-sm hover:shadow-md transition">
          <div class="h-10 w-10 rounded-full bg-[#0b1742] text-white flex items-center justify-center text-lg">⚖️</div>
          <h3 class="mt-4 font-semibold text-[#0b1742]">Integrity</h3>
          <p class="mt-2 text-sm text-gray-600">Ethical practice, transparent counsel, and unwavering client trust.</p>
        </div>
        <div class="p-6 border rounded-xl bg-white shadow-sm hover:shadow-md transition">
          <div class="h-10 w-10 rounded-full bg-[#0b1742] text-white flex items-center justify-center text-lg">🏆</div>
          <h3 class="mt-4 font-semibold text-[#0b1742]">Excellence</h3>
          <p class="mt-2 text-sm text-gray-600">High-quality work, rigorous analysis, and attention to detail.</p>
        </div>
        <div class="p-6 border rounded-xl bg-white shadow-sm hover:shadow-md transition">
          <div class="h-10 w-10 rounded-full bg-[#0b1742] text-white flex items-center justify-center text-lg">🤝</div>
          <h3 class="mt-4 font-semibold text-[#0b1742]">Client-Centered</h3>
          <p class="mt-2 text-sm text-gray-600">Tailored strategies aligned to your priorities and risk profile.</p>
        </div>
        <div class="p-6 border rounded-xl bg-white shadow-sm hover:shadow-md transition">
          <div class="h-10 w-10 rounded-full bg-[#0b1742] text-white flex items-center justify-center text-lg">💡</div>
          <h3 class="mt-4 font-semibold text-[#0b1742]">Innovation</h3>
          <p class="mt-2 text-sm text-gray-600">Modern, practical, and proactive approach to complex matters.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Google Reviews Placeholder -->
  <section class="py-16 bg-gray-50">
    <div class="max-w-6xl mx-auto px-4">
      <h2 class="text-2xl md:text-3xl font-bold text-[#0b1742] text-center">What Clients Say</h2>
      <div class="mt-8 w-full border rounded-lg overflow-hidden flex items-center justify-center min-h-[180px] bg-white text-gray-400 text-lg">
        <span>Client reviews coming soon.</span>
      </div>
    </div>
  </section>

  <!-- Latest Articles -->
  <section class="py-16">
    <div class="max-w-7xl mx-auto px-4">
      <div class="flex items-end justify-between">
        <h2 class="text-2xl md:text-3xl font-bold text-[#0b1742]">Latest Articles</h2>
        <a href="/pages/articles.php" class="text-[#0b1742] hover:underline">View All Articles</a>
      </div>
      <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
        <?php if (!empty($articles)): ?>
          <?php foreach ($articles as $a): ?>
            <article class="border rounded-lg overflow-hidden hover:shadow-md">
              <a href="/pages/article-detail.php?id=<?= htmlspecialchars($a['id'] ?? '') ?>">
                <div class="h-40 bg-gray-200" style="background-image:url('<?= htmlspecialchars($a['image_url'] ?? '/assets/images/article-placeholder.jpg') ?>'); background-size:cover; background-position:center;"></div>
              </a>
              <div class="p-4">
                <h3 class="text-lg font-semibold text-[#0b1742] line-clamp-2">
                  <a href="/pages/article-detail.php?id=<?= htmlspecialchars($a['id'] ?? '') ?>">
                    <?= htmlspecialchars($a['title'] ?? 'Untitled') ?>
                  </a>
                </h3>
                <p class="mt-2 text-sm text-gray-600 line-clamp-3">
                  <?= htmlspecialchars($a['excerpt'] ?? '') ?>
                </p>
                <div class="mt-3 text-xs text-gray-500">
                  <?= htmlspecialchars(isset($a['created_at']) ? date('M j, Y', strtotime($a['created_at'])) : '') ?>
                </div>
                <div class="mt-4">
                  <a class="text-sm text-[#0b1742] hover:underline" href="/pages/article-detail.php?id=<?= htmlspecialchars($a['id'] ?? '') ?>">Read Article →</a>
                </div>
              </div>
            </article>
          <?php endforeach; ?>
        <?php else: ?>
          <?php for ($i=0; $i<3; $i++): ?>
            <article class="border rounded-lg overflow-hidden">
              <div class="h-40 bg-gray-200"></div>
              <div class="p-4">
                <h3 class="text-lg font-semibold text-[#0b1742]">Article Title</h3>
                <p class="mt-2 text-sm text-gray-600">Stay tuned for our latest legal articles and updates.</p>
              </div>
            </article>
          <?php endfor; ?>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- CTA Banner -->
  <section class="py-14 bg-gradient-to-r from-[#0b1742] to-[#13235d] text-white">
    <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row items-center justify-between gap-4">
      <div>
        <h2 class="text-2xl md:text-3xl font-bold">Ready to discuss your matter?</h2>
        <p class="mt-2 text-sm text-gray-200">Speak to our team about your objectives and timelines.</p>
      </div>
      <div class="flex gap-3">
        <a href="/pages/contact.php" class="bg-white text-[#0b1742] px-5 py-2 rounded font-medium hover:bg-gray-100">Contact Form</a>
        <a href="mailto:info@gmorinaadvocates.org" class="border border-white px-5 py-2 rounded font-medium hover:bg-white hover:text-[#0b1742]">Email Us</a>
      </div>
    </div>
  </section>
</main>

<!-- Page Scripts: simple slideshow + counters -->
<script>
  // Slideshow
  (function() {
    const slides = document.querySelectorAll('#hero-slides .slide');
    const dots = document.querySelectorAll('[data-dot]');
    let idx = 0;
    function show(i) {
      slides.forEach((s, n) => s.style.opacity = n === i ? '1' : '0');
      dots.forEach((d, n) => d.style.backgroundColor = n === i ? 'rgba(255,255,255,0.8)' : 'rgba(255,255,255,0.3)');
      idx = i;
    }
    dots.forEach(d => d.addEventListener('click', () => show(parseInt(d.dataset.dot))));
    setInterval(() => show((idx + 1) % slides.length), 6000);
    show(0);
  })();

  // Animated counters
  (function() {
    const els = document.querySelectorAll('[data-counter]');
    const animate = (el) => {
      const target = parseInt(el.getAttribute('target') || '0', 10);
      let cur = 0;
      const step = Math.max(1, Math.floor(target / 120)); // ~2s
      const timer = setInterval(() => {
        cur += step;
        if (cur >= target) { cur = target; clearInterval(timer); }
        el.textContent = cur.toLocaleString();
      }, 16);
    };
    // Trigger when in view
    const io = new IntersectionObserver((entries) => {
      entries.forEach(e => {
        if (e.isIntersecting) { animate(e.target); io.unobserve(e.target); }
      });
    }, { threshold: 0.6 });
    els.forEach(el => io.observe(el));
  })();
</script>

<?php include 'includes/footer.php'; ?>
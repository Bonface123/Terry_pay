<?php
$pageTitle = "Our Practice Areas - G.M. Orina & Co. Advocates";
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';

// Fetch practice areas (graceful fallback if DB not ready)
$practiceAreas = [];
try {
    require_once __DIR__ . '/../includes/db.php';
    if (isset($pdo)) {
        $stmt = $pdo->query("SELECT id, title, slug, excerpt, image FROM practice_areas ORDER BY id ASC");
        $practiceAreas = $stmt->fetchAll();
    }
} catch (Throwable $e) {
    // Leave $practiceAreas empty -> show placeholders
}
?>

<main>
  <!-- Hero -->
  <section class="relative w-full h-[40vh] md:h-[48vh] overflow-hidden">
    <div class="absolute inset-0"
         style="background-image: linear-gradient(rgba(11,23,66,0.65), rgba(11,23,66,0.65)), url('/assets/images/practice-areas-hero.jpg'); background-size: cover; background-position: center;">
    </div>
    <div class="relative z-10 h-full flex flex-col items-center justify-center text-center text-white px-4">
      <h1 class="text-3xl md:text-5xl font-extrabold">Our Practice Areas</h1>
      <p class="mt-3 md:mt-4 text-sm md:text-lg text-gray-200">Breadth of expertise across disputes, corporate, real estate, technology, and more.</p>
    </div>
  </section>

  <!-- Intro -->
  <section class="py-12">
    <div class="max-w-4xl mx-auto px-4 text-center">
      <p class="text-gray-700">
        We provide comprehensive legal services spanning litigation and dispute resolution, corporate and commercial,
        real estate and conveyancing, technology and data protection, procurement, aviation, and more.
        Explore our core areas below.
      </p>
    </div>
  </section>

  <!-- Grid -->
  <section class="pb-16">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php if (!empty($practiceAreas)): ?>
        <?php foreach ($practiceAreas as $pa): ?>
          <?php
            $img = !empty($pa['image']) ? $pa['image'] : '/assets/images/practice-placeholder.jpg';
          ?>
          <article class="border rounded-lg overflow-hidden flex flex-col hover:shadow-md">
            <div class="h-40 bg-gray-200" style="background-image:url('<?= htmlspecialchars($img) ?>'); background-size:cover; background-position:center;"></div>
            <div class="p-5 flex-1 flex flex-col">
              <h3 class="text-xl font-semibold text-[#0b1742]"><?= htmlspecialchars($pa['title'] ?? 'Practice Area') ?></h3>
              <p class="mt-2 text-sm text-gray-700 line-clamp-3"><?= htmlspecialchars($pa['excerpt'] ?? '') ?></p>
              <div class="mt-4">
                <a href="/pages/practice-area-detail.php?slug=<?= urlencode($pa['slug'] ?? '') ?>"
                   class="inline-block bg-[#0b1742] text-white px-4 py-2 rounded hover:bg-[#0a153a]">
                  Read More
                </a>
              </div>
            </div>
          </article>
        <?php endforeach; ?>
      <?php else: ?>
        <!-- Static placeholders if DB is empty/unavailable -->
        <?php for ($i=0; $i<6; $i++): ?>
          <article class="border rounded-lg overflow-hidden flex flex-col">
            <div class="h-40 bg-gray-200"></div>
            <div class="p-5 flex-1 flex flex-col">
              <h3 class="text-xl font-semibold text-[#0b1742]">Practice Area</h3>
              <p class="mt-2 text-sm text-gray-700">An overview of our services in this domain. Details coming soon.</p>
              <div class="mt-4">
                <a href="#" class="inline-block bg-[#0b1742] text-white px-4 py-2 rounded opacity-60 cursor-not-allowed">Read More</a>
              </div>
            </div>
          </article>
        <?php endfor; ?>
      <?php endif; ?>
    </div>
  </section>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
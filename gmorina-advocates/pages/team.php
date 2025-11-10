<?php
$pageTitle = "Our People - G.M. Orina & Co. Advocates";
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';

// Fetch team (graceful fallback if DB not ready)
$team = [];
try {
    require_once __DIR__ . '/../includes/db.php';
    if (isset($pdo)) {
        $stmt = $pdo->query("SELECT id, name, slug, role, specialization, image FROM team_members ORDER BY id ASC");
        $team = $stmt->fetchAll();
    }
} catch (Throwable $e) {
    // Leave $team empty -> show placeholders
}
?>

<main>
  <!-- Hero -->
  <section class="relative w-full h-[40vh] md:h-[48vh] overflow-hidden">
    <div class="absolute inset-0"
         style="background-image: linear-gradient(rgba(11,23,66,0.65), rgba(11,23,66,0.65)), url('/assets/images/team-hero.jpg'); background-size: cover; background-position: center;">
    </div>
    <div class="relative z-10 h-full flex flex-col items-center justify-center text-center text-white px-4">
      <h1 class="text-3xl md:text-5xl font-extrabold">Our People</h1>
      <p class="mt-3 md:mt-4 text-sm md:text-lg text-gray-200">Meet the advocates and professionals powering client success.</p>
    </div>
  </section>

  <!-- Intro -->
  <section class="py-12">
    <div class="max-w-4xl mx-auto px-4 text-center">
      <p class="text-gray-700">
        Our team combines deep legal expertise with a client-first approach across litigation, corporate advisory,
        real estate, technology, and more. Explore profiles to learn about their experience and focus areas.
      </p>
    </div>
  </section>

  <!-- Grid -->
  <section class="pb-16">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      <?php if (!empty($team)): ?>
        <?php foreach ($team as $m): ?>
          <?php
            $img = !empty($m['image']) ? $m['image'] : '/assets/images/team/placeholder.jpg';
            // If stored images are relative, ensure they point to /assets/images/team/
            if (strpos($img, '/') !== 0) {
              $img = '/assets/images/team/' . $img;
            }
          ?>
          <article class="border rounded-lg overflow-hidden bg-white hover:shadow-md flex flex-col">
            <div class="h-44 bg-gray-100" style="background-image:url('<?= htmlspecialchars($img) ?>'); background-size:cover; background-position:center;"></div>
            <div class="p-4 flex-1 flex flex-col">
              <h3 class="text-lg font-semibold text-[#0b1742]"><?= htmlspecialchars($m['name'] ?? 'Team Member') ?></h3>
              <p class="text-sm text-gray-700"><?= htmlspecialchars($m['role'] ?? '') ?></p>
              <?php if (!empty($m['specialization'])): ?>
                <p class="mt-1 text-xs text-gray-600"><?= htmlspecialchars($m['specialization']) ?></p>
              <?php endif; ?>
              <div class="mt-4">
                <a href="/pages/team-detail.php?slug=<?= urlencode($m['slug'] ?? '') ?>"
                   class="inline-block bg-[#0b1742] text-white px-4 py-2 rounded hover:bg-[#0a153a] text-sm">
                  View Profile
                </a>
              </div>
            </div>
          </article>
        <?php endforeach; ?>
      <?php else: ?>
        <!-- Placeholders -->
        <?php for ($i=0; $i<8; $i++): ?>
          <article class="border rounded-lg overflow-hidden bg-white flex flex-col">
            <div class="h-44 bg-gray-100"></div>
            <div class="p-4 flex-1 flex flex-col">
              <h3 class="text-lg font-semibold text-[#0b1742]">Team Member</h3>
              <p class="text-sm text-gray-700">Role</p>
              <p class="mt-1 text-xs text-gray-600">Specialization</p>
              <div class="mt-4">
                <span class="inline-block bg-[#0b1742] text-white px-4 py-2 rounded text-sm opacity-60 cursor-not-allowed">View Profile</span>
              </div>
            </div>
          </article>
        <?php endfor; ?>
      <?php endif; ?>
    </div>
  </section>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
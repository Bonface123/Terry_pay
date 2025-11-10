<?php
$pageTitle = "Practice Area - G.M. Orina & Co. Advocates";
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';

// Read slug
$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';
$area = null;

if ($slug === '') {
    header('Location: /pages/practice-areas.php', true, 302);
    exit;
}

try {
    require_once __DIR__ . '/../includes/db.php';
    if (isset($pdo)) {
        $stmt = $pdo->prepare("SELECT id, title, slug, excerpt, description, focus_areas, experience, image FROM practice_areas WHERE slug = ? LIMIT 1");
        $stmt->execute([$slug]);
        $area = $stmt->fetch();
    }
} catch (Throwable $e) {
    // Leave $area as null to render a graceful message
}

if (!$area) {
    // Not found
    ?>
    <main class="py-20">
      <div class="max-w-3xl mx-auto px-4 text-center">
        <h1 class="text-3xl md:text-4xl font-extrabold text-[#0b1742]">Practice Area Not Found</h1>
        <p class="mt-3 text-gray-700">The requested practice area could not be found.</p>
        <div class="mt-6">
          <a href="/pages/practice-areas.php" class="text-[#0b1742] hover:underline">Back to Practice Areas</a>
        </div>
      </div>
    </main>
    <?php require_once __DIR__ . '/../includes/footer.php'; exit; }
?>

<main>
  <!-- Hero -->
  <?php
    $hero = !empty($area['image']) ? $area['image'] : '/assets/images/practice-placeholder.jpg';
    $title = $area['title'] ?? 'Practice Area';
  ?>
  <section class="relative w-full h-[40vh] md:h-[48vh] overflow-hidden">
    <div class="absolute inset-0"
         style="background-image: linear-gradient(rgba(11,23,66,0.6), rgba(11,23,66,0.6)), url('<?= htmlspecialchars($hero) ?>'); background-size: cover; background-position: center;">
    </div>
    <div class="relative z-10 h-full flex flex-col items-center justify-center text-center text-white px-4">
      <h1 class="text-3xl md:text-5xl font-extrabold"><?= htmlspecialchars($title) ?></h1>
      <?php if (!empty($area['excerpt'])): ?>
        <p class="mt-3 md:mt-4 text-sm md:text-lg text-gray-200 max-w-2xl"><?= htmlspecialchars($area['excerpt']) ?></p>
      <?php endif; ?>
    </div>
  </section>

  <!-- Overview Content -->
  <section class="py-16">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 lg:grid-cols-3 gap-10">
      <div class="lg:col-span-2">
        <h2 class="text-2xl md:text-3xl font-bold text-[#0b1742]">Overview</h2>
        <div class="mt-4 prose prose-slate max-w-none">
          <p class="text-gray-700 whitespace-pre-line">
            <?= nl2br(htmlspecialchars($area['description'] ?? '')) ?>
          </p>
        </div>

        <!-- Areas of Focus -->
        <?php
          $focusRaw = $area['focus_areas'] ?? '';
          $focusItems = [];
          $decoded = json_decode($focusRaw, true);
          if (is_array($decoded)) {
              $focusItems = array_filter(array_map('trim', $decoded));
          } else {
              // treat as newline or comma-separated text
              if (strpos($focusRaw, "\n") !== false) {
                  $focusItems = array_filter(array_map('trim', explode("\n", $focusRaw)));
              } elseif (strpos($focusRaw, ',') !== false) {
                  $focusItems = array_filter(array_map('trim', explode(',', $focusRaw)));
              } elseif (!empty($focusRaw)) {
                  $focusItems = [trim($focusRaw)];
              }
          }
        ?>
        <?php if (!empty($focusItems)): ?>
          <div class="mt-10">
            <h3 class="text-xl font-semibold text-[#0b1742]">Areas of Focus</h3>
            <ul class="mt-4 list-disc pl-5 space-y-1 text-gray-700">
              <?php foreach ($focusItems as $fi): ?>
                <li><?= htmlspecialchars($fi) ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endif; ?>

        <!-- Experience Highlights (Optional) -->
        <?php if (!empty($area['experience'])): ?>
          <div class="mt-10">
            <h3 class="text-xl font-semibold text-[#0b1742]">Experience Highlights</h3>
            <div class="mt-3 text-gray-700 whitespace-pre-line">
              <?= nl2br(htmlspecialchars($area['experience'])) ?>
            </div>
          </div>
        <?php endif; ?>
      </div>

      <!-- Side Card (optional quick contact) -->
      <aside class="lg:col-span-1">
        <div class="border rounded-lg p-5">
          <h3 class="text-lg font-semibold text-[#0b1742]">Need Assistance?</h3>
          <p class="mt-2 text-sm text-gray-700">Discuss your matter with our team today.</p>
          <div class="mt-4 flex gap-2">
            <a href="/pages/contact.php" class="bg-[#0b1742] text-white px-4 py-2 rounded hover:bg-[#0a153a]">Contact Us</a>
            <a href="mailto:info@gmorinaadvocates.org" class="border border-[#0b1742] text-[#0b1742] px-4 py-2 rounded hover:bg-[#0b1742] hover:text-white">Email</a>
          </div>
        </div>
      </aside>
    </div>
  </section>

  <!-- CTA -->
  <section class="py-14 bg-[#0b1742] text-white">
    <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row items-center justify-between gap-4">
      <h2 class="text-2xl md:text-3xl font-bold">Ready to take the next step?</h2>
      <div class="flex gap-3">
        <a href="/pages/contact.php" class="bg-white text-[#0b1742] px-5 py-2 rounded font-medium hover:bg-gray-100">📩 Contact Us</a>
        <a href="mailto:info@gmorinaadvocates.org" class="border border-white px-5 py-2 rounded font-medium hover:bg-white hover:text-[#0b1742]">📧 Email Us</a>
      </div>
    </div>
  </section>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
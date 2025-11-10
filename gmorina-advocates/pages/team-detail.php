<?php
$pageTitle = "Team Member - G.M. Orina & Co. Advocates";
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';

// Read slug
$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';
$member = null;

if ($slug === '') {
    header('Location: /pages/team.php', true, 302);
    exit;
}

try {
    require_once __DIR__ . '/../includes/db.php';
    if (isset($pdo)) {
        $stmt = $pdo->prepare("SELECT id, name, slug, role, specialization, bio, education, image FROM team_members WHERE slug = ? LIMIT 1");
        $stmt->execute([$slug]);
        $member = $stmt->fetch();

        // Try to locate related practice area by title matching specialization (optional link)
        $practiceMatch = null;
        if (!empty($member['specialization'])) {
            $stmt2 = $pdo->prepare("SELECT slug, title FROM practice_areas WHERE title = ? LIMIT 1");
            $stmt2->execute([$member['specialization']]);
            $practiceMatch = $stmt2->fetch();
        }
    }
} catch (Throwable $e) {
    // Leave $member null for graceful not-found
}

if (!$member) {
    ?>
    <main class="py-20">
      <div class="max-w-3xl mx-auto px-4 text-center">
        <h1 class="text-3xl md:text-4xl font-extrabold text-[#0b1742]">Profile Not Found</h1>
        <p class="mt-3 text-gray-700">The requested team member could not be found.</p>
        <div class="mt-6">
          <a href="/pages/team.php" class="text-[#0b1742] hover:underline">Back to Team</a>
        </div>
      </div>
    </main>
    <?php require_once __DIR__ . '/../includes/footer.php'; exit; }
?>

<?php
  $heroImg = '/assets/images/team-hero.jpg'; // generic banner
  $profileImg = !empty($member['image']) ? $member['image'] : '/assets/images/team/placeholder.jpg';
  if (strpos($profileImg, '/') !== 0) {
    $profileImg = '/assets/images/team/' . $profileImg;
  }
?>

<main>
  <!-- Hero -->
  <section class="relative w-full h-[38vh] md:h-[44vh] overflow-hidden">
    <div class="absolute inset-0"
         style="background-image: linear-gradient(rgba(11,23,66,0.6), rgba(11,23,66,0.6)), url('<?= htmlspecialchars($heroImg) ?>'); background-size: cover; background-position: center;">
    </div>
    <div class="relative z-10 h-full flex flex-col items-center justify-center text-center text-white px-4">
      <h1 class="text-3xl md:text-5xl font-extrabold"><?= htmlspecialchars($member['name']) ?></h1>
      <p class="mt-2 text-gray-200"><?= htmlspecialchars($member['role'] ?? '') ?></p>
    </div>
  </section>

  <!-- Profile -->
  <section class="py-16">
    <div class="max-w-5xl mx-auto px-4 grid grid-cols-1 lg:grid-cols-3 gap-10">
      <div class="lg:col-span-1 flex flex-col items-center">
        <img src="<?= htmlspecialchars($profileImg) ?>" alt="<?= htmlspecialchars($member['name']) ?>"
             class="w-40 h-40 md:w-48 md:h-48 rounded-full object-cover shadow" />
        <div class="mt-4 text-center">
          <div class="text-xl font-semibold text-[#0b1742]"><?= htmlspecialchars($member['name']) ?></div>
          <div class="text-sm text-gray-700"><?= htmlspecialchars($member['role'] ?? '') ?></div>
          <?php if (!empty($member['specialization'])): ?>
            <div class="mt-1 text-sm">
              <?php if (!empty($practiceMatch['slug'])): ?>
                <a class="text-[#0b1742] hover:underline"
                   href="/pages/practice-area-detail.php?slug=<?= urlencode($practiceMatch['slug']) ?>">
                  <?= htmlspecialchars($member['specialization']) ?>
                </a>
              <?php else: ?>
                <span class="text-gray-700"><?= htmlspecialchars($member['specialization']) ?></span>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>

      <div class="lg:col-span-2">
        <h2 class="text-2xl md:text-3xl font-bold text-[#0b1742]">Biography</h2>
        <div class="mt-4 text-gray-700 whitespace-pre-line">
          <?= nl2br(htmlspecialchars($member['bio'] ?? '')) ?>
        </div>

        <?php if (!empty($member['education'])): ?>
          <?php
            // Parse education as JSON array or newline-separated text
            $eduRaw = $member['education'];
            $eduItems = [];
            $decoded = json_decode($eduRaw, true);
            if (is_array($decoded)) {
              $eduItems = array_filter(array_map('trim', $decoded));
            } else {
              if (strpos($eduRaw, "\n") !== false) {
                $eduItems = array_filter(array_map('trim', explode("\n", $eduRaw)));
              } elseif (strpos($eduRaw, ';') !== false) {
                $eduItems = array_filter(array_map('trim', explode(";", $eduRaw)));
              } elseif (!empty($eduRaw)) {
                $eduItems = [trim($eduRaw)];
              }
            }
          ?>
          <?php if (!empty($eduItems)): ?>
            <div class="mt-10">
              <h3 class="text-xl font-semibold text-[#0b1742]">Education & Professional Memberships</h3>
              <ul class="mt-3 list-disc pl-6 space-y-1 text-gray-700">
                <?php foreach ($eduItems as $ed): ?>
                  <li><?= htmlspecialchars($ed) ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="py-14 bg-[#0b1742] text-white">
    <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row items-center justify-between gap-4">
      <h2 class="text-2xl md:text-3xl font-bold">Work with our team</h2>
      <div class="flex gap-3">
        <a href="/pages/contact.php" class="bg-white text-[#0b1742] px-5 py-2 rounded font-medium hover:bg-gray-100">📩 Contact Us</a>
        <a href="mailto:info@gmorinaadvocates.org" class="border border-white px-5 py-2 rounded font-medium hover:bg-white hover:text-[#0b1742]">📧 Email Us</a>
      </div>
    </div>
  </section>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
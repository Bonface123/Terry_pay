<?php
$pageTitle = "Article Details - G.M. Orina & Co. Advocates";
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$article = null;

if ($id <= 0) {
    header('Location: /pages/articles.php', true, 302);
    exit;
}

try {
    require_once __DIR__ . '/../includes/db.php';
    if (isset($pdo)) {
        $stmt = $pdo->prepare("SELECT id, title, author, date, image, description FROM articles WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);
        $article = $stmt->fetch();
    }
} catch (Throwable $e) {
    // Leave $article as null
}

if (!$article) {
    ?>
    <main class="py-20">
      <div class="max-w-3xl mx-auto px-4 text-center">
        <h1 class="text-3xl md:text-4xl font-extrabold text-[#0b1742]">Article Not Found</h1>
        <p class="mt-3 text-gray-700">The requested article could not be found.</p>
        <div class="mt-6">
          <a href="/pages/articles.php" class="text-[#0b1742] hover:underline">Back to Articles</a>
        </div>
      </div>
    </main>
    <?php require_once __DIR__ . '/../includes/footer.php'; exit; }

$hero = !empty($article['image']) ? (str_starts_with($article['image'], '/') ? $article['image'] : '/uploads/' . $article['image']) : '/assets/images/article-placeholder.jpg';
$title = $article['title'] ?? 'Article';
$author = $article['author'] ?? '';
$date = $article['date'] ?? '';
$descHtml = $article['description'] ?? '';
?>
<main>
  <!-- Hero Banner -->
  <section class="relative w-full h-[40vh] md:h-[48vh] overflow-hidden">
    <div class="absolute inset-0"
         style="background-image: linear-gradient(rgba(11,23,66,0.6), rgba(11,23,66,0.6)), url('<?= htmlspecialchars($hero) ?>'); background-size: cover; background-position: center;">
    </div>
    <div class="relative z-10 h-full flex flex-col items-center justify-center text-center text-white px-4">
      <h1 class="text-3xl md:text-5xl font-extrabold"><?= htmlspecialchars($title) ?></h1>
      <div class="mt-3 md:mt-4 text-sm md:text-lg text-gray-200 flex flex-col gap-1 items-center">
        <?php if ($author): ?><span>By <?= htmlspecialchars($author) ?></span><?php endif; ?>
        <?php if ($date): ?><span><?= date('M j, Y', strtotime($date)) ?></span><?php endif; ?>
      </div>
    </div>
  </section>

  <!-- Article Content -->
  <section class="py-16">
    <div class="max-w-3xl mx-auto px-4">
      <div class="prose prose-slate max-w-none">
        <?= $descHtml ?>
      </div>
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

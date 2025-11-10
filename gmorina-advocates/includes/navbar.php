<nav class="bg-[#0b1742] text-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">
      <!-- Logo -->
      <div class="flex-shrink-0">
        <a href="index.php">
          <img class="h-10" src="/assets/images/logo.png" alt="G.M. Orina & Co. Advocates">
        </a>
      </div>
      <!-- Links -->
      <div class="hidden md:flex space-x-6">
        <a href="../index.php" class="hover:text-gray-300">Home</a>
        <a href="../pages/about.php" class="hover:text-gray-300">About Us</a>
        <a href="pages/practice-areas.php" class="hover:text-gray-300">Practice Areas</a>
        <a href="pages/team.php" class="hover:text-gray-300">Team</a>
        <a href="pages/articles.php" class="hover:text-gray-300">Articles</a>
        <a href="pages/contact.php" class="hover:text-gray-300">Contact</a>
        <a href="pages/client-portal.php" class="bg-white text-[#0b1742] px-3 py-1 rounded hover:bg-gray-100">Client Portal</a>
      </div>
      <!-- Mobile Menu -->
      <div class="md:hidden">
        <button class="text-white focus:outline-none" id="mobile-menu-toggle">☰</button>
      </div>
    </div>
  </div>
  <!-- Mobile Links -->
  <div class="hidden md:hidden px-2 pb-3 space-y-1" id="mobile-menu">
    <a href="index.php" class="block hover:text-gray-300">Home</a>
    <a href="pages/about.php" class="block hover:text-gray-300">About Us</a>
    <a href="pages/practice-areas.php" class="block hover:text-gray-300">Practice Areas</a>
    <a href="pages/team.php" class="block hover:text-gray-300">Team</a>
    <a href="pages/articles.php" class="block hover:text-gray-300">Articles</a>
    <a href="pages/contact.php" class="block hover:text-gray-300">Contact</a>
    <a href="pages/client-portal.php" class="block bg-white text-[#0b1742] px-3 py-1 rounded">Client Portal</a>
  </div>
</nav>

<script>
document.getElementById('mobile-menu-toggle').addEventListener('click', function() {
  const menu = document.getElementById('mobile-menu');
  menu.classList.toggle('hidden');
});
</script>
<?php 
$page_title = "Insights & News";
$page_description = "Stay updated with our latest travel insights, coastal adventures, and news from Pwani Safaris. Discover Kenya's coastal treasures through our blog.";
include('components/header.php'); 

// Database connection (you'll need to set this up)
// include('backend/db-config.php');

// Pagination settings
$posts_per_page = 6;
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $posts_per_page;

// Sample blog posts data (replace with database query)
$sample_posts = [
    [
        'id' => 1,
        'title' => 'Discovering the Hidden Gems of Kilifi Creek',
        'excerpt' => 'Explore the pristine waters and mangrove forests of Kilifi Creek, where traditional dhows sail alongside modern adventures in Kenya\'s coastal paradise.',
        'content' => 'Full article content here...',
        'image' => 'assets/img/blog/kilifi-creek.jpg',
        'author' => 'Sarah Mwangi',
        'date' => '2024-01-15',
        'category' => 'Coastal Adventures'
    ],
    [
        'id' => 2,
        'title' => 'Traditional Giriama Culture: A Living Heritage',
        'excerpt' => 'Immerse yourself in the rich traditions of the Giriama people, from ancient dances to traditional crafts that tell stories of coastal Kenya.',
        'content' => 'Full article content here...',
        'image' => 'assets/img/blog/giriama-culture.jpg',
        'author' => 'James Kazungu',
        'date' => '2024-01-12',
        'category' => 'Cultural Heritage'
    ],
    [
        'id' => 3,
        'title' => 'Sustainable Tourism: Our Commitment to Conservation',
        'excerpt' => 'Learn how Pwani Safaris partners with local communities to protect Kenya\'s coastal ecosystems while providing authentic travel experiences.',
        'content' => 'Full article content here...',
        'image' => 'assets/img/blog/conservation.jpg',
        'author' => 'Dr. Amina Hassan',
        'date' => '2024-01-10',
        'category' => 'Conservation'
    ],
    [
        'id' => 4,
        'title' => 'Best Time to Visit Kenya\'s Coast: A Seasonal Guide',
        'excerpt' => 'Planning your coastal adventure? Discover the perfect seasons for beach activities, cultural festivals, and wildlife encounters along Kenya\'s coast.',
        'content' => 'Full article content here...',
        'image' => 'assets/img/blog/seasonal-guide.jpg',
        'author' => 'Michael Ochieng',
        'date' => '2024-01-08',
        'category' => 'Travel Tips'
    ],
    [
        'id' => 5,
        'title' => 'Malindi: Where History Meets Paradise',
        'excerpt' => 'Journey through centuries of Swahili history in Malindi, from ancient ruins to vibrant markets, all set against stunning Indian Ocean views.',
        'content' => 'Full article content here...',
        'image' => 'assets/img/blog/malindi-history.jpg',
        'author' => 'Fatuma Ali',
        'date' => '2024-01-05',
        'category' => 'Historical Sites'
    ],
    [
        'id' => 6,
        'title' => 'Community-Based Tourism: Empowering Local Voices',
        'excerpt' => 'Discover how our community partnerships create authentic experiences while directly benefiting local families and preserving cultural traditions.',
        'content' => 'Full article content here...',
        'image' => 'assets/img/blog/community-tourism.jpg',
        'author' => 'Grace Nyong',
        'date' => '2024-01-03',
        'category' => 'Community Impact'
    ]
];

// Get current page posts
$total_posts = count($sample_posts);
$total_pages = ceil($total_posts / $posts_per_page);
$current_posts = array_slice($sample_posts, $offset, $posts_per_page);

// Categories for sidebar
$categories = [
    'Coastal Adventures' => 3,
    'Cultural Heritage' => 2,
    'Conservation' => 1,
    'Travel Tips' => 2,
    'Historical Sites' => 1,
    'Community Impact' => 1
];

// Recent posts for sidebar
$recent_posts = array_slice($sample_posts, 0, 3);
?>


<!-- HERO SECTION -->
<section class="relative bg-gradient-to-br from-primary via-accent to-primary opacity-90text-white py-24">
    <div class="container mx-auto px-6 text-center">
<h1 class="text-white md:text-5xl font-bold text-charcoal mb-6 font-sans">Insights & News</h1>
        <p class="text-white md:text-xl text-white font-body max-w-3xl mx-auto">
            Stay updated with our latest travel insights, coastal adventures, and stories from Kenya's beautiful coast
        </p>
    </div>
</section>

<!-- Breadcrumb Navigation -->
<nav class="bg-white border-b border-gray-200 py-4">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center space-x-2 text-sm font-body">
            <a href="index.php" class="text-primary hover:text-accent transition-colors">Home</a>
            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
            </svg>
            <span class="text-gray-600">Insights & News</span>
        </div>
    </div>
</nav>

<!-- Main Content -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            <!-- Blog Posts Grid -->
            <div class="lg:col-span-2">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <?php foreach ($current_posts as $post): ?>
                    <article class="bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 hover:scale-105 overflow-hidden">
                        <!-- Featured Image -->
                        <div class="relative h-48 overflow-hidden">
                            <img src="<?php echo htmlspecialchars($post['image']); ?>" 
                                 alt="<?php echo htmlspecialchars($post['title']); ?>"
                                 class="w-full h-full object-cover transition-transform duration-300 hover:scale-110"
                                 loading="lazy">
                            <!-- Category Badge -->
                            <div class="absolute top-4 left-4">
                                <span class="bg-primary text-white px-3 py-1 rounded-full text-xs font-medium">
                                    <?php echo htmlspecialchars($post['category']); ?>
                                </span>
                            </div>
                        </div>
                        
                        <!-- Post Content -->
                        <div class="p-6">
                            <!-- Title -->
                            <h2 class="text-xl font-bold text-charcoal mb-3 font-sans line-clamp-2 hover:text-primary transition-colors">
                                <a href="blog-detail.php?id=<?php echo $post['id']; ?>">
                                    <?php echo htmlspecialchars($post['title']); ?>
                                </a>
                            </h2>
                            
                            <!-- Excerpt -->
                            <p class="text-gray-600 font-body mb-4 line-clamp-3">
                                <?php echo htmlspecialchars($post['excerpt']); ?>
                            </p>
                            
                            <!-- Author & Date -->
                            <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                                <span class="font-body">By <?php echo htmlspecialchars($post['author']); ?></span>
                                <span class="font-body"><?php echo date('M j, Y', strtotime($post['date'])); ?></span>
                            </div>
                            
                            <!-- Read More Button -->
                            <a href="blog-detail.php?id=<?php echo $post['id']; ?>" 
                               class="inline-flex items-center text-primary hover:text-accent font-medium font-body transition-colors">
                                Read More
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </article>
                    <?php endforeach; ?>
                </div>
                
                <!-- Pagination -->
                <?php if ($total_pages > 1): ?>
                <div class="mt-12 flex justify-center">
                    <nav class="flex items-center space-x-2">
                        <!-- Previous Button -->
                        <?php if ($current_page > 1): ?>
                        <a href="?page=<?php echo $current_page - 1; ?>" 
                           class="flex items-center px-4 py-2 text-primary hover:text-accent border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                            Previous
                        </a>
                        <?php endif; ?>
                        
                        <!-- Page Numbers -->
                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <a href="?page=<?php echo $i; ?>" 
                           class="px-4 py-2 <?php echo $i === $current_page ? 'bg-primary text-white' : 'text-primary hover:text-accent border border-gray-300 hover:bg-gray-50'; ?> rounded-lg transition-colors">
                            <?php echo $i; ?>
                        </a>
                        <?php endfor; ?>
                        
                        <!-- Next Button -->
                        <?php if ($current_page < $total_pages): ?>
                        <a href="?page=<?php echo $current_page + 1; ?>" 
                           class="flex items-center px-4 py-2 text-primary hover:text-accent border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                            Next
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                        <?php endif; ?>
                    </nav>
                </div>
                <?php endif; ?>
            </div>
            
            <!-- Sidebar -->
            <div class="lg:col-span-1 space-y-8">
                
                <!-- Search Bar -->
                <div class="bg-gray-50 rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-charcoal mb-4 font-sans">Search Articles</h3>
                    <form class="relative">
                        <input type="text" 
                               placeholder="Search for articles..." 
                               class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent font-body">
                        <button type="submit" 
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-primary hover:text-accent">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </button>
                    </form>
                </div>
                
                <!-- Categories -->
                <div class="bg-gray-50 rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-charcoal mb-4 font-sans">Categories</h3>
                    <ul class="space-y-2">
                        <?php foreach ($categories as $category => $count): ?>
                        <li>
                            <a href="?category=<?php echo urlencode($category); ?>" 
                               class="flex items-center justify-between text-gray-600 hover:text-primary transition-colors font-body">
                                <span><?php echo htmlspecialchars($category); ?></span>
                                <span class="bg-primary text-white text-xs px-2 py-1 rounded-full"><?php echo $count; ?></span>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                
                <!-- Recent Posts -->
                <div class="bg-gray-50 rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-charcoal mb-4 font-sans">Recent Posts</h3>
                    <div class="space-y-4">
                        <?php foreach ($recent_posts as $recent): ?>
                        <div class="flex space-x-3">
                            <img src="<?php echo htmlspecialchars($recent['image']); ?>" 
                                 alt="<?php echo htmlspecialchars($recent['title']); ?>"
                                 class="w-16 h-16 object-cover rounded-lg flex-shrink-0">
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-medium text-charcoal line-clamp-2 mb-1">
                                    <a href="blog-detail.php?id=<?php echo $recent['id']; ?>" 
                                       class="hover:text-primary transition-colors">
                                        <?php echo htmlspecialchars($recent['title']); ?>
                                    </a>
                                </h4>
                                <p class="text-xs text-gray-500 font-body">
                                    <?php echo date('M j, Y', strtotime($recent['date'])); ?>
                                </p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <!-- Newsletter Signup -->
                <div class="bg-gradient-to-br from-primary to-accent rounded-xl p-6 text-white">
                    <h3 class="text-lg font-semibold mb-3 font-sans">Stay Updated</h3>
                    <p class="text-sm mb-4 font-body opacity-90">
                        Get the latest travel insights and coastal adventures delivered to your inbox.
                    </p>
                    <form class="space-y-3">
                        <input type="email" 
                               placeholder="Your email address" 
                               class="w-full px-4 py-3 rounded-lg text-charcoal font-body focus:ring-2 focus:ring-white focus:outline-none">
                        <button type="submit" 
                                class="w-full bg-white text-primary hover:bg-gray-100 px-4 py-3 rounded-lg font-semibold transition-colors">
                            Subscribe Now
                        </button>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="bg-gradient-to-r from-primary to-accent py-16">
    <div class="max-w-4xl mx-auto px-6 text-center text-white">
        <h2 class="text-3xl md:text-4xl font-bold mb-6 font-sans">Ready for Your Coastal Adventure?</h2>
        <p class="text-lg md:text-xl mb-8 font-body opacity-90">
            Discover the authentic beauty of Kenya's coast with our expertly crafted tours and cultural experiences.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="tours.php" 
               class="bg-white text-primary hover:bg-gray-100 px-8 py-4 rounded-full font-semibold transition-all duration-300 transform hover:scale-105">
                Explore Tours
            </a>
            <a href="booking.php" 
               class="bg-cta hover:bg-altcta px-8 py-4 rounded-full font-semibold transition-all duration-300 transform hover:scale-105">
                Book Now
            </a>
        </div>
    </div>
</section>

<style>
/* Custom styles for line clamping */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .lg\:col-span-1 {
        order: -1;
    }
}
</style>

<?php include('components/footer.php'); ?>
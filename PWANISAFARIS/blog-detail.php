<?php 
// Get the post ID from URL parameter
$post_id = isset($_GET['id']) ? (int)$_GET['id'] : 1;

// Sample blog posts data (same as in blog.php - in real app, fetch from database)
$sample_posts = [
    1 => [
        'id' => 1,
        'title' => 'Discovering the Hidden Gems of Kilifi Creek',
        'excerpt' => 'Explore the pristine waters and mangrove forests of Kilifi Creek, where traditional dhows sail alongside modern adventures in Kenya\'s coastal paradise.',
        'content' => '<p>Kilifi Creek is one of Kenya\'s most spectacular coastal destinations, offering a perfect blend of natural beauty, cultural heritage, and adventure opportunities. This tidal inlet, carved by centuries of ocean currents, creates a unique ecosystem where mangrove forests thrive and traditional Swahili culture flourishes.</p>

<p>The creek stretches inland for several kilometers, creating a network of channels and islands that are best explored by traditional dhow or modern kayak. The mangrove forests that line the creek are home to a diverse array of wildlife, including over 100 species of birds, various fish species, and the occasional dolphin that ventures into the calmer waters.</p>

<h3>Traditional Dhow Adventures</h3>
<p>One of the most authentic ways to experience Kilifi Creek is aboard a traditional dhow. These wooden sailing vessels have been used by coastal communities for centuries and represent a living connection to the area\'s maritime heritage. Our experienced local captains share stories of their ancestors while navigating the creek\'s winding channels.</p>

<p>The best time for dhow sailing is during the late afternoon when the winds are favorable and the light creates magical reflections on the water. As the sun sets, the creek transforms into a golden mirror, providing perfect opportunities for photography and quiet contemplation.</p>

<h3>Mangrove Conservation</h3>
<p>The mangrove forests of Kilifi Creek play a crucial role in coastal protection and marine ecosystem health. These remarkable trees can survive in saltwater and serve as nurseries for many fish species. Our tours include educational components about mangrove conservation and the important work being done by local communities to protect these vital ecosystems.</p>

<p>Visitors can participate in mangrove planting activities, learning about the different species and their unique adaptations. This hands-on experience helps travelers understand the delicate balance of coastal ecosystems and the importance of sustainable tourism practices.</p>

<h3>Cultural Encounters</h3>
<p>The communities around Kilifi Creek maintain strong connections to their Swahili heritage. Visitors can experience traditional fishing methods, learn about local boat-building techniques, and enjoy authentic coastal cuisine prepared by community members.</p>

<p>Evening cultural performances often take place on the creek\'s shores, featuring traditional taarab music and ngoma dances. These intimate gatherings provide insight into the rich cultural traditions that have been passed down through generations of coastal communities.</p>',
        'image' => 'assets/img/blog/kilifi-creek.jpg',
        'author' => 'Sarah Mwangi',
        'date' => '2024-01-15',
        'category' => 'Coastal Adventures',
        'tags' => ['Kilifi', 'Mangroves', 'Dhow Sailing', 'Conservation']
    ],
    2 => [
        'id' => 2,
        'title' => 'Traditional Giriama Culture: A Living Heritage',
        'excerpt' => 'Immerse yourself in the rich traditions of the Giriama people, from ancient dances to traditional crafts that tell stories of coastal Kenya.',
        'content' => '<p>The Giriama people are one of the nine Mijikenda ethnic groups of coastal Kenya, with a rich cultural heritage that spans centuries. Their traditions, customs, and way of life offer visitors a unique window into authentic African coastal culture that has remained largely unchanged despite modern influences.</p>

<p>Located primarily in the hinterland of Kenya\'s coast, the Giriama communities have developed sophisticated systems of governance, agriculture, and spiritual practices that are deeply connected to their environment. Their traditional homesteads, known as "mudzi," are carefully planned settlements that reflect both practical needs and cultural values.</p>

<h3>Traditional Architecture and Homesteads</h3>
<p>Giriama architecture is perfectly adapted to the coastal climate, using locally available materials like makuti (palm fronds), mangrove poles, and coral stone. The traditional round houses with conical roofs provide excellent ventilation and protection from both sun and rain.</p>

<p>The layout of a traditional homestead follows specific cultural protocols, with the main house positioned according to ancestral guidelines and surrounded by smaller structures for different family members and activities. Visitors can tour authentic homesteads and learn about the significance of different architectural elements.</p>

<h3>Sacred Forests and Spiritual Practices</h3>
<p>The Giriama maintain sacred forests called "kaya" which serve as spiritual centers and repositories of traditional knowledge. These forests are protected by strict traditional laws and contain rare plant species used for medicinal and ceremonial purposes.</p>

<p>Guided visits to the kaya forests, when permitted by community elders, offer insights into traditional ecological knowledge and spiritual practices. Visitors learn about medicinal plants, traditional conservation methods, and the role of ancestral spirits in daily life.</p>

<h3>Traditional Crafts and Skills</h3>
<p>Giriama artisans are renowned for their woodcarving, basket weaving, and pottery. These skills are passed down through generations, with each piece telling a story or serving a specific cultural function. Visitors can participate in craft workshops and learn traditional techniques from master artisans.</p>

<p>The intricate patterns and symbols used in Giriama crafts have deep cultural meanings, often representing aspects of nature, spiritual beliefs, or historical events. Understanding these symbols provides insight into the sophisticated worldview of the Giriama people.</p>',
        'image' => 'assets/img/blog/giriama-culture.jpg',
        'author' => 'James Kazungu',
        'date' => '2024-01-12',
        'category' => 'Cultural Heritage',
        'tags' => ['Giriama', 'Mijikenda', 'Traditional Culture', 'Sacred Forests']
    ],
    3 => [
        'id' => 3,
        'title' => 'Sustainable Tourism: Our Commitment to Conservation',
        'excerpt' => 'Learn how Pwani Safaris partners with local communities to protect Kenya\'s coastal ecosystems while providing authentic travel experiences.',
        'content' => '<p>At Pwani Safaris, we believe that tourism should be a force for positive change, benefiting both visitors and the communities and environments we explore. Our commitment to sustainable tourism goes beyond simple environmental protection – it encompasses social responsibility, economic empowerment, and cultural preservation.</p>

<p>The coastal region of Kenya faces numerous environmental challenges, from coral reef degradation to mangrove deforestation. At the same time, local communities need economic opportunities that don\'t compromise their natural heritage. Sustainable tourism offers a solution that addresses both needs.</p>

<h3>Community Partnerships</h3>
<p>Our approach to sustainable tourism is built on genuine partnerships with local communities. Rather than simply operating in these areas, we work with community leaders, elders, and local organizations to ensure that tourism benefits reach the grassroots level.</p>

<p>We employ local guides, source food and materials from community suppliers, and ensure that a significant portion of tour revenues goes directly to community development projects. This includes funding for schools, healthcare facilities, and conservation initiatives.</p>

<h3>Marine Conservation Efforts</h3>
<p>The coral reefs and marine ecosystems of Kenya\'s coast are under pressure from climate change, pollution, and overfishing. Our marine conservation programs include coral restoration projects, beach cleanups, and education initiatives that raise awareness about marine protection.</p>

<p>Visitors can participate in coral planting activities, learn about marine biology from local experts, and contribute to citizen science projects that monitor reef health. These hands-on experiences create lasting connections between travelers and the marine environment.</p>

<h3>Cultural Preservation</h3>
<p>Traditional cultures along Kenya\'s coast are repositories of invaluable knowledge about sustainable living and environmental stewardship. Our cultural tourism programs are designed to celebrate and preserve these traditions while providing economic incentives for their continuation.</p>

<p>We work with cultural groups to document traditional knowledge, support traditional craft production, and create platforms for intergenerational knowledge transfer. This ensures that valuable cultural practices are preserved for future generations.</p>

<h3>Environmental Education</h3>
<p>Every tour includes educational components that help visitors understand the complex relationships between human activities and environmental health. We believe that informed travelers become advocates for conservation long after their visit ends.</p>

<p>Our guides are trained not just in tourism but in environmental science and conservation principles. They share knowledge about local ecosystems, conservation challenges, and success stories that inspire visitors to take action in their own communities.</p>',
        'image' => 'assets/img/blog/conservation.jpg',
        'author' => 'Dr. Amina Hassan',
        'date' => '2024-01-10',
        'category' => 'Conservation',
        'tags' => ['Sustainable Tourism', 'Conservation', 'Community Development', 'Marine Protection']
    ]
];

// Get the specific post or default to first post
$post = isset($sample_posts[$post_id]) ? $sample_posts[$post_id] : $sample_posts[1];

$page_title = $post['title'];
$page_description = $post['excerpt'];
include('components/header.php'); 

// Related posts (exclude current post)
$related_posts = array_filter($sample_posts, function($p) use ($post_id, $post) {
    return $p['id'] !== $post_id && $p['category'] === $post['category'];
});
$related_posts = array_slice($related_posts, 0, 3);
?>

<!-- Breadcrumb Navigation -->
<nav class="bg-white border-b border-gray-200 py-4 mt-16 lg:mt-20">
    <div class="max-w-4xl mx-auto px-6">
        <div class="flex items-center space-x-2 text-sm font-body">
            <a href="index.php" class="text-primary hover:text-accent transition-colors">Home</a>
            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
            </svg>
            <a href="blog.php" class="text-primary hover:text-accent transition-colors">Insights & News</a>
            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
            </svg>
            <span class="text-gray-600 truncate"><?php echo htmlspecialchars($post['title']); ?></span>
        </div>
    </div>
</nav>

<!-- Article Header -->
<header class="bg-white py-12">
    <div class="max-w-4xl mx-auto px-6">
        <!-- Category Badge -->
        <div class="mb-4">
            <span class="bg-primary text-white px-4 py-2 rounded-full text-sm font-medium">
                <?php echo htmlspecialchars($post['category']); ?>
            </span>
        </div>
        
        <!-- Title -->
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-charcoal mb-6 font-sans leading-tight">
            <?php echo htmlspecialchars($post['title']); ?>
        </h1>
        
        <!-- Meta Information -->
        <div class="flex flex-wrap items-center gap-6 text-gray-600 font-body">
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                </svg>
                <span>By <?php echo htmlspecialchars($post['author']); ?></span>
            </div>
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                </svg>
                <span><?php echo date('F j, Y', strtotime($post['date'])); ?></span>
            </div>
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                </svg>
                <span>5 min read</span>
            </div>
        </div>
    </div>
</header>

<!-- Featured Image -->
<section class="mb-12">
    <div class="max-w-5xl mx-auto px-6">
        <img src="<?php echo htmlspecialchars($post['image']); ?>" 
             alt="<?php echo htmlspecialchars($post['title']); ?>"
             class="w-full h-64 md:h-96 object-cover rounded-2xl shadow-lg">
    </div>
</section>

<!-- Article Content -->
<article class="max-w-4xl mx-auto px-6 mb-16">
    <div class="prose prose-lg max-w-none">
        <div class="text-gray-700 font-body leading-relaxed text-lg">
            <?php echo $post['content']; ?>
        </div>
    </div>
    
    <!-- Tags -->
    <?php if (!empty($post['tags'])): ?>
    <div class="mt-12 pt-8 border-t border-gray-200">
        <h3 class="text-lg font-semibold text-charcoal mb-4 font-sans">Tags</h3>
        <div class="flex flex-wrap gap-2">
            <?php foreach ($post['tags'] as $tag): ?>
            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-medium hover:bg-primary hover:text-white transition-colors cursor-pointer">
                <?php echo htmlspecialchars($tag); ?>
            </span>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Share Buttons -->
    <div class="mt-8 pt-8 border-t border-gray-200">
        <h3 class="text-lg font-semibold text-charcoal mb-4 font-sans">Share this article</h3>
        <div class="flex space-x-4">
            <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode($post['title']); ?>&url=<?php echo urlencode('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" 
               target="_blank"
               class="flex items-center space-x-2 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                </svg>
                <span>Twitter</span>
            </a>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" 
               target="_blank"
               class="flex items-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
                <span>Facebook</span>
            </a>
            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" 
               target="_blank"
               class="flex items-center space-x-2 bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                </svg>
                <span>LinkedIn</span>
            </a>
        </div>
    </div>
</article>

<!-- Related Posts -->
<?php if (!empty($related_posts)): ?>
<section class="bg-gray-50 py-16">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-2xl md:text-3xl font-bold text-charcoal mb-8 font-sans text-center">Related Articles</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php foreach ($related_posts as $related): ?>
            <article class="bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 hover:scale-105 overflow-hidden">
                <div class="relative h-48 overflow-hidden">
                    <img src="<?php echo htmlspecialchars($related['image']); ?>" 
                         alt="<?php echo htmlspecialchars($related['title']); ?>"
                         class="w-full h-full object-cover transition-transform duration-300 hover:scale-110">
                    <div class="absolute top-4 left-4">
                        <span class="bg-primary text-white px-3 py-1 rounded-full text-xs font-medium">
                            <?php echo htmlspecialchars($related['category']); ?>
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-bold text-charcoal mb-3 font-sans line-clamp-2">
                        <a href="blog-detail.php?id=<?php echo $related['id']; ?>" class="hover:text-primary transition-colors">
                            <?php echo htmlspecialchars($related['title']); ?>
                        </a>
                    </h3>
                    <p class="text-gray-600 font-body mb-4 line-clamp-2">
                        <?php echo htmlspecialchars($related['excerpt']); ?>
                    </p>
                    <div class="flex items-center justify-between text-sm text-gray-500">
                        <span class="font-body"><?php echo htmlspecialchars($related['author']); ?></span>
                        <span class="font-body"><?php echo date('M j, Y', strtotime($related['date'])); ?></span>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Call to Action -->
<section class="bg-gradient-to-r from-primary to-accent py-16">
    <div class="max-w-4xl mx-auto px-6 text-center text-white">
        <h2 class="text-3xl md:text-4xl font-bold mb-6 font-sans">Experience Kenya's Coast</h2>
        <p class="text-lg md:text-xl mb-8 font-body opacity-90">
            Ready to discover the authentic beauty and rich culture of Kenya's coastal region?
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="tours.php" 
               class="bg-white text-primary hover:bg-gray-100 px-8 py-4 rounded-full font-semibold transition-all duration-300 transform hover:scale-105">
                View Our Tours
            </a>
            <a href="booking.php" 
               class="bg-cta hover:bg-altcta px-8 py-4 rounded-full font-semibold transition-all duration-300 transform hover:scale-105">
                Book Your Adventure
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

/* Prose styling for article content */
.prose h3 {
    font-size: 1.5rem;
    font-weight: 600;
    color: #2C2C2C;
    margin-top: 2rem;
    margin-bottom: 1rem;
    font-family: 'Poppins', sans-serif;
}

.prose p {
    margin-bottom: 1.5rem;
    line-height: 1.8;
}

.prose p:last-child {
    margin-bottom: 0;
}
</style>

<?php include('components/footer.php'); ?>

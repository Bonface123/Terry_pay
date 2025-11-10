<?php 
// NOTE: Replace hardcoded product data with backend/fetch-products.php API calls
$page_title = "Shop - Pwani Safaris";
$page_description = "Shop authentic handcrafted coastal goods from local artisans. Jewelry, carvings, apparel and accessories supporting Kenya's coastal communities.";

// Sample product data (replace with database/API calls)
$products = [
    [
        'id' => 1,
        'sku' => 'KS-001',
        'title' => 'Mijikenda Beaded Necklace',
        'category' => 'Jewelry',
        'price' => 1200,
        'currency' => 'KSh',
        'short_desc' => 'Hand-beaded traditional Mijikenda design necklace with authentic coastal patterns.',
        'long_desc' => 'This beautiful necklace showcases the intricate beadwork traditions of the Mijikenda people. Each piece is carefully crafted by local artisans using traditional techniques passed down through generations.',
        'images' => ['assets/img/products/necklace-1.jpg'],
        'stock' => 8,
        'rating' => 4.8,
        'tags' => ['Traditional', 'Handmade', 'Mijikenda', 'Beadwork']
    ],
    [
        'id' => 2,
        'sku' => 'KS-002',
        'title' => 'Makonde Wood Carving',
        'category' => 'Carvings',
        'price' => 3500,
        'currency' => 'KSh',
        'short_desc' => 'Authentic Makonde tree of life carving representing family and community bonds.',
        'long_desc' => 'Carved from sustainable ebony wood by master Makonde artisans, this piece represents the interconnectedness of life and community values central to coastal culture.',
        'images' => ['assets/img/products/carving-1.jpg'],
        'stock' => 3,
        'rating' => 4.9,
        'tags' => ['Wood Carving', 'Makonde', 'Ebony', 'Traditional Art']
    ],
    [
        'id' => 3,
        'sku' => 'KS-003',
        'title' => 'Swahili Cotton Kikoy',
        'category' => 'Apparel',
        'price' => 800,
        'currency' => 'KSh',
        'short_desc' => 'Traditional handwoven kikoy in vibrant coastal colors and patterns.',
        'long_desc' => 'This versatile kikoy can be worn as a sarong, used as a beach towel, or displayed as wall art. Woven by coastal communities using traditional looms.',
        'images' => ['assets/img/products/kikoy-1.jpg'],
        'stock' => 15,
        'rating' => 4.6,
        'tags' => ['Kikoy', 'Cotton', 'Handwoven', 'Versatile']
    ],
    [
        'id' => 4,
        'sku' => 'KS-004',
        'title' => 'Coconut Shell Bracelet',
        'category' => 'Jewelry',
        'price' => 450,
        'currency' => 'KSh',
        'short_desc' => 'Eco-friendly bracelet crafted from polished coconut shells with silver accents.',
        'long_desc' => 'Sustainable jewelry made from locally sourced coconut shells, polished to perfection and accented with sterling silver details.',
        'images' => ['assets/img/products/bracelet-1.jpg'],
        'stock' => 12,
        'rating' => 4.4,
        'tags' => ['Eco-friendly', 'Coconut Shell', 'Silver', 'Sustainable']
    ],
    [
        'id' => 5,
        'sku' => 'KS-005',
        'title' => 'Dhow Model Sculpture',
        'category' => 'Carvings',
        'price' => 2800,
        'currency' => 'KSh',
        'short_desc' => 'Miniature traditional dhow boat carved from local hardwood.',
        'long_desc' => 'Detailed replica of traditional Swahili dhow boats that have sailed the Indian Ocean for centuries. Hand-carved by coastal artisans.',
        'images' => ['assets/img/products/dhow-model.jpg'],
        'stock' => 5,
        'rating' => 4.7,
        'tags' => ['Dhow', 'Maritime', 'Hardwood', 'Replica']
    ],
    [
        'id' => 6,
        'sku' => 'KS-006',
        'title' => 'Kanga Fabric Bag',
        'category' => 'Accessories',
        'price' => 950,
        'currency' => 'KSh',
        'short_desc' => 'Stylish tote bag made from authentic Kanga fabric with leather handles.',
        'long_desc' => 'Beautiful tote bag featuring traditional Kanga patterns with meaningful Swahili proverbs, complemented by genuine leather handles.',
        'images' => ['assets/img/products/kanga-bag.jpg'],
        'stock' => 7,
        'rating' => 4.5,
        'tags' => ['Kanga', 'Tote Bag', 'Leather', 'Proverbs']
    ],
    [
        'id' => 7,
        'sku' => 'KS-007',
        'title' => 'Baobab Seed Earrings',
        'category' => 'Jewelry',
        'price' => 650,
        'currency' => 'KSh',
        'short_desc' => 'Unique earrings made from polished baobab seeds with gold wire.',
        'long_desc' => 'One-of-a-kind earrings featuring seeds from the iconic baobab tree, polished and set with gold-plated wire for an elegant finish.',
        'images' => ['assets/img/products/baobab-earrings.jpg'],
        'stock' => 9,
        'rating' => 4.6,
        'tags' => ['Baobab', 'Seeds', 'Gold Wire', 'Unique']
    ],
    [
        'id' => 8,
        'sku' => 'KS-008',
        'title' => 'Swahili Embroidered Kaftan',
        'category' => 'Apparel',
        'price' => 1800,
        'currency' => 'KSh',
        'short_desc' => 'Elegant kaftan with traditional Swahili embroidery in coastal colors.',
        'long_desc' => 'Flowing kaftan featuring intricate hand-embroidered patterns inspired by Swahili architecture and coastal motifs. Perfect for beach or evening wear.',
        'images' => ['assets/img/products/kaftan-1.jpg'],
        'stock' => 6,
        'rating' => 4.8,
        'tags' => ['Kaftan', 'Embroidery', 'Swahili', 'Evening Wear']
    ]
];

include('components/header.php'); 
?>

<!-- Breadcrumb Navigation -->
<nav class="bg-white border-b border-gray-200 py-4 mt-16 lg:mt-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center space-x-2 text-sm font-body">
            <a href="index.php" class="text-primary hover:text-accent transition-colors">Home</a>
            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
            </svg>
            <span class="text-gray-600">Shop</span>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="bg-base py-12">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-primary mb-4 font-sans">
                Shop Handcrafted Coastal Goods
            </h1>
            <p class="text-lg text-gray-600 font-body max-w-2xl mx-auto">
                Support coastal artisans through authentic jewelry, carvings, apparel & accessories that tell the story of Kenya's rich cultural heritage.
            </p>
        </div>
        
        <!-- Category Pills -->
        <div class="flex flex-wrap justify-center gap-3 mb-8">
            <button class="category-filter bg-primary text-white px-6 py-2 rounded-full font-medium transition-all hover:bg-accent focus:ring-2 focus:ring-accent" data-category="all">
                All Products
            </button>
            <button class="category-filter bg-white text-primary border border-primary px-6 py-2 rounded-full font-medium transition-all hover:bg-primary hover:text-white focus:ring-2 focus:ring-accent" data-category="Jewelry">
                Jewelry
            </button>
            <button class="category-filter bg-white text-primary border border-primary px-6 py-2 rounded-full font-medium transition-all hover:bg-primary hover:text-white focus:ring-2 focus:ring-accent" data-category="Carvings">
                Carvings
            </button>
            <button class="category-filter bg-white text-primary border border-primary px-6 py-2 rounded-full font-medium transition-all hover:bg-primary hover:text-white focus:ring-2 focus:ring-accent" data-category="Apparel">
                Apparel
            </button>
            <button class="category-filter bg-white text-primary border border-primary px-6 py-2 rounded-full font-medium transition-all hover:bg-primary hover:text-white focus:ring-2 focus:ring-accent" data-category="Accessories">
                Accessories
            </button>
        </div>
    </div>
</section>

<!-- Search & Controls Section -->
<section class="bg-white py-6 sticky top-16 lg:top-20 z-40 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col lg:flex-row gap-4 items-center justify-between">
            <!-- Search Input -->
            <div class="flex-1 max-w-md">
                <div class="relative">
                    <input 
                        type="search" 
                        id="product-search" 
                        placeholder="Search products, artisans, tags..." 
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-transparent font-body"
                        aria-label="Search products">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>
            
            <!-- Controls Row -->
            <div class="flex flex-wrap items-center gap-4">
                <!-- Sort Dropdown -->
                <select id="sort-select" class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-transparent font-body" aria-label="Sort products">
                    <option value="popular">Popular</option>
                    <option value="newest">Newest</option>
                    <option value="price-asc">Price: Low → High</option>
                    <option value="price-desc">Price: High → Low</option>
                    <option value="rating">Highest Rated</option>
                </select>
                
                <!-- View Toggle -->
                <div class="flex border border-gray-300 rounded-lg overflow-hidden">
                    <button id="grid-view" class="px-4 py-3 bg-primary text-white hover:bg-accent transition-colors focus:ring-2 focus:ring-accent" aria-label="Grid view">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                        </svg>
                    </button>
                    <button id="list-view" class="px-4 py-3 bg-white text-gray-600 hover:bg-gray-50 transition-colors focus:ring-2 focus:ring-accent" aria-label="List view">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
                
                <!-- Cart Icon -->
                <a href="cart.php" class="relative p-3 bg-cta text-white rounded-lg hover:bg-altcta transition-colors focus:ring-2 focus:ring-accent" aria-label="Shopping cart">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"/>
                    </svg>
                    <span id="cart-count" class="absolute -top-2 -right-2 bg-altcta text-white text-xs rounded-full h-6 w-6 flex items-center justify-center font-bold">0</span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Main Content Area -->
<main class="bg-white py-12">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            
            <!-- Filters Sidebar (Desktop) -->
            <aside class="lg:col-span-1 space-y-6">
                <div class="bg-gray-50 rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-charcoal mb-4 font-sans">Filters</h3>
                    
                    <!-- Price Range -->
                    <div class="mb-6">
                        <h4 class="font-medium text-charcoal mb-3 font-body">Price Range</h4>
                        <div class="flex items-center space-x-3">
                            <input type="number" id="min-price" placeholder="Min" class="w-20 px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-accent">
                            <span class="text-gray-500">-</span>
                            <input type="number" id="max-price" placeholder="Max" class="w-20 px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-accent">
                            <span class="text-sm text-gray-500">KSh</span>
                        </div>
                    </div>
                    
                    <!-- Tags Filter -->
                    <div class="mb-6">
                        <h4 class="font-medium text-charcoal mb-3 font-body">Tags</h4>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" class="tag-filter rounded text-primary focus:ring-accent" value="Traditional">
                                <span class="ml-2 text-sm text-gray-700">Traditional</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="tag-filter rounded text-primary focus:ring-accent" value="Handmade">
                                <span class="ml-2 text-sm text-gray-700">Handmade</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="tag-filter rounded text-primary focus:ring-accent" value="Eco-friendly">
                                <span class="ml-2 text-sm text-gray-700">Eco-friendly</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="tag-filter rounded text-primary focus:ring-accent" value="Sustainable">
                                <span class="ml-2 text-sm text-gray-700">Sustainable</span>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Rating Filter -->
                    <div class="mb-6">
                        <h4 class="font-medium text-charcoal mb-3 font-body">Rating</h4>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="radio" name="rating" class="rating-filter text-primary focus:ring-accent" value="4">
                                <span class="ml-2 flex items-center text-sm">
                                    <span class="text-yellow-400">★★★★</span>
                                    <span class="text-gray-300">★</span>
                                    <span class="ml-1 text-gray-700">& up</span>
                                </span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="rating" class="rating-filter text-primary focus:ring-accent" value="3">
                                <span class="ml-2 flex items-center text-sm">
                                    <span class="text-yellow-400">★★★</span>
                                    <span class="text-gray-300">★★</span>
                                    <span class="ml-1 text-gray-700">& up</span>
                                </span>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Clear Filters -->
                    <button id="clear-filters" class="w-full bg-gray-200 text-charcoal px-4 py-2 rounded-lg hover:bg-gray-300 transition-colors font-medium">
                        Clear All Filters
                    </button>
                </div>
            </aside>
            
            <!-- Product Grid -->
            <div class="lg:col-span-3">
                <!-- Results Info -->
                <div class="flex items-center justify-between mb-6">
                    <p class="text-gray-600 font-body">
                        Showing <span id="results-count"><?php echo count($products); ?></span> products
                    </p>
                </div>
                
                <!-- Product Grid Container -->
                <div id="product-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($products as $product): ?>
                    <article class="product-card bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 hover:scale-105 overflow-hidden" 
                             data-id="<?php echo $product['id']; ?>"
                             data-sku="<?php echo htmlspecialchars($product['sku']); ?>"
                             data-price="<?php echo $product['price']; ?>"
                             data-category="<?php echo htmlspecialchars($product['category']); ?>"
                             data-stock="<?php echo $product['stock']; ?>"
                             data-rating="<?php echo $product['rating']; ?>"
                             data-tags="<?php echo htmlspecialchars(implode(',', $product['tags'])); ?>">
                        
                        <!-- Product Image -->
                        <div class="relative h-48 overflow-hidden">
                            <img src="<?php echo htmlspecialchars($product['images'][0]); ?>" 
                                 alt="<?php echo htmlspecialchars($product['title']); ?>"
                                 class="w-full h-full object-cover transition-transform duration-300 hover:scale-110"
                                 loading="lazy"
                                 onerror="this.src='assets/img/products/placeholder.jpg'">
                            
                            <!-- Category Badge -->
                            <div class="absolute top-3 left-3">
                                <span class="bg-primary text-white px-2 py-1 rounded text-xs font-medium">
                                    <?php echo htmlspecialchars($product['category']); ?>
                                </span>
                            </div>
                            
                            <!-- Quick View Button -->
                            <button class="quick-view absolute top-3 right-3 bg-white bg-opacity-90 hover:bg-opacity-100 p-2 rounded-full shadow-md transition-all"
                                    data-product-id="<?php echo $product['id']; ?>"
                                    aria-label="Quick view <?php echo htmlspecialchars($product['title']); ?>">
                                <svg class="w-4 h-4 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                        
                        <!-- Product Details -->
                        <div class="p-4">
                            <!-- Title -->
                            <h3 class="text-lg font-semibold text-charcoal mb-2 font-sans line-clamp-2">
                                <?php echo htmlspecialchars($product['title']); ?>
                            </h3>
                            
                            <!-- Description -->
                            <p class="text-gray-600 font-body text-sm mb-3 line-clamp-2">
                                <?php echo htmlspecialchars($product['short_desc']); ?>
                            </p>
                            
                            <!-- Rating & Price Row -->
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center space-x-1">
                                    <?php 
                                    $rating = $product['rating'];
                                    $fullStars = floor($rating);
                                    $hasHalfStar = ($rating - $fullStars) >= 0.5;
                                    
                                    for ($i = 0; $i < $fullStars; $i++): ?>
                                        <span class="text-yellow-400">★</span>
                                    <?php endfor; 
                                    
                                    if ($hasHalfStar): ?>
                                        <span class="text-yellow-400">☆</span>
                                    <?php endif;
                                    
                                    for ($i = $fullStars + ($hasHalfStar ? 1 : 0); $i < 5; $i++): ?>
                                        <span class="text-gray-300">★</span>
                                    <?php endfor; ?>
                                    <span class="text-xs text-gray-500 ml-1">(<?php echo $rating; ?>)</span>
                                </div>
                                <div class="text-lg font-bold text-cta">
                                    <?php echo $product['currency'] . ' ' . number_format($product['price']); ?>
                                </div>
                            </div>
                            
                            <!-- Stock Status -->
                            <div class="mb-4">
                                <?php if ($product['stock'] > 0): ?>
                                    <span class="text-sm text-accent font-medium">
                                        ✓ In Stock (<?php echo $product['stock']; ?> available)
                                    </span>
                                <?php else: ?>
                                    <span class="text-sm text-altcta font-medium">
                                        ✗ Out of Stock
                                    </span>
                                <?php endif; ?>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="flex space-x-2">
                                <button class="add-to-cart flex-1 bg-cta hover:bg-altcta text-white px-4 py-2 rounded-lg font-medium transition-colors focus:ring-2 focus:ring-accent <?php echo $product['stock'] <= 0 ? 'opacity-50 cursor-not-allowed' : ''; ?>"
                                        data-product-id="<?php echo $product['id']; ?>"
                                        <?php echo $product['stock'] <= 0 ? 'disabled' : ''; ?>>
                                    Add to Cart
                                </button>
                                <a href="product-details.php?id=<?php echo $product['id']; ?>" 
                                   class="bg-white border border-primary text-primary hover:bg-primary hover:text-white px-4 py-2 rounded-lg font-medium transition-colors focus:ring-2 focus:ring-accent">
                                    Details
                                </a>
                            </div>
                        </div>
                    </article>
                    <?php endforeach; ?>
                </div>
                
                <!-- Empty State (Hidden by default) -->
                <div id="empty-state" class="hidden text-center py-12">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-600 mb-2">No products found</h3>
                    <p class="text-gray-500 mb-4">Try adjusting your search or filters</p>
                    <div class="flex flex-wrap justify-center gap-2">
                        <button class="category-filter bg-primary text-white px-4 py-2 rounded-full text-sm" data-category="Jewelry">Browse Jewelry</button>
                        <button class="category-filter bg-primary text-white px-4 py-2 rounded-full text-sm" data-category="Carvings">Browse Carvings</button>
                        <button class="category-filter bg-primary text-white px-4 py-2 rounded-full text-sm" data-category="Apparel">Browse Apparel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Quick View Modal -->
<div id="quick-view-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6">
            <!-- Modal Header -->
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-charcoal font-sans">Quick View</h2>
                <button id="close-modal" class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <!-- Modal Content -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Product Image -->
                <div class="space-y-4">
                    <img id="modal-image" src="" alt="" class="w-full h-64 md:h-80 object-cover rounded-lg">
                </div>
                
                <!-- Product Details -->
                <div class="space-y-4">
                    <div>
                        <span id="modal-category" class="bg-primary text-white px-3 py-1 rounded-full text-sm font-medium"></span>
                    </div>
                    
                    <h3 id="modal-title" class="text-2xl font-bold text-charcoal font-sans"></h3>
                    
                    <div class="flex items-center space-x-4">
                        <div id="modal-rating" class="flex items-center space-x-1"></div>
                        <div id="modal-price" class="text-2xl font-bold text-cta"></div>
                    </div>
                    
                    <p id="modal-description" class="text-gray-600 font-body"></p>
                    
                    <div id="modal-stock" class="text-sm font-medium"></div>
                    
                    <!-- Quantity Selector -->
                    <div class="flex items-center space-x-4">
                        <label class="font-medium text-charcoal">Quantity:</label>
                        <div class="flex items-center border border-gray-300 rounded-lg">
                            <button id="qty-minus" class="px-3 py-2 hover:bg-gray-100 transition-colors">-</button>
                            <input id="modal-quantity" type="number" value="1" min="1" class="w-16 px-3 py-2 text-center border-0 focus:ring-0">
                            <button id="qty-plus" class="px-3 py-2 hover:bg-gray-100 transition-colors">+</button>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex space-x-3">
                        <button id="modal-add-to-cart" class="flex-1 bg-cta hover:bg-altcta text-white px-6 py-3 rounded-lg font-medium transition-colors">
                            Add to Cart
                        </button>
                        <a id="modal-view-details" href="#" class="bg-white border border-primary text-primary hover:bg-primary hover:text-white px-6 py-3 rounded-lg font-medium transition-colors">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pagination -->
<section class="bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-6">
        <nav class="flex items-center justify-center" aria-label="Pagination">
            <div class="flex items-center space-x-2">
                <!-- Previous Button -->
                <button class="flex items-center px-4 py-2 text-primary hover:text-accent border border-gray-300 rounded-lg hover:bg-white transition-colors disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Previous
                </button>
                
                <!-- Page Numbers -->
                <button class="px-4 py-2 bg-primary text-white rounded-lg">1</button>
                <button class="px-4 py-2 text-primary hover:text-accent border border-gray-300 rounded-lg hover:bg-white transition-colors">2</button>
                <button class="px-4 py-2 text-primary hover:text-accent border border-gray-300 rounded-lg hover:bg-white transition-colors">3</button>
                <span class="px-2 text-gray-500">...</span>
                <button class="px-4 py-2 text-primary hover:text-accent border border-gray-300 rounded-lg hover:bg-white transition-colors">12</button>
                
                <!-- Next Button -->
                <button class="flex items-center px-4 py-2 text-primary hover:text-accent border border-gray-300 rounded-lg hover:bg-white transition-colors">
                    Next
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </nav>
    </div>
</section>

<!-- Call to Action -->
<section class="bg-gradient-to-r from-primary to-accent py-16">
    <div class="max-w-4xl mx-auto px-6 text-center text-white">
        <h2 class="text-3xl md:text-4xl font-bold mb-6 font-sans">Support Coastal Artisans</h2>
        <p class="text-lg md:text-xl mb-8 font-body opacity-90">
            Every purchase directly supports local communities and helps preserve traditional crafts for future generations.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="about.php" 
               class="bg-white text-primary hover:bg-gray-100 px-8 py-4 rounded-full font-semibold transition-all duration-300 transform hover:scale-105">
                Learn Our Story
            </a>
            <a href="contact.php" 
               class="bg-cta hover:bg-altcta px-8 py-4 rounded-full font-semibold transition-all duration-300 transform hover:scale-105">
                Get in Touch
            </a>
        </div>
    </div>
</section>

<!-- Custom Styles -->
<style>
/* Line clamping for product cards */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Focus states for accessibility */
.focus\:ring-accent:focus {
    --tw-ring-color: #2A9D8F;
}

/* Product card hover effects */
.product-card:hover {
    transform: translateY(-2px);
}

/* Modal backdrop blur */
#quick-view-modal.show {
    backdrop-filter: blur(4px);
}

/* Custom scrollbar for modal */
#quick-view-modal .overflow-y-auto::-webkit-scrollbar {
    width: 6px;
}

#quick-view-modal .overflow-y-auto::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

#quick-view-modal .overflow-y-auto::-webkit-scrollbar-thumb {
    background: #0077B6;
    border-radius: 3px;
}

/* Toast notification styles */
.toast {
    position: fixed;
    top: 100px;
    right: 20px;
    background: #2A9D8F;
    color: white;
    padding: 12px 24px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    transform: translateX(100%);
    transition: transform 0.3s ease;
    z-index: 1000;
}

.toast.show {
    transform: translateX(0);
}

/* Responsive adjustments */
@media (max-width: 1023px) {
    aside {
        order: 2;
    }
    
    .lg\:col-span-3 {
        order: 1;
    }
}
</style>

<!-- Include JavaScript -->
<script src="assets/js/shop.js"></script>

<?php include('components/footer.php'); ?>
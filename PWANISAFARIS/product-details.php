<?php 
// Get the product ID from URL parameter
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 1;

// Sample product data (same as in shop.php - in real app, fetch from database)
$sample_products = [
    1 => [
        'id' => 1,
        'sku' => 'KS-001',
        'title' => 'Mijikenda Beaded Necklace',
        'category' => 'Jewelry',
        'price' => 1200,
        'currency' => 'KSh',
        'short_desc' => 'Hand-beaded traditional Mijikenda design necklace with authentic coastal patterns.',
        'long_desc' => 'This beautiful necklace showcases the intricate beadwork traditions of the Mijikenda people. Each piece is carefully crafted by local artisans using traditional techniques passed down through generations. The vibrant colors and patterns tell stories of coastal heritage and cultural identity.',
        'images' => [
            'assets/img/products/necklace-1.jpg',
            'assets/img/products/necklace-2.jpg',
            'assets/img/products/necklace-3.jpg'
        ],
        'stock' => 8,
        'rating' => 4.8,
        'reviews_count' => 24,
        'tags' => ['Traditional', 'Handmade', 'Mijikenda', 'Beadwork'],
        'materials' => ['Glass beads', 'Cotton thread', 'Metal clasp'],
        'dimensions' => '45cm length, adjustable',
        'care_instructions' => 'Store in dry place. Clean gently with soft cloth.',
        'artisan' => 'Kadzo Mwangi',
        'artisan_story' => 'Kadzo has been creating traditional Mijikenda jewelry for over 20 years, learning the craft from her grandmother.'
    ],
    2 => [
        'id' => 2,
        'sku' => 'KS-002',
        'title' => 'Makonde Wood Carving',
        'category' => 'Carvings',
        'price' => 3500,
        'currency' => 'KSh',
        'short_desc' => 'Authentic Makonde tree of life carving representing family and community bonds.',
        'long_desc' => 'Carved from sustainable ebony wood by master Makonde artisans, this piece represents the interconnectedness of life and community values central to coastal culture. Each carving is unique and tells a story of family, growth, and unity.',
        'images' => [
            'assets/img/products/carving-1.jpg',
            'assets/img/products/carving-2.jpg',
            'assets/img/products/carving-3.jpg'
        ],
        'stock' => 3,
        'rating' => 4.9,
        'reviews_count' => 18,
        'tags' => ['Wood Carving', 'Makonde', 'Ebony', 'Traditional Art'],
        'materials' => ['Ebony wood', 'Natural finish'],
        'dimensions' => '25cm height x 15cm width',
        'care_instructions' => 'Dust regularly. Apply wood oil occasionally to maintain finish.',
        'artisan' => 'Hassan Mwalimu',
        'artisan_story' => 'Hassan is a third-generation Makonde carver who specializes in traditional tree of life sculptures.'
    ]
];

// Get the specific product or default to first product
$product = isset($sample_products[$product_id]) ? $sample_products[$product_id] : $sample_products[1];

$page_title = $product['title'] . " - Pwani Safaris";
$page_description = $product['short_desc'];
include('components/header.php'); 

// Related products (same category, exclude current)
$related_products = array_filter($sample_products, function($p) use ($product_id, $product) {
    return $p['id'] !== $product_id && $p['category'] === $product['category'];
});
$related_products = array_slice($related_products, 0, 3);
?>

<!-- Breadcrumb Navigation -->
<nav class="bg-white border-b border-gray-200 py-4 mt-16 lg:mt-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center space-x-2 text-sm font-body">
            <a href="index.php" class="text-primary hover:text-accent transition-colors">Home</a>
            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
            </svg>
            <a href="shop.php" class="text-primary hover:text-accent transition-colors">Shop</a>
            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
            </svg>
            <a href="shop.php?category=<?php echo urlencode($product['category']); ?>" class="text-primary hover:text-accent transition-colors"><?php echo htmlspecialchars($product['category']); ?></a>
            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
            </svg>
            <span class="text-gray-600 truncate"><?php echo htmlspecialchars($product['title']); ?></span>
        </div>
    </div>
</nav>

<!-- Product Details -->
<main class="bg-white py-12">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            
            <!-- Product Images -->
            <div class="space-y-4">
                <!-- Main Image -->
                <div class="aspect-square overflow-hidden rounded-xl bg-gray-100">
                    <img id="main-image" 
                         src="<?php echo htmlspecialchars($product['images'][0]); ?>" 
                         alt="<?php echo htmlspecialchars($product['title']); ?>"
                         class="w-full h-full object-cover cursor-zoom-in"
                         onclick="openImageModal(this.src)"
                         onerror="this.src='assets/img/products/placeholder.jpg'">
                </div>
                
                <!-- Thumbnail Images -->
                <?php if (count($product['images']) > 1): ?>
                <div class="flex space-x-4 overflow-x-auto">
                    <?php foreach ($product['images'] as $index => $image): ?>
                    <img src="<?php echo htmlspecialchars($image); ?>" 
                         alt="<?php echo htmlspecialchars($product['title']); ?> - View <?php echo $index + 1; ?>"
                         class="w-20 h-20 object-cover rounded-lg cursor-pointer border-2 border-transparent hover:border-primary transition-colors <?php echo $index === 0 ? 'border-primary' : ''; ?>"
                         onclick="changeMainImage(this.src, this)"
                         onerror="this.src='assets/img/products/placeholder.jpg'">
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
            
            <!-- Product Information -->
            <div class="space-y-6">
                <!-- Category Badge -->
                <div>
                    <span class="bg-primary text-white px-4 py-2 rounded-full text-sm font-medium">
                        <?php echo htmlspecialchars($product['category']); ?>
                    </span>
                </div>
                
                <!-- Title and Rating -->
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-charcoal mb-4 font-sans">
                        <?php echo htmlspecialchars($product['title']); ?>
                    </h1>
                    
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="flex items-center space-x-1">
                            <?php 
                            $rating = $product['rating'];
                            $fullStars = floor($rating);
                            $hasHalfStar = ($rating - $fullStars) >= 0.5;
                            
                            for ($i = 0; $i < $fullStars; $i++): ?>
                                <span class="text-yellow-400 text-lg">★</span>
                            <?php endfor; 
                            
                            if ($hasHalfStar): ?>
                                <span class="text-yellow-400 text-lg">☆</span>
                            <?php endif;
                            
                            for ($i = $fullStars + ($hasHalfStar ? 1 : 0); $i < 5; $i++): ?>
                                <span class="text-gray-300 text-lg">★</span>
                            <?php endfor; ?>
                        </div>
                        <span class="text-sm text-gray-600">
                            <?php echo $rating; ?> (<?php echo $product['reviews_count']; ?> reviews)
                        </span>
                    </div>
                </div>
                
                <!-- Price -->
                <div class="text-3xl font-bold text-cta">
                    <?php echo $product['currency'] . ' ' . number_format($product['price']); ?>
                </div>
                
                <!-- Description -->
                <div class="prose prose-lg max-w-none">
                    <p class="text-gray-700 font-body leading-relaxed">
                        <?php echo htmlspecialchars($product['long_desc']); ?>
                    </p>
                </div>
                
                <!-- Stock Status -->
                <div class="flex items-center space-x-2">
                    <?php if ($product['stock'] > 0): ?>
                        <svg class="w-5 h-5 text-accent" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-accent font-medium">In Stock (<?php echo $product['stock']; ?> available)</span>
                    <?php else: ?>
                        <svg class="w-5 h-5 text-altcta" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-altcta font-medium">Out of Stock</span>
                    <?php endif; ?>
                </div>
                
                <!-- Quantity and Add to Cart -->
                <div class="space-y-4">
                    <div class="flex items-center space-x-4">
                        <label class="font-medium text-charcoal">Quantity:</label>
                        <div class="flex items-center border border-gray-300 rounded-lg">
                            <button id="qty-minus" class="px-4 py-2 hover:bg-gray-100 transition-colors">-</button>
                            <input id="quantity" type="number" value="1" min="1" max="<?php echo $product['stock']; ?>" 
                                   class="w-16 px-3 py-2 text-center border-0 focus:ring-0">
                            <button id="qty-plus" class="px-4 py-2 hover:bg-gray-100 transition-colors">+</button>
                        </div>
                    </div>
                    
                    <div class="flex space-x-4">
                        <button id="add-to-cart" 
                                class="flex-1 bg-cta hover:bg-altcta text-white px-8 py-4 rounded-lg font-medium text-lg transition-colors focus:ring-2 focus:ring-accent <?php echo $product['stock'] <= 0 ? 'opacity-50 cursor-not-allowed' : ''; ?>"
                                data-product-id="<?php echo $product['id']; ?>"
                                <?php echo $product['stock'] <= 0 ? 'disabled' : ''; ?>>
                            Add to Cart
                        </button>
                        <button class="bg-white border border-primary text-primary hover:bg-primary hover:text-white px-6 py-4 rounded-lg font-medium transition-colors focus:ring-2 focus:ring-accent">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                
                <!-- Product Details Tabs -->
                <div class="border-t pt-6">
                    <div class="space-y-6">
                        <!-- Materials -->
                        <div>
                            <h3 class="text-lg font-semibold text-charcoal mb-3 font-sans">Materials</h3>
                            <ul class="list-disc list-inside text-gray-700 font-body space-y-1">
                                <?php foreach ($product['materials'] as $material): ?>
                                <li><?php echo htmlspecialchars($material); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        
                        <!-- Dimensions -->
                        <div>
                            <h3 class="text-lg font-semibold text-charcoal mb-3 font-sans">Dimensions</h3>
                            <p class="text-gray-700 font-body"><?php echo htmlspecialchars($product['dimensions']); ?></p>
                        </div>
                        
                        <!-- Care Instructions -->
                        <div>
                            <h3 class="text-lg font-semibold text-charcoal mb-3 font-sans">Care Instructions</h3>
                            <p class="text-gray-700 font-body"><?php echo htmlspecialchars($product['care_instructions']); ?></p>
                        </div>
                        
                        <!-- Artisan Story -->
                        <div>
                            <h3 class="text-lg font-semibold text-charcoal mb-3 font-sans">Meet the Artisan</h3>
                            <p class="text-gray-700 font-body">
                                <strong><?php echo htmlspecialchars($product['artisan']); ?>:</strong> 
                                <?php echo htmlspecialchars($product['artisan_story']); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Related Products -->
<?php if (!empty($related_products)): ?>
<section class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-2xl md:text-3xl font-bold text-charcoal mb-8 font-sans text-center">Related Products</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php foreach ($related_products as $related): ?>
            <article class="bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 hover:scale-105 overflow-hidden">
                <div class="relative h-48 overflow-hidden">
                    <img src="<?php echo htmlspecialchars($related['images'][0]); ?>" 
                         alt="<?php echo htmlspecialchars($related['title']); ?>"
                         class="w-full h-full object-cover transition-transform duration-300 hover:scale-110"
                         onerror="this.src='assets/img/products/placeholder.jpg'">
                    <div class="absolute top-4 left-4">
                        <span class="bg-primary text-white px-3 py-1 rounded-full text-xs font-medium">
                            <?php echo htmlspecialchars($related['category']); ?>
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-bold text-charcoal mb-3 font-sans line-clamp-2">
                        <a href="product-details.php?id=<?php echo $related['id']; ?>" class="hover:text-primary transition-colors">
                            <?php echo htmlspecialchars($related['title']); ?>
                        </a>
                    </h3>
                    <p class="text-gray-600 font-body mb-4 line-clamp-2">
                        <?php echo htmlspecialchars($related['short_desc']); ?>
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="text-lg font-bold text-cta">
                            <?php echo $related['currency'] . ' ' . number_format($related['price']); ?>
                        </div>
                        <a href="product-details.php?id=<?php echo $related['id']; ?>" 
                           class="bg-primary hover:bg-accent text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            View Details
                        </a>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Image Modal -->
<div id="image-modal" class="fixed inset-0 bg-black bg-opacity-75 z-50 hidden items-center justify-center p-4">
    <div class="relative max-w-4xl max-h-full">
        <img id="modal-image" src="" alt="" class="max-w-full max-h-full object-contain">
        <button id="close-image-modal" class="absolute top-4 right-4 text-white hover:text-gray-300 transition-colors">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
</div>

<!-- Custom Styles -->
<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.cursor-zoom-in {
    cursor: zoom-in;
}

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
</style>

<!-- Product Details JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    initializeProductDetails();
});

function initializeProductDetails() {
    // Quantity controls
    const qtyMinus = document.getElementById('qty-minus');
    const qtyPlus = document.getElementById('qty-plus');
    const qtyInput = document.getElementById('quantity');
    const maxStock = parseInt(qtyInput.getAttribute('max'));
    
    qtyMinus.addEventListener('click', () => {
        const current = parseInt(qtyInput.value);
        if (current > 1) {
            qtyInput.value = current - 1;
        }
    });
    
    qtyPlus.addEventListener('click', () => {
        const current = parseInt(qtyInput.value);
        if (current < maxStock) {
            qtyInput.value = current + 1;
        }
    });
    
    // Add to cart
    const addToCartBtn = document.getElementById('add-to-cart');
    addToCartBtn.addEventListener('click', function() {
        const productId = this.dataset.productId;
        const quantity = parseInt(qtyInput.value);
        addToCart(productId, quantity);
    });
    
    // Image modal
    const imageModal = document.getElementById('image-modal');
    const closeModalBtn = document.getElementById('close-image-modal');
    
    closeModalBtn.addEventListener('click', closeImageModal);
    imageModal.addEventListener('click', function(e) {
        if (e.target === imageModal) {
            closeImageModal();
        }
    });
    
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeImageModal();
        }
    });
}

function changeMainImage(src, thumbnail) {
    document.getElementById('main-image').src = src;
    
    // Update thumbnail borders
    document.querySelectorAll('.w-20').forEach(thumb => {
        thumb.classList.remove('border-primary');
        thumb.classList.add('border-transparent');
    });
    thumbnail.classList.remove('border-transparent');
    thumbnail.classList.add('border-primary');
}

function openImageModal(src) {
    const modal = document.getElementById('image-modal');
    const modalImage = document.getElementById('modal-image');
    
    modalImage.src = src;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeImageModal() {
    const modal = document.getElementById('image-modal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = '';
}

function addToCart(productId, quantity = 1) {
    // Get product data from page
    const title = document.querySelector('h1').textContent;
    const priceText = document.querySelector('.text-3xl.font-bold.text-cta').textContent;
    const price = parseInt(priceText.replace(/[^\d]/g, ''));
    const category = document.querySelector('.bg-primary.text-white.px-4').textContent;
    const image = document.getElementById('main-image').src;
    const sku = '<?php echo $product["sku"]; ?>';
    
    const product = {
        id: productId,
        sku: sku,
        title: title,
        price: price,
        category: category,
        image: image,
        quantity: quantity
    };
    
    // Get existing cart from localStorage
    let cart = JSON.parse(localStorage.getItem('pwanisafaris_cart') || '[]');
    
    // Check if product already exists in cart
    const existingIndex = cart.findIndex(item => item.id === productId);
    
    if (existingIndex > -1) {
        cart[existingIndex].quantity += quantity;
    } else {
        cart.push(product);
    }
    
    // Save to localStorage
    localStorage.setItem('pwanisafaris_cart', JSON.stringify(cart));
    
    // Update cart count
    updateCartCount();
    
    // Show success toast
    showToast(`${product.title} added to cart!`);
}

function updateCartCount() {
    const cart = JSON.parse(localStorage.getItem('pwanisafaris_cart') || '[]');
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    
    const cartCountElement = document.getElementById('cart-count');
    if (cartCountElement) {
        cartCountElement.textContent = totalItems;
    }
}

function showToast(message) {
    // Remove existing toast
    const existingToast = document.querySelector('.toast');
    if (existingToast) {
        existingToast.remove();
    }
    
    // Create new toast
    const toast = document.createElement('div');
    toast.className = 'toast';
    toast.textContent = message;
    
    document.body.appendChild(toast);
    
    // Show toast
    setTimeout(() => toast.classList.add('show'), 100);
    
    // Hide and remove toast
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

// Initialize cart count on page load
updateCartCount();
</script>

<?php include('components/footer.php'); ?>

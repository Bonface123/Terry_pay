<?php 
$page_title = "Shopping Cart - Pwani Safaris";
$page_description = "Review your selected handcrafted coastal goods and proceed to checkout. Supporting local artisans with every purchase.";
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
            <a href="shop.php" class="text-primary hover:text-accent transition-colors">Shop</a>
            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
            </svg>
            <span class="text-gray-600">Shopping Cart</span>
        </div>
    </div>
</nav>

<!-- Cart Content -->
<main class="bg-gray-50 py-12 min-h-screen">
    <div class="max-w-7xl mx-auto px-6">
        
        <!-- Page Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-charcoal mb-4 font-sans">Shopping Cart</h1>
            <p class="text-lg text-gray-600 font-body">Review your selected items and proceed to checkout</p>
        </div>

        <!-- Cart Container -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Cart Items -->
            <div class="lg:col-span-2">
                
                <!-- Empty Cart State -->
                <div id="empty-cart" class="bg-white rounded-xl shadow-md p-8 text-center">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"/>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2 font-sans">Your cart is empty</h3>
                    <p class="text-gray-500 mb-6 font-body">Discover our beautiful handcrafted coastal goods</p>
                    <a href="shop.php" class="bg-primary hover:bg-accent text-white px-8 py-3 rounded-lg font-medium transition-colors">
                        Continue Shopping
                    </a>
                </div>

                <!-- Cart Items Container -->
                <div id="cart-items" class="space-y-4 hidden">
                    <!-- Cart items will be populated by JavaScript -->
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div id="order-summary" class="bg-white rounded-xl shadow-md p-6 sticky top-24 hidden">
                    <h3 class="text-xl font-semibold text-charcoal mb-4 font-sans">Order Summary</h3>
                    
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-gray-600 font-body">
                            <span>Subtotal (<span id="total-items">0</span> items)</span>
                            <span id="subtotal">KSh 0</span>
                        </div>
                        <div class="flex justify-between text-gray-600 font-body">
                            <span>Shipping</span>
                            <span id="shipping">Free</span>
                        </div>
                        <div class="border-t pt-3">
                            <div class="flex justify-between text-lg font-semibold text-charcoal">
                                <span>Total</span>
                                <span id="total">KSh 0</span>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <button id="checkout-btn" class="w-full bg-cta hover:bg-altcta text-white px-6 py-3 rounded-lg font-medium transition-colors">
                            Proceed to Checkout
                        </button>
                        <a href="shop.php" class="block w-full text-center bg-white border border-primary text-primary hover:bg-primary hover:text-white px-6 py-3 rounded-lg font-medium transition-colors">
                            Continue Shopping
                        </a>
                    </div>

                    <!-- Trust Badges -->
                    <div class="mt-6 pt-6 border-t">
                        <div class="flex items-center justify-center space-x-4 text-sm text-gray-500">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1 text-accent" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                                </svg>
                                Secure Checkout
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1 text-accent" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Authentic Products
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Call to Action -->
<section class="bg-gradient-to-r from-primary to-accent py-16">
    <div class="max-w-4xl mx-auto px-6 text-center text-white">
        <h2 class="text-3xl md:text-4xl font-bold mb-6 font-sans">Supporting Coastal Communities</h2>
        <p class="text-lg md:text-xl mb-8 font-body opacity-90">
            Every purchase directly supports local artisans and helps preserve traditional coastal crafts for future generations.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="about.php" 
               class="bg-white text-primary hover:bg-gray-100 px-8 py-4 rounded-full font-semibold transition-all duration-300 transform hover:scale-105">
                Learn Our Impact
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
.cart-item {
    transition: all 0.3s ease;
}

.cart-item.removing {
    opacity: 0;
    transform: translateX(-100%);
}

.quantity-input {
    -moz-appearance: textfield;
}

.quantity-input::-webkit-outer-spin-button,
.quantity-input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
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

<!-- Cart JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    loadCart();
    
    // Checkout button
    document.getElementById('checkout-btn')?.addEventListener('click', function() {
        // For demo purposes, redirect to booking page
        // In production, this would go to a proper checkout flow
        window.location.href = 'booking.php';
    });
});

function loadCart() {
    const cart = JSON.parse(localStorage.getItem('pwanisafaris_cart') || '[]');
    const emptyCart = document.getElementById('empty-cart');
    const cartItems = document.getElementById('cart-items');
    const orderSummary = document.getElementById('order-summary');
    
    if (cart.length === 0) {
        emptyCart.classList.remove('hidden');
        cartItems.classList.add('hidden');
        orderSummary.classList.add('hidden');
        return;
    }
    
    emptyCart.classList.add('hidden');
    cartItems.classList.remove('hidden');
    orderSummary.classList.remove('hidden');
    
    renderCartItems(cart);
    updateOrderSummary(cart);
}

function renderCartItems(cart) {
    const container = document.getElementById('cart-items');
    container.innerHTML = '';
    
    cart.forEach(item => {
        const cartItemHtml = `
            <div class="cart-item bg-white rounded-xl shadow-md p-6" data-id="${item.id}">
                <div class="flex flex-col md:flex-row gap-4">
                    <!-- Product Image -->
                    <div class="w-full md:w-32 h-32 flex-shrink-0">
                        <img src="${item.image}" alt="${item.title}" 
                             class="w-full h-full object-cover rounded-lg"
                             onerror="this.src='assets/img/products/placeholder.jpg'">
                    </div>
                    
                    <!-- Product Details -->
                    <div class="flex-1">
                        <div class="flex flex-col md:flex-row md:items-start justify-between">
                            <div class="flex-1 mb-4 md:mb-0">
                                <h3 class="text-lg font-semibold text-charcoal mb-1 font-sans">${item.title}</h3>
                                <p class="text-sm text-gray-500 mb-2">${item.category} • SKU: ${item.sku}</p>
                                <p class="text-lg font-bold text-cta">KSh ${item.price.toLocaleString()}</p>
                            </div>
                            
                            <!-- Quantity and Remove -->
                            <div class="flex items-center space-x-4">
                                <!-- Quantity Controls -->
                                <div class="flex items-center border border-gray-300 rounded-lg">
                                    <button onclick="updateQuantity('${item.id}', ${item.quantity - 1})" 
                                            class="px-3 py-2 hover:bg-gray-100 transition-colors ${item.quantity <= 1 ? 'opacity-50 cursor-not-allowed' : ''}"
                                            ${item.quantity <= 1 ? 'disabled' : ''}>-</button>
                                    <input type="number" value="${item.quantity}" min="1" 
                                           class="quantity-input w-16 px-3 py-2 text-center border-0 focus:ring-0"
                                           onchange="updateQuantity('${item.id}', this.value)">
                                    <button onclick="updateQuantity('${item.id}', ${item.quantity + 1})" 
                                            class="px-3 py-2 hover:bg-gray-100 transition-colors">+</button>
                                </div>
                                
                                <!-- Remove Button -->
                                <button onclick="removeFromCart('${item.id}')" 
                                        class="p-2 text-gray-400 hover:text-altcta transition-colors"
                                        title="Remove item">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', cartItemHtml);
    });
}

function updateQuantity(productId, newQuantity) {
    newQuantity = parseInt(newQuantity);
    if (newQuantity < 1) return;
    
    let cart = JSON.parse(localStorage.getItem('pwanisafaris_cart') || '[]');
    const itemIndex = cart.findIndex(item => item.id === productId);
    
    if (itemIndex > -1) {
        cart[itemIndex].quantity = newQuantity;
        localStorage.setItem('pwanisafaris_cart', JSON.stringify(cart));
        loadCart();
        updateCartCount();
        showToast('Cart updated successfully!');
    }
}

function removeFromCart(productId) {
    let cart = JSON.parse(localStorage.getItem('pwanisafaris_cart') || '[]');
    const itemIndex = cart.findIndex(item => item.id === productId);
    
    if (itemIndex > -1) {
        const item = cart[itemIndex];
        
        // Add removing animation
        const cartItemElement = document.querySelector(`[data-id="${productId}"]`);
        if (cartItemElement) {
            cartItemElement.classList.add('removing');
            
            setTimeout(() => {
                cart.splice(itemIndex, 1);
                localStorage.setItem('pwanisafaris_cart', JSON.stringify(cart));
                loadCart();
                updateCartCount();
                showToast(`${item.title} removed from cart`);
            }, 300);
        }
    }
}

function updateOrderSummary(cart) {
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    const shipping = 0; // Free shipping
    const total = subtotal + shipping;
    
    document.getElementById('total-items').textContent = totalItems;
    document.getElementById('subtotal').textContent = `KSh ${subtotal.toLocaleString()}`;
    document.getElementById('total').textContent = `KSh ${total.toLocaleString()}`;
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
</script>

<?php include('components/footer.php'); ?>

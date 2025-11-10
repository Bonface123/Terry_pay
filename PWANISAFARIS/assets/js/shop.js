/**
 * Pwani Safaris Shop JavaScript
 * Handles search, filtering, sorting, cart functionality, and quick view modal
 * NOTE: Replace localStorage cart with backend API calls when ready
 */

document.addEventListener('DOMContentLoaded', function() {
    initializeShop();
});

function initializeShop() {
    initializeSearch();
    initializeFilters();
    initializeSorting();
    initializeCart();
    initializeQuickView();
    initializeViewToggle();
    updateCartCount();
}

// ============================================================================
// SEARCH FUNCTIONALITY
// ============================================================================

let searchTimeout;
const SEARCH_DEBOUNCE_DELAY = 250;

function initializeSearch() {
    const searchInput = document.getElementById('product-search');
    
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                performSearch(e.target.value.toLowerCase().trim());
            }, SEARCH_DEBOUNCE_DELAY);
        });
    }
}

function performSearch(query) {
    const productCards = document.querySelectorAll('.product-card');
    let visibleCount = 0;
    
    productCards.forEach(card => {
        const title = card.querySelector('h3').textContent.toLowerCase();
        const description = card.querySelector('p').textContent.toLowerCase();
        const tags = card.dataset.tags.toLowerCase();
        const category = card.dataset.category.toLowerCase();
        
        const matches = !query || 
            title.includes(query) || 
            description.includes(query) || 
            tags.includes(query) || 
            category.includes(query);
        
        if (matches) {
            card.style.display = 'block';
            card.style.animation = 'fadeIn 0.3s ease-in';
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });
    
    updateResultsCount(visibleCount);
    toggleEmptyState(visibleCount === 0);
}

// ============================================================================
// FILTER FUNCTIONALITY
// ============================================================================

function initializeFilters() {
    // Category filters
    const categoryFilters = document.querySelectorAll('.category-filter');
    categoryFilters.forEach(filter => {
        filter.addEventListener('click', function() {
            handleCategoryFilter(this);
        });
    });
    
    // Price range filters
    const minPriceInput = document.getElementById('min-price');
    const maxPriceInput = document.getElementById('max-price');
    
    if (minPriceInput && maxPriceInput) {
        minPriceInput.addEventListener('input', debounce(applyFilters, 300));
        maxPriceInput.addEventListener('input', debounce(applyFilters, 300));
    }
    
    // Tag filters
    const tagFilters = document.querySelectorAll('.tag-filter');
    tagFilters.forEach(filter => {
        filter.addEventListener('change', applyFilters);
    });
    
    // Rating filters
    const ratingFilters = document.querySelectorAll('.rating-filter');
    ratingFilters.forEach(filter => {
        filter.addEventListener('change', applyFilters);
    });
    
    // Clear filters
    const clearFiltersBtn = document.getElementById('clear-filters');
    if (clearFiltersBtn) {
        clearFiltersBtn.addEventListener('click', clearAllFilters);
    }
}

function handleCategoryFilter(filterBtn) {
    const category = filterBtn.dataset.category;
    
    // Update active state
    document.querySelectorAll('.category-filter').forEach(btn => {
        btn.classList.remove('bg-primary', 'text-white');
        btn.classList.add('bg-white', 'text-primary', 'border', 'border-primary');
    });
    
    filterBtn.classList.remove('bg-white', 'text-primary', 'border', 'border-primary');
    filterBtn.classList.add('bg-primary', 'text-white');
    
    // Apply category filter
    filterByCategory(category);
}

function filterByCategory(category) {
    const productCards = document.querySelectorAll('.product-card');
    let visibleCount = 0;
    
    productCards.forEach(card => {
        const cardCategory = card.dataset.category;
        const matches = category === 'all' || cardCategory === category;
        
        if (matches) {
            card.style.display = 'block';
            card.style.animation = 'fadeIn 0.3s ease-in';
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });
    
    updateResultsCount(visibleCount);
    toggleEmptyState(visibleCount === 0);
}

function applyFilters() {
    const minPrice = parseFloat(document.getElementById('min-price')?.value) || 0;
    const maxPrice = parseFloat(document.getElementById('max-price')?.value) || Infinity;
    
    const selectedTags = Array.from(document.querySelectorAll('.tag-filter:checked'))
        .map(cb => cb.value);
    
    const selectedRating = document.querySelector('.rating-filter:checked')?.value;
    
    const productCards = document.querySelectorAll('.product-card');
    let visibleCount = 0;
    
    productCards.forEach(card => {
        const price = parseFloat(card.dataset.price);
        const rating = parseFloat(card.dataset.rating);
        const cardTags = card.dataset.tags.split(',');
        
        // Check price range
        const priceMatch = price >= minPrice && price <= maxPrice;
        
        // Check tags (if any selected, card must have at least one)
        const tagMatch = selectedTags.length === 0 || 
            selectedTags.some(tag => cardTags.includes(tag));
        
        // Check rating
        const ratingMatch = !selectedRating || rating >= parseFloat(selectedRating);
        
        if (priceMatch && tagMatch && ratingMatch) {
            card.style.display = 'block';
            card.style.animation = 'fadeIn 0.3s ease-in';
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });
    
    updateResultsCount(visibleCount);
    toggleEmptyState(visibleCount === 0);
}

function clearAllFilters() {
    // Reset category to "All"
    document.querySelector('.category-filter[data-category="all"]')?.click();
    
    // Clear price inputs
    document.getElementById('min-price').value = '';
    document.getElementById('max-price').value = '';
    
    // Uncheck all tag filters
    document.querySelectorAll('.tag-filter').forEach(cb => cb.checked = false);
    
    // Uncheck rating filters
    document.querySelectorAll('.rating-filter').forEach(radio => radio.checked = false);
    
    // Clear search
    document.getElementById('product-search').value = '';
    
    // Show all products
    filterByCategory('all');
}

// ============================================================================
// SORTING FUNCTIONALITY
// ============================================================================

function initializeSorting() {
    const sortSelect = document.getElementById('sort-select');
    
    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            sortProducts(this.value);
        });
    }
}

function sortProducts(sortBy) {
    const productGrid = document.getElementById('product-grid');
    const productCards = Array.from(productGrid.querySelectorAll('.product-card:not([style*="display: none"])'));
    
    productCards.sort((a, b) => {
        switch (sortBy) {
            case 'price-asc':
                return parseFloat(a.dataset.price) - parseFloat(b.dataset.price);
            case 'price-desc':
                return parseFloat(b.dataset.price) - parseFloat(a.dataset.price);
            case 'rating':
                return parseFloat(b.dataset.rating) - parseFloat(a.dataset.rating);
            case 'newest':
                return parseInt(b.dataset.id) - parseInt(a.dataset.id);
            case 'popular':
            default:
                return parseFloat(b.dataset.rating) - parseFloat(a.dataset.rating);
        }
    });
    
    // Re-append sorted cards
    productCards.forEach(card => {
        productGrid.appendChild(card);
    });
}

// ============================================================================
// CART FUNCTIONALITY
// ============================================================================

function initializeCart() {
    // Add to cart buttons
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('add-to-cart') || e.target.closest('.add-to-cart')) {
            const button = e.target.classList.contains('add-to-cart') ? e.target : e.target.closest('.add-to-cart');
            const productId = button.dataset.productId;
            const quantity = document.getElementById('modal-quantity')?.value || 1;
            
            addToCart(productId, parseInt(quantity));
        }
    });
}

function addToCart(productId, quantity = 1) {
    // Get product data from card
    const productCard = document.querySelector(`[data-id="${productId}"]`);
    if (!productCard) return;
    
    const product = {
        id: productId,
        sku: productCard.dataset.sku,
        title: productCard.querySelector('h3').textContent,
        price: parseFloat(productCard.dataset.price),
        category: productCard.dataset.category,
        image: productCard.querySelector('img').src,
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
    
    // Close modal if open
    closeQuickViewModal();
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

// ============================================================================
// QUICK VIEW MODAL
// ============================================================================

function initializeQuickView() {
    // Quick view buttons
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('quick-view') || e.target.closest('.quick-view')) {
            const button = e.target.classList.contains('quick-view') ? e.target : e.target.closest('.quick-view');
            const productId = button.dataset.productId;
            openQuickViewModal(productId);
        }
    });
    
    // Modal close events
    const modal = document.getElementById('quick-view-modal');
    const closeBtn = document.getElementById('close-modal');
    
    if (closeBtn) {
        closeBtn.addEventListener('click', closeQuickViewModal);
    }
    
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeQuickViewModal();
            }
        });
    }
    
    // Quantity controls
    const qtyMinus = document.getElementById('qty-minus');
    const qtyPlus = document.getElementById('qty-plus');
    const qtyInput = document.getElementById('modal-quantity');
    
    if (qtyMinus && qtyPlus && qtyInput) {
        qtyMinus.addEventListener('click', () => {
            const current = parseInt(qtyInput.value);
            if (current > 1) {
                qtyInput.value = current - 1;
            }
        });
        
        qtyPlus.addEventListener('click', () => {
            const current = parseInt(qtyInput.value);
            qtyInput.value = current + 1;
        });
    }
    
    // Keyboard events
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeQuickViewModal();
        }
    });
}

function openQuickViewModal(productId) {
    const productCard = document.querySelector(`[data-id="${productId}"]`);
    if (!productCard) return;
    
    const modal = document.getElementById('quick-view-modal');
    if (!modal) return;
    
    // Populate modal with product data
    const title = productCard.querySelector('h3').textContent;
    const description = productCard.querySelector('p').textContent;
    const price = productCard.dataset.price;
    const currency = 'KSh';
    const category = productCard.dataset.category;
    const rating = parseFloat(productCard.dataset.rating);
    const stock = parseInt(productCard.dataset.stock);
    const image = productCard.querySelector('img').src;
    
    // Update modal content
    document.getElementById('modal-title').textContent = title;
    document.getElementById('modal-description').textContent = description;
    document.getElementById('modal-price').textContent = `${currency} ${parseInt(price).toLocaleString()}`;
    document.getElementById('modal-category').textContent = category;
    document.getElementById('modal-image').src = image;
    document.getElementById('modal-image').alt = title;
    
    // Update rating stars
    const ratingContainer = document.getElementById('modal-rating');
    ratingContainer.innerHTML = generateStarRating(rating);
    
    // Update stock status
    const stockContainer = document.getElementById('modal-stock');
    if (stock > 0) {
        stockContainer.innerHTML = `<span class="text-accent">✓ In Stock (${stock} available)</span>`;
        document.getElementById('modal-add-to-cart').disabled = false;
        document.getElementById('modal-add-to-cart').classList.remove('opacity-50', 'cursor-not-allowed');
    } else {
        stockContainer.innerHTML = `<span class="text-altcta">✗ Out of Stock</span>`;
        document.getElementById('modal-add-to-cart').disabled = true;
        document.getElementById('modal-add-to-cart').classList.add('opacity-50', 'cursor-not-allowed');
    }
    
    // Update view details link
    document.getElementById('modal-view-details').href = `product-details.php?id=${productId}`;
    
    // Update add to cart button
    document.getElementById('modal-add-to-cart').dataset.productId = productId;
    
    // Reset quantity
    document.getElementById('modal-quantity').value = 1;
    
    // Show modal
    modal.classList.remove('hidden');
    modal.classList.add('flex', 'show');
    document.body.style.overflow = 'hidden';
    
    // Focus trap
    const focusableElements = modal.querySelectorAll('button, input, a');
    if (focusableElements.length > 0) {
        focusableElements[0].focus();
    }
}

function closeQuickViewModal() {
    const modal = document.getElementById('quick-view-modal');
    if (modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex', 'show');
        document.body.style.overflow = '';
    }
}

function generateStarRating(rating) {
    const fullStars = Math.floor(rating);
    const hasHalfStar = (rating - fullStars) >= 0.5;
    let starsHtml = '';
    
    // Full stars
    for (let i = 0; i < fullStars; i++) {
        starsHtml += '<span class="text-yellow-400">★</span>';
    }
    
    // Half star
    if (hasHalfStar) {
        starsHtml += '<span class="text-yellow-400">☆</span>';
    }
    
    // Empty stars
    for (let i = fullStars + (hasHalfStar ? 1 : 0); i < 5; i++) {
        starsHtml += '<span class="text-gray-300">★</span>';
    }
    
    starsHtml += `<span class="text-xs text-gray-500 ml-1">(${rating})</span>`;
    
    return starsHtml;
}

// ============================================================================
// VIEW TOGGLE FUNCTIONALITY
// ============================================================================

function initializeViewToggle() {
    const gridViewBtn = document.getElementById('grid-view');
    const listViewBtn = document.getElementById('list-view');
    
    if (gridViewBtn && listViewBtn) {
        gridViewBtn.addEventListener('click', () => setView('grid'));
        listViewBtn.addEventListener('click', () => setView('list'));
    }
}

function setView(viewType) {
    const gridViewBtn = document.getElementById('grid-view');
    const listViewBtn = document.getElementById('list-view');
    const productGrid = document.getElementById('product-grid');
    
    if (viewType === 'grid') {
        gridViewBtn.classList.add('bg-primary', 'text-white');
        gridViewBtn.classList.remove('bg-white', 'text-gray-600');
        listViewBtn.classList.remove('bg-primary', 'text-white');
        listViewBtn.classList.add('bg-white', 'text-gray-600');
        
        productGrid.className = 'grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6';
    } else {
        listViewBtn.classList.add('bg-primary', 'text-white');
        listViewBtn.classList.remove('bg-white', 'text-gray-600');
        gridViewBtn.classList.remove('bg-primary', 'text-white');
        gridViewBtn.classList.add('bg-white', 'text-gray-600');
        
        productGrid.className = 'space-y-6';
        
        // Convert cards to list view (simplified for demo)
        const cards = productGrid.querySelectorAll('.product-card');
        cards.forEach(card => {
            card.classList.add('flex', 'flex-row');
            const img = card.querySelector('img').parentElement;
            img.classList.add('w-48', 'flex-shrink-0');
        });
    }
}

// ============================================================================
// UTILITY FUNCTIONS
// ============================================================================

function updateResultsCount(count) {
    const resultsCountElement = document.getElementById('results-count');
    if (resultsCountElement) {
        resultsCountElement.textContent = count;
    }
}

function toggleEmptyState(show) {
    const emptyState = document.getElementById('empty-state');
    const productGrid = document.getElementById('product-grid');
    
    if (emptyState && productGrid) {
        if (show) {
            emptyState.classList.remove('hidden');
            productGrid.classList.add('hidden');
        } else {
            emptyState.classList.add('hidden');
            productGrid.classList.remove('hidden');
        }
    }
}

function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// ============================================================================
// CSS ANIMATIONS
// ============================================================================

// Add fadeIn animation
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
`;
document.head.appendChild(style);
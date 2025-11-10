<?php
/**
 * Reusable Tour Card Component for Pwani Safaris
 * 
 * Usage: include this file and pass tour data as variables
 * Required variables:
 * - $tour_image: Image path
 * - $tour_title: Tour title
 * - $tour_description: Short description
 * - $tour_duration: Duration text (e.g., "2 Days / 1 Night")
 * - $tour_price: Price text (e.g., "From KSh 15,000")
 * - $tour_category: Category for filtering (cultural, coastal, custom)
 * - $tour_link: Link to tour details page
 * - $tour_category_label: Display label for category badge
 */

// Set default values if not provided
$tour_image = $tour_image ?? 'assets/img/tours/default.jpg';
$tour_title = $tour_title ?? 'Tour Title';
$tour_description = $tour_description ?? 'Tour description goes here.';
$tour_duration = $tour_duration ?? '1 Day';
$tour_price = $tour_price ?? 'Contact for Price';
$tour_category = $tour_category ?? 'cultural';
$tour_link = $tour_link ?? 'tour-details.php';
$tour_category_label = $tour_category_label ?? 'Cultural';

// Set category badge colors
$badge_classes = [
    'cultural' => 'bg-accent text-white',
    'coastal' => 'bg-cta text-white',
    'custom' => 'bg-altcta text-white'
];

$badge_class = $badge_classes[$tour_category] ?? 'bg-accent text-white';
?>

<div class="tour-card bg-white shadow-lg rounded-xl overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2" data-category="<?php echo htmlspecialchars($tour_category); ?>">
    <div class="relative">
        <img src="<?php echo htmlspecialchars($tour_image); ?>" class="w-full aspect-[4/3] object-cover" alt="<?php echo htmlspecialchars($tour_title); ?>">
        <div class="absolute top-4 left-4">
            <span class="<?php echo $badge_class; ?> px-3 py-1 rounded-full text-sm font-semibold">
                <?php echo htmlspecialchars($tour_category_label); ?>
            </span>
        </div>
    </div>
    <div class="p-5">
        <h3 class="text-xl font-semibold mb-2 text-primary font-sans">
            <?php echo htmlspecialchars($tour_title); ?>
        </h3>
        <p class="text-gray-600 mb-3 font-body">
            <?php echo htmlspecialchars($tour_description); ?>
        </p>
        <div class="flex items-center justify-between text-sm text-gray-500 mb-4 font-body">
            <span><?php echo htmlspecialchars($tour_duration); ?></span>
            <span class="font-semibold text-cta"><?php echo htmlspecialchars($tour_price); ?></span>
        </div>
        <a href="<?php echo htmlspecialchars($tour_link); ?>" class="inline-block px-5 py-2 bg-primary text-white rounded-full hover:bg-accent transition-all duration-300 font-semibold font-sans">
            View Details
        </a>
    </div>
</div>
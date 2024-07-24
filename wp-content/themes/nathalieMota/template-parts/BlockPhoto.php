<div class="photosPostsContainer" id="photosPostsContainer">

<?php 
$photosPosts = get_custom_posts_with_images();
if (!empty($photosPosts)) {
    foreach ($photosPosts as $post):
        // Fetch the reference field from ACF
        $reference = get_field('reference', $post['ID']);
?>

    <!-- implode(', ', $post['categorie'])
     takes the array of term names and joins them into a single string, with each term separated by a comma and a space.
     For example, if $post['categorie'] is ['Nature', 'Wildlife'],
     implode(', ', $post['categorie']) will produce the string "Nature, Wildlife". -->
    <div class="postItem" data-category="<?= esc_attr(implode(', ', $post['categorie'])); ?>" data-format="<?= esc_attr(implode(', ', $post['format'])); ?>" data-year="<?= esc_attr($post['year']); ?>">
            <div class="informationsHoverPhoto">
                <h4><?= esc_html($reference); ?></h4>
                <h4><?= esc_html(implode(', ', $post['categorie'])); ?></h4>
            </div>
            <div class="iconEye" onclick="window.open('<?= esc_url(get_permalink($post['ID'])); ?>', '_blank')"></div>
            <div class="expandPhotoIcon"></div>
            <img src="<?= esc_url($post['image']); ?>" alt="<?= esc_attr($post['alt_text']); ?>">
        </div>
    <?php endforeach; 
    } else {
        echo 'Pas de photos trouvées';
    }
    ?>
    
</div>
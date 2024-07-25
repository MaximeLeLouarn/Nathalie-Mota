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
    <div class="postItem" data-category="<?= esc_attr(implode(', ', $post['categorie'])); ?>
    " data-format="<?= esc_attr(implode(', ', $post['format'])); ?>" data-year="<?= esc_attr($post['year']); ?>">
            <div class="informationsHoverPhoto">
                <h4 class="refPhotoLightbox"><?= esc_html($reference); ?></h4>
                <h4 class="catPhotoLightbox"><?= esc_html(implode(', ', $post['categorie'])); ?></h4>
            </div>
            <div class="iconEye" onclick="window.open('<?= esc_url(get_permalink($post['ID'])); ?>', '_blank')"></div>
            <div class="expandPhotoIcon"></div>
            <img class="imgPostItem" src="<?= esc_url($post['image']); ?>" alt="<?= esc_attr($post['alt_text']); ?>">
        </div>
    <?php endforeach; 
    } else {
        echo 'Pas de photos trouvées';
    }
    ?>
    
</div>

<!-- Structure for the modal lightbox -->
<div id="photoModal" class="photoModal">
    <span class="closePhotoModal">&times;</span>
    <img class="modalPhotoContent" id="expandedImg">
    <div class="modalPhotoCaption" id="modalPhotoCaption"></div>
    <div class="navigationLightbox">
        <div class="arrowLight leftLight" id="prevPostLightbox">&#9664; Previous Post</div>
        <div class="arrowLight rightLight" id="nextPostLightbox">Next Post &#9654;</div>
    </div>
</div>
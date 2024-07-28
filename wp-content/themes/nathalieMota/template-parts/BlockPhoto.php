<div class="photosPostsContainer" id="photosPostsContainer">
    <p>test</p>
    <?php
        // Get all the needed informations for different circumpstances
    $currentPostId = get_the_ID();
    $currentPostTitle = get_the_title();
    $currentPostImage = get_the_post_thumbnail_url();
    $currentPostAltText = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
    $currentPostReference= get_field('reference');
    $currentPostCat = get_term_ids($currentPostId, 'categorie');
    $currentPostFor = get_term_ids($currentPostId, 'format');
    $currentPostYear = get_the_date('Y');

    // Backup solution for the categories
    // wp_get_post_terms(get_the_ID(), 'categorie', array('fields' => 'names'));
    // wp_get_post_terms(get_the_ID(), 'format', array('fields' => 'names'));
    ?>

<?php 
// if (!empty($photosPosts)) {
//     foreach ($photosPosts as $post):
//         // Fetch the reference field from ACF
//         $reference = get_field('reference', $post['ID']);

   ?>
<!-- 
    implode(', ', $post['categorie'])
     takes the array of term names and joins them into a single string, with each term separated by a comma and a space.
     For example, if $post['categorie'] is ['Nature', 'Wildlife'],
     implode(', ', $post['categorie']) will produce the string "Nature, Wildlife". -->
     <!-- LINES PROBLEM 31 32 35 (+1 now), CONVERSION ARRAY TO STRING -->
    <div class="postItem" data-categorie="<?= $currentPostCat; ?>
    " data-format="<?= $currentPostFor; ?>" data-year="<?= esc_attr($currentPostYear); ?>">
            <div class="informationsHoverPhoto">
                <h4 class="refPhotoLightbox"><?= esc_html($currentPostReference); ?></h4>
                <h4 class="catPhotoLightbox"><?= $currentPostCat; ?></h4>
            </div>
            <div class="iconEye" onclick="window.open('<?= esc_url($currentPostId); ?>', '_blank')"></div>
            <div class="expandPhotoIcon"></div>
            <img class="imgPostItem" src="<?= $currentPostImage; ?>" alt="<?= $currentPostAltText; ?>">
        </div>
    <?php 
    // endforeach;
    // } else {
    //     echo 'Pas de photos trouvées';
    // }
    // ?>
    
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
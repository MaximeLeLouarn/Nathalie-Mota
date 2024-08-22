<div class="photosPostsContainer" id="photosPostsContainer">
    <?php
        // Get all the needed informations for different circumpstances
    $currentPostId = get_the_ID();
    $currentPostTitle = get_the_title();
    $currentPostImage = get_the_post_thumbnail_url(get_the_ID(), 'full');
    $currentPostAltText = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
    $currentPostReference= get_field('reference');
    $currentPostYear = get_the_date('Y');
    $currentPostURL = get_permalink();
    // For the taxonomies it's a bit more specific. So first we go get the terms name
    $currentPostC = wp_get_post_terms($currentPostId, 'categorie');
    $currentPostF = wp_get_post_terms($currentPostId, 'format');
    // We need then to put them into array
    $currentPostCatSlugs = array();
    $currentPostForSlugs = array();
    // And retrieve the slugs from the arrays
    if (!is_wp_error($currentPostC)) {
        foreach ($currentPostC as $term) {
            $currentPostCatSlugs[] = $term->slug;
        }
    }
    
    if (!is_wp_error($currentPostF)) {
        foreach ($currentPostF as $term) {
            $currentPostForSlugs[] = $term->slug;
        }
    }
    
    // var_dump($currentPostCatSlugs);
    // var_dump($currentPostForSlugs);
    
    // For then breaking the array into string -explanations of implode function bellow-.
    $currentPostCat = implode(',', $currentPostCatSlugs);
    $currentPostFor = implode(',', $currentPostForSlugs);

    ?>

<!-- 
    implode(', ', $post['categorie'])
     takes the array of term names and joins them into a single string, with each term separated by a comma and a space.
     For example, if $post['categorie'] is ['Nature', 'Wildlife'],
     implode(', ', $post['categorie']) will produce the string "Nature, Wildlife". -->
    <div class="postItem" data-categorie="<?= $currentPostCat; ?>" data-format="<?= $currentPostFor; ?>" data-year="<?= esc_attr($currentPostYear); ?>" data-url="<?= esc_url($currentPostURL); ?>" >
            <div class="informationsHoverPhoto">
                <h4 class="refPhotoLightbox"><?= esc_html($currentPostReference); ?></h4>
                <h4 class="catPhotoLightbox"><?= $currentPostCat; ?></h4>
            </div>
            <div class="iconEye" onclick="window.open('<?= esc_url( $currentPostURL); ?>', '_blank')"></div>
            <div class="expandPhotoIcon"></div>
            <img class="imgPostItem" src="<?= esc_url($currentPostImage); ?>" alt="<?= esc_attr($currentPostAltText) ?>">
        </div>
    
        <!-- Structure for the modal lightbox -->
        <div id="photoModal" class="photoModal">
            <span class="closePhotoModal">&times;</span>
            <div class="photoModalCenter">
                <div class="imgContentContainer">
                <img class="modalPhotoContent" id="expandedImg">
                <div class="modalPhotoCaption" id="modalPhotoCaption"></div>
            </div>
        </div>
            <div class="navigationLightbox">
                <div class="arrowLight leftLight" id="prevPostLightbox">&#9664; Précédante</div>
                <div class="arrowLight rightLight" id="nextPostLightbox">Suivante &#9654;</div>
            </div>
        </div>
</div>

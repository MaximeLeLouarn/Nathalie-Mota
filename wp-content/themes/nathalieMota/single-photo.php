<?php

get_header();
?>

<main id="primary" class="site-main">

<div class="desktop100vh">
        
    <section class="firstContainerPhoto">
        <div class="photoPost">
            <div class="imgPhoto">
                <?php if ( has_post_thumbnail() ) : 
                    $thumbnail_id = get_post_thumbnail_id();
                    $thumbnail_url = wp_get_attachment_image_src( $thumbnail_id, 'full' )[0];
                    $thumbnail_alt = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
                ?>
                 <img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php echo esc_attr($thumbnail_alt); ?>" />
                 <?php endif; ?>
            </div>
            <div class="photoInformations">
                <h2><?php single_post_title(); ?></h2>
                <p>Référence : <?= get_field('reference'); ?></p>
                <p>Catégorie : <?php $termsC = get_the_terms(get_the_ID(), 'categorie');
                if($termsC && !is_wp_error($termsC)) {
                    foreach($termsC as $terms) {
                        $termsCName = $terms->name;
                    }
                }
                echo $termsCName;
                // var_dump($termsC);
                    ?>
                </p>
                <p>FORMAT : <?php $termsF = get_the_terms(get_the_ID(), 'format');
                if($termsF && !is_wp_error($termsF)) {
                    foreach($termsF as $terms) {
                        $termsFName = $terms->name;
                    }
                }
                echo $termsFName;
                // var_dump($termsF);
                    ?></p>
                <p>Type : <?= get_field('type'); ?></p>
                <p>ANNÉE : <?= the_time('Y'); ?></p>
            </div>
        </div>
    </section>
    
    <section class="phoneBorders">
        <div class="contactContent">
            <div class="pContactButton">
                 <p>Cette photo vous intéresse ?</p>
                 <button class="postContactBtn" data-ref="<?= get_field('reference')?>">Contact</button>
            </div>
            <div class="desktopPhotoNav">
                <div class="closeArticles">

                    <div class="thumbnailNextArticle">
                        <?php $next_thumbnail_id = get_next_post_thumbnail_id();
                        if ($next_thumbnail_id && has_post_thumbnail()) {
                            $thumbnail_url = wp_get_attachment_image_src( $next_thumbnail_id, 'thumbnail' )[0];
                            $thumbnail_alt = get_post_meta( $next_thumbnail_id, '_wp_attachment_image_alt', true );
                        } else {
                            $previous_thumbnail_id = get_previous_post_thumbnail_id();
                            if ($previous_thumbnail_id && has_post_thumbnail()) {
                                    $thumbnail_url = wp_get_attachment_image_src( $previous_thumbnail_id, 'thumbnail' )[0];
                                    $thumbnail_alt = get_post_meta( $previous_thumbnail_id, '_wp_attachment_image_alt', true );
                            } 
                         }
                        ?>
                       <img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php echo esc_attr($thumbnail_alt); ?>" />

                    </div>

                    <?php
                    while ( have_posts() ) :
                        the_post();
            
                        the_post_navigation(
                            array(
                                'prev_text' => '<span class="nav-subtitle">' . esc_html__( '', 'nathaliemota' ) . '</span> <span class="nav-title">&#8592;</span>',
                                'next_text' => '<span class="nav-subtitle">' . esc_html__( '', 'nathaliemota' ) . '</span> <span class="nav-title">&#8594;</span>',
                            )
                        );
            
                    endwhile;
                    ?>
                
                </div>
            </div>
        </div>
    </section>
</div>

    <section class="otherPhotos">
        <div class="otherPhotosContainer">

            <h3>VOUS AIMEREZ AUSSI</h3>

            <div class="otherImgsBox">
                
            <?php
            // Get the current post ID
            $currentPostId = get_the_ID();
            // Get the categories of the current post
            $termsC = get_the_terms($currentPostId, 'categorie');
            $termsCIds = array();
            if($termsC && !is_wp_error($termsC)) {
                foreach($termsC as $terms) {
                    $termsCIds[] = $terms->term_id;
                }
            }
            // Query to get a post from the same category but not the current post
            $argsC2P = array(
                'post_type' => 'photo', // Replace with your custom post type
                'tax_query' => array(
                    array(
                        'taxonomy' => 'categorie',
                        'field' => 'term_id',
                        'terms' => $termsCIds,
                    ),
                ),
                'post__not_in' => array($currentPostId),
                'posts_per_page' => 1,
                'orderby' => 'rand',
                // 'order' => 'variable qui prend ASC ou DESC'
            );

            $queryCategoriesPhotos = new WP_Query($argsC2P);

            if ($queryCategoriesPhotos->have_posts()) {
                while ($queryCategoriesPhotos->have_posts()) {
                    $queryCategoriesPhotos->the_post();
            
                    // Get the thumbnail URL of the post from the same category
                    $thumbnailRCUrl = get_the_post_thumbnail_url(get_the_ID(), 'full');
                    ?>
                    <img class="otherImage1" src="<?= esc_url($thumbnailRCUrl) ?>" alt="<?= esc_attr(get_the_title()) ?>">
                    <?php
                    $firstPostId = get_the_ID();
                }
                // Reset post data
                wp_reset_postdata();
                
            } else {
                // Debug output: No terms found
                echo 'Plus de posts à venir';
            }
            ?>
            <!-- With the same method, get the second image, just adding the exclusion of the first image to not have it repeated -->
            <?php
             $argsC2P2 = array(
            'post_type' => 'photo', // Replace with your actual custom post type
            'tax_query' => array(
                array(
                    'taxonomy' => 'categorie',
                    'field' => 'term_id',
                    'terms' => $termsCIds,
                ),
            ),
            'post__not_in' => array($currentPostId, $firstPostId),
            'posts_per_page' => 1,
            'orderby' => 'rand'
        );

        $queryCategoriesPhotos2 = new WP_Query($argsC2P2);

        if ($queryCategoriesPhotos2->have_posts()) {
            while ($queryCategoriesPhotos2->have_posts()) {
                $queryCategoriesPhotos2->the_post();

                // Get the thumbnail URL of the post from the same category
                $thumbnailRCUrl2 = get_the_post_thumbnail_url(get_the_ID(), 'full');
                ?>
                <img class="otherImage2" src="<?= esc_url($thumbnailRCUrl2) ?>" alt="<?= esc_attr(get_the_title()) ?>">
                <?php
            }
            // Reset post data for the second query
            wp_reset_postdata();
        } else {
            // Debug output: No second post found
            echo 'Plus de posts à venir';
        }
        ?>
            </div>

        </div>
    </section>

	

</main>

<?php
get_sidebar();
get_footer();

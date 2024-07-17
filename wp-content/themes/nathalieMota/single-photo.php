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
                            $thumbnail_url = wp_get_attachment_image_src( $next_thumbnail_id, 'full' )[0];
                            $thumbnail_alt = get_post_meta( $next_thumbnail_id, '_wp_attachment_image_alt', true );
                        } else {
                            $previous_thumbnail_id = get_previous_post_thumbnail_id();
                            if ($previous_thumbnail_id && has_post_thumbnail()) {
                                    $thumbnail_url = wp_get_attachment_image_src( $previous_thumbnail_id, 'full' )[0];
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
                
                <img class="otherImage1" src="" alt="">
                <img class="otherImage2" src="" alt="">
            </div>

        </div>
    </section>

	

</main>

<?php
get_sidebar();
get_footer();

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
                <p>Référence : <?= $refPhoto = get_field('reference'); ?></p>
                <p>Catégorie : MARIAGE</p>
                <p>FORMAT : PORTRAIT</p>
                <p>Type : <?= $typeACF = get_field('type'); ?></p>
                <p>ANNÉE : 2022</p>
            </div>
        </div>
    </section>
    
    <section class="phoneBorders">
        <div class="contactContent">
            <div class="pContactButton">
                 <p>Cette photo vous intéresse ?</p>
                 <button data-ref="<?= get_field('reference')?>">Contact</button>
            </div>
            <div class="desktopPhotoNav">
                <?php
                while ( have_posts() ) :
                    the_post();
        
                    the_post_navigation(
                        array(
                            'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'nathaliemota' ) . '</span> <span class="nav-title">%title</span>',
                            'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'nathaliemota' ) . '</span> <span class="nav-title">%title</span>',
                        )
                    );
        
                endwhile;
                ?>
            </div>
        </div>
    </section>
</div>

    <section class="otherPhotos">
        <h3>VOUS AIMEREZ AUSSI</h3>
        <div class="otherImgsBox">
            <img class="otherImage1" src="" alt="">
            <img class="otherImage2" src="" alt="">
        </div>
    </section>

	

</main>

<?php
get_sidebar();
get_footer();

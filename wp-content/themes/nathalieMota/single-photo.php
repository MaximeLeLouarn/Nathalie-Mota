<?php

get_header();
?>

<main id="primary" class="site-main">

<div class="desktop100vh">
        
    <section class="firstContainerPhoto">
        <div class="photoPost">
            <div class="imgPhoto">
                <img src="<?= get_template_directory_uri() . '/assets/nathalie-15.jpeg' ?>" alt="photo test">
            </div>
            <div class="photoInformations">
                <h2>TEAM MARIEE</h2>
                <p>Référence : bf2400</p>
                <p>Catégorie : MARIAGE</p>
                <p>FORMAT : PORTRAIT</p>
                <p>Type : NUMérique</p>
                <p>ANNÉE : 2022</p>
            </div>
        </div>
    </section>
    
    <section class="phoneBorders">
        <div class="contactContent">
            <div class="pContactButton">
                 <p>Cette photo vous intéresse ?</p>
                 <button>Contact</button>
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

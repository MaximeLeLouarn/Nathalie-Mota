<?php
/*
Template Name: Prototype
*/
get_header();
?>

<h1><?php the_title(); ?></h1>
<!-- Content -->
<main id="primary" class="site-main">

    <section class="frontImage">

    <?php

        // get_random_image_url() can be found in the functions file
        $image_data = get_random_image_url_and_alt();

        if ($image_data && $image_data['url']) {
            echo '<img src="' . esc_url($image_data['url']) . '" alt="' . esc_attr($image_data['alt']) . '" />';
        } else {
            echo '<p>Aucune image n\'a été trouvée</p>';
        }

    ?>

    </section>

    <section class="filters&Images">
        <div class="filters"></div>
        <div class="images"></div>
    </section>

</main>

<?php
get_sidebar();
get_footer();
?>
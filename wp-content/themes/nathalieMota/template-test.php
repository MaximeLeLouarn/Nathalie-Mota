<?php
/*
Template Name: Prototype
*/
get_header();
?>

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

        <div class="filters">

            <div class="dropdown dropdown1">

                <label for="filter1">Formats</label>
                <select id="filter1" class="dropdown">
            <option value="all">All</option>
            <option value="option1">Option 1</option>
            </select>

            </div>

            <div class="dropdown dropdown2">

            <label for="filter2">Catégories</label>
                <select id="filter2" class="dropdown">
            <option value="all">All</option>
            <option value="option1">Option 1</option>
            </select>

            </div>

            <div class="dropdown dropdown3">

            <label for="filter3">Trier par</label>
                <select id="filter3" class="dropdown">
            <option value="all">All</option>
            <option value="option1">Option 1</option>

            </select>

            </div>

        </div>

        <div class="images"></div>
    </section>

</main>

<?php
get_sidebar();
get_footer();
?>
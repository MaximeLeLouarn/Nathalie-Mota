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

    <section class="filtersImages">

            <div class="filters">

                <div class="catFor">
                    <div class="categorieContainer">

                        <button class="dropdownButton" id="dropdownButton">
                            Catégorie <span class="arrow" id="arrow">&#9660;</span>
                        </button>

                        <div class="dropdownContent">
                            <?php
                            $getSubCategories = get_terms('categorie');

                            if (!empty($getSubCategories) && !is_wp_error($getSubCategories)) {
                                foreach ($getSubCategories as $getSubCategory) {
                                    echo '<a href="# ' . esc_attr($getSubCategory->slug) . '">' . esc_html($getSubCategory->name) . '</a>';
                                }
                            }
                            ?>
                        </div>

                    </div>

                    <div class="formatContainer">

                            <button class="dropdownButton" id="dropdownButton">
                                format <span class="arrow" id="arrow">&#9660;</span>
                            </button>

                        <div class="dropdownContent">
                            <?php
                            $getSubFormats = get_terms('format');

                            if (!empty($getSubFormats) && !is_wp_error($getSubFormats)) {
                                foreach ($getSubFormats as $getSubFormat) {
                                    echo '<a href="# ' . esc_attr($getSubFormat->slug) . '">' . esc_html($getSubFormat->name) . '</a>';
                                }
                            }
                            ?>
                        </div>
                        
                    </div>
                </div>

                <div class="filterContainer">

                    <div class="filterContent">

                            <button class="dropdownButton" id="dropdownButton">
                                Trier par<span class="arrow" id="arrow">&#9660;</span>
                            </button>

                        <div class="dropdownContent">
                            <?php
                            $getSubFormats = get_terms('format');

                            if (!empty($getSubFormats) && !is_wp_error($getSubFormats)) {
                                foreach ($getSubFormats as $getSubFormat) {
                                    echo '<a href="# ' . esc_attr($getSubFormat->slug) . '">' . esc_html($getSubFormat->name) . '</a>';
                                }
                            }
                            ?>
                        </div>

                    </div>
            </div>

        </div>

        <div class="images"></div>
    </section>

</main>

<?php
get_sidebar();
get_footer();
?>
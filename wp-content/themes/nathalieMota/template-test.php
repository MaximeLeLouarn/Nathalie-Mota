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

                        <button class="dropdownButton dropdownButtonTextCat" id="categorieButton">
                            Catégorie <span class="arrow" id="arrow">&#9660;</span>
                        </button>

                        <div class="dropdownContent">
                            <!-- To be able to come back to all photos without filter -->
                        <a href="#" class="categoryFilter" data-category="all">Tout</a>
                        <!-- And go fetch all the other possible options -->
                            <?php
                            $getSubCategories = get_terms('categorie');

                            if (!empty($getSubCategories) && !is_wp_error($getSubCategories)) {
                                foreach ($getSubCategories as $getSubCategory) {
                                    echo '<a href="#" class="categoryFilter" data-category="' . esc_attr($getSubCategory->slug) . '">' . esc_html($getSubCategory->name) . '</a>';
                                }
                            }
                            ?>
                        </div>

                    </div>

                    <div class="formatContainer">

                            <button class="dropdownButton dropdownButtonTextFor" id="formatButton">
                                format <span class="arrow" id="arrow">&#9660;</span>
                            </button>

                        <div class="dropdownContent">
                        <!-- To be able to come back to all photos without filter -->
                        <a href="#" class="formatFilter" data-category="all2">Tout</a>
                        <!-- And go fetch all the other possible options -->
                            <?php
                            $getSubFormats = get_terms('format');

                            if (!empty($getSubFormats) && !is_wp_error($getSubFormats)) {
                                foreach ($getSubFormats as $getSubFormat) {
                                    echo '<a href="#" class="formatFilter" data-category="' . esc_attr($getSubFormat->slug) . '">' . esc_html($getSubFormat->name) . '</a>';
                                }
                            }
                            ?>
                        </div>
                        
                    </div>
                </div>

                <div class="filterContainer">

                    <div class="filterContent">

                            <button class="dropdownButton dropdownButtonTextTri" id="triButton">
                                Trier par<span class="arrow" id="arrow">&#9660;</span>
                            </button>

                        <div class="dropdownContent">
                        <?php
                        $years = array();
                        $posts = get_posts(array(
                            'post_type' => 'photo',
                            'posts_per_page' => -1,
                            'orderby' => 'date',
                            'order' => 'DESC'
                        ));
                        if ($posts) {
                            foreach ($posts as $post) {
                                $year = get_the_date('Y', $post);
                                if (!in_array($year, $years)) {
                                    $years[] = $year;
                                }
                            }

                                echo '<a href="#" class="yearFilter" data-sort-order="newest">Descendant</a>';
                                echo '<a href="#" class="yearFilter" data-sort-order="oldest">Ascendant</a>';

                        }
                        ?>
                        </div>

                    </div>
            </div>

        </div>

        <div class="images">

        <?php 
$publications = new WP_Query([
  'post_type' => 'publications',
  'posts_per_page' => 8,
  'orderby' => 'date',
  'order' => 'DESC',
  'paged' => 1,
]);
?>
            <?php if($publications->have_posts()): ?>
            <ul class="publicationList">
            <?php 
                get_template_part('template-parts/BlockPhoto', 'photo');
            ?>
            </ul>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>

            <div class="loadMoreContainer">
                <a href="#!" class="" id="loadMore">Load more</a>
            </div>

        </div>

    </section>

</main>

<?php
get_sidebar();
get_footer();
?>
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
                        <a href="#!" class="categorieFilter" data-categorie="all">Tout</a>
                        <!-- And go fetch all the other possible options -->
                            <?php
                            $getSubCategories = get_terms('categorie');

                            if (!empty($getSubCategories) && !is_wp_error($getSubCategories)) {
                                foreach ($getSubCategories as $getSubCategory) {
                                    echo '<a href="#" class="categorieFilter" data-categorie="' . esc_attr($getSubCategory->slug) . '">' . esc_html($getSubCategory->name) . '</a>';
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
                        <a href="#" class="formatFilter" data-format="all2">Tout</a>
                        <!-- And go fetch all the other possible options -->
                            <?php
                            $getSubFormats = get_terms('format');

                            if (!empty($getSubFormats) && !is_wp_error($getSubFormats)) {
                                foreach ($getSubFormats as $getSubFormat) {
                                    echo '<a href="#!" class="formatFilter" data-format="' . esc_attr($getSubFormat->slug) . '">' . esc_html($getSubFormat->name) . '</a>';
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
                            'posts_per_page' => 8,
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

                                echo '<a href="#!" class="yearFilter" data-sort-order="newest">Descendant</a>';
                                echo '<a href="#!" class="yearFilter" data-sort-order="oldest">Ascendant</a>';

                        }
                        ?>
                        </div>

                    </div>
            </div>

        </div>

        <div class="imagesAndLoad">
                
            <div class="images">

            <?php 

                // Get all term slugs for the 'categorie' taxonomy
                $termsCArray = get_all_term_slugs('categorie');
                // Get all term slugs for the 'format' taxonomy
                $termsFArray = get_all_term_slugs('format');

                // Debug output
                // print_r($termsCArray);
                // print_r($termsFArray);



                $postsPerPage = 8;
                $photo = new WP_Query([
                'post_type' => 'photo',
                'posts_per_page' => $postsPerPage,
                'orderby' => 'date',
                'order' => 'DESC',
                'paged' => 1,
                'tax_query' => array(
                'relation' => 'OR',
                array(
                    'taxonomy' => 'categorie',
                    'field' => 'slug',
                    'terms' => $termsCArray,
                    'operator' => 'IN'
                ),
                array(
                    'taxonomy' => 'format',
                    'field' => 'slug',
                    'terms' => $termsFArray,
                    'operator' => 'IN'
                )
            )
                ]);
                
                // If it doesn't work, let's try different structure where we can endwhile after get_template_part and reset after endif.
                // Tutorial followed at this link: https://weichie.com/blog/load-more-posts-ajax-wordpress/.
                // The position of the div is important in this way, or it will keep displaying many divs
                if ($photo->have_posts()) : ?>
                    <div class="publicationList"><?php
                    while ($photo->have_posts()) : $photo->the_post(); ?>
                            <?php get_template_part('template-parts/BlockPhoto');
                            
                            endwhile; 
                            // Try to debug and understand what could cause no post to appear on page load
                            ?></div><?php
                            else :
                            echo '<p>No posts found.</p>';?>
                <?php endif; 
                wp_reset_postdata(); 
                ?>
            
            </div>


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
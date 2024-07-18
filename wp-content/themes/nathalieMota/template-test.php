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

        <div class="dropdown">
        <button class="dropbtn">Filter Options</button>
        <div class="dropdown-content">
            <ul>
                <li>Filter 1
                    <ul class="submenu">
                        <li><input type="checkbox" id="filter1a" name="filter1a"><label for="filter1a">Option 1a</label></li>
                        <li><input type="checkbox" id="filter1b" name="filter1b"><label for="filter1b">Option 1b</label></li>
                        <li><input type="checkbox" id="filter1c" name="filter1c"><label for="filter1c">Option 1c</label></li>
                    </ul>
                </li>
                <li>Filter 2
                    <ul class="submenu">
                        <li><input type="checkbox" id="filter2a" name="filter2a"><label for="filter2a">Option 2a</label></li>
                        <li><input type="checkbox" id="filter2b" name="filter2b"><label for="filter2b">Option 2b</label></li>
                        <li><input type="checkbox" id="filter2c" name="filter2c"><label for="filter2c">Option 2c</label></li>
                    </ul>
                </li>
                <li>Filter 3
                    <ul class="submenu">
                        <li><input type="checkbox" id="filter3a" name="filter3a"><label for="filter3a">Option 3a</label></li>
                        <li><input type="checkbox" id="filter3b" name="filter3b"><label for="filter3b">Option 3b</label></li>
                        <li><input type="checkbox" id="filter3c" name="filter3c"><label for="filter3c">Option 3c</label></li>
                    </ul>
                </li>
            </ul>
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
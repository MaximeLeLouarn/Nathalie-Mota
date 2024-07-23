<div class="photosPostsContainer">

<?php 
$photosPosts = get_custom_posts_with_images();

if (!empty($photosPosts)) {
foreach ($photosPosts as $post):
?>

    <!-- implode(', ', $post['categorie'])
     takes the array of term names and joins them into a single string, with each term separated by a comma and a space.
     For example, if $post['categorie'] is ['Nature', 'Wildlife'],
     implode(', ', $post['categorie']) will produce the string "Nature, Wildlife". -->
    <div class="postItem" data-category="<?= esc_attr(implode(', ', $post['categorie'])); ?>" data-format="<?= esc_attr(implode(', ', $post['format'])); ?>" data-year="<?= esc_attr($post['year']); ?>">
            <img src="<?= $post['image']; ?>" alt="<?= $post['alt_text']; ?>">
        </div>
    <?php endforeach; 
    } else {
        echo 'Pas de photos trouvées';
    }
    ?>
    
</div>
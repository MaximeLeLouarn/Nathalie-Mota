<div class="photosPostsContainer">

<?php 
$photosPosts = get_custom_posts_with_images();
foreach ($posts as $post):
?>

    <div class="postItem" data-category="<?php echo $post['categorie']; ?>" data-format="<?php echo $post['format']; ?>" data-year="<?php echo $post['year']; ?>">
            <img src="<?php echo $post['image']; ?>" alt="<?php echo $post['alt_text']; ?>">
        </div>
    <?php endforeach; ?>
    
</div>
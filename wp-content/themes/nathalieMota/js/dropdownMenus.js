const dropdownButton = document.querySelectorAll(".dropdownButton");
const dropdownContent = document.querySelectorAll(".dropdownContent");
const arrow = document.querySelectorAll(".arrow");

// Front end of the filter buttons
dropdownButton.forEach((button, index) => {
  button.addEventListener("click", function () {
    dropdownContent[index].classList.toggle("activeBlock");
    dropdownButton[index].classList.toggle("buttonBorderStyle");
    if (dropdownContent[index].classList.contains("activeBlock")) {
      arrow[index].innerHTML = "&#9650;"; // Up arrow
    } else {
      arrow[index].innerHTML = "&#9660;"; // Down arrow
    }
  });
});

window.onclick = function (event) {
  if (!event.target.matches(".dropdownButton")) {
    dropdownButton.forEach((button) => {
      button.classList.remove("buttonBorderStyle");
    });
    dropdownContent.forEach((content, index) => {
      if (content.classList.contains("activeBlock")) {
        content.classList.remove("activeBlock");
        arrow[index].innerHTML = "&#9660;"; // Down arrow
      }
    });
  }
};


// The AJAX part
document.getElementById('dropdownButton').addEventListener('click', function() {
  const category = document.querySelector('.categoryFilter.selected') ? document.querySelector('.categoryFilter.selected').dataset.category : '';
  const format = document.getElementById('formatFilter').value;
  const year = document.getElementById('year-filter').value;

  let data = {
      'action': 'filter_custom_posts',
      'category': category,
      'format': format,
      'year': year
  };

  jQuery.post('<?php echo admin_url('admin-ajax.php'); ?>', data, function(response) {
      if (response.success) {
          const postsContainer = document.getElementById('photosPostsContainer');
          postsContainer.innerHTML = '';
          response.data.forEach(function(post) {
              const postItem = document.createElement('div');
              postItem.classList.add('postItem');
              postItem.setAttribute('data-category', post.categorie.join(', '));
              postItem.setAttribute('data-format', post.format.join(', '));
              postItem.setAttribute('data-year', post.year);
              postItem.innerHTML = '<img src="' + post.image + '" alt="' + post.alt_text + '">';
              postsContainer.appendChild(postItem);
          });
      } else {
          alert('No posts found');
      }
  });
});

document.querySelectorAll('.category-filter').forEach(function(categoryLink) {
  categoryLink.addEventListener('click', function(event) {
      event.preventDefault();
      document.querySelectorAll('.category-filter').forEach(function(link) {
          link.classList.remove('selected');
      });
      categoryLink.classList.add('selected');
  });
});
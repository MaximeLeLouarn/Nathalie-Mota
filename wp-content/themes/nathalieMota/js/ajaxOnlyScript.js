// The AJAX part
const filterContainer = document.querySelector(".filtersImages");

const selectedFilters = {
  category: "",
  format: "",
  year: "",
};

filterContainer.addEventListener("click", function (e) {
  if (e.target.classList.contains("categoryFilter")) {
    selectedFilters.category = e.target.getAttribute("data-category");
    applyFilters();
  }

  if (e.target.classList.contains("formatFilter")) {
    selectedFilters.format = e.target.getAttribute("data-format");
    applyFilters();
  }

  if (e.target.classList.contains("yearFilter")) {
    selectedFilters.year = e.target.getAttribute("data-year");
    applyFilters();
  }
});

function applyFilters() {
  $.ajax({
    url: ajax_object.ajax_url,
    type: "POST",
    data: {
      action: "filter_custom_posts_ajax",
      category: selectedFilters.category,
      format: selectedFilters.format,
      year: selectedFilters.year,
    },
    success: function (response) {
      const container = $("#photosPostsContainer");
      container.empty();
      if (response.success) {
        response.data.forEach((post) => {
          const postItem = `
            <div class="postItem" data-category="${post.categorie.join(
              ", "
            )}" data-format="${post.format.join(", ")}" data-year="${
            post.year
          }">
              <img src="${post.image}" alt="${post.alt_text}">
            </div>`;
          container.append(postItem);
        });
      } else {
        container.append("<p>Pas de photos trouvées</p>");
      }
    },
    error: function (xhr, status, error) {
      console.error("AJAX Error:", error);
    },
  });
}

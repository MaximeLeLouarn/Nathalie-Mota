// The AJAX part

// The filters CATFOR + Trier par interractions
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

// The loadMore button
let page = 1;
const loadMore = document.querySelector(".loadMore");
const loadMoreContainer = document.querySelector(".images");

loadMore.addEventListener("click", function () {
  page++;
  // Send request
  const xhr = new XMLHttpRequest();
  // True = asynchronous
  xhr.open("POST", "/wp-admin/admin-ajax.php", true);
  xhr.setRequestHeader(
    "Content-Type",
    "application/x-www-form-urlencoded; charset=UTF-8"
  );
  // Defines the function to handle the response from the server when the AJAX request completes
  xhr.onload = function () {
    // Checks if the request was successful (HTTP status code 200)
    if (xhr.status === 200) {
      const response = JSON.parse(xhr.responseText);
      if (response.success) {
        const newPosts = response.data;
        newPosts.forEach((post) => {
          // Extracts the array of new posts from the response data
          const postItem = document.createElement("div");
          postItem.classList.add("postItem");
          postItem.setAttribute("data-category", post.categorie.join(", "));
          postItem.setAttribute("data-format", post.format.join(", "));
          postItem.setAttribute("data-year", post.year);
          postItem.innerHTML = `
                        <div class="informationsHoverPhoto">
                            <h4 class="refPhotoLightbox">${post.reference}</h4>
                            <h4 class="catPhotoLightbox">${post.categorie.join(
                              ", "
                            )}</h4>
                        </div>
                        <div class="iconEye" onclick="window.open('${
                          post.permalink
                        }', '_blank')"></div>
                        <div class="expandPhotoIcon"></div>
                        <img class="imgPostItem" src="${post.image}" alt="${
            post.alt_text
          }">
                    `;
          loadMoreContainer.appendChild(postItem);
        });
      } else {
        loadMore.style.display = "none";
      }
    }
  };
  // Send request to server with the action and page number
  xhr.send("action=load_more_photos&page=" + page);
});

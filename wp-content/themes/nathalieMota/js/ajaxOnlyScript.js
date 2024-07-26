(function ($) {
  // The AJAX part

  // The filters CATFOR + Trier par interractions
  // const filterContainer = document.querySelector(".filtersImages");

  // const selectedFilters = {
  //   categorie: "",
  //   format: "",
  //   year: "",
  // };

  // filterContainer.addEventListener("click", function (e) {
  //   if (e.target.classList.contains("categoryFilter")) {
  //     selectedFilters.category = e.target.getAttribute("data-category");
  //     applyFilters();
  //   }

  //   if (e.target.classList.contains("formatFilter")) {
  //     selectedFilters.format = e.target.getAttribute("data-format");
  //     applyFilters();
  //   }

  //   if (e.target.classList.contains("yearFilter")) {
  //     selectedFilters.year = e.target.getAttribute("data-year");
  //     applyFilters();
  //   }
  // });

  // function applyFilters() {
  //   $.ajax({
  //     url: "./wp-admin/admin-ajax.php",
  //     type: "POST",
  //     dataType: "json",
  //     data: {
  //       action: "filter_custom_posts_ajax",
  //       categorie: "test",
  //       format: selectedFilters.format,
  //       year: selectedFilters.year,
  //     },
  //     success: function (response) {
  //       console.log(response);
  //       const container = $("#photosPostsContainer");
  //       if (response.success) {
  //         container.html(response);
  //         //   response.data.forEach((post) => {
  //         //     const postItem = `
  //         //     <div class="postItem" data-category="${post.categorie.join(
  //         //       ", "
  //         //     )}" data-format="${post.format.join(", ")}" data-year="${
  //         //       post.year
  //         //     }">
  //         //       <img src="${post.image}" alt="${post.alt_text}">
  //         //     </div>`;
  //         //     container.append(postItem);
  //         //   });
  //         // } else {
  //         //   container.append("<p>Pas de photos trouvées</p>");
  //       }
  //     },
  //     error: function (xhr, status, error) {
  //       console.error("AJAX Error:", error);
  //     },
  //   });
  // }

  // The loadMore button
  let currentPage = 1;

  $("#loadMore").on("click", function () {
    currentPage++;
    $.ajax({
      type: "POST",
      url: "./wp-admin/admin-ajax.php",
      dataType: "json",
      data: {
        action: "load_more_photos",
        paged: currentPage,
      },
      success: function (res) {
        if (currentPage >= res.max) {
          $("#loadMore").hide();
        }
        $(".publicationList").append(res);
      },
    });
  });
})(jQuery);

// Ensure the jquery
(function ($) {
  // The filters
  // Go fetch the data-(...) informations setup in the html filter parts of template-test.php
  let currentPage = 1;
  let currentCategorie = "all";
  let currentFormat = "all2";

  $(".categorieFilter").on("click", function (e) {
    e.preventDefault();
    currentCategorie = $(this).data("categorie");
    // Reset currentpage value after use of filters
    currentPage = 1;
    applyFilters();
  });

  $(".formatFilter").on("click", function (f) {
    f.preventDefault();
    currentFormat = $(this).data("format");
    currentPage = 1;
    applyFilters();
  });
  // To reuse their value in the ajax request
  function applyFilters() {
    $.ajax({
      type: "POST",
      url: "./wp-admin/admin-ajax.php",
      dataType: "html",
      data: {
        action: "filter_custom_posts_ajax",
        categorie: currentCategorie,
        format: currentFormat,
        // Reset to first page when there is a change of filters
        paged: currentPage,
      },
      success: function (res) {
        console.log(res);
        $(".images").html(res);
        if (res.max <= 1) {
          $("#loadMore").hide();
        } else {
          $("#loadMore").show();
        }
      },
    });
  }

  // The loadMore button
  $("#loadMore").on("click", function (event) {
    event.preventDefault();
    currentPage++;
    $.ajax({
      type: "POST",
      url: "./wp-admin/admin-ajax.php",
      dataType: "json",
      data: {
        action: "load_more_photos",
        categorie: currentCategorie,
        format: currentFormat,
        paged: currentPage,
      },
      success: function (res) {
        console.log(res);
        if (currentPage >= res.max) {
          $("#loadMore").hide();
        }
        $(".images").append(res.html);
      },
    });
  });

  // If the page would contain less than 8 posts at the loading, then something like this piece of code should be
  // written to hide the loadMore btn.
  // $(document).ready(function () {
  //   applyFilters();
  // });
})(jQuery);

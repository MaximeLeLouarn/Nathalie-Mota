(function ($) {
  // The loadMore button

  let currentPage = 1;
  $("#loadMore").on("click", function (event) {
    event.preventDefault();
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
        console.log(res);
        if (currentPage >= res.max) {
          $("#loadMore").hide();
        }
        $(".images").append(res.html);
      },
    });
  });

  // The filters
  $(".categoryFilter").on("click", function () {
    let filter = $(this).data("categorie");
    $.ajax({
      type: "POST",
      url: "./wp-admin/admin-ajax.php",
      dataType: "html",
      data: {
        action: "filter_custom_posts_ajax",
        taxonomy: "categorie",
        term: filter,
      },
      success: function (res) {
        $(".images").html(res);
      },
    });
  });
  // $(".formatFilter").on("click", function () {
  //   let filter2 = $(this).data("format");
  //   $.ajax({
  //     type: "POST",
  //     url: "./wp-admin/admin-ajax.php",
  //     dataType: "html",
  //     data: {
  //       action: "filter_custom_posts_ajax",
  //       taxonomy: "format",
  //       term: filter2,
  //     },
  //     success: function (res) {
  //       $(".images").html(res);
  //     },
  //   });
  // });
  // $(".formatFilter").on("click", function () {
  //   $.ajax({
  //     type: "POST",
  //     url: "./wp-admin/admin-ajax.php",
  //     dataType: "html",
  //     data: {
  //       action: "filter_projects",
  //       category: $(this).data("slug"),
  //       type: $(this).data("type"),
  //     },
  //     success: function (res) {
  //       $(".publicationList").html(res);
  //     },
  //   });
  // });
})(jQuery);

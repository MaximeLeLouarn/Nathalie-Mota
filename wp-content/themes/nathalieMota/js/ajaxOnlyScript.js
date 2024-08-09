// Ensure the jquery
(function ($) {
  // The filters
  // Go fetch the data-(...) informations setup in the html filter parts of template-test.php
  let currentPage = 1;
  let currentCategorie = "all";
  let currentFormat = "all2";
  let currentOrder = "DESC";
  const arrow = document.querySelectorAll(".arrow");

  // Function to reinitialize the lazy load from EWWW. Without it, the images will loose the lazyload class
  // after interacting with the filters. It's interacting with all images that are imgPostItem
  function reinitializePlugins() {
    document.querySelectorAll(".imgPostItem").forEach((img) => {
      // If image doesn't contain lazyloaded, we give lazyload class to it. We don't want the front section img to
      // reboot tho !
      if (
        !img.classList.contains("lazyloaded") &&
        !img.classList.contains("notLazy")
      ) {
        img.classList.add("lazyload");
      }
    });

    // If the library for lazy loading lazySizes is defined, we can initialize it
    if (typeof lazySizes !== "undefined") {
      lazySizes.init();
    }

    initLightbox();
  }
  // const allOrders = document.querySelectorAll(".yearFilter");
  // To reuse their value in the ajax request
  function applyFilters() {
    currentPage = 1;
    console.log("Applying filters with:", {
      currentCategorie,
      currentFormat,
      currentOrder,
      currentPage,
    });
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
        direction: currentOrder,
        // order: currentOrder,
      },
      success: function (res) {
        $(".publicationList").html(res);
        //   if (res.max <= 1) {
        //     $("#loadMore").hide();
        //   } else {
        //     $("#loadMore").show();
        //   }
        // },
        if ($(".publicationList").children().length < 8) {
          $("#loadMore").hide();
        } else {
          $("#loadMore").show();
        }
        reinitializePlugins();
      },
    });
  }

  // Function to reset dropdown text and close all dropdowns options menus
  function resetDropdowns() {
    dropdownContent.forEach((content) =>
      content.classList.remove("activeBlock")
    );
    dropdownButton.forEach((button) =>
      button.classList.remove("buttonBorderStyle")
    );
    arrow.forEach((arrow) => (arrow.innerHTML = "&#9660;"));
  }

  const dropdownButtonTextCat = document.querySelector(
    ".dropdownButtonTextCat"
  );
  const dropdownButtonTextFor = document.querySelector(
    ".dropdownButtonTextFor"
  );
  const dropdownButtonTextTri = document.querySelector(
    ".dropdownButtonTextTri"
  );
  const categoryLinksCat = document.querySelectorAll(".categorieFilter");
  const categoryLinksFor = document.querySelectorAll(".formatFilter");
  const categoryLinksTri = document.querySelectorAll(".yearFilter");
  // photoPosts Item might be used
  // Make the text of the selected option staying
  // Catégorie
  categoryLinksCat.forEach((link) => {
    link.addEventListener("click", function (event) {
      event.preventDefault();
      currentCategorie = event.target.dataset.categorie;
      if (currentCategorie === "all") {
        dropdownButtonTextCat.innerHTML = `Catégorie <span class="arrow">&#9660;</span>`;
      } else {
        dropdownButtonTextCat.innerHTML = `${event.target.textContent} <span class="arrow">&#9660;</span>`;
      }
      resetDropdowns();
      // Reset currentpage value after use of filters
      currentPage = 1;
      applyFilters();
    });
  });
  // Format
  categoryLinksFor.forEach((link) => {
    link.addEventListener("click", function (event) {
      event.preventDefault();
      currentFormat = event.target.dataset.format;
      if (currentFormat === "all2") {
        dropdownButtonTextFor.innerHTML = `format <span class="arrow">&#9660;</span>`;
      } else {
        dropdownButtonTextFor.innerHTML = `${event.target.textContent} <span class="arrow">&#9660;</span>`;
      }
      resetDropdowns();
      currentPage = 1;
      applyFilters();
    });
  });

  // Trier par
  // In 2 parts, first specific function (this filter is different)
  // Aborted method, now doing much simpler method with ASC DESC, no A - B kind of calculs.
  // And second, the usual foreach
  categoryLinksTri.forEach((link) => {
    link.addEventListener("click", function (event) {
      event.preventDefault();
      currentOrder = event.target.dataset.direction;
      console.log(
        "Clicked link data-direction:",
        event.target.dataset.direction
      );
      console.log("Assigned currentOrder:", currentOrder);
      dropdownButtonTextTri.innerHTML = `${event.target.textContent} <span class="arrow">&#9660;</span>`;
      resetDropdowns();
      currentPage = 1;
      console.log("Trier by order:", currentOrder);
      applyFilters();
    });
  });

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
        direction: currentOrder,
      },
      success: function (res) {
        if (currentPage >= res.max) {
          $("#loadMore").hide();
        }
        $(".publicationList").append(res.html);
        reinitializePlugins();
      },
    });
  });
})(jQuery);

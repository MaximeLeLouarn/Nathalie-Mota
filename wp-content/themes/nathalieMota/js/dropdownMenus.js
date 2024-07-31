const dropdownButton = document.querySelectorAll(".dropdownButton");
const dropdownContent = document.querySelectorAll(".dropdownContent");
const arrow = document.querySelectorAll(".arrow");
const dropdownButtonTextCat = document.querySelector(".dropdownButtonTextCat");
const dropdownButtonTextFor = document.querySelector(".dropdownButtonTextFor");
const dropdownButtonTextTri = document.querySelector(".dropdownButtonTextTri");
const categoryLinksCat = document.querySelectorAll(".categorieFilter");
const categoryLinksFor = document.querySelectorAll(".formatFilter");
const categoryLinksTri = document.querySelectorAll(".yearFilter");
// photoPosts Item might be used
// const photoPosts = document.querySelectorAll(".postItem"); !!! THe class is already fetched in lightbox.js

// Function to reset dropdown text and close all dropdowns options menus
function resetDropdowns() {
  dropdownContent.forEach((content) => content.classList.remove("activeBlock"));
  dropdownButton.forEach((button) =>
    button.classList.remove("buttonBorderStyle")
  );
  arrow.forEach((arrow) => (arrow.innerHTML = "&#9660;"));
}

// Function to filter photo posts
// function filterPhotos(category, format, year) {
//   photoPosts.forEach((post) => {
//     const postCategory = post.getAttribute("data-category").split(", ");
//     const postFormat = post.getAttribute("data-format").split(", ");
//     const postYear = post.getAttribute("data-year");

//     const categoryMatch = category === "all" || postCategory.includes(category);
//     const formatMatch = format === "all2" || postFormat.includes(format);
//     const yearMatch = year === "all3" || postYear === year;

//     if (categoryMatch && formatMatch && yearMatch) {
//       post.style.display = "block";
//     } else {
//       post.style.display = "none";
//     }
//   });
// }

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
// Make the text of the selected option staying
// Catégorie
categoryLinksCat.forEach((link) => {
  link.addEventListener("click", function (event) {
    event.preventDefault();
    const categorie = event.target.dataset.categorie;
    if (categorie === "all") {
      dropdownButtonTextCat.innerHTML = `Catégorie <span class="arrow">&#9660;</span>`;
    } else {
      dropdownButtonTextCat.innerHTML = `${event.target.textContent} <span class="arrow">&#9660;</span>`;
    }
    resetDropdowns();
    // filterPhotos(
    //   categorie,
    //   dropdownButtonTextFor.textContent.trim().toLowerCase(),
    //   dropdownButtonTextTri.textContent.trim()
    // );
  });
});
// Format
categoryLinksFor.forEach((link) => {
  link.addEventListener("click", function (event) {
    event.preventDefault();
    const format = event.target.dataset.format;
    if (format === "all2") {
      dropdownButtonTextFor.innerHTML = `format <span class="arrow">&#9660;</span>`;
    } else {
      dropdownButtonTextFor.innerHTML = `${event.target.textContent} <span class="arrow">&#9660;</span>`;
    }
    resetDropdowns();
    // filterPhotos(
    //   dropdownButtonTextCat.textContent.trim().toLowerCase(),
    //   format,
    //   dropdownButtonTextTri.textContent.trim()
    // );
  });
});
// Trier par
// In 2 parts, first specific function (this filter is different)
function sortPhotos(order) {
  const photoPosts = Array.from(document.querySelectorAll(".postItem"));
  const sortedPosts = photoPosts.sort((a, b) => {
    const yearA = parseInt(a.getAttribute("data-year"));
    const yearB = parseInt(b.getAttribute("data-year"));
    return order === "newest" ? yearB - yearA : yearA - yearB;
  });
  const container = document.querySelector(".photosPostsContainer");
  container.innerHTML = "";
  sortedPosts.forEach((post) => container.appendChild(post));
}
// And second, the usual foreach
categoryLinksTri.forEach((link) => {
  link.addEventListener("click", function (event) {
    event.preventDefault();
    // const year = event.target.dataset.year;
    const sortOrder = event.target.dataset.sortOrder;
    dropdownButtonTextTri.innerHTML = `${event.target.textContent} <span class="arrow">&#9660;</span>`;
    resetDropdowns();
    sortPhotos(sortOrder);
    // filterPhotos(
    //   dropdownButtonTextCat.textContent.trim().toLowerCase(),
    //   dropdownButtonTextFor.textContent.trim().toLowerCase(),
    //   year
    // );
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

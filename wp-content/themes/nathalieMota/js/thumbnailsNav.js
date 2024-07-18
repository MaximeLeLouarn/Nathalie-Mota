document.addEventListener("DOMContentLoaded", function () {
  const thumbnail = document.getElementById("currentThumbnail");
  const prevNav = document.querySelector(".nav-prev");
  const nextNav = document.querySelector(".nav-next");
  const currentThumbnailUrl = thumbnail.getAttribute("data-current-thumbnail");
  const currentThumbnailAlt = thumbnail.getAttribute(
    "data-current-thumbnail-alt"
  );

  if (prevNav) {
    prevNav.addEventListener("mouseover", function () {
      thumbnail.src = thumbnail.getAttribute("data-prev-thumbnail");
      thumbnail.alt = thumbnail.getAttribute("data-prev-thumbnail-alt");
    });

    prevNav.addEventListener("mouseout", function () {
      thumbnail.src = currentThumbnailUrl;
      thumbnail.alt = currentThumbnailAlt;
    });
  }

  if (nextNav) {
    nextNav.addEventListener("mouseover", function () {
      thumbnail.src = thumbnail.getAttribute("data-next-thumbnail");
      thumbnail.alt = thumbnail.getAttribute("data-next-thumbnail-alt");
    });

    nextNav.addEventListener("mouseout", function () {
      thumbnail.src = currentThumbnailUrl;
      thumbnail.alt = currentThumbnailAlt;
    });
  }
});

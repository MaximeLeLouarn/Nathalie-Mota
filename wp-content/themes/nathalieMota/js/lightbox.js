// Init lightbox through function to avoid it to not display after touching filters that modify the scripts with ajax
function initLightbox() {
  const modal = document.getElementById("photoModal");
  const modalImg = document.getElementById("expandedImg");
  const modalCaption = document.getElementById("modalPhotoCaption");
  const closeModal = document.querySelector(".closePhotoModal");
  console.log(closeModal);
  const prevPost = document.getElementById("prevPostLightbox");
  const nextPost = document.getElementById("nextPostLightbox");
  const postItems = document.querySelectorAll(".postItem");
  const refPL = document.querySelector(".refPhotoLightbox");
  const catPL = document.querySelector(".catPhotoLightbox");

  let currentIndex;

  function openModal(item) {
    const imgPostItem = item.querySelector(".imgPostItem");
    const refText = item.querySelector(".refPhotoLightbox").innerText;
    const catText = item.querySelector(".catPhotoLightbox").innerText;

    modal.style.display = "flex";
    modalImg.src = imgPostItem.src;
    modalCaption.innerHTML = `<span class="refText">${refText}</span> <span class="catText">${catText}</span>`;
  }

  postItems.forEach((item, index) => {
    const expandIcons = item.querySelectorAll(".expandPhotoIcon");
    // ExpandIcons returns a nodeList, so we need to go fetch each element inside it with a forEach
    console.log(expandIcons);

    if (expandIcons) {
      expandIcons.forEach((expandIcon) => {
        expandIcon.addEventListener("click", () => {
          currentIndex = index;
          openModal(item);
          console.log(expandIcons);
        });
      });
    } else {
      item.addEventListener("click", () => {
        currentIndex = index;
        openModal(item);
        console.log(expandIcons);
      });
    }
  });

  closeModal.addEventListener("click", () => {
    modal.style.display = "none";
  });

  window.addEventListener("click", (event) => {
    if (event.target === modal) {
      modal.style.display = "none";
    }
  });

  window.addEventListener("keydown", (event) => {
    if (event.key === "Escape") {
      modal.style.display = "none";
    }
  });

  prevPost.addEventListener("click", () => {
    currentIndex = currentIndex > 0 ? currentIndex - 1 : postItems.length - 1;
    openModal(postItems[currentIndex]);
  });

  nextPost.addEventListener("click", () => {
    currentIndex = currentIndex < postItems.length - 1 ? currentIndex + 1 : 0;
    openModal(postItems[currentIndex]);
  });
}

initLightbox();

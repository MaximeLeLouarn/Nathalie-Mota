const dropdownButton = document.querySelectorAll(".dropdownButton");
const dropdownContent = document.querySelectorAll(".dropdownContent");
const arrow = document.querySelectorAll(".arrow");

// const photoPosts = document.querySelectorAll(".postItem"); !!! THe class is already fetched in lightbox.js

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

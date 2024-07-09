// contactModal class is given inside wordpress Menus
const noContact = document.querySelectorAll(".contactModal");
const contactDiv = document.querySelector(".modalContactCf7");
const EffectiveModal = document.querySelector(".cf7Container");
const XModal = document.querySelector(".XModal");

noContact.forEach((block) => {
  block.addEventListener("click", function (e) {
    e.preventDefault();
    contactDiv.classList.add("active");
  });
});

// Closing the modal at the click on the cross
// Closing the modal at the click on the cross
XModal.addEventListener("click", () => {
  contactDiv.classList.remove("active");
});

contactDiv.addEventListener("click", (event) => {
  if (
    event.target === EffectiveModal ||
    EffectiveModal.contains(event.target)
  ) {
    // Do nothing if the click is inside the modal content
  } else {
    // Close the modal if the click is outside the modal content
    contactDiv.classList.remove("active");
  }
});

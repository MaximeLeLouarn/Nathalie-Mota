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

// With the contact btn from the posts
// Get all contact buttons
const contactButtons = document.querySelectorAll(".postContactBtn");

// Add click event listener to each button
contactButtons.forEach(function (button) {
  button.addEventListener("click", function () {
    // Get the data-ref value from the clicked button
    var refValue = this.getAttribute("data-ref");

    // Find the CF7 hidden field and set its value
    var preWrittenField = document.getElementById("preWritten");
    if (preWrittenField) {
      preWrittenField.value = refValue;
    }
    contactDiv.classList.add("active");
  });
});

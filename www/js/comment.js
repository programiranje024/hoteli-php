// Get the form element
const form = document.querySelector("form");
// Get the id_hotel select
const hotel = document.querySelector("#id_hotel");
// Get the comment input
const comment = document.querySelector("#comment");

function setError(id, error = "") {
  if (error) {
    document.getElementById(id).classList.add("error");
    document.getElementById(`${id}_error`).innerHTML = error;
  } else {
    document.getElementById(id).classList.remove("error");
    document.getElementById(`${id}_error`).innerHTML = "";
  }
}

// Add an event listener to the form
form.addEventListener("submit", (e) => {
  // Prevent the default behaviour of the form
  e.preventDefault();

  // Get the value of the hotel select
  const hotelValue = hotel.value;
  // Get the value of the comment input
  const commentValue = comment.value.trim();

  // Reset the errors
  setError(hotel.id);
  setError(comment.id);
  setError("submit");

  // Check if the hotel is empty
  if (!hotelValue) {
    setError(hotel.id, "Please select a hotel");
    return;
  }

  // Check if the comment is less than 10 characters
  if (commentValue.length < 10) {
    setError(
      comment.id,
      "Please enter a comment with at least 10 characters"
    );
    return;
  }

  // Create a new FormData object
  const formData = new FormData();
  // Add the hotel and comment values to the formData object
  formData.append("id_hotel", hotelValue);
  formData.append("comment", commentValue);

  // Send a POST request to the server (path: /ajax/insert-hotel.php)
  fetch("/ajax/insert-hotel.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }

      alert("You have successfully added a new hotel comment");
    })
    .catch((error) => {
      setError("submit", error.message);
    });
});

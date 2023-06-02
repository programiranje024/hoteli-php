// Get the form element
const form = document.querySelector("form");

// Add event listeners
window.addEventListener('load', (e) => {
  const id_comment = document.querySelector("input[type=hidden]").value;
  reloadCommentMark(id_comment);
});

form.addEventListener("submit", (e) => {
  // Prevent default action
  e.preventDefault();

  // Get the selected mark
  const mark = document.querySelector("select").value;

  // Get the hidden input
  const id_comment = document.querySelector("input[type=hidden]").value;

  // If no choice, alert the user
  if (!mark) {
    alert("Please select a mark!");
    return;
  }

  // Create the data to send
  const data = new FormData();
  data.append("id_comment", id_comment);
  data.append("mark", mark);

  // Send a POST request to the server (path: /ajax/vote.php)
  fetch("/ajax/mark.php", {
    method: "POST",
    body: data,
  })
    .then((response) => {
      if (!response.ok) {
        // If the response is not ok, alert the user
        alert("Error marking the comment!");
      } else {
        // If the response is ok, reload the page
        alert("Thank you for marking!");
        reloadCommentMark(id_comment);
      }
    })
    .catch((_error) => {
      // If there is an error, alert the user
      alert("Error voting for the breed!");
    });
});

function reloadCommentMark(id_comment) {
  // Send a GET request to the server (path: /ajax/vote.php)
  fetch(`/ajax/get-mark.php?id=${id_comment}`, {
    method: "GET",
  })
    .then((response) => {
      if (!response.ok) {
        // If the response is not ok, alert the user
        alert("Error getting the comment marks!");
      } else {
        return response.json();
      }
    })
    .then((json) => {
      // Construct a string from JSON
      const entries = Object.entries(json);
      let string = "";
      for (const [key, value] of entries) {
        const k = key.replace("_", " ");
        string += `<p>${k}: ${value}</p>`;
      }
      document.querySelector("#marks").innerHTML = string;
    })
    .catch((_error) => {
      // If there is an error, alert the user
      alert("Error getting the comment marks!");
    });
}
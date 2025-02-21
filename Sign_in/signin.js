document.getElementById("signIn").addEventListener("submit", function (event) {
  event.preventDefault();

  let formData = new FormData(this);
  for (let [key, value] of formData.entries()) {
    console.log(key, value);
  }

  fetch("signin.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => {
      console.log(response);
      return response.json();
    })
    .then((data) => {
      console.log(data);
      if (data.success) {
        window.location.href = "/ep/Home/home.html";
      } else {
        alert(data.message);
      }
    })
    .catch((error) => {
      console.error("Error:", error);
      alert("An error occurred, please try again later.");
    });
});

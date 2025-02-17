document.getElementById("signIn").addEventListener("submit", function (event) {
    event.preventDefault();
  
    let formData = new FormData(this);
    for (let [key, value] of formData.entries()) {
      console.log(key, value); // Log form data
    }
  
    fetch("signin.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => {
        console.log(response); // Log the response object
        return response.json();
      })
      .then((data) => {
        console.log(data); // Log the parsed JSON data
        if (data.success) {
          window.location.href = "dashboard.php";
        } else {
          document.getElementById("error-message").textContent = data.message;
        }
      })
      .catch((error) => console.error("Error:", error));
  });
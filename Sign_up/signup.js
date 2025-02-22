document.querySelector("form").addEventListener("submit", function (e) {
  e.preventDefault();

  const formData = new FormData(this);

  fetch("signup.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      alert(data.message);

      if (data.status === "success") {
        window.location.href = "/Event-Hive/Sign_in/signin.html";
      }
    })
    .catch((error) => console.error("Error:", error));
});

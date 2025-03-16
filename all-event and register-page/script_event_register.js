document.addEventListener("DOMContentLoaded", function () {
    const eventSelect = document.getElementById("event");
    const chargesInput = document.getElementById("charges");
    const paymentInput = document.getElementById("payment");
    const transactionInput = document.getElementById("transaction");
    const form = document.getElementById("eventForm");
    const popup = document.getElementById("popup");
    const popupMessage = document.getElementById("popup-message");
    const closePopupBtn = document.getElementById("close-popup");

    function toggleInputs() {
        if (eventSelect.value === "free") {
            chargesInput.disabled = true;
            paymentInput.disabled = true;
            transactionInput.disabled = true;

            chargesInput.removeAttribute("required");
            paymentInput.removeAttribute("required");
            transactionInput.removeAttribute("required");

            // Clear values when disabled
            chargesInput.value = "";
            paymentInput.value = "";
            transactionInput.value = "";
        } else {
            chargesInput.disabled = false;
            paymentInput.disabled = false;
            transactionInput.disabled = false;

            chargesInput.setAttribute("required", "true");
            paymentInput.setAttribute("required", "true");
            transactionInput.setAttribute("required", "true");
        }
    }

    // Event listener to toggle fields when event type is changed
    eventSelect.addEventListener("change", toggleInputs);

    // Initialize state on page load
    toggleInputs();

    // Handle Form Submission
    form.addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent default form submission
        
        // Show the popup
        popup.style.display = "flex";
    });

    // Close Popup
    closePopupBtn.addEventListener("click", function () {
        popup.style.display = "none";
        form.reset(); // Reset the form after successful submission
        toggleInputs(); // Reset input states
    });
});


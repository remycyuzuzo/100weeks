// import axios from "axios"

const formContainer = document.querySelector(".form-overlay .form-container");
const formOverlay = document.querySelector(".form-overlay");

function loadSavingForm() {
  const url = "/admin/savings/new-savings-form.php";
  axios
    .get(url)
    .then((response) => {
      formOverlay.classList.remove("d-none");
      formContainer.innerHTML = response.data;
    })
    .catch((error) => {
      const alert = document.createElement("div");
      alert.className = "alert alert-danger";
      alert.innerHTML = "<b>Loading Error</b>";
      formContainer.appendChild(alert);
      console.log(error);
    })
    .then(() => {
      const cancelBtn = document.querySelectorAll(".close-btn");
      cancelBtn.forEach((btn) => {
        btn.addEventListener("click", () => {
          formOverlay.classList.add("d-none");
        });
      });
    });
}

export { loadSavingForm, formOverlay };

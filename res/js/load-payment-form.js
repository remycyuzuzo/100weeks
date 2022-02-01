import HTML from "./form-validators/univalidator-module.js";

const formContainer = document.querySelector(".form-overlay .form-container");
const formOverlay = document.querySelector(".form-overlay");

function loadPaymentForm(url) {
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
      const paymentForm = document.querySelector("#payment-form");
      const requiredFields = document.querySelectorAll("[data-required]");

      cancelBtn.forEach((btn) => {
        btn.addEventListener("click", () => {
          formOverlay.classList.add("d-none");
        });
      });

      paymentForm.addEventListener("submit", (e) => {
        e.preventDefault();

        let formValidated = true;

        requiredFields.forEach((element) => {
          if (element.value == "") {
            HTML.alert("required field", element);
            formValidated = false;
          }
        });

        if (!formValidated) return;
        const data = new FormData(paymentForm);
        const alert = document.createElement("div");
        alert.className = "alert alert-success";
        axios
          .post(paymentForm.action, data)
          .then((response) => {
            if (response.data.dataStatus == "success") {
              alert.innerHTML = "payment registered successfully!";
            } else {
              throw `error in the database: ${response.data.error}`;
            }
          })
          .catch((err) => {
            console.log(err);
            alert.innerHTML = "internal error: Contact the administrator";
            alert.className = "alert alert-danger";
          })
          .then(() => {
            paymentForm.appendChild(alert);
          });
      });

      requiredFields.forEach((element) => {
        element.addEventListener("keyup", () => {
          if (element.value == "") return;
          HTML.clearErrors();
        });
      });
    });
}

export { loadPaymentForm, formOverlay };

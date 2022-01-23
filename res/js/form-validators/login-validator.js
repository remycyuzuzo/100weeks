// import axios from "axios";
import { Validate, UI } from "./form-validate-module.js";

const emailField = document.querySelector("#email");
const passwordField = document.querySelector("#password");
const form = document.querySelector("#formLogin");
const validationMessage = document.querySelector("#validation");

const validator = new Validate();
form.addEventListener("submit", (e) => {
  e.preventDefault();
  if (!validator.validateEmail(emailField.value).result) {
    UI.showAlert(
      validator.validateEmail(emailField.value).message,
      "danger",
      validationMessage
    );
    return false;
  }

  if (!validator.validatePassword(passwordField.value).result) {
    UI.showAlert(
      validator.validatePassword(passwordField.value).message,
      "danger",
      validationMessage
    );
    return;
  }
  const formData = new FormData(form);
  const url = "/admin/backend/login_backend.php";
  UI.showAlert("loading...", "", validationMessage);
  axios
    .post(url, formData)
    .then((response) => {
      if (response.data.result) {
        UI.showAlert(response.data.message, "success", validationMessage);
        window.location = response.data.redirectURL;
      } else {
        console.log("error");
        UI.showAlert(response.data.message, "danger", validationMessage);
      }
    })
    .catch((error) => console.log(error));
});

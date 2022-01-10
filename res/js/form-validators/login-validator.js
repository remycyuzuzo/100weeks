import { Validate, UI, Data } from "./form-validate-module.js";

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

  form.submit();
});

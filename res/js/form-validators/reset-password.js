import { Validate, UI } from "./form-validate-module.js";

const pass1 = document.querySelector("#password");
const pass2 = document.querySelector("#retype-password");
const form = document.querySelector("[data-form]");
const validateDiv = document.querySelector("[data-validate]");

const validator = new Validate();

form.onsubmit = (e) => {
  e.preventDefault();
  let validatePassword = validator.validatePassword(pass1.value);
  if (validatePassword.result) {
    if (pass1.value !== pass2.value) {
      validatePassword.message = "password mismatch";
      UI.showAlert(validatePassword.message, "danger", validateDiv);
      return false;
    }
    form.submit();
  } else {
    UI.showAlert(validatePassword.message, "danger", validateDiv);
    return;
  }
};

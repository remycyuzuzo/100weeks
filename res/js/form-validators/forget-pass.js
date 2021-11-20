import { Validate, UI } from "./form-validate-module.js";

const emailElement = document.querySelector("#email");
const form = document.querySelector("[data-form]");
const validateDiv = document.querySelector("[data-validate]");

const validator = new Validate();
form.onsubmit = (e) => {
  e.preventDefault();
  const validateEmail = validator.validateEmail(emailElement.value);

  if (validateEmail.result) {
    form.submit();
  } else {
    UI.showAlert(validateEmail.message, "danger", validateDiv);
    return false;
  }
};

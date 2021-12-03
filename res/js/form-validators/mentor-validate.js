import { Validate } from "./form-validate-module.js";
const requiredFields = document.querySelectorAll("[data-required]");
const validationMsgDiv = document.querySelectorAll(".validation-message");
const validatedField = document.querySelectorAll(".validated");
const email = document.querySelector("#email");

const form = document.querySelector("form");

class HTML {
  static isFormOk = {
    validEmail: false,
    notEmptyFields: false,
  };
  static appendError(message, element) {
    let validatorElement = element.parentElement.lastChild;
    validatorElement.classList.add("text-danger");
    element.classList.add("border-danger");
    element.classList.add("validated-field");
    validatorElement.innerText = message;
  }
  static appendErrorDiv(element) {
    let validatorElement = document.createElement("span");
    element.parentElement.appendChild(validatorElement);
    validatorElement.classList.add("validation-message");
  }
  static removeError(element) {
    let validatorElement = element.parentElement.lastChild;
    validatorElement.classList.remove("text-danger");
    element.classList.remove("border-danger");
    validatorElement.innerText = null;
  }
}

requiredFields.forEach((element) => {
  HTML.appendErrorDiv(element);
});
HTML.appendErrorDiv(email);
const validator = new Validate();

form.addEventListener("submit", (e) => {
  e.preventDefault();
  requiredFields.forEach((element) => {
    if (element.value.length === 0) {
      HTML.isFormOk.notEmptyFields = false;
      HTML.appendError("this is a required field", element);
    } else HTML.isFormOk.notEmptyFields = true;
  });
  if (email.value.length > 0 && !validator.validateEmail(email.value).result) {
    HTML.isFormOk.validEmail = false;
    HTML.appendError("this is an invalid email address", email);
  } else HTML.isFormOk.validEmail = true;

  if (HTML.isFormOk.validEmail && HTML.isFormOk.notEmptyFields) {
    form.submit();
  } else return false;
});

requiredFields.forEach((element) => {
  element.addEventListener("blur", () => {
    if (element.value.length !== 0) {
      HTML.removeError(element);
    } else {
      HTML.appendError("this can't be empty", element);
    }
  });
});

requiredFields.forEach((element) => {
  element.addEventListener("keyup", () => {
    if (element.value.length !== 0) {
      HTML.removeError(element);
    } else {
      HTML.appendError("this can't be empty", element);
    }
  });
});

email.addEventListener("keyup", () => {
  if (email.value.length <= 0 || validator.validateEmail(email.value).result) {
    HTML.removeError(email);
  } else if (
    email.value.length > 0 &&
    !validator.validateEmail(email.value).result
  ) {
    HTML.appendError("invalid email address", email);
  }
});
import { Validate } from "./form-validate-module.js";
const requiredFields = document.querySelectorAll("[data-required]");
const validationMsgDiv = document.querySelectorAll(".validation-message");
const validatedField = document.querySelectorAll(".validated");
const email = document.querySelector("#email");
const resultDiv = document.querySelector("[data-result]");
/** @var {HTMLInputElement} chkAccept */
const chkAccept = document.querySelector("form #accept");

const form = document.querySelector("form");

class HTML {
  /** this object will help me to know wether every field is filled accordingly */
  static isFormOk = {
    // these are default values
    validEmail: false,
    notEmptyFields: false,
  };
  static appendError(message, element) {
    console.log(element);
    let validatorElement = element.parentElement.lastChild;
    validatorElement.classList.add("text-danger");
    element.classList.add("border-danger");
    element.classList.add("validated-field");
    validatorElement.innerHTML = message;
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
    validatorElement.innerHTML = null;
  }
}

/** create an error div/span after every element which is required */
requiredFields.forEach((element) => {
  HTML.appendErrorDiv(element);
});
HTML.appendErrorDiv(email);

/** object to access an imported Validate class */
const validator = new Validate();

function isFormValidated() {
  // loop through out all elements with the attribute data-required
  requiredFields.forEach((element) => {
    if (element.value.length === 0) {
      HTML.appendError("this is a required field", element);
      return false;
    }
  });
  if (email.value.length > 0 && !validator.validateEmail(email.value).result) {
    HTML.appendError("this is an invalid email address", email);
    return false;
  }
  return true;
}

/** listening to the form submit event */
form.addEventListener("submit", (e) => {
  // prevent the form from instantly submit without validations
  e.preventDefault();

  if (!isFormValidated()) return;

  if (!chkAccept.checked) {
    HTML.appendErrorDiv(chkAccept);
    HTML.appendError(
      "<br>You have to agree that every data is correct",
      chkAccept
    );
    return;
  }
  // if the form is validated well, submit the form
  const formData = new FormData(form);
  const url = form.action;
  submitFormData(formData, url);
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

function displayAlert(message, type = "success") {
  const alert = document.createElement("div");
  alert.className = `alert alert-${type}`;
  alert.innerHTML = `${message}`;

  return alert;
}

function submitFormData(data, url) {
  axios.post(url, data).then((response) => {
    if (response.data.dataStatus === "success") {
      resultDiv.innerHTML = displayAlert(response.data.message).outerHTML;
    } else if (response.data.dataStatus === "dbError") {
      resultDiv.innerHTML = displayAlert(
        response.data.errorMessage,
        "warning"
      ).outerHTML;
    } else {
      resultDiv.innerHTML = displayAlert(
        response.data.message,
        "warning"
      ).outerHTML;
    }
  });
}

export default HTML;

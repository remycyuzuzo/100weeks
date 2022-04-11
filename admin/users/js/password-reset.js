import { Validate, UI } from "/res/js/form-validators/form-validate-module.js";

const pass1 = document.querySelector("#password");
const pass2 = document.querySelector("#retype-password");
const form = document.querySelector("[data-form]");
const validateDiv = document.querySelector("[data-validate]");

const validator = new Validate();

const submitFormData = (data, url) => {
  axios.post(url, data).then((response) => {
    if (response.status !== 200) {
      console.log("request failed, check the network");
      return;
    }
    if (response.data.result)
      UI.showAlert(response.data.message, "success", validateDiv);
    else if (!response.data.result)
      UI.showAlert(
        `Something went wrong: ${response.data.errMessage}`,
        "danger",
        validateDiv
      );
    else if (response.data == "")
      UI.showAlert("The server returned empty result", "danger", validateDiv);
  });
};

form.onsubmit = (e) => {
  e.preventDefault();
  let validatePassword = validator.validatePassword(pass1.value);
  if (validatePassword.result) {
    if (pass1.value !== pass2.value) {
      validatePassword.message = "password mismatch";
      UI.showAlert(validatePassword.message, "danger", validateDiv);
      return false;
    }
    const data = new FormData(form);
    const url = form.action;
    submitFormData(data, url);
  } else {
    UI.showAlert(validatePassword.message, "danger", validateDiv);
    return;
  }
};

import { UI } from "./form-validate-module.js";

const codeElement = document.querySelector("[data-code]");
const form = document.querySelector("form");
const validateDiv = document.querySelector("#validate");

form.addEventListener("submit", (e) => {
  e.preventDefault();
  if (codeElement.value.length < 6) {
    UI.showAlert("code is too short", "danger", validateDiv);
    return;
  }
  if (codeElement.value.length > 6) {
    UI.showAlert("code is too long", "danger", validateDiv);
    return;
  }
});
codeElement.addEventListener("keyup", () => UI.hideAlert());

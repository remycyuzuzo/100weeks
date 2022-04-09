// all required fields must have an data-required attribute

/**
 *
 * @param {string} msg
 * @param {HTMLDivElement} el
 */
const createAlertMsg = (msg, el) => {
  const div = document.createElement("div");
  div.className = "text-danger error-msg";
  div.innerHTML = `${msg}`;
  el.after(div);
};

const isEmpty = (requiredField) => {
  let empty = true;
  if (requiredField.value != "") {
    empty = false;
  }
  return empty;
};

const clearErrors = () => {
  const errorTexts = document.querySelectorAll("div.error-msg");
  if (errorTexts.length <= 0) return;
  errorTexts.forEach((element) => {
    element.remove();
  });
};

/**
 *
 * @param {HTMLInputElement} requiredFields
 * @returns
 */
const checkEmptyFields = (requiredFields) => {
  let valid = false;
  requiredFields.forEach((requiredField) => {
    if (isEmpty(requiredField)) {
      createAlertMsg("this is required", requiredField);
      return;
    } else valid = true;
  });
  return valid;
};

const submitForm = (data, url) => {
  axios
    .post(url, data)
    .then((response) => {
      if (response.status !== 200) {
        document.querySelector(
          "[data-result]"
        ).innerHTML = `something went wrong`;
      }
      if (response.data.result) {
        document.querySelector(
          "[data-result]"
        ).innerHTML = `User updated! please wait..`;
        window.location = "/admin/users/?completed=update-coach&status=success";
      } else {
        document.querySelector(
          "[data-result]"
        ).innerHTML = `<div class="alert alert-warning">${response.data.errMessage}</div>`;
      }
    })
    .catch((err) => {});
};

/**
 *
 * @param {HTMLFormElement} form
 */
const validate = (form) => {
  const requiredFields = document.querySelectorAll("[data-required]");
  let isFormValidated = false;
  form.addEventListener("submit", (e) => {
    clearErrors(); // before validating, remove all error messages if any
    e.preventDefault();
    if (!checkEmptyFields(requiredFields)) return;
    const data = new FormData(form);
    const url = form.action;
    submitForm(data, url);
  });
  return isFormValidated;
};

const form = document.querySelector("form");
validate(form);

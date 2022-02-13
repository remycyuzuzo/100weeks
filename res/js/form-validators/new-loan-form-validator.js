import HTML from "./univalidator-module.js";

/**
 *
 * @param {HTMLInputElement} requiresFields
 */
function validateForm(requiresFields) {
  let formValidated = true;

  // check whether each required element is filled, if not, append an error text
  requiresFields.forEach((element) => {
    element.addEventListener("keyup", () => {
      if (!formValidated) {
        HTML.clearErrors(element.nextSibling);
      }
    });
    if (element.value.length <= 0) {
      HTML.alert("you must fill this", element);
      formValidated = false;
    }
  });
  return formValidated;
}

export { validateForm };

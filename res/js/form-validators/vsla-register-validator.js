(function () {
  const requiredElements = document.querySelectorAll("[data-required]");
  

  class HTML {
    /** this object will help me to know wether every field is filled accordingly */
    static isFormOk = {
      // these are default values
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
})();

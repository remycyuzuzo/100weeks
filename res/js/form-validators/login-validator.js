const emailField = document.querySelector("#email");
const passwordField = document.querySelector("#password");
const loginButton = document.querySelector("[data-dubmit]");
const form = document.querySelector("#formLogin");
const validationMessage = document.querySelector("#validation");

class UI {
  static showAlert(message, className, where) {
    where.classList.add("alert");
    where.classList.add(`alert-${className}`);
    where.innerText = message;
  }
}
class Validate {
  constructor(emailAddress, password) {
    this.emailAddress = emailAddress;
    this.password = password;
  }
  validateEmail() {
    const regExp =
      /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (!regExp.test(this.emailAddress)) {
      return {
        result: false,
        message: "please enter your email correctly",
      };
    } else {
      return { result: true };
    }
  }
  validatePassword() {
    if (this.password.length <= 0) {
      return { result: false, message: "your password is empty" };
    } else return { result: true };
  }
}

const validator = new Validate(emailField.innerText, passwordField.innerText);
form.addEventListener("submit", (e) => {
  e.preventDefault();
  if (!validator.validateEmail().result) {
    UI.showAlert(
      validator.validateEmail().message,
      "danger",
      validationMessage
    );
    return false;
  }

  if (!validator.validatePassword().result) {
    UI.showAlert(
      validator.validatePassword().message,
      "danger",
      validationMessage
    );
    return false;
  }

  form.submit();
});

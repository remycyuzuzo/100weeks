export class Validate {
  validateEmail(email) {
    // /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
    const regexExp =
      /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (!regexExp.test(email)) {
      return {
        result: false,
        message: "enter a valid email address",
      };
    } else {
      return { result: true };
    }
  }
  validatePassword(password) {
    if (password.length <= 0) {
      return { result: false, message: "your password is empty" };
    } else return { result: true };
  }
}

/**
 * Manipulation of the interface while validating forms
 */
export class UI {
  static showAlert(message, className, where) {
    this.alert = where;
    this.alertClassName = className;
    this.alert.classList.add("alert");
    this.alert.classList.add(`alert-${className}`);
    this.alert.innerText = message;
  }

  static hideAlert() {
    this.alert.classList.remove("alert");
    this.alert.classList.remove(`alert-${this.alertClassName}`);
    this.alert.innerText = "";
  }
}

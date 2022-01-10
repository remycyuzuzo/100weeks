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

/**
 * Using ajax to send data via http
 * via AXIOS libraly
 */
export class Data {
  constructor(email, password, form) {
    this.password = password;
    this.email = email;
    this.form = form;

    this.sendData();
    this.returnedData = returnData();
  }

  returnData() {
    console.log(this.returnedData);
    return this.returnedData;
  }

  sendData() {
    const url = this.form.action;
    console.log(url);
    axios({
      method: "post",
      url: url,
      data: {
        email: this.email,
        password: this.password,
      },
      headers: { "Content-Type": "multipart/form-data" },
    })
      .then((response) => {
        // handle success
        console.log(response.data);
        let msg = response.data;
        if (response.data.res === true) {
          this.returnedData = {
            result: true,
            message: msg.message,
          };
        } else {
          this.returnedData = {
            result: false,
            message: msg.message,
          };
        }
      })
      .catch(function (error) {
        // handle error
        console.log("error: ", error);
      })
      .then(function () {
        console.log("always run");
      });
  }
}

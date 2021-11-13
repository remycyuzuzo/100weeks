(function () {
    const emailField = document.querySelector("#email");
    const passwordField = document.querySelector("#password");
    const loginButton = document.querySelector("[data-dubmit]");
    const form = document.querySelector("#formLogin");
    class Form {
       static validateEmail(email) {
            if (email.length<=0) {
                return {
                    result: false,
                    message: "email address is required"
                }
            } else {
                const pattern = /([a-z]|[0-9])\@([a-z])\.([a-z])/;
                if (!pattern.test(email)) {
                    return {
                        result: false,
                        message: "enter a valid email address"
                    }
                }
                return {
                    result: true,
                    message: "ok"
                }
            }
        }

        static validatePassword(password) {
            if (password.length <= 0) {
                return {
                    result: false,
                    message: "your password must no be empty"
                }
            }
        }

        static showAlert(message, type, where) {
            // if (where.parentElement.contains(document.querySelector(`span.text-${type}`))) {
            //     console.log(alert, ": already exists")
            //     return false
            // }
            const alert = document.createElement('span')
            alert.innerHTML = message
            alert.className = `text-${type}`;
            console.log(where.parentElement.children.find(document.querySelector(`span.text-danger`)), "parent: ", where.parentElement)
            
            where.parentElement.appendChild(alert);
            setTimeout(() => {
                alert.remove();
            }, 3000);
        }
    }
    form.addEventListener('submit', e => {
        e.preventDefault();
        if(!Form.validateEmail(emailField.value).result)
            {
                const msg = Form.validateEmail(emailField.value).message;
                Form.showAlert(msg, 'danger', emailField)
               
        }
        if (!Form.validatePassword(passwordField.value).result) {
             // create an element
             const msg = Form.validatePassword(passwordField.value).message;
             Form.showAlert(msg, 'danger', passwordField)
        }
    })
})()
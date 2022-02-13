import { validateForm } from "./form-validators/new-loan-form-validator.js";

function loadLoanForm() {
  const moduleGrobals = {
    isIDLegit: true,
    dismissAlert: (alertDiv) => {
      alertDiv.innerHTML = "";
    },
  };
  /**
   * @var {bool} isIDLegit
   * this is a block scope variable which will either allow or block form submission if the person is not eligible for the loan
   */

  const url = "/admin/loans/new-loan-form.php";
  axios
    .get(url)
    .then((response) => {
      location.innerHTML = response.data;
    })
    .catch((err) => console.log(err))
    .then(() => {
      const idNumberField = document.querySelector(
        "[data-fetchbeneficiarydata]"
      );

      const newDivNode = document.createElement("div");

      moduleGrobals.IDNumberField = idNumberField.parentElement.insertBefore(
        newDivNode,
        idNumberField.nextSibling
      );
      const newDiv = moduleGrobals.IDNumberField;

      idNumberField.addEventListener("blur", () => {
        if (idNumberField.value.length > 0) {
          newDiv.innerHTML = `<i class="fas fa-spinner"></i> fetching beneficiary data...`;
          axios
            .get(
              `/admin/backend/load_beneficiary_info.php?beneficiary_id=${idNumberField.value}`
            )
            .then((response) => {
              newDiv.className = "form-group col-md-6";
              if (response.data.result) {
                moduleGrobals.isIDLegit = true;
                newDiv.innerHTML = `
                  <div class="my-2">
                    <div>Name: <strong>${response.data.beneficiaryName}</strong></div>
                    <div>VSLA: <strong>${response.data.beneficiaryVSLA}</strong></div>
                  </div>
                `;
              } else {
                moduleGrobals.isIDLegit = false;
                newDiv.innerHTML = `
                  <div class="my-2">
                    <strong>${response.data.message}</strong>
                  </div>
                `;
              }
            })
            .catch((err) => console.log(err));
        }
      });
    })
    .then(() => {
      /** @var {HTMLFormElement} form*/
      const form = document.querySelector("#form");
      const requiresFields = document.querySelectorAll("[data-required]");

      form.addEventListener("submit", (e) => {
        e.preventDefault();
        if (!validateForm(requiresFields) || !moduleGrobals.isIDLegit) {
          return;
        }

        moduleGrobals.responseDiv = document.querySelector("[data-response]");
        const formData = new FormData(form);
        const responseDiv = moduleGrobals.responseDiv;
        const url = form.action;

        // Let the user know that the form is being submitted
        responseDiv.innerHTML = `<i class="fas fa-spinner"></i> please wait...`;
        moduleGrobals.formSubmitBtn =
          document.querySelector("[data-submitbtn]");
        moduleGrobals.formSubmitBtn.disabled = true;

        // send data to the backend with a POST method
        axios
          .post(url, formData)
          .then((response) => {
            if (response.data.result) {
              responseDiv.innerHTML = `
              <div class="alert alert-success"> 
                ${response.data.message} 
                <div class="text-black">
                  <strong>beneficiary: </strong> ${response.data.beneficiaryID}<br>
                  <strong>loan: </strong> ${response.data.amount} Rwf<br>
                  <strong>Interest Rate: </strong> ${response.data.interestRate}%<br>
                  <strong>Interest: </strong> ${response.data.interest}<br>
                  <strong>Deadline: </strong> ${response.data.deadline}<br>
                  <strong>TOTAL (with interest): </strong> ${response.data.totalDebt} Rwf<br>
                  <button type="button" class="btn btn-success" data-dismiss>okay</button>

                </div>
              </div>
            `;
              //the reset the form to avoid submitting twice
              moduleGrobals.IDNumberField.innerHTML = "";
              form.reset();
            } else {
              responseDiv.innerHTML = `
                <div class="alert alert-danger"> 
                  ${response.data.message} 
                  <button type="button" class="btn btn-danger" data-dismiss>dismis</button>  
                </div>
              `;
            }

            moduleGrobals.formSubmitBtn.disabled = false;
          })
          .catch((err) => {
            console.log("error: ", err);
            moduleGrobals.responseDiv.innerHTML = `${response.data.message}`;
          })
          .then(() => {
            document
              .querySelector("[data-dismiss]")
              .addEventListener("click", () => {
                moduleGrobals.dismissAlert(moduleGrobals.responseDiv);
              });
          });
      });
    });
}

export { loadLoanForm };

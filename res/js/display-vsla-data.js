import { loadPaymentForm } from "./load-payment-form.js";

/**
 * @function loadTable
 * Loads the table consisting the list of VSLAs with members of each one
 */
export function loadTable() {
  // console.log(tabs);
  const contDiv = document.querySelector(".vsla-list");

  const showAlert = (message, type = "danger") => {
    const div = document.createElement("div");
    div.className = `alert alert-${type}`;
    div.innerHTML = `${message}`;
    contDiv.appendChild(div);
  };

  /**
   *
   * @param {string} className
   * @param {string} launchForm
   * @param {int} memberID
   * @returns {HTMLButtonElement}
   */
  function newPaymentButton(className, launchForm, memberID) {
    const button = document.createElement("button");
    button.className = `${className}`;
    button.classList.add("mr-2");
    button.dataset.launchform = `${launchForm}`;
    button.dataset.memberid = memberID;
    let buttonInnerHTML = `<i class="fas fa-plus-circle"></i> `;

    if (launchForm === "savings") buttonInnerHTML += "savings";
    else if (launchForm === "socialfunds") buttonInnerHTML += "social funds";
    else if (launchForm === "loan") buttonInnerHTML += "loan";

    button.innerHTML = `${buttonInnerHTML}`;

    return button;
  }

  const url = "/admin/savings/retrieve_users_per_VSLA.php?getBeneficiaryVSLA";
  axios
    .get(url)
    .then((response) => {
      if (response.data.dataStatus == "nodata") {
        showAlert("nothing to display - data will be displayed here", "info");
        return;
      }

      if (response.data.dataStatus === "error") {
        showAlert("there is system error: contact the system admin");
        return;
      }

      response.data.forEach((vsla) => {
        const vslaDiv = document.createElement("div");
        const table = document.createElement("table");
        const tableDiv = document.createElement("div");

        const thead = table.createTHead();
        const tbody = table.createTBody();

        thead.innerHTML = `<th>#</th><th>Name</th><th class="idcardCell">ID number</th><th></th>`;

        let h3 = document.createElement("h3");
        h3.innerText = `VSLA: ${vsla.VSLA_name}`;
        vslaDiv.appendChild(h3);
        let i = 0;

        vsla.members.forEach((member) => {
          let trow = tbody.insertRow();
          trow.setAttribute("data-memberid", member.beneficiary_id_card);

          trow.innerHTML = `<td>${++i}</td><td>${member.fname} ${
            member.lname
          }</td><td class="idcardCell">${member.beneficiary_id_card}</td>
          `;

          const buttonColumnCell = trow.insertCell();

          buttonColumnCell.appendChild(
            newPaymentButton(
              "savings btn btn-primary btn-sm new-saving",
              "savings",
              member.beneficiary_id_card
            )
          );

          buttonColumnCell.appendChild(
            newPaymentButton(
              "social-funds btn btn-secondary btn-sm",
              "socialfunds",
              member.beneficiary_id_card
            )
          );
          if (member.finance_data.result) {
            // display the loan buttononly if the beneficiary has an active loan to pay
            if (member.finance_data.hasActiveLoan == true) {
              buttonColumnCell.appendChild(
                newPaymentButton(
                  "loan btn btn-success btn-sm",
                  "loan",
                  member.beneficiary_id_card
                )
              );
            }
          }
        });

        tableDiv.appendChild(table);
        vslaDiv.appendChild(tableDiv);
        contDiv.appendChild(vslaDiv);

        table.className = "table table-striped";
        tableDiv.className = "table-responsive";
      });

      const trigger = document.querySelectorAll("[data-launchform]");

      trigger.forEach((element) => {
        element.addEventListener("click", () => {
          let url = "";

          if (element.dataset.launchform == "savings")
            url = `/admin/savings/new-savings-form.php?member_id=${element.dataset.memberid}`;
          else if (element.dataset.launchform == "socialfunds")
            url = `/admin/social-funds/register-social-funds-form.php?member_id=${element.dataset.memberid}`;
          else if (element.dataset.launchform == "loan")
            url = `/admin/savings/new-savings-form.php?member_id=${element.dataset.memberid}`;
          else return;

          loadPaymentForm(url);
        });
      });
    })
    .catch((error) => {
      console.log(error);
      showAlert(
        "There was an error while getting your data, contact the administrator"
      );
    });
}

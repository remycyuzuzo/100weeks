import { loadPaymentForm } from "./load-payment-form.js";
export function loadTable() {
  // console.log(tabs);
  const contDiv = document.querySelector(".vsla-list");

  const showAlert = (message, type = "danger") => {
    const div = document.createElement("div");
    div.className = `alert alert-${type}`;
    div.innerHTML = `${message}`;
    contDiv.appendChild(div);
  };

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
          <td class="align-right">
            <button class="savings btn btn-primary btn-sm new-saving" data-launchform="savings" data-memberid='${
              member.beneficiary_id_card
            }'">saving <i class="fas fa-plus-circle"></i></button>
            <button class="social-funds btn btn-secondary btn-sm" data-launchform="socialfunds" data-memberid='${
              member.beneficiary_id_card
            }'">social funds <i class="fas fa-plus-circle"></i></button>
            <button class="loan btn btn-success btn-sm" data-launchform="loan" data-memberid='${
              member.beneficiary_id_card
            }'">loan <i class="fas fa-plus-circle"></i></button>
          </td>`;
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

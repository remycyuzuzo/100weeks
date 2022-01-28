import { loadSavingForm } from "./load-savings-form.js";
export function loadTable() {
  // console.log(tabs);
  const contDiv = document.querySelector(".vsla-list");

  const showAlert = (message, type = "danger") => {
    const div = document.createElement("div");
    div.className = "alert";
    div.classList.add(`alert-${type}`);
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
        const thead = table.createTHead();
        const tbody = table.createTBody();

        thead.innerHTML = `<th>#</th><th>Name</th><th>ID number</th><th></th>`;

        let h3 = document.createElement("h3");
        h3.innerText = `VSLA: ${vsla.VSLA_name}`;
        vslaDiv.appendChild(h3);
        let i = 0;

        vsla.members.forEach((member) => {
          let trow = tbody.insertRow();
          trow.innerHTML = `<td>${++i}</td><td>${member.fname} ${
            member.lname
          }</td><td>${member.beneficiary_id_card}</td>
          <td><button data-memberid='${
            member.beneficiary_id_card
          }'">Add</button></td>`;
        });

        vslaDiv.appendChild(table);
        contDiv.appendChild(vslaDiv);

        table.className = "table";
      });
      const button = document.querySelectorAll("[data-memberid]");

      button.forEach((element) => {
        element.className = "btn btn-secondary btn-sm new-saving";
        element.innerHTML = `new saving <i class="fas fa-plus-circle"></i>`;
        element.addEventListener("click", () => {
          loadSavingForm();
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

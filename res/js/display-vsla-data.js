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
      console.log(response);
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

        let h3 = document.createElement("h3");
        h3.innerText = `VSLA: ${vsla.VSLA_name}(${vsla.VSLA_id})`;
        vslaDiv.appendChild(h3);
        vsla.members.forEach((member) => {
          let trow = table.insertRow();
          trow.innerHTML = `<td>${member.fname} ${member.lname}</td><td>${member.beneficiary_id_card}</td>`;
        });
        vslaDiv.appendChild(table);
        contDiv.appendChild(vslaDiv);

        table.className = "table";
      });
    })
    .catch((error) => {
      console.log(error);
      showAlert(
        "There was an error retrieving the data.. check your connectivity"
      );
    });
}

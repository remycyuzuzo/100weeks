function loadGeneralReportTable() {
  const resultDiv = document.querySelector(".report-table");
  const url = "/admin/reports/load_general_report.php";
  axios
    .get(url)
    .then((response) => {
      console.log(response.data);
      if (response.data.result === true) {
        // create an table wrapper
        const tableContainer = document.createElement("div");
        tableContainer.className = "table-responsive";

        // create the table
        const table = document.createElement("table");
        table.className = "table table-stripped";
        table.id = "datatable";

        // insert tHead
        const thead = table.createTHead();
        thead.innerHTML = `
            <tr>
                <th>#</th>
                <th>Parishes</th>
                <th>Number of VSLAs</th>
                <th>Members</th>
                <th>total paid</th>
                <th>penalties</th>
                <th>total in-debt</th>
                <th>Date issued</th>
                <th>Due date</th>
            </tr>
          `;

        // create table tbody
        const tBody = table.createTBody();

        // place data into row cells
        response.data.loanHolders.forEach((dataRow, index) => {
          const tBodyRow = tBody.insertRow();
          tBodyRow.innerHTML = `
              <td> ${(index += 1)} </td>
              <td> ${dataRow.fname} ${dataRow.lname} </td>
              <td> ${dataRow.beneficiary_id_card}</td>
              <td> ${toCurrency(parseFloat(dataRow.loan_amount))} </td>
              <td> ${toCurrency(dataRow.total_loan_paid)} </td>
              <td> ${toCurrency(0)} </td>
              <td> ${toCurrency(dataRow.debt_left)} </td>
              <td> ${dataRow.approval_date} </td>
              <td> ${dataRow.loan_due_date} </td>
            `;
        });

        tableContainer.appendChild(table);
        resultDiv.appendChild(tableContainer);
      }
      //
      else if (response.data.result === null) {
        console.log(response.data.message);
        const alert = createAlert(response.data.message, "info");
        resultDiv.appendChild(alert);
      } else if (response.data.result === false) {
        throw "PHP error: " + response.data.message;
      }
    })
    .catch((err) => {
      let alert = createAlert(
        "something went wrong, refresh the page, if the error keep appearing, contact the administrator",
        "danger"
      );
      resultDiv.appendChild(alert);
      console.log(err);
    });
}

function createAlert(text, type = "danger") {
  const alert = document.createElement("div");
  alert.className = `alert alert-${type}`;
  alert.innerHTML = text;

  return alert;
}

function toCurrency(floatNumber) {
  floatNumber = parseFloat(floatNumber);
  return new Intl.NumberFormat("en-IN", {
    style: "currency",
    currency: "RWF",
    minimumFractionDigits: 2,
  }).format(floatNumber);
}

export { loadGeneralReportTable };

function loadGeneralReportTable() {
  const resultDiv = document.querySelector(".report-table");
  const url = "/admin/reports/generate_report_draft.php";
  axios
    .get(url)
    .then((response) => {
      if (response.data.result === true) {
        // create an table wrapper div
        const tableContainer = document.createElement("div");
        tableContainer.className = "table-responsive";

        // create the table
        const table = document.createElement("table");
        table.className = "table table-bordered table-hover";

        // insert tHead
        const thead = table.createTHead();
        thead.innerHTML = `
            <tr>
                <th rowspan="2">#</th>
                <th rowspan="2">Parishes</th>
                <th rowspan="2">Number of VSLAs</th>
                <th rowspan="2">Members</th>
                <th colspan="2">Savings</th>
                <th colspan="2">Loans</th>
                <th rowspan="2">Social funds</th>
                <th colspan="2">Other assets</th>
                <th rowspan="2">Total</th>
            </tr>
            <tr>
              <th>Nber</th>
              <th>Value</th>
              <th>Nber</th>
              <th>Value</th>              
              <th>Nature</th>
              <th>Values</th>            
            </tr>
          `;

        // create table tbody
        const tBody = table.createTBody();

        // place data into row cells
        response.data.parishes.forEach((dataRow, index) => {
          const tBodyRow = tBody.insertRow();
          tBodyRow.innerHTML = `
              <td> <strong>${(index += 1)}</strong> </td>
              <td> ${dataRow.parishName}</td>
              <td> ${dataRow.numberOfVSLAs}</td>
              <td> ${dataRow.totalMembersInZone} </td>
              <td> ${dataRow.numberOfSavings} </td>
              <td> ${toCurrency(dataRow.totalSavings)} </td>
              <td> ${dataRow.numberOfLoans} </td>
              <td> ${toCurrency(dataRow.totalLoanAmount)} </td>
              <td> ${dataRow.totalSocialFunds} </td>
              <td> N/A </td>
              <td> ${dataRow.valueOfVSLAAssets} </td>
              <td> ${toCurrency(dataRow.total)} </td>
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

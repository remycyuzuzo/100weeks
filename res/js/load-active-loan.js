/**
 *
 * @param {HTMLDivElement} location
 */
function loadActiveLoanList(location) {
  const url = "/admin/loans/active-loans.php";
  axios
    .get(url)
    .then((response) => {
      location.innerHTML = response.data;
    })
    .catch((err) => console.log(err));
}

export { loadActiveLoanList };

function loadLoanForm() {
  const url = "/admin/loans/new-loan-form.php";
  axios
    .get(url)
    .then((response) => {
      location.innerHTML = response.data;
    })
    .catch((err) => console.log(err));
}

export { loadLoanForm };

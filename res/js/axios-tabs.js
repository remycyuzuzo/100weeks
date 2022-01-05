// Make a request for a user with a given ID
link = document.querySelector("#link");
r = document.querySelector(".tab-contents");
link.addEventListener("click", (e) => {
  e.preventDefault();
  r.innerHTML = "Loading..";
  axios
    .get("./tests/page.php")
    .then(function (response) {
      // handle success
      console.log(response);
      r.innerHTML = response.data;
    })
    .catch(function (error) {
      // handle error
      console.log(error);
    })
    .then(function () {
      console.log("always run");
    });
});

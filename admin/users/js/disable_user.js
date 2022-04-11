const links = document.querySelectorAll("[data-disable]");

const showAlert = (
  message,
  type,
  where = document.querySelector("[data-results]")
) => {
  where.className = `my-2 alert alert-${type}`;
  where.dataset.disappearing = true;
  where.innerHTML = `${message}  <a href="#" class="close">dismiss</a>`;
};

const enableDisableUser = (data) => {
  axios
    .post("/admin/users/disable_enable_user.php", data)
    .then((response) => {
      if (response.data.result) {
        showAlert(response.data.message, "success");
      } else {
        showAlert(response.data.errMessage, "danger");
      }
    })
    .catch((err) => console.warn(err));
};

links.forEach((link) => {
  link.addEventListener("click", (e) => {
    e.preventDefault();
    const user_data = {
      user_id: link.dataset.userid,
      user_type: link.dataset.usertype,
      action: link.dataset.action,
    };
    let message;
    if (user_data.action === "disable")
      message = `You are about to ${user_data.action} this user, they won't be able to sign in..\n Are you sure?`;
    else
      message = `You are about to ${user_data.action} this user, \n Are you sure?`;

    if (confirm(`${message}`)) enableDisableUser(user_data);
  });
});

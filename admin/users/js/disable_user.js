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

const enableDisableUser = async (data) => {
  let currentStatus = {};
  await axios
    .post("/admin/users/disable_enable_user.php", data)
    .then((response) => {
      if (response.data.result) {
        showAlert(response.data.message, "success");
        currentStatus.status = response.data.status;
      } else {
        showAlert(response.data.errMessage, "danger");
      }
    })
    .catch((err) => console.warn(err));
  console.log("status: ", currentStatus.status);
  return currentStatus.status;
};

links.forEach((link) => {
  link.addEventListener("click", async (e) => {
    e.preventDefault();
    const user_data = {
      user_id: link.dataset.userid,
      user_type: link.dataset.usertype,
      action: link.dataset.action,
    };
    const form = new FormData();
    form.append("user_id", user_data.user_id);
    form.append("user_type", user_data.user_type);
    form.append("action", user_data.action);

    let message;
    if (user_data.action === "disable")
      message = `You are about to ${user_data.action} this user, they won't be able to sign in..\nAre you sure?`;
    else
      message = `You are about to ${user_data.action} this user, \nAre you sure?`;

    if (confirm(`${message}`)) {
      const newStatus = await enableDisableUser(form);
      console.log(newStatus);
      link.dataset.action = newStatus === "active" ? "disable" : "enable";
      link.innerHTML = `${newStatus === "active" ? "disable" : "enable"}`;
      link.closest(
        "td"
      ).previousSibling.previousSibling.innerHTML = `${newStatus}`;
    }
  });
});

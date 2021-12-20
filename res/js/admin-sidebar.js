(function () {
  /** get necessary elements */
  const togglerBtn = document.querySelector("[data-toggler]");
  const sideBar = document.querySelector("aside.side-bar");
  const mainContents = document.querySelector("main.main-contents");

  togglerBtn.addEventListener("click", (e) => {
    e.preventDefault();
    if (sideBar.classList.contains("minimized")) {
      sideBar.classList.remove("minimized");
      mainContents.classList.remove("full");
    } else {
      sideBar.classList.add("minimized");
      mainContents.classList.add("full");
    }
  });
  if (window.innerWidth <= 768) {
    sideBar.classList.add("minimized");
    mainContents.classList.add("full");
  }
  window.addEventListener("resize", () => {
    setTimeout(() => {
      if (window.innerWidth <= 768) {
        sideBar.classList.add("minimized");
        mainContents.classList.add("full");
      } else {
        sideBar.classList.remove("minimized");
        mainContents.classList.remove("full");
      }
    }, 1000);
  });

  const submenu = document.querySelectorAll("aside ul li ul");

  submenu.forEach((element) => {
    let spanEl = document.createElement("span");
    let menuLink = element.parentElement.firstChild;
    menuLink.appendChild(spanEl);
    spanEl.classList.add("fas");
    spanEl.classList.add("fa-angle-down");
    spanEl.classList.add("toggler");

    menuLink.addEventListener("click", (e) => {
      e.preventDefault();
      if (element.parentElement.classList.contains("collapsed")) {
        element.parentElement.classList.remove("collapsed");
        element.parentElement.classList.remove("active");
        spanEl.classList.remove("rotated");
      } else {
        element.parentElement.classList.add("collapsed");
        element.parentElement.classList.add("active");
        spanEl.classList.add("rotated");
      }
    });
  });
})();

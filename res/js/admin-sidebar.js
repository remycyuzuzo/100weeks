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
})();
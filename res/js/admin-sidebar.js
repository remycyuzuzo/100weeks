(function () {
  /** get necessary elements */
  const togglerBtn = document.querySelector("[data-toggler]");
  const sideBar = document.querySelector("aside.side-bar");
  const mainContents = document.querySelector("main.main-contents");
  const overlay = document.querySelector("#overlay");

  const handleSideBar = () => {
    sideBar.classList.toggle("maximized");
    mainContents.classList.toggle("full");
    if (window.innerWidth <= 820 && sideBar.classList.contains("maximized")) {
      overlay.classList.remove("d-none");
    } else {
      overlay.classList.add("d-none");
    }
  };

  togglerBtn.addEventListener("click", (e) => {
    e.preventDefault();
    handleSideBar();
  });

  overlay.addEventListener("click", () => handleSideBar());

  if (window.innerWidth <= 820) {
    sideBar.classList.remove("maximized");
    mainContents.classList.remove("full");
  } else {
    sideBar.classList.add("maximized");
    mainContents.classList.add("full");
  }

  window.addEventListener("resize", () => {
    setTimeout(() => {
      if (window.innerWidth <= 820) {
        sideBar.classList.remove("maximized");
        mainContents.classList.remove("full");
      } else {
        sideBar.classList.add("maximized");
        mainContents.classList.add("full");
      }
    }, 100);
  });

  // add an active CSS class on the current page menu on the sidebar
  const links = document.querySelectorAll("aside ul a");
  let currentPage = window.location.pathname;
  const findPageUri = (pageFullPath) => {
    let pathArray = pageFullPath.split("/").slice(-1);
    if (pathArray[0] == "") {
      pathArray = pageFullPath.split("/").slice(-2);
    }
    return pathArray[0];
  };

  currentPage = findPageUri(currentPage);
  links.forEach((link) => {
    const href = findPageUri(link.attributes.href.value);

    if (href === currentPage) {
      link.parentElement.classList.add("active");
    }
  });

  // submenus
  const submenu = document.querySelectorAll("aside ul li ul");

  submenu.forEach((element) => {
    let spanEl = document.createElement("span");
    let menuLink = element.parentElement.firstChild;
    element.parentElement.classList.add("submenu");
    menuLink.appendChild(spanEl);
    // add an icon on the submenu
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

  const activeSubmenu = document.querySelectorAll("aside ul li ul li.active");
  activeSubmenu.forEach((element) => {
    element.closest("li.submenu").classList.add("collapsed");
    element.closest("li.submenu").classList.add("active");
  });
})();

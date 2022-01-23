// import { Tab } from "./bootstrap.min.js";
(function () {
  // elements

  const tabs = document.querySelectorAll("[data-vslaTab]");
  const activeTab = document.querySelector(".tab-nav a");

  const tabContents = document.querySelector(".tab-contents");

  class Tabs {
    constructor(tabs) {
      this.allTabs = tabs;
      this.storageData = localStorage.getItem("activeVslaTab");
      if (this.storageData === null) {
        this.activeTab = document.querySelector("[data-vslaTab=view-vsla]");
        this.setCurrentTab("view-vsla");
      } else {
        this.activeTab = document.querySelector(
          `[data-vslaTab=${this.storageData}]`
        );
        this.setCurrentTab(this.storageData);
      }
    }

    setCurrentTab(localStorageData) {
      this.currentTab = localStorageData;
      this.resetActiveClass();
      this.activeTab.classList.add("active");
      this.loadData();
    }

    resetActiveClass() {
      this.allTabs.forEach((tab) => {
        tab.className = "nav-link";
      });
    }

    loadData() {
      if (this.currentTab === null) return;
      let url = "";
      switch (this.currentTab) {
        case "view-vsla":
          url = "/admin/vsla/all-vslas.php";
          this.setLocalStorage("view-vsla");
          break;

        case "new-vsla":
          url = "/admin/vsla/vsla-creation.php";
          this.setLocalStorage("new-vsla");
          break;

        case "vsla-property":
          url = "/admin/vsla/vsla-properties.php";
          this.setLocalStorage("vsla-property");
          break;

        case "vsla-reports":
          url = "/admin/vsla/vsla-reports.php";
          this.setLocalStorage("vsla-reports");
          break;

        default:
          break;
      }
      this.showLoadingGif();
      axios
        .get(url)
        .then((response) => {
          // handle success
          this.hideLoadingGif();
          //   console.log(response);
          this.response = response;
          this.displayData(this.location);
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        })
        .then(() => {
          // this.displayData(this.location)
        });
    }

    displayData(location) {
      location.innerHTML = `${this.response.data}`;
    }

    setLocalStorage() {
      localStorage.setItem("activeVslaTab", this.currentTab);
    }

    showLoadingGif() {
      if (this.location)
        this.location.innerHTML = `<div class="d-flex flex-column align-items-center justify-content-center"><i class="fas fa-spinner"></i></div>`;
    }

    hideLoadingGif() {
      //   console.log("loading ended");
    }
  }

  const tabObj = new Tabs(tabs);
  tabObj.location = tabContents;
  tabObj.allTabs = tabs;

  tabs.forEach((tab) => {
    tab.onclick = (e) => {
      e.preventDefault();
      tabObj.activeTab = tab;
      tabObj.setCurrentTab(tab.dataset.vslatab);
    };
  });
})();

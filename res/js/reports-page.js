import { loadGeneralReportTable } from "./display-general-report.js";

// I didn't rename everything to payment, so don't get confused

const tabs = document.querySelectorAll("[data-reportstab]");

const tabContents = document.querySelector(".tab-contents");

class Tabs {
  constructor(tabs, location) {
    this.allTabs = tabs;
    this.location = location;
    this.storageData = localStorage.getItem("activeReportsTab");
    if (this.storageData) {
      this.activeTab = document.querySelector(
        `[data-reportstab=${this.storageData}]`
      );
      this.setCurrentTab(this.storageData);
    } else {
      this.activeTab = document.querySelector(
        "[data-reportstab=general-reports]"
      );
      this.setCurrentTab("general-reports");
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
      // tab.classList.add("fade");
    });
  }

  loadData() {
    if (this.currentTab === null) return;
    let url = "";
    switch (this.currentTab) {
      case "general-reports":
        url = "/admin/reports/general-reports.php";
        this.setLocalStorage("general-reports");
        break;

      default:
        url = "/admin/reports/general-reports.php";
        this.setLocalStorage("general-reports");
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
        loadGeneralReportTable();
      });
  }

  displayData(location) {
    location.innerHTML = `${this.response.data}`;
  }

  setLocalStorage() {
    localStorage.setItem("activeReportsTab", this.currentTab);
  }

  showLoadingGif() {
    if (this.location)
      this.location.innerHTML = `<div class="d-flex flex-column align-items-center h-100 justify-content-center"><i class="fas fa-spinner"></i> Loading</div>`;
  }

  hideLoadingGif() {
    //   console.log("loading ended");
  }
}

const tabObj = new Tabs(tabs, tabContents);

tabs.forEach((tab) => {
  tab.onclick = (e) => {
    e.preventDefault();
    tabObj.activeTab = tab;
    tabObj.setCurrentTab(tab.dataset.reportstab);
  };
});

import { loadLoanForm } from "./load-loan-registation-form.js";
import { loadActiveLoanList } from "./load-active-loan.js";
const tabs = document.querySelectorAll("[data-loantab]");

const tabContents = document.querySelector(".tab-contents");

class Tabs {
  constructor(tabs, location) {
    this.allTabs = tabs;
    this.location = location;
    this.storageData = localStorage.getItem("activeloanTab");
    if (this.storageData) {
      this.activeTab = document.querySelector(
        `[data-loantab=${this.storageData}]`
      );
      this.setCurrentTab(this.storageData);
    } else {
      this.activeTab = document.querySelector("[data-loantab=new-loan]");
      this.setCurrentTab("new-loan");
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
      case "new-loan":
        url = "/admin/loans/new-loan-form.php";
        this.setLocalStorage("new-loan");
        break;

      case "active-loans":
        url = "/admin/loans/active-loans.php";
        this.setLocalStorage("active-loans");
        break;

      default:
        url = "/admin/loans/active-loans.php";
        this.setLocalStorage("new-loan");
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
        // if (this.currentTab === "new-loan") loadLoanForm(this.location);
        // if (this.currentTab === "active-loans")
        //   loadActiveLoanList(this.location);
      });
  }

  displayData(location) {
    location.innerHTML = `${this.response.data}`;
  }

  setLocalStorage() {
    localStorage.setItem("activeloanTab", this.currentTab);
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
    tabObj.setCurrentTab(tab.dataset.loantab);
  };
});

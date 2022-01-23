(function () {
  const tabs = document.querySelectorAll("[data-savingtab]");

  const tabContents = document.querySelector(".tab-contents");

  class Tabs {
    constructor(tabs, location) {
      this.allTabs = tabs;
      this.location = location;
      this.storageData = localStorage.getItem("activeSavingTab");
      if (this.storageData) {
        this.activeTab = document.querySelector(
          `[data-savingtab=${this.storageData}]`
        );
        this.setCurrentTab(this.storageData);
      } else {
        this.activeTab = document.querySelector("[data-savingtab=new-savings]");
        this.setCurrentTab("new-savings");
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
        case "new-savings":
          url = "/admin/savings/new-savings.php";
          this.setLocalStorage("new-savings");
          break;

        case "saving-history":
          url = "/admin/savings/savings-weekly-history.php";
          this.setLocalStorage("saving-history");
          break;

        default:
          url = "/admin/savings/new-savings.php";
          this.setLocalStorage("new-savings");
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
      localStorage.setItem("activeSavingTab", this.currentTab);
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
      tabObj.setCurrentTab(tab.dataset.savingtab);
    };
  });
})();

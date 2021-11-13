(function () {
    /** get necessary elements */
    const togglerBtn = document.querySelector("[data-toggler]");
    const sideBar = document.querySelector("aside.side-bar");
    const mainContents = document.querySelector("main.main-contents");


    class UI {
        static showSideBar() {}

        static hideStaticBar() {}

        static shiftRightMain() {}

        static shiftLeftMain() {}
    }

    togglerBtn.addEventListener('click', (e) => {
        e.preventDefault();
        if (sideBar.classList.contains('minimized')) {
            sideBar.classList.remove('minimized');
            mainContents.classList.remove('full');
        } else {
            sideBar.classList.add('minimized');
            mainContents.classList.add('full');
        }
    });
})()
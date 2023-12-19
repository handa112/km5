(function () {
    // const btnLeft = document.querySelector(".btn-left")
    // const btnRight = document.querySelector(".btn-right")

    console.log("welcome to mouse-tab");
    const tabMenu = document.querySelector(".tab-menu")

    // btnRight.addEventListener("click",() => {
    //   tabMenu.scrollLeft += 150;
    // })
    // btnLeft.addEventListener("click",() => {
    //   tabMenu.scrollLeft -= 150;
    // })

    let activeDrag = false;

    tabMenu.addEventListener("mousemove", (drag) => {
        if (!activeDrag) return
        tabMenu.scrollLeft -= drag.movementX
        tabMenu.classList.add("dragging")
    });

    document.addEventListener("mouseup", () => {
        activeDrag = false
        tabMenu.classList.remove("dragging")
    });

    tabMenu.addEventListener("mousedown", (drag) => {
        activeDrag = true
    });
    const travelBlack = document.querySelector(".travelBlack")
    const travelNext = document.querySelector(".travelNext")
    const travelGallery = document.querySelector(".travel-gallery")


    // const IconVisibility = () => {
    //   let scrollLeftValue = Math.ceil(travelGallery.scrollLeft);
    //   console.log("1.",scrollLeftValue);
    //   let scrollableWidth = travelGallery.scrollLeft - travelGallery.clientWidth
    //   console.log("2.",scrollableWidth);

    //   travelBlack.style.display = scrollLeftValue > 0 ? "block" : "none";
    //   travelNext.style.display = scrollableWidth > scrollLeftValue ? "block" : "none";
    // }


    travelNext.addEventListener("click", () => {
        travelGallery.scrollLeft += 340;
        // IconVisibility();
        // setTimeout(() => IconVisibility(), 50)
    })
    travelBlack.addEventListener("click", () => {
        travelGallery.scrollLeft -= 340;
        // IconVisibility();
    });

    travelGallery.addEventListener("mousemove", (drag) => {
        if (!activeDrag) return;
        travelGallery.scrollLeft -= drag.movementX;
        travelGallery.classList.add("dragging")
    });
    document.addEventListener("mouseup", () => {
        activeDrag = false
        travelGallery.classList.remove("dragging")
    });

    travelGallery.addEventListener("mousedown", () => {
        activeDrag = true
    });

    // view
    const tabs = document.querySelectorAll(".tab")
    const tabBtns = document.querySelectorAll(".tab-btn");

    const tab_Nav = function (tabBtnClick) {
        tabBtns.forEach((tabBtn) => {
            tabBtn.classList.remove("active")
        });

        tabs.forEach((tab) => {
            tab.classList.remove("active")
        })
        tabBtns[tabBtnClick].classList.add("active");
        tabs[tabBtnClick].classList.add("active");
    }

    tabBtns.forEach((tabBtn, i) => {
        tabBtn.addEventListener("click", () => {
            tab_Nav(i);
        })
    })

    const newsGallery = document.querySelector(".news-gallery")
    newsGallery.addEventListener("mousemove", (drag) => {
        if (!activeDrag) return;
        newsGallery.scrollLeft -= drag.movementX;
        newsGallery.classList.add("dragging")
    });
    document.addEventListener("mouseup", () => {
        activeDrag = false
        newsGallery.classList.remove("dragging")
    });

    newsGallery.addEventListener("mousedown", () => {
        activeDrag = true
    });


    let scrollContainer = document.querySelector(".gallery");
    let backbtn = document.getElementById("backbtn");
    let nextbtn = document.getElementById("nextbtn");

    scrollContainer.addEventListener("wheel", (evt) => {
        evt.preventDefault();
        scrollContainer.scrollLeft += evt.deltaY;
        scrollContainer.style.scrollBehavior = "auto";
    });

    nextbtn.addEventListener("click", () => {
        scrollContainer.style.scrollBehavior = "smooth";
        scrollContainer.scrollLeft += 500;
    });
    backbtn.addEventListener("click", () => {
        scrollContainer.style.scrollBehavior = "smooth";
        scrollContainer.scrollLeft -= 500;
    });

})()
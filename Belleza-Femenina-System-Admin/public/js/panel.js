const toggleSiderbarBtns = document.querySelectorAll(".toggleSiderbar");
const mainSidebar = document.querySelector(".mainSidebar");

toggleSiderbarBtns.forEach(btn => {
    btn.addEventListener("click", () => {
    if (window.innerWidth <= 768) {
        mainSidebar.classList.toggle("show");
        mainSidebar.classList.remove("collapsed");
    } else {
        mainSidebar.classList.toggle("collapsed");
        mainSidebar.classList.remove("show");
    }
    });
});

document.addEventListener("click", (e) => {
    if (window.innerWidth <= 768) {
    if (!e.target.closest('.mainSidebar') && !e.target.closest('.toggleSiderbar')) {
        mainSidebar.classList.remove("show");
    }
    }
});

const dropdowns = [
    { trigger: "productosDropdown", menu: "productosMenu" },
    { trigger: "empleadosDropdown", menu: "empleadosMenu" }
];

dropdowns.forEach(dropdown => {
    const trigger = document.getElementById(dropdown.trigger);
    const menu = document.getElementById(dropdown.menu);
    const icon = trigger.querySelector(".dropdownIcon");

    trigger.addEventListener("click", (e) => {
    e.preventDefault();
    if (mainSidebar.classList.contains("collapsed")) {
        const rect = trigger.getBoundingClientRect();
        menu.style.top = rect.top + "px";
        menu.style.left = rect.right + "px";
        menu.classList.toggle("show");
    } else {
        menu.classList.toggle("show");
        if (icon) {
        icon.textContent = menu.classList.contains("show") ? "expand_more" : "chevron_right";
        }
    }
    });
});

document.addEventListener('click', (e) => {
    if (!e.target.closest('.itemMenu')) {
    dropdowns.forEach(dropdown => {
        const menu = document.getElementById(dropdown.menu);
        const trigger = document.getElementById(dropdown.trigger);
        const icon = trigger.querySelector(".dropdownIcon");
        menu.classList.remove("show");
        if (icon) icon.textContent = "chevron_right";
    });
    }
});

function handleResize() {
    if (window.innerWidth > 768) {
    mainSidebar.classList.remove("show");
    }
}

window.addEventListener("resize", handleResize);
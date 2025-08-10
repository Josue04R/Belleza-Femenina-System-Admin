// Toggle sidebar
const sidebarToggleBtns = document.querySelectorAll(".sidebarToggle");
const sidebar = document.querySelector(".sidebar");

sidebarToggleBtns.forEach(btn => {
    btn.addEventListener("click", () => {
    if (window.innerWidth <= 768) {
        // Solo mostrar/ocultar en móviles
        sidebar.classList.toggle("show");
        sidebar.classList.remove("collapsed");
    } else {
        // Solo colapsar en escritorio
        sidebar.classList.toggle("collapsed");
        sidebar.classList.remove("show");
    }
    });
});

// Cerrar sidebar al hacer clic fuera en móviles
document.addEventListener("click", (e) => {
    if (window.innerWidth <= 768) {
    if (!e.target.closest('.sidebar') && !e.target.closest('.sidebarToggle')) {
        sidebar.classList.remove("show");
    }
    }
});

// Dropdown functionality
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
    if (sidebar.classList.contains("collapsed")) {
        // Mostrar el menú como flyout en colapsado
        // Calcula la posición del trigger para mostrar el menú al lado
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

// Cerrar dropdowns al hacer clic fuera
document.addEventListener('click', (e) => {
    if (!e.target.closest('.menuItem')) {
    dropdowns.forEach(dropdown => {
        const menu = document.getElementById(dropdown.menu);
        const trigger = document.getElementById(dropdown.trigger);
        const icon = trigger.querySelector(".dropdownIcon");
        menu.classList.remove("show");
        if (icon) icon.textContent = "chevron_right";
    });
    }
});

// Responsive behavior
function handleResize() {
    if (window.innerWidth > 768) {
    sidebar.classList.remove("show");
    }
}

window.addEventListener("resize", handleResize);
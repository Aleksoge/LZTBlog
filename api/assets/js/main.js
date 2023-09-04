const hamb = document.querySelector("#hamb");
const popup = document.querySelector("#popup");
const body = document.body;
const menu = document.querySelector("#menu").cloneNode(1);

hamb.addEventListener("click", hambHandler);

function hambHandler(e) {
  e.preventDefault();
  popup.classList.toggle("open");
  hamb.classList.toggle("active");
  body.classList.toggle("noscroll");
  renderPopup();
}

function renderPopup() {
  popup.appendChild(menu);
}

const links = Array.from(menu.children);

links.forEach((link) => {
  link.addEventListener("click", closeOnClick);
});

function closeOnClick() {
  popup.classList.remove("open");
  hamb.classList.remove("active");
  body.classList.remove("noscroll");
}

document.addEventListener("DOMContentLoaded", function() {
  let dropdownLink = document.querySelector(".dropdown > a");
  
  if (dropdownLink) {
      dropdownLink.addEventListener("click", function(e) {
          e.preventDefault();
          let submenu = this.nextElementSibling;
          if (submenu) {
              if (submenu.style.display === "none" || submenu.style.display === "") {
                  submenu.style.display = "block";
              } else {
                  submenu.style.display = "none";
              }
          }
      });
  }

  // Закрыть подменю, если клик происходит вне меню
  document.addEventListener("click", function(e) {
      let dropdown = document.querySelector(".dropdown");
      let isClickInsideDropdown = dropdown.contains(e.target);
      if (!isClickInsideDropdown) {
          let submenu = document.querySelector(".sub-menu");
          if (submenu) {
              submenu.style.display = "none";
          }
      }
  });
});

const fadeIn = (el, timeout, display) => {
  el.style.opacity = 0;
  el.style.display = display || 'block';
  el.style.transition = `opacity ${timeout}ms`;
  setTimeout(() => {
    el.style.opacity = 1;
  }, 10);
};

const fadeOut = (el, timeout) => {
  el.style.opacity = 1;
  el.style.transition = `opacity ${timeout}ms`;
  el.style.opacity = 0;

  setTimeout(() => {
    el.style.display = 'none';
  }, timeout);
};

function showAlert() {
  let alertBadge = document.getElementById("alertBadge");
  // alertBadge.style.opacity = 0;
  // alertBadge.style.display = "none";
  fadeIn(alertBadge, 1000, "block");
  setTimeout('fadeOut(alertBadge, 1000);', 3000);
}
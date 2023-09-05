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

function loadPage(pageNumber) {
  getArticles(pageNumber).then(articles => {
      const templateSource = document.getElementById('article_template').innerHTML;
      const template = Handlebars.compile(templateSource);
      const output = template({ articles: articles });  
      document.getElementById('articles_container').innerHTML = output;
      document.getElementById('current_page').textContent = pageNumber;
      updatePaginationControls();
  })
  .catch(error => {
      console.log("Ошибка при получении статей:", error);
  });
}

function changePage(increment) {
  currentPage += increment;
  if (currentPage < 1) currentPage = 1;
  if (currentPage > totalPages) currentPage = totalPages;
  loadPage(currentPage);
}

function updatePaginationControls() {
  document.getElementById('prev_page').disabled = (currentPage === 1);
  document.getElementById('next_page').disabled = (currentPage === totalPages);
}

window.addEventListener('load', function() {
  var preloader = document.getElementById('preloader');
  var iconAnimate = preloader.querySelector('.icon_animate');

  iconAnimate.style.opacity = '0';
  iconAnimate.style.transition = 'opacity 0.3s';

  setTimeout(function() {
      preloader.style.opacity = '0';
      preloader.style.transition = 'opacity 0.6s';
      setTimeout(function() {
          preloader.style.display = 'none';
      }, 600);
  }, 300);
});

const header = document.querySelector('#nav-header'); 
window.addEventListener('scroll', function() {
  if (window.scrollY >= 54) {
    header.classList.add('header-scrolling'); 
  } else {
    header.classList.remove('header-scrolling'); 
  }
});
// Set current year
const yearEl = document.querySelector(".year");
const currentYear = new Date().getFullYear();
yearEl.textContent = currentYear;
// Sign in modal elements
const signInLink1 = document.querySelector(".Sign-in-link");
const signInLink2 = document.querySelector(".Sign-in-link-foot");
const signInModal = document.querySelector(".Sign-in-modal");
const overLay = document.querySelector(".overlay");
// Help & Support
const helpLink = document.querySelector(".Help");
const helpWindow = document.querySelector(".Help-Support");
///////////////////////////////////////////////////////////
// Make mobile navigation work

const btnNavEl = document.querySelector(".btn-mobile-nav");
const headerEl = document.querySelector(".header");

btnNavEl.addEventListener("click", function () {
  headerEl.classList.toggle("nav-open");
});

///////////////////////////////////////////////////////////
// Smooth scrolling animation

const allLinks = document.querySelectorAll("a:link");

allLinks.forEach(function (link) {
  link.addEventListener("click", function (e) {
    // e.preventDefault(); because of this we are not able to move from index.html to user.html
    const href = link.getAttribute("href");

    // Scroll back to top
    if (href === "#")
      window.scrollTo({
        top: 0,
        behavior: "smooth",
      });

    // Scroll to other links
    if (href !== "#" && href.startsWith("#")) {
      const sectionEl = document.querySelector(href);
      sectionEl.scrollIntoView({ behavior: "smooth" });
    }

    // Close mobile naviagtion
    if (link.classList.contains("main-nav-link"))
      headerEl.classList.toggle("nav-open");
  });
});

///////////////////////////////////////////////////////////
// Sticky navigation
const sectionHeroEl = document.querySelector(".hero-section");

const obs = new IntersectionObserver(
  function (entries) {
    const ent = entries[0];
    console.log(ent);

    if (ent.isIntersecting === false) {
      document.querySelector("header").classList.add("sticky");
    }

    if (ent.isIntersecting === true) {
      document.querySelector("header").classList.remove("sticky");
    }
    if (ent.isIntersecting === false) {
      overLay.classList.add("hidden");
      helpWindow.classList.add("hidden");
      signInModal.classList.add("hidden");
      signInLink1.computedStyleMap.border = "none";
    }
  },
  {
    // In the viewport
    root: null,
    threshold: 0,
    rootMargin: "-80px",
  }
);
obs.observe(sectionHeroEl);

// logo
const logo = document.querySelector(".logo");
logo.addEventListener("click", function () {});

// Sign in modal
signInLink1.addEventListener("click", function () {
  signInModal.classList.remove("hidden");
  overLay.classList.remove("hidden");
});
signInLink2.addEventListener("click", function () {
  signInModal.classList.remove("hidden");
  overLay.classList.remove("hidden");
});
overLay.addEventListener("click", function () {
  overLay.classList.add("hidden");
  signInModal.classList.add("hidden");
  helpWindow.classList.add("hidden");
  signInLink1.computedStyleMap.border = "none";
});

//Help-Support
helpLink.addEventListener("click", function () {
  helpWindow.classList.remove("hidden");
  overLay.classList.remove("hidden");
});

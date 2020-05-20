window.onscroll = function() {
  navbarFunction();
  scrollFunction();
};

// When the user scrolls down 50px from the top of the document, change the style of navigation bar
function navbarFunction() {
  var navbar = document.getElementById("navbar");
  if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
    navbar.style.boxShadow = "4px 0 20px -5px rgba(0, 0, 0, 0.2)";
  } else {
    navbar.style.boxShadow = "none";
  }
}

// When the user scrolls down 450px from the top of the document, show the Scroll-to-top button
function scrollFunction() {
  if (
    document.body.scrollTop > 250 ||
    document.documentElement.scrollTop > 250
  ) {
    $(".back-to-top").fadeIn("slow");
  } else {
    $(".back-to-top").fadeOut("slow");
  }
}

$(document).ready(function() {
  $(".back-to-top").click(function() {
    $("html, body").animate({ scrollTop: 0 }, 1000);
    return false;
  });
});

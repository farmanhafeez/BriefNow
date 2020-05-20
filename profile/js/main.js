window.onscroll = function() {
  scrollFunction();
};

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

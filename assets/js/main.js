// loader
$(document).ready(function() {
    let container = $(".loader");
    let ring = $(".ring-frame");
    let disc = $(".disc-frame");
    let i = 1;
    let num = 200;
    let radius = 150;
    let lim = 4;

    for (i; i < lim; i++) {
        let span = $("<span class='ring'></span>");
        let disk = $("<span class='disc'></span>");
        span.css("height", `${i * 20 + num}px`);
        span.css("width", `${i * 20 + num}px`);
        disk.css("animation-delay", `${i - 0.8}s`);
        ring.append(span);
        disc.append(disk);
    }

    // Set a timeout to hide the loader after 3 seconds (3000 milliseconds)
    setTimeout(function() {
        container.hide(); // Hide the loader
    }, 3000);
});

$(document).ready(function () {
    const form = $("#multi-step-form");
    const loader = $("#loader");

    form.submit(function (e) {
        e.preventDefault(); // Prevent the form from submitting immediately

        // Show the loader
        loader.css("display", "block");

        // Simulate a delay of 3 seconds (3000 milliseconds)
        setTimeout(function () {
            // Hide the loader after 3 seconds
            loader.css("display", "none");

            // Now, you can submit the form
            form.submit();
        }, 3000);
    });
});


// nav
$(document).ready(function() {
    $('.nav-toggle').click(function() {
        $('.main-nav').slideToggle(); // Toggle the visibility of the navigation links
    });
});

// future

$(document).ready(function () {
    $('.future-details .future-stage').click(function () {
      // Close previously opened "future-text" divs
      $('.future-details .future-text').removeClass('show');
      
      // Open the clicked "future-text" div
      $(this).closest('.future-details').find('.future-text').addClass('show');
    });
});

// projects testimonial
$(document).ready(function() {
    const cards = $(".testimonial-card");
    let currentSlide = 0;

    function showSlide(slideIndex) {
        cards.removeClass("active");
        cards.eq(slideIndex).addClass("active");
    }

    // Show initial slide
    showSlide(currentSlide);

    // Auto slide every 5 seconds
    setInterval(function() {
        currentSlide = (currentSlide + 1) % cards.length;
        showSlide(currentSlide);
    }, 5000);
});


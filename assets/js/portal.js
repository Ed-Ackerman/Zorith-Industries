// budget input
$(document).ready(function() {
    $('input.budget').keyup(function(event) {

    // skip for arrow keys
    if(event.which >= 37 && event.which <= 40) return;
  
    // format number
    $(this).val(function(index, value) {
      return value
      .replace(/\D/g, "")
      .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
      ;
    });
  });
});
  
// progress
$(document).ready(function () {
  const form = $('#multi-step-form');
  const stages = $('.stage');
  const circles = $('.circle');
  const steps = $('.step');
  const submitButton = $('#submit');
  let currentStep = 0;

  function showStep(stepIndex) {
      stages.removeClass('active');
      circles.removeClass('active');
      steps.removeClass('active');
      stages.eq(stepIndex).addClass('active');
      circles.eq(stepIndex).addClass('active');
      steps.eq(stepIndex).addClass('active');
      updateButtonVisibility(stepIndex);
  }

  function updateButtonVisibility(stepIndex) {
      // Disable previous button on the first step
      if (stepIndex === 0) {
          $('.prev-button').prop('disabled', true);
      } else {
          $('.prev-button').prop('disabled', false);
      }

      // Hide the "next" button on the last step, show the "submit" button
      if (stepIndex === stages.length - 1) {
          $('.next-button').hide();
          submitButton.show();
      } else {
          $('.next-button').show();
          submitButton.hide();
      }
  }

  // Handle previous button click
  $('.prev-button').on('click', function (e) {
      e.preventDefault();
      if (currentStep > 0) {
          currentStep--;
          showStep(currentStep);
      }
  });

  // Handle next button click
  $('.next-button').on('click', function (e) {
      e.preventDefault();
      if (currentStep < stages.length - 1) {
          currentStep++;
          showStep(currentStep);
      }
  });

  showStep(currentStep);
});

// Portal
$(document).ready(function () {
    $('#multi-step-form').on('submit', function (e) {
        e.preventDefault();
        
        var formData = new FormData(this); // Create a FormData object from the form

        $.ajax({
            type: "POST",
            url: "../../../assets/php/portal.php",
            dataType: "json",
            data: formData,
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Prevent jQuery from setting the content type
            success: function (response) {
                if (response.success) {
                    // Successful submission, show success message or redirect
                    alert('Inquiry submitted successfully!');
                } else {
                    // Handle server-side validation errors or other error messages
                    alert('Inquiry submission failed: ' + response.message);
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr);
                alert('Error: ' + error);
            }
        });
    });
});
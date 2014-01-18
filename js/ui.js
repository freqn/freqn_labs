$(document).ready(function() {
      $('#wrapper').delay(500).fadeIn(1000);

      $('.menu-item').click(function(event) {
          event.preventDefault();
          newLocation = this.href;
          $('#wrapper').fadeOut(1000, function () {
              window.location = newLocation;
          });
      });
});
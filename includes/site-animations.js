  $(document).ready(function() {
      (function() {
          var nav = document.getElementById('nav');

          anchor = nav.getElementsByTagName('a');
          current = window.location.pathname.split('/')[4];
          for (var i = 0; i < anchor.length; i++) {
              var href = anchor[i].href;
              var parts = href.split('/');
              var answer = parts[parts.length - 1];

              if (answer == current) {
                  anchor[i].className = "active";

              }

          }

      })();

   
  });
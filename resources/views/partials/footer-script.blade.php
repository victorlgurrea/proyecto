  <!-- Bootstrap core JavaScript-->
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <!--<script src="{{ asset('theme/vendor/jquery/jquery.min.js') }}"></script>-->

    <script src="{{ asset('theme/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('theme/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('theme/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('theme/vendor/chart.js/Chart.min.js') }}"></script>

    
    <script type="text/javascript">
    $(document).ready(function(){
      if($(".alert").length){
        $(".alert").delay(3000).slideUp(200, function () {
          $(this).alert('close');
        });
      }

      let lang = $('html').attr('lang');
        switch(lang) {
            case 'es':
                var language = "Spanish";
                break;
            case 'fr':
                var language = "French";
                break;
            case 'de':
                var language = "German";
                break;
            case 'it':
                var language = "Italian";
                break;
            case 'en':
                var language = "English";
                break;
            case 'ru':
                var language = "Russian";
                break;
            case 'pt':
                var language = "Portuguese";
                break;
            case 'ca':
                var language = "Catalan";
                break;
            default:
                var language = "English";
                break;
            }

         $("html").attr('language', language);   
    });
    </script>
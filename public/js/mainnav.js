$(document).ready(
    function(){
       
        $('.navbar-nav').on('click','a', function(){
            $('.navbar-nav a.active').removeclass('active');
            $(this).addclass('active');
        })
    }
  
)


$( document ).ready(function() {

    $('.form-delete').submit(function(){
      return confirm('Confirma a exclusão dos dados?');
    });

    $('.imagepreview').change(function(){
      readURL(this);
    });

});

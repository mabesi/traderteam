$( document ).ready(function() {

    $('.form-delete').submit(function(){
      return confirm('Confirma a exclusão dos dados?');
    });

    $('.imagepreview').change(function(){
      readURL(this);
    });

    $('form').submit(function(){

      var fileInput = $(':file');

      for (var i=0; i<fileInput.length; i++){
        if (fileInput.get(i).files.length){

          var fileSize = fileInput.get(i).files[0].size;
          var maxSize = fileInput.get(i).getAttribute('max-size');
          var fieldName = fileInput.get(i).getAttribute('name');

          if (fileSize > maxSize){
            alert(fieldName.toUpperCase() +': Arquivo muito grande para ser enviado!\n'+
            'Tamanho Máximo: ' + maxSize/1024 + ' KB');
            return false;
          }
        }
      }
      return true;
    });
});

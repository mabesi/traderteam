$( document ).ready(function() {

    $('.form-delete').submit(function(){
      return confirm('Confirma a exclusão dos dados?');
    });

    $('.imagepreview').change(function(){
      readURL(this);
    });

    $(".delete-button").on("click", function() {
      return deleteItem(this);
    });

    function deleteItem(e) {

      var token = $(e).data('token');
      var resource = ($(e).data('resource') == 'True');
      var previous = $(e).data('previous');
      var url = $(e).attr('href');

      if (confirm('Confirma a exclusão deste item?')==true){
        $.ajax({
          type: "post",
          url: url,
          data: {_method: 'delete',_token: token},
          success: function(response){
            if (response.success){
              alert(response.msg);
              if (resource){
                $(location).attr('href',previous);
                //history.back();
              } else {
                location.reload();
              }
            } else {
              alert(response.msg);
            }
          }
        });

      }
      return false;
    }

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

$( document ).ready(function() {

  $(".azoom").on("click", function() {
    zoomImageModal(this);
  });

});

function readURL(input) {
   if (input.files && input.files[0]) {
       var reader = new FileReader();
       reader.onload = function (e) {
           $('.'+input.id).first().attr('src', e.target.result);
       }
       reader.readAsDataURL(input.files[0]);
   }
 }

function zoomImageModal(e) {
  $('#imagepreview').attr('src', $(e).find("> img").first().attr('src'));
  $('#imagemodal').modal('show');
}

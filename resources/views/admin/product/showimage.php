//show image

{{asset('/storage/images/'.$product->filename)}}


function readURL(input){
        if(input.files && input.files[0]){
          var reader = new FileReader();
          reader.onload = function(e){
            $('#image').attr('src', e.target.result).attr('width',100).attr('height',100);

          };
          reader.readAsDataURL(input.files[0]);
        }
      }
{{--showValues --}}

<script>
var shop_id='';
  function showFa(id)
  {
  
      $('#Fa_'+id).css({'display' : ''});
      Toset('{{ trans("main.proccess") }}','info','');

    $.ajax({
      url : '/manage/Shop/getFacility/' +id,
      type : 'get',
      success : function(data){
        var fa='';
        
          for(var i=0 ; i<data.length;i++)
          {
              var cheked_fa= '';
              if(data[i].checked){
                 cheked_fa= 'checked';
              }
            fa+='<div class="col-md-3"><div class="form-group"><label for="example-email">'+data[i].name_ar+ '/' +data[i].name_en+'</label><input '+cheked_fa+' type="checkbox" value="'+data[i].id+'" id="facilty_'+data[i].id+'" name="facilty_id[]" class="form-control"></div></div>';

          }
          $('#fa').empty();
          $('#fa').append(fa);

            shop_id=id;
            $('#shop_id2').val(id);

            $('#Fa_'+id).css({'display' : 'none'});

          $('#FacilityModel').modal();
      
    }
    })
  }
</script>


{{--Add Function --}}


{{--submit Function --}}
<script>
          $('#faSubmit').submit(function(e){
            e.preventDefault();
            $("#saveValue").attr("disabled", true);
            $('#err').slideUp(200);

            Toset('{{ trans("main.proccess") }}','info','');

          var id=$('#id').val();
          var formData = new FormData($('#faSubmit')[0]);
          url =  "{{route('Shop.storeFacility')}}"  ;
          $.ajax({
          url : url,
          type : "post",
          data : formData,
          contentType:false,
          processData:false,

          success : function(data)
          {
              $.toast().reset('all');
              $("#saveValue").attr("disabled", false);

             if(data.errors==false)
             {
                $('#err').slideUp(200);

                Toset('{{trans("main.success")}}','success','{{trans("main.successText")}}');
                $('#FacilityModel').modal('toggle');

             }
             // Error
             else
             {
              Toset('{{ trans("main.error") }}','error','');

             }
          },
          error :  function(y)
          {
            $("#saveValue").attr("disabled", false);
            Toset('{{ trans("main.tryAgin") }}','error','');
            var error = y.responseText;
            error= JSON.parse(error);
            error = error.errors;
            console.log(error );
            $('#err').empty();
            for(var i in error)
            {
              for(var k in error[i])
              {
                var message=error[i][k];
                $('#err').append("<p class='text-danger'>*"+message+"</p>");
                }
                $('#err').slideDown(200);

            }
          }
          });

        })

</script>









{{-- Add Brand --}}

{{--showValues --}}

<script>
var shop_id='';
  function showBrand(id)
  {
  
      $('#Brand_'+id).css({'display' : ''});
      Toset('{{ trans("main.proccess") }}','info','');

    $.ajax({
      url : '/manage/Shop/getBrand/' +id,
      type : 'get',
      success : function(data){
        var fa='';
        
          for(var i=0 ; i<data.length;i++)
          {
              var cheked_fa= '';
              if(data[i].checked){
                 cheked_fa= 'checked';
              }
            fa+='<div class="col-md-3"><div class="form-group"><label for="example-email"><img src="'+data[i].file+'" width="25px"></label><input '+cheked_fa+' type="checkbox" value="'+data[i].id+'" id="Brand_shop_'+data[i].id+'" name="Brand_shop[]" class="form-control"></div></div>';

          }
          $('#ba').empty();
          $('#ba').append(fa);

            shop_id=id;
            $('#shop_id3').val(id);

            $('#Brand_'+id).css({'display' : 'none'});

          $('#BrandModel').modal();
      
    }
    })
  }
</script>


{{--Add Function --}}


{{--submit Function --}}
<script>
          $('#BrandSubmit').submit(function(e){
            e.preventDefault();
            $("#saveValue").attr("disabled", true);
            $('#err').slideUp(200);

            Toset('{{ trans("main.proccess") }}','info','');

          var id=$('#id').val();
          var formData = new FormData($('#BrandSubmit')[0]);
          url =  "{{route('Shop.storeBrand')}}"  ;
          $.ajax({
          url : url,
          type : "post",
          data : formData,
          contentType:false,
          processData:false,

          success : function(data)
          {
              $.toast().reset('all');
              $("#saveValue").attr("disabled", false);

             if(data.errors==false)
             {
                $('#err').slideUp(200);

                Toset('{{trans("main.success")}}','success','{{trans("main.successText")}}');
                $('#BrandModel').modal('toggle');

             }
             // Error
             else
             {
              Toset('{{ trans("main.error") }}','error','');

             }
          },
          error :  function(y)
          {
            $("#saveValue").attr("disabled", false);
            Toset('{{ trans("main.tryAgin") }}','error','');
            var error = y.responseText;
            error= JSON.parse(error);
            error = error.errors;
            console.log(error );
            $('#err').empty();
            for(var i in error)
            {
              for(var k in error[i])
              {
                var message=error[i][k];
                $('#err').append("<p class='text-danger'>*"+message+"</p>");
                }
                $('#err').slideDown(200);

            }
          }
          });

        })

</script>






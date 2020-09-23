{{--showValues --}}

<script>
var shop_id='';
  function showValues(id)
  {
  
      $('#ss_'+id).css({'display' : ''});
      Toset('{{ trans("main.proccess") }}','info','');

    $.ajax({
      url : '/manage/Days/getDays/' +id,
      type : 'get',
      success : function(data){
        var cats='';
        
          for(var i=0 ; i<data.daysOffShop.days.length;i++)
          {
            type='';
             if(data.daysOffShop.days[i].pivot.type == 1)
             {
                type= "{{trans('main.work')}}" ;
             }else if(data.daysOffShop.days[i].pivot.type == 0)
             {
                type= "{{trans('main.off')}}" ;  
             }

            cats+='<tr>'+
                  '<th scope="row">'+data.daysOffShop.days[i].id+'</th>'+
                  '<td>'+data.daysOffShop.days[i].name_ar+ '/' + data.daysOffShop.days[i].name_en+ '</td>'+
                  '<td>'+data.daysOffShop.days[i].pivot.from+ '/' +data.daysOffShop.days[i].pivot.to +'</td><td>'+type+'</td>';
          cats+='<td><button type="button"  class="btn btn-danger waves-effect btn-circle waves-light" onclick="deleteValues('+data.daysOffShop.days[i].id+')" ><i class="fa fa-spinner fa-spin" id="deleteValues_'+data.daysOffShop.days[i].id+'" style="display:none"></i><i class="fas fa-trash"></i></button></td></tr>';
              
          }
          $('#cats').empty();
          $('#cats').append(cats);

          $("#shop_id").val(id);
            shop_id=id;

          var daysDiff='';
          for(var i=0;i<data.daysDiff.length;i++)
          {
            daysDiff+='<option value="'+data.daysDiff[i].id+'">'+data.daysDiff[i].name_ar+'</option>';
          }
        
          $('#ss_'+id).css({'display' : 'none'});
          $('#day_id').empty();
          $('#day_id').append(daysDiff);

          $('#showvalues').modal();
      
    }
    })
  }
</script>


{{--Add Function --}}

<script>

    function addNewValue()
    {

        save_method='addNewValue';

        $('#err').slideUp(200);

        $('#saveValue').text('{{trans("main.save")}}');

        $('#titleValue').text('{{trans("main.AddNewtamplate_value")}}');

        $('#formaddNewValue')[0].reset();

        $('#formaddNewValue').slideDown(200);

    }
</script>
{{--submit Function --}}
<script>
          $('#formaddNewValue').submit(function(e){
            e.preventDefault();
            $("#saveValue").attr("disabled", true);
            $('#err').slideUp(200);

            Toset('{{ trans("main.proccess") }}','info','');

          var id=$('#id').val();
          var formData = new FormData($('#formaddNewValue')[0]);
          url =  "{{route('Days.store')}}"  ;
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
                $('#formaddNewValue')[0].reset();
                $('#loginDiv').slideUp(300);
                $('#err').slideUp(200);

                Toset('{{trans("main.success")}}','success','{{trans("main.successText")}}');
                showValues(data.id);
                $('#formaddNewValue').slideUp(200);

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



{{--Delete --}}
<script>
    var id_num='';
    var checkNum='';
    function deleteValues(id){
      
      id_num=id;
      checkNum=check;
      
      $('#DeleteModel2').modal();
      
    }

    function yesDelete2()
    {
      
     
        Toset('{{ trans("main.proccess") }}','info','');

      $.ajax({
          url : '/manage/Days/deleteDays/'+id_num + '?shop_id='+shop_id,
          type : "get",
          success : function(data)
          {
         
            showValues(data.id);
            $('#DeleteModel2').modal('toggle');
            $("#deleteYse").attr("disabled", false);
            Toset('{{trans("main.success")}}','success','{{trans("main.successText")}}');
      
          },
          error : function ()
          {
            $("#deleteYse").attr("disabled", false);

          }

      })
 
      }

    
    
</script>


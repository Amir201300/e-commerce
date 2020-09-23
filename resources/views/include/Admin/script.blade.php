<script>
 function Toset(messag,btnClass,text)
 {
    $.toast({
                heading: messag,
                text: text,
              position: 'bottom-right',
                stack: 2,
                icon : btnClass,
                hideAfter: 5000,

            });
 }


 function TosetV2(messag,btnClass,text,hideAfter)
 {
    $.toast({
                heading: messag,
                text: text,
              position: 'bottom-right',
                stack: 2,
                icon : btnClass,
                hideAfter: hideAfter,

            });
 }
</script>
{{-- custom Function to checkBox --}}
<script>

var checkArray=[];

function check(id)

{

  if($("#checkBox_"+id.toString()+"").is(":checked")==true){

  if(jQuery.inArray(id, checkArray) === -1 || checkArray.length === 0){

     checkArray.push(id);

}

  }else{

     checkArray.splice(checkArray.indexOf(id),1);

}
  console.log(checkArray);
}
</script>

{{-- custom Function to Delete --}}
<script>
function deleteProccess(url)
{
  $("#deleteYse").attr("disabled", true);

        Toset('{{ trans("main.proccess") }}','info','');

      $.ajax({
          url : url,
          type : "get",
          success : function(data)
          {

            table.ajax.reload();
            $('#DeleteModel').modal('toggle');
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

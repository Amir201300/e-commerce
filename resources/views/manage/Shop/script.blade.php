
{{-- DataTable Function --}}
<script>
    var table = $('#datatable').DataTable({

    bLengthChange: false,

    searching: true,

    responsive: true,

    'processing': true,

    serverSide:true,

    order: [[0, 'desc']],

    buttons: ['copy', 'excel', 'pdf'],

    ajax:"{{ route('Shop.view',['client_id'=>$client_id]) }}",

columns:
[
    {data:'checkBox' , name :'checkBox'},

    {data:'id' , name :'id'},
    {data:'file' , name :'file'},

    {data:'name_ar' , name :'name_ar'},

    {data:'name_en' , name :'name_en'},

    {data:'status' , name :'status'},

    {data:'type' , name :'type'},

    {data:'per' , name :'per'},


    {data:'action' , name :'action',orderable:false,searchable:false},
]
});
</script>

{{--Add Function --}}
<script>
var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!

var yyyy = today.getFullYear() + 1;
if(dd<10){dd='0'+dd} if(mm<10){mm='0'+mm} today =yyyy + '-'+ mm+'-'+dd;

$('#date').val(today);

</script>

<script>
    function addFunction()
    {

        save_method='add';

        $('#err').slideUp(200);

        $('#save').text('{{trans("main.save")}}');

        $('#title').text('{{trans("main.AddNewShop")}}');

        $('#formSubmit')[0].reset();
        $('#date').val(today);

        $('#formModel').modal();

    }
</script>
{{--submit Function --}}
<script>
          $('#formSubmit').submit(function(e){
            e.preventDefault();
            $("#save").attr("disabled", true);
            $('#err').slideUp(200);

            $.toast({
                heading: '{{ trans("main.proccess") }}',
                text: '{{ trans("main.proccess") }}',
              position: 'bottom-right',
                stack: 2,
                icon : 'info',
                hideAfter: false,

            });


          var id=$('#id').val();
          var formData = new FormData($('#formSubmit')[0]);
          url = save_method == 'add' ? "{{route('Shop.store')}}" : "{{route('Shop.update')}}" ;
          $.ajax({
          url : url,
          type : "post",
          data : formData,
          contentType:false,
          processData:false,

          success : function(data)
          {
              $.toast().reset('all');
              $("#save").attr("disabled", false);

             if(data.errors==false)
             {
                $('#formSubmit')[0].reset();
                $('#loginDiv').slideUp(300);
                $('#err').slideUp(200);

                Toset('{{trans("main.success")}}','success','{{trans("main.successText")}}');

               //Redirect to dashboard
               $("#formModel").modal('toggle');
               table.ajax.reload();

             }
             // Error
             else
             {
              Toset('{{ trans("main.error") }}','error','');

             }
          },
          error :  function(y)
          {
            $.toast().reset('all');
            $("#save").attr("disabled", false);
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

{{--Show --}}

<script>
  function show(id)
  {

      $('#loadShow_'+id).css({'display' : ''});
      Toset('{{ trans("main.proccess") }}','info','');

    $.ajax({
      url : '/manage/Shop/show/' +id,
      type : 'get',
      success : function(data){
        var status=data.type == 1 ? '{{trans("main.Active")}}' : '{{trans("main.inActive")}}';

        if(data.style == 2){style = "{{trans('main.daleel')}}"}
        else if(data.style==3){style="{{trans('main.delivery')}}"}
        else if(data.style==4){style="{{trans('main.house')}}"}

        $('.status').text(status);
        $('.name_en').text(data.name_en);
        $('.name_ar').text(data.name_ar);
        $('.created_by').text(data.created_by);
        $('.updated_by').text(data.updated_by);
        $('#loadShow_'+id).css({'display' : 'none'});
        $('#showData').modal();
      }
    })
  }
</script>

{{--Eedit --}}
<script>
  function edit(id)
  {
      Toset('{{ trans("main.proccess") }}','info','');
      $('#loadEdit_'+id).css({'display' : ''});
        save_method='edit';
        $('#save').text('{{trans("main.edit")}}');
        $('#title').text('{{trans("main.edit")}}');

    $.ajax({
      url : '/manage/Shop/show/' +id,
      type : 'get',
      success : function(data){

        $('#status').val(data.status);
        $('#desc').val(data.desc_en);
        $('#desc_ar').val(data.desc_ar);
        $('#name_ar').val(data.name_ar);
        $('#name_en').val(data.name_en);
        $('#type').val(data.type);
        $('#numOFContract').val(data.numOFContract);
        $('#client_id').val(data.client_id);
        $('#location').val(data.location);
        $('#mainCatId').val(data.cat.parent_id);
          $('#city_id').val(data.city_id);

          getCat(1,data.categoriesid);
        $('#subCat').val(data.categoriesid);

        $('#id').val(id);
        $('#loadEdit_'+id).css({'display' : 'none'});
        $('#formModel').modal();

        // social
        $('#phone').val(data.phone);

        $('#twitter').val(data.twitter);
        $('#whatsapp').val(data.whatsapp);
        $('#website').val(data.website);
        $('#instagram').val(data.instagram);
        $('#snap').val(data.snap);
        $('#facebook').val(data.facebook);
          $('#package_id').val(data.package_id);
          showPackage();
          showSocial();


      }
    })
  }
</script>


{{--Delete --}}
<script>
    var id_num='';
    var checkNum='';
    function deleteFunction(id,check){

      id_num=id;
      checkNum=check;

      if(check == 2){
        if(checkArray.length == 0){
          alert("{{trans('main.noItemSelected')}}")
          }else{
            $('#DeleteModel').modal();
          }
        }

      else{
        $('#DeleteModel').modal();
      }

    }

    function yesDelete()
    {

      if(checkNum == 1){
      deleteProccess("/manage/Shop/delete/" +id_num);
      }else{

      deleteProccess("/manage/Shop/delete/"+checkArray +'?type=2');

    }
      }



</script>



<script>
$('#seachForm').submit(function(e){
  e.preventDefault();
  var formData=$('#seachForm').serialize();
  table.ajax.url('/manage/Shop/search?'+formData);
  table.ajax.reload();
})

</script>


<script>
function showProduct(id)
{
  location.href='/manage/Product_store/index/'+id;
}
</script>


<script>
function showPackage()
{
  var type=$('#type').val();
  if(type == 1)
  {
    $('#package').slideDown(200);
      $('#package_id').attr('required',true);

  }else{
    $('#package').slideUp(200);
      $('#package_id').attr('required',false);
      $('#social').slideUp(200);
      $('.video').slideUp(200);
  }
}
</script>

<script !src="">
    function showSocial() {
    var pakage_id = $('#package_id').val();
        $.toast({
            heading: '{{ trans("main.proccess") }}',
            text: '{{ trans("main.proccess") }}',
            position: 'bottom-right',
            stack: 2,
            icon : 'info',
            hideAfter: false,

        });
        $.ajax({
        url : '/manage/package/show/'+pakage_id,
        type : 'get',
        success : function (data)
        {
            data.soical ? $('#social').slideDown(200) : $('#social').slideUp(200);
            data.video ? $('.video').slideDown(200) : $('.video').slideUp(200);
            $.toast().reset('all');

        }
    })

    }
</script>


<script !src="">
   $('#location').blur(function(){
       var url = $('#location').val();
        url = new URL(url);

       console.log(url.searchParams.get("c"));
       var regex = new RegExp('@(.*),(.*)&');
       var lon_lat_match = url.match(regex);
       var lon = lon_lat_match[1];
       var lat = lon_lat_match[2];
       console.log(lon);
       console.log(lat);
       $("#latInput").val(lat);
       $("#lngInput").val(lon);



   })

</script>
<script>

    function getCat(check,suId){
        var mainCatId=$('#mainCatId').val();

            TosetV2('{{ trans("main.proccess") }}','info','',false);

            $.ajax({
                url : '/manage/Shop/getLevelTwo/'+mainCatId+'?client_id={{$client_id}}',
                type : 'get',
                success : function(data)
                {
                    $.toast().reset('all');
                    var option='';
                    for(var i=0 ; i<data.length;i++){
                        option+='<option value="'+data[i].id+'">'+data[i].name_ar+' / '+data[i].name_en+'</option>';
                    }
                    console.log(option);

                    $('#subCat').empty();
                    $('#subCat').append(option);
                    if(check == 1)
                    {
                        $('#subCat').val(suId);
                    }
                }
            })

    }
</script>




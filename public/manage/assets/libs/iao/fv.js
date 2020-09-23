const form = document.getElementById('form'),

 name = document.getElementById('exampleInputName'),
 email = document.getElementById('exampleInputEmail'),
 password= document.getElementById('exampleInputPassword'),
 selector = document.getElementById('inlineFormCustomSelect'),
 textArea = document.getElementById('text_new'),
 dateInput = document.getElementById('date_input');


 form.addEventListener('submit', function(e){

     if (name.value === '' || name.value == null) {
          e.preventDefault();

             $.iaoAlert({msg: "Name Is Required!",
             type: "error",
             mode: "dark",})
    }

    else if (email.value === '' || email.value == null) {

        e.preventDefault();

        $.iaoAlert({msg: "Email Is Required!",
        type: "error",
        mode: "dark",})
     }

     else if (password.value === '' || password.value == null) {

        e.preventDefault();

        $.iaoAlert({msg: "Password Is Required!",
        type: "error",
        mode: "dark",})
     }
     else if (!$('#inlineFormCustomSelect').val()) {

        e.preventDefault();

        $.iaoAlert({msg: "Please Select",
        type: "error",
        mode: "dark",})
     }
     else if (textArea.value === '' || textArea.value == null) {
        e.preventDefault();

        $.iaoAlert({msg: "Text Area Is Empty!",
        type: "error",
        mode: "dark",})
     }

     else if (dateInput.value === '' || dateInput.value == null) {
        e.preventDefault();

        $.iaoAlert({msg: "Please Pick A Date!",
        type: "error",
        mode: "dark",})
     }

     else {

        $.iaoAlert({msg: "Success!",
        type: "success",
        mode: "dark",})

         return true;
     }               
})

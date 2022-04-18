function showSuccessToast(message,stickyy=true,stayTime=8000) {
    if(stickyy==true)
        stayTime=300000;
    $().toastmessage("showToast", {
        text: message,
        sticky: stickyy,
        type: "success",
        position: "top-right",
        stayTime: stayTime
    });
}

function showErrorToast(message,stickyy=true,stayTime=8000) {
    if(stickyy==true)
        stayTime=300000;
    $().toastmessage("showToast", {
        text: message,
        sticky: stickyy,
        type: "error",
        position: "top-right",
        stayTime: stayTime
    });
}

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $('#image_review').show();
      $('#image_review').attr('src', e.target.result).width(150).height(200);
    };

    reader.readAsDataURL(input.files[0]);
  }
}
function submitForm(formObj){

    var formData = new FormData(formObj[0]);

    $.ajax({
      type: formObj.attr('method'),
      url: formObj.attr('action'),
      data: formData,
      headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
      },
      processData: false,
      contentType: false,
      success: function(response){
        showSuccessToast(response.data.message);

        setTimeout(function(){
          window.location.reload();
        },2000);

      },
      error:function(response){
        showErrorToast("Something went wrong");
      },
    });
}

function deleteModel(id,type){
    $.ajax({
      type: "DELETE",
      url: "/"+type+"/"+id,
      headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
      },
      processData: false,
      contentType: false,
      success: function(response){
        showSuccessToast(response.data.message);

        setTimeout(function(){
          window.location.href = "/"+type;
        },2000);

      },
      error:function(response){
        showErrorToast("Something went wrong");
      },
    });  
}

function deleteModels(id,type){
    $.ajax({
      type: "DELETE",
      url: "/"+type+"/delete-all/",
      data:{
        "id":id
      },
      headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
      },
      success: function(response){
        showSuccessToast(response.data.message);

        setTimeout(function(){
          window.location.reload();
        },2000);

      },
      error:function(response){
        showErrorToast("Something went wrong");
      },
    });  
}

function deleteCategory(category_id){
      deleteModel(category_id,"category");
}

function deleteProduct(product_id){
      deleteModel(product_id,"product");
}

function deleteMany(type){
      // deleteModel(product_id,"product");
      let checked_ids = [];
      $(".check_model:checked").each(function($e){
          checked_ids.push($(this).val());
      });
      console.log(checked_ids)
      if(checked_ids.length == 0){
        showErrorToast("Please select item to delete.");
        return false;
      }else{
        deleteModels(checked_ids,type);
      }
}


$(function(){
  $("#check_all").click(function(){
    $(".check_model").prop("checked",$(this).is(":checked"));
  });
  $("#category").validate({
    onfocusout: false,
    onkeyup: false,
    rules:{
      "name":{
        required:true,
      },
      "image":{
        accept: "jpg,jpeg,png,ico,bmp"
      }
    },
    messages:{
      "name":{
        required:"Please enter the name of the category"
      }
    },
    submitHandler: function(form) {
      submitForm($("#category"));
    }
  });

  $("#product").validate({
    onfocusout: false,
    onkeyup: false,
    rules:{
      "name":{
        required:true,
      },
      "image":{
        accept: "jpg,jpeg,png,ico,bmp"
      },
      "category_id":{
        required: true
      }
    },
    messages:{
      "name":{
        required:"Please enter the name of the product"
      },
      "category_id":{
        required:"Please select a category"
      },
    },
    submitHandler: function(form) {
      submitForm($("#product"));
    }
  });
});

  
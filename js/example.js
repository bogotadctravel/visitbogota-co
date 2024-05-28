$("#FORMID").validate({
  ignore: "",
  rules: {
    NAMEINPUT: "required",
  },
  messages: {
    NAMEINPUT: "Mensaje de error",
  },
  submitHandler: function (form) {
    $("#FORMID button").attr("disabled", true);
    $("#FORMID button").text("Enviando");
    $("#FORMID").ajaxSubmit({
      dataType: "json",
      success: function (data) {},
    });
  },
});

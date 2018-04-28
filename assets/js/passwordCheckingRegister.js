function checkPasswordMatch() {
    var password = $("#pass-1").val();
    var confirmPassword = $("#pass-2").val();

    if (password != confirmPassword) {
        if (!$("#submit-profile").hasClass("disabled"))
            $("#submit-profile").addClass("disabled");
        
        if (!$("#submit-profile").hasClass("btn-warning"))
            $("#submit-profile").addClass("btn-warning");
        
        if ($("#submit-profile").hasClass("btn-default"))
            $("#submit-profile").removeClass("btn-default");
    } else {
        if ($("#submit-profile").hasClass("disabled"))
            $("#submit-profile").removeClass("disabled");
        
        if ($("#submit-profile").hasClass("btn-warning"))
            $("#submit-profile").removeClass("btn-warning");
        
        if (!$("#submit-profile").hasClass("btn-default"))
            $("#submit-profile").addClass("btn-default");
    }
}

$(document).ready(function () {
    $("pass-2").keyup(checkPasswordMatch);
});
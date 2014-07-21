$(document).on('hidden.bs.modal', function (e) {
    $(e.target).removeData('bs.modal');
});
$(document).ready(function (e) {
    $("select.select2").select2();
    $('#dynamicModal').on('loaded.bs.modal', function (e) {
        $("select.select2").select2();
        $("#dynamicModal .btn-send-form").first().click(sendModalForm);
    })
    $(document).bind("ajaxComplete", function () {

    });
})

function sendModalForm() {
    var form = $("#dynamicModal form").first();
    $("#dynamicModal .btn-send-form").first().button('loading');
    $('#dynamicModal .errors-list').first().empty()
    $('#dynamicModal .alert').first().addClass("hidden");
    $.ajax({
        url: form.attr("action"),
        type: "POST",
        data: form.serialize()
    }).done(function (resp) {
        if(resp.success){
            $('#dynamicModal').modal('hide')
        }else{
            for (key in resp.error){
                $('#dynamicModal .errors-list').first().append("<li>"+resp.error[key]+"</li>");
            }
            $('#dynamicModal .alert').first().removeClass("hidden");
            $("#dynamicModal .btn-send-form").first().button('reset');
        }
    });
}

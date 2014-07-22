$(document).on('hidden.bs.modal', function (e) {
    $(e.target).removeData('bs.modal');
});
$(document).ready(function (e) {
    $("select.select2").select2();
    $("select.select2").on("change", function(e){
        $(".form-table-search").first().submit();
    });

    $(".form-table-search").submit(getTable);

    $(".pag-num a").click(getPageTable);

    $(".send-sarch").click(function(e){
        e.preventDefault();
        $(".form-table-search").first().submit();
    });

    $(".form-table-search input").keypress(function(e){
        if(e.keyCode==13)
            $(".form-table-search").first().submit();
    });


    $('#dynamicModal').on('loaded.bs.modal', function (e) {
        $("select.select2").select2();
        $("#dynamicModal .btn-send-form").first().click(sendModalForm);
    })
    $(document).bind("ajaxComplete", function () {
        $(".slider").css('display','none');
        $(".pag-num a").click(getPageTable);
    });

    $(document).bind("ajaxSend", function () {
        $(".slider").css('display','block')
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
            $('#dynamicModal').modal('hide');
            $(".form-table-search").first().submit();
        }else{
            for (key in resp.error){
                $('#dynamicModal .errors-list').first().append("<li>"+resp.error[key]+"</li>");
            }
            $('#dynamicModal .alert').first().removeClass("hidden");
            $("#dynamicModal .btn-send-form").first().button('reset');
        }
    });
}

function getTable(e){
    e.preventDefault();
    var form = $(e.currentTarget);
    $("table tbody").first().remove();
    $("table tfoot").first().remove();
    $.ajax({
        url: form.attr("action"),
        type: "POST",
        data: form.serialize()
    }).done(function (resp) {
        $("table").first().append(resp);
    });
}

function getPageTable(e){
    e.preventDefault();
    var link = $(e.currentTarget);
    $("table tbody").first().empty();
    $.ajax({
        url: link.attr("href"),
    }).done(function (resp) {
        $("table tbody").first().append(resp);
    });
}

$(document).on('hidden.bs.modal', function (e) {
    $(e.target).removeData('bs.modal');
});

$(document).bind("ajaxComplete", function () {
    $(".slider").css('display', 'none');
    $(".pagination a").click(getPageTable);
    $(".popover-button").popover();
});

$(document).bind("ajaxSend", function () {
    $(".slider").css('display', 'block')
});


$(document).ready(function (e) {
    $("select.select2").select2();
    $("select.select2").on("change", function (e) {
        $(".form-table-search").first().submit();
    });

    $(".popover-button").popover();

    $(".form-table-search").submit(getTable);

    $(".pagination a").click(getPageTable);

    $(".send-sarch").click(function (e) {
        e.preventDefault();
        $(".form-table-search").first().submit();
    });

    $(".form-table-search input").keypress(function (e) {
        if (e.keyCode == 13)
            $(".form-table-search").first().submit();
    });

    $('.input-date').datepicker({
            format: 'dd/mm/yyyy'
        });
        $('.input-date').on("keyup", function (e) {
            var value = $(e.currentTarget).val();
            var length = value.length
            if ((length == 3 || length == 6) && !isNaN(value.substring(length - 1, length))) {
                var str = value.substring(0, length - 1);
                str += "/" + value.substring(length - 1, length);
                $(e.currentTarget).val(str);
            }
        });

    $('#dynamicModal').on('loaded.bs.modal', function (e) {

        $("#dynamicModal .btn-send-form").first().click(sendModalForm);

        $('.input-date').datepicker({
            format: 'dd/mm/yyyy'
        });
        $('.input-date').on("keyup", function (e) {
            var value = $(e.currentTarget).val();
            var length = value.length
            if ((length == 3 || length == 6) && !isNaN(value.substring(length - 1, length))) {
                var str = value.substring(0, length - 1);
                str += "/" + value.substring(length - 1, length);
                $(e.currentTarget).val(str);
            }
        });
        $("select.select2").select2();

        $(".numeric").numeric({
            decimal: ","
        });
        $(".select2-together").on("change", function (e) {
            $(".select2-together").select2("val", $(e.currentTarget).val());
        });

        $(".value-uni").on("keyup", function (e) {
            if ($(e.currentTarget).val().replace(",", ".") <= 0 || $(".quantity").first().val() <= 0) {
                $(".value-tot").first().val("");
            } else {
                var value = $(e.currentTarget).val().replace(",", ".") * $(".quantity").first().val().replace(",", ".");
                $(".value-tot").first().val(value.toFixed(2).toString().replace(".", ","));
            }
        });
        $(".value-tot").on("keyup", function (e) {
            if ($(e.currentTarget).val().replace(",", ".") <= 0 || $(".quantity").first().val() <= 0) {
                $(".value-uni").first().val("");
            } else {
                var value = $(e.currentTarget).val().replace(",", ".") / $(".quantity").first().val().replace(",", ".");
                $(".value-uni").first().val(value.toFixed(2).toString().replace(".", ","));
            }
        });

        $(".quantity").on("keyup", function (e) {
            if ($(".value-uni").first().val().replace(",", ".") > 0 && $(".quantity").first().val() > 0) {
                var value = $(".value-uni").first().val().replace(",", ".") * $(".quantity").first().val().replace(",", ".");
                $(".value-tot").first().val(value.toFixed(2).toString().replace(".", ","));
            } else {
                if ($(".value-tot").first().val().replace(",", ".") > 0 && $(".quantity").first().val() > 0) {
                    var value = $(".value-tot").first().val().replace(",", ".") / $(".quantity").first().val().replace(",", ".");
                    $(".value-uni").first().val(value.toFixed(2).toString().replace(".", ","));
                }else{
                    $(".value-tot").first().val("");
                }
            }

        });
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
        if (resp.success) {
            $('#dynamicModal').modal('hide');
            $(".form-table-search").first().submit();
        } else {
            for (key in resp.error) {
                $('#dynamicModal .errors-list').first().append("<li>" + resp.error[key] + "</li>");
            }
            $('#dynamicModal .alert').first().removeClass("hidden");
            $("#dynamicModal .btn-send-form").first().button('reset');
        }
    }).error(function (j, sta, thr) {
        if (thr) {
            $('#dynamicModal .errors-list').first().append("<li>" + thr + "</li>");
            $('#dynamicModal .alert').first().removeClass("hidden");
            $("#dynamicModal .btn-send-form").first().button('reset');
        }
    });
}

function getTable(e) {
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

function getPageTable(e) {
    e.preventDefault();
    var link = $(e.currentTarget);
    var form = $("form").first();
    $("table tbody").first().remove();
    $("table tfoot").first().remove();
    $.ajax({
        url: link.attr("href"),
        type: "POST",
        data: form.serialize()
    }).done(function (resp) {
        $("table").first().append(resp);
    });
}

function confirmationMotal(elem) {

}

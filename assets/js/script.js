$(document).on('hidden.bs.modal', function (e) {
    $(e.target).removeData('bs.modal');
});
$(document).ready(function (e) {
    $(".chosen-select").chosen({
        width: "100%"
    })
    $(".chosen-select").on('chosen:showing_dropdown', function (evt, params) {
        $(".chosen-drop").first().css('width', $(".chosen-container").first().css('width'));
    });

    $(document).bind("ajaxComplete", function () {
        $(".chosen-select").chosen({
            width: "100%"
        })
        $(".chosen-select").on('chosen:showing_dropdown', function (evt, params) {
            $(".chosen-drop").each(function (index) {
                console.log($(this).children(".chosen-drop"));
                $(this).css('width', $(this).parent().css('width'));
            });
        });
    });
})

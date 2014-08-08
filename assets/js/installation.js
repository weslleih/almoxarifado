$("#confirm").on("click",function(e){
    e.preventDefault();
    var link = $(this);
    link.button('loading');
    $.ajax({
        url: link.data("url")
    }).done(function (resp) {
        link.button('reset')
    });
})

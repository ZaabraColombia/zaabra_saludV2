$(function () {
    var filtro = $("#search");
    filtro.click(function (e) {
        var filtro = $(this);
        filtro.autocomplete("search", filtro.val());
    }).autocomplete({
        autoFocus: true,
        minLength: 0,
        source: function (request, response) {
            $.ajax({
                url: filtro.data('url'),
                dataType: "json",
                type: 'post',
                header: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: { search: request.term },
                success: function (data) {
                    response(data);
                }
            });
        }, select: function (event, ui) {
            window.location = ui.item.url;
        }, open: function () {
            //$("ul.ui-menu").css('width', $('.containt_buscador_desk').width() + 'px');
        }
    }).data("ui-autocomplete")._renderItem = function (ul, item) {

        var btn = '<a href="' + item.ruta + '">' + item.titulo + '</a>';

        return $("<li></li>")
            .data("item.autocomplete", item)
            .append(btn)
            .appendTo(ul);

    }
});

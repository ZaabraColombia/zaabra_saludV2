$('.search').autocomplete({
    autoFocus: true,
    minLength: 0,
    source: function (request, response) {
        var type = $(this.element).data('type');
        $.ajax({
            url: '/api/search/' + type,
            dataType: "json",
            contentType: 'application/json',
            type: 'get',
            data: {
                term: request.term,
            },
            success: function( res ) {
                response( $.map(res.data, function (item) {

                    return {
                        label: item.code + '-' + item.text,
                        value: item.code + '-' + item.text,
                        code: item.code
                    };
                }));
            }
        });
    },
    select: function( event , ui ) {
        let input = $(this).data('description');
        console.log(ui);
        if ($(input)) $(input).html(ui.item.label);
    }
});
$('.search-cups').autocomplete({
    autoFocus: true,
    minLength: 0,
    source: function (request, response) {
        $.ajax({
            url: '/api/search/cie10',
            dataType: "json",
            contentType: 'application/json',
            type: 'get',
            data: {
                term: request.term,
            },
            success: function( res ) {
                console.log(res);
                response( $.map(res.data, function (item) {

                    return {
                        label: item.code + '-' + item.text,
                        value: item.code + '-' + item.text,
                        code: item.code
                    };
                }));
            }
        });
    },
    select: function( event , ui ) {
        let input = $(this).data('description');
        console.log(ui);
        if ($(input)) $(input).html(ui.item.label);
    }
});

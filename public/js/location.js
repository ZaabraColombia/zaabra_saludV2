
//Inicializar segmentado por el modal
var selects = $('.select2');

$.each(selects, function (key, item) {
    var modal = ($(item).data('modal')) ? $($(item).data('modal')):null;
    $(item).select2({
        theme: 'bootstrap4',
        dropdownParent: modal
    });
});

//Para el pais
$('.pais').on('change', async function () {
    var item = $(this);

    var region = $(item.data('region'));
    region.empty();

    var ciudad = $(item.data('ciudad'));
    ciudad.empty();

    var val = (item.val() !== '') ? item.val() : ((item.data('id') !== '') ? item.data('id') : null);

    if (val) {

        $.ajax({
            url: '/ubicacion/regiones',
            dataType: 'json',
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {'pais': val},
            success: function (response) {
                if (response) {
                    $.each(response, function (key, item) {
                        var newOption = new Option(item.nombre, item.id, false, false);
                        region.append(newOption);
                    });
                }
                item.val(val);

                region.trigger('change');
            },
            error: function (response) {
                console.log(response);
            }
        });


    }
});
//Para el departamento
$('.region').on('change', function () {
    var item = $(this);

    var pais = $(item.data('pais'));

    var ciudad = $(item.data('ciudad'));
    ciudad.empty();

    var val = (item.val() !== '') ? item.val():((item.data('id') !== '') ? item.data('id'):null );

    if(val){

        $.ajax({
            url: '/ubicacion/ciudades',
            dataType: 'json',
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {'pais': pais.val(), 'region': val},
            success: function (response) {
                if (response) {
                    $.each(response, function (key, item) {
                        var newOption = new Option(item.nombre, item.id, false, false);
                        ciudad.append(newOption);
                    });
                }
                item.val(val);

                ciudad.trigger('change');
            },
            error: function (response) {
                console.log(response);
            }
        });
    }
});

//para ciudad
$('.ciudad').on('change', function () {
    var item = $(this);
    var val = (item.val() !== '') ? item.val():((item.data('id') !== '') ? item.data('id'):null );
    item.val(val);
});

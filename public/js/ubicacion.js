
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
$('.pais').on('change', function () {
    var item = $(this);

    var departamento = $(item.data('departamento'));
    departamento.empty();

    console.log(departamento);
    var provincia = $(item.data('provincia'));
    provincia.empty();

    var ciudad = $(item.data('ciudad'));
    ciudad.empty();

    var val = (item.val() !== '') ? item.val():((item.data('id') !== '') ? item.data('id'):null );

    if(val){
        $.get("/api/departamentos/" + val, function (response) {
            if(response.items){
                $.each(response.items,function(key, item){
                    var newOption = new Option(item.text, item.id, false, false);
                    departamento.append(newOption);
                });
            }

            departamento.val(departamento.data('id')).trigger('change');
        }, 'json');
    }
});
//Para el departamento
$('.departamento').on('change', function () {
    var item = $(this);

    var provincia = $(item.data('provincia'));
    provincia.empty();

    var ciudad = $(item.data('ciudad'));
    ciudad.empty();

    var val = (item.val() !== '') ? item.val():((item.data('id') !== '') ? item.data('id'):null );

    if(val){
        $.get("/api/provincias/" + val, function (response) {
            if(response.items){
                $.each(response.items,function(key, item){
                    var newOption = new Option(item.text, item.id, false, false);
                    provincia.append(newOption);
                });
            }

            item.val(val);
            provincia.val(provincia.data('id')).trigger('change');

        }, 'json');
    }
});
//Para la provincia
$('.provincia').on('change', function () {
    var item = $(this);

    var ciudad = $(item.data('ciudad'));
    ciudad.empty();

    var val = (item.val() !== '') ? item.val():((item.data('id') !== '') ? item.data('id'):null );

    if(val){
        $.get("/api/ciudades/" + val, function (response) {
            if(response.items){
                $.each(response.items,function(key, item){
                    var newOption = new Option(item.text, item.id, false, false);
                    ciudad.append(newOption);
                });
            }

            item.val(val);

            ciudad.val(ciudad.data('id')).trigger('change');

        }, 'json');
    }
});
//para ciudad
$('.ciudad').on('change', function () {
    var item = $(this);
    var val = (item.val() !== '') ? item.val():((item.data('id') !== '') ? item.data('id'):null );
    item.val(val);
});


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

    var provincia = $(item.data('provincia'));
    provincia.empty();

    var ciudad = $(item.data('ciudad'));
    ciudad.empty();

    if(item.val()){
        $.get("/api/departamentos/" + item.val(), function (response) {
            if(response.items){
                $.each(response.items,function(key, item){
                    var newOption = new Option(item.text, item.id, false, false);
                    departamento.append(newOption);
                });
            }
            departamento.trigger('change');
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

    if(item.val()){
        $.get("/api/provincias/" + item.val(), function (response) {
            if(response.items){
                $.each(response.items,function(key, item){
                    var newOption = new Option(item.text, item.id, false, false);
                    provincia.append(newOption);
                });
            }
            provincia.trigger('change');
        }, 'json');
    }
});
//Para la provincia
$('.provincia').on('change', function () {
    var item = $(this);

    var ciudad = $(item.data('ciudad'));
    ciudad.empty();

    if(item.val()){
        $.get("/api/ciudades/" + item.val(), function (response) {
            if(response.items){
                $.each(response.items,function(key, item){
                    var newOption = new Option(item.text, item.id, false, false);
                    ciudad.append(newOption);
                });
            }
            ciudad.trigger('change');
        }, 'json');
    }
});

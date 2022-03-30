//Están invertidos por la inicialización
var ciudad = $('#ciudad_id').select2({
    theme: 'bootstrap4',
    dropdownParent: $($('#ciudad_id').data('modal'))
});

var provincia = $('.provincia_id').select2({
    theme: 'bootstrap4',
    dropdownParent: $($(this).data('modal'))
}).on('change', function () {
    var id_provincia = $(this).val();
    ciudad.empty();
    if(id_provincia){
        $.ajax({
            type:"GET",
            url:"/api/ciudades/" + id_provincia,
            dataType: 'json',
            success:function(res){
                if(res.items){
                    $.each(res.items,function(key, item){
                        var newOption = new Option(item.text, item.id, false, false);
                        ciudad.append(newOption);
                    });
                }
                ciudad.trigger('change');
            }
        });
    }
});

var departamento = $('.departamento_id').select2({
    theme: 'bootstrap4',
    dropdownParent: $($(this).data('modal'))
}).on('change', function () {
    var id_departamento = $(this).val();
    provincia.empty();
    ciudad.empty();
    if(id_departamento){
        $.ajax({
            type:"GET",
            url:"/api/provincias/" + id_departamento,
            dataType: 'json',
            success:function(res){
                if(res.items){
                    $.each(res.items,function(key, item){
                        var newOption = new Option(item.text, item.id, false, false);
                        provincia.append(newOption);
                    });
                }
                provincia.trigger('change');
            }
        });
    }
});

var pais = $('.pais_id').select2({
    theme: 'bootstrap4',
    dropdownParent: $($(this).data('modal'))
}).on('change', function () {
    var id_pais = $(this).val();
    departamento.empty();
    provincia.empty();
    ciudad.empty();
    if(id_pais){
        $.ajax({
            type:"GET",
            url:"/api/departamentos/" + id_pais,
            dataType: 'json',
            success:function(res){
                if(res.items){
                    $.each(res.items,function(key, item){
                        var newOption = new Option(item.text, item.id, false, false);
                        departamento.append(newOption);
                    });
                }
                departamento.trigger('change');
            }
        });
    }
});

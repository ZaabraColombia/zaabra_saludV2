//-------------------------------------------------Adicinar campos experinecia-------------------------------------------
var campos_max= 3;   //max de 4 campos
        var x = 1;
        $('#add_field2').click (function(e) {
                e.preventDefault();     //prevenir novos clicks
                if (x < campos_max) {
                        $('#listas').append(
                           '<div>'+
                                '<div class="col-12">'+
                                        '<div class="form-group">'+
                                        '<label for="title">Empresa</label>'+
                                        '<input id="nombreEmpresaExperiencia"  type="text" name="nombreEmpresaExperiencia[]" value="">'+
                                        '</div>'+
                                '</div>'+
                                '<div class="col-12">'+
                                        '<div class="form-group">'+
                                        '<label for="title">cargo</label>'+
                                        '<input id="descripcionExperiencia"  type="text" name="descripcionExperiencia[]" value="">'+
                                        '</div>'+
                                '</div>'+
                                '<div class="form-group col-12">'+
                                        '<label for="example-date-input" class="col-2 col-form-label">Fecha de inicio</label>'+
                                        '<div class="col-10">'+
                                        '<input class="form-control" type="date"  id="fechaInicioExperiencia" name="fechaInicioExperiencia[]">'+
                                        '</div>'+
                                '</div>'+
                                '<div class="form-group col-12">'+
                                        '<label for="example-date-input" class="col-2 col-form-label">Fecha de terminación</label>'+
                                        '<div class="col-10">'+
                                        '<input class="form-control" type="date"  id="fechaFinExperiencia" name="fechaFinExperiencia[]">'+
                                        '</div>'+
                                '</div>'+
                                '<a href="#" class="remover_campo">Remover</a>'+
                           '</div>'
                           
                                );
                        x++;
                        $(".contadorexperinecia").val(x);
                }
        });
        // Remover o div anterior
        $('#listas2').on("click",".remover_campo",function(e) {
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
                $(".contadorexperinecia").val(x);
        });

        
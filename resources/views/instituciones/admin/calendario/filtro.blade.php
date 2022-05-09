@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2-bootstrap4.min.css') }}">
@endsection

@extends('instituciones.admin.layouts.layout')

@section('contenido')
    <div class="container-fluid p-0 pr-lg-4">
        <div class="containt_agendaProf">
            <div class="my-4 my-xl-5">
                <h1 class="title__xl green_bold">Administración citas</h1>
                <p class="text__md black_light">
                    Gestione el flujo de pacientes de uno o varios consultorios. <br><br> Filtrar por:
                </p>
                <div class="filtrado_citas">
                    <ul class="m-0">
                        <li>Fecha</li>
                        <li>Profesionales</li>
                    </ul>
                    <ul class="m-0">
                        <li>Servicio</li>
                        <li>Especialidad</li>
                    </ul>
                </div>
            </div>

            <div class="containt_main_table mb-3">
                <div class="row">
                    @if($errors->any())
                        <div class="col-12">
                            <div class="alert alert-danger" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="alert-heading">Error!</h4>
                                @error('lista-profesionales.*.id')
                                <p>{{ $message }}</p>
                                @enderror
                                @error('fecha')
                                <p>{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    @endif
                </div>
                <form action="{{ route('institucion.calendario.citas') }}" method="post">
                    <div class="row">
                        <div class="col-md-4 input__box d-flex align-items-center">
                            <label for="fecha">Fecha:</label>&nbsp; &nbsp;
                            <input type="date" id="fecha" name="fecha" value="{{ old('fecha', date('Y-m-d')) }}"
                                   class="@error('fecha') is-invalid @enderror"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 input__box">
                            <label for="profesionales">Profesionales</label>
                            <select id="profesionales" name="profesionales" class="select2">
                                <option></option>
                                @if($profesionales->isNotEmpty())
                                    @foreach($profesionales as $profesional)
                                        <option value="{{ $profesional->id_profesional_inst }}">{{ $profesional->nombre_completo }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="col-md-4 input__box">
                            <label for="servicios">Servicio</label>
                            <select id="servicios" name="servicios" class="select2">
                                <option></option>
                                @if($servicios->isNotEmpty())
                                    @foreach($servicios as $servicio)
                                        <option value="{{ $servicio->id }}">{{ $servicio->nombre }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="col-md-4 input__box">
                            <label for="especialidades">Especialidad</label>
                            <select id="especialidades" name="especialidades" class="select2">
                                <option></option>
                                @if($especialidades->isNotEmpty())
                                    @foreach($especialidades as $especialidad)
                                        <option value="{{ $especialidad->idEspecialidad }}">{{ $especialidad->nombreEspecialidad }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    @php $lista_profesionales = collect(old('lista-profesionales'))->values() @endphp

                    <div class="containt_main_table mb-3 mt-4 px-xl-5">
                        <table class="table table-striped" id="table-lista-profesionales">
                            <thead class="thead_green">
                            <tr>
                                <th scope="col">Nombre profesional</th>
                                <th scope="col">Acción</th>
                            </tr>
                            </thead>
                            <tbody>

                            @if($lista_profesionales->isNotEmpty())
                                @foreach($lista_profesionales as $key => $item)
                                    <tr>
                                        <td>
                                            {{ $item['nombre'] }}
                                            <input type="hidden" name="lista-profesionales[{{ $key }}][nombre]"
                                                   id="lista-profesionales-{{ $key }}-nombre" value="{{ $item['nombre'] }}">
                                            <input type="hidden" name="lista-profesionales[{{ $key }}][id]"
                                                   id="lista-profesionales-{{ $key }}-id" value="{{ $item['id'] }}">
                                        </td>
                                        <td>
                                            <button class="border-0 bg-transparent tool top btn-quitar-filtro" type="button" data-id="{{ $item['id'] }}">
                                                <i data-feather="x-circle" class="green_bold"></i> <span class="tiptext">Eliminar filtro</span>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>

                    <!-- Buttons -->
                    <div class="row m-0 content_btn_right">
                        <button type="submit" class="button_green">Filtar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        $('.select2').select2({
            theme: 'bootstrap4'
        });

        $('#profesionales').on('change.select2', (event) => {
            var select = $(event.target);

            if (select.val() !== '') {
                search(select.val(), 'profesional');
                select.val('').trigger('change');
            }
        });

        $('#servicios').on('change.select2', (event) => {
            var select = $(event.target);
            console.log(select.val());
            if (select.val() !== '') {
                search(select.val(), 'servicio');
                select.val('').trigger('change');
            }
        });

        $('#especialidades').on('change.select2', (event) => {
            var select = $(event.target);
            console.log(select.val());
            if (select.val() !== '') {
                search(select.val(), 'especialidad');
                select.val('').trigger('change');
            }
        });

        var count = {{ $lista_profesionales->count() }};

        function search(id, tipo) {
            $.ajax({
                url: "{{ route('institucion.calendario.buscar') }}",
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{id:id, tipo:tipo},
                dataType: 'json',
                success: (response) => {
                    $.each(response.items, (key, item) =>{
                        var input = $('.list-ids[value=' + item.id + ']');

                        console.log(input);

                        if (input.length <= 0)
                        {
                            $('#table-lista-profesionales').append('<tr>' +
                                '<td>' +
                                item.nombre_completo +
                                '<input type="hidden" name="lista-profesionales[' + count + '][nombre]" value="' + item.nombre_completo + '" id="lista-profesionales-0-nombre">' +
                                '<input type="hidden" name="lista-profesionales[' + count + '][id]" class="list-ids" value="' + item.id + '" id="lista-profesionales-0-id">' +
                                '</td>' +
                                '<td>' +
                                '<button class="border-0 bg-transparent tool top btn-quitar-filtro" type="button" data-id="' + item.id + '">' +
                                '<i data-feather="x-circle" class="green_bold"></i> <span class="tiptext">Eliminar filtro</span>' +
                                '</button>' +
                                '</td>' +
                                '</tr>');
                            count++;
                        }
                    });
                    feather.replace();
                },
                error: (response) => {
                    //
                    //  console.log(response);
                }
            });

            $('#table-lista-profesionales').on('click', '.btn-quitar-filtro', function (event) {
                $(this).parents('tr').remove();
            });
        }

    </script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2-bootstrap4.min.css') }}">
@endsection

@extends('instituciones.admin.layouts.layout')

@section('contenido')
<div class="container-fluid p-0 pr-lg-4">
        <div class="containt_agendaProf">
            <div class="my-4 my-xl-5">
                <h1 class="title__xl green_bold">Control de actividades</h1>
                <p class="text__md black_light">
                    Controle el inico de actividades filtrandolas por: Profesionales, servicios y especialidades, para una optima gestión y flujo de citas médicas de la institución.
                </p>
            </div>

            <div class="containt_main_table mb-3">
                <form action="">
                    <div class="row">
                        <div class="col-md-4 input__box d-flex align-items-center">
                            <label for="date">Fecha:</label>&nbsp; &nbsp;
                            <input type="date" id="date" name="date" value="{{ old('date') }}"
                                class="@error('date') is-invalid @enderror"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 input__box">
                            <label for="tipo_documento_id">Profesionales</label>
                            <select id="tipo_documento_id" name="tipo_documento_id" class="select2 @error('tipo_documento_id') is-invalid @enderror">
                                <option value="}}"></option>
                            </select>
                        </div>

                        <div class="col-md-4 input__box">
                            <label for="tipo_documento_id">Servicio</label>
                            <select id="tipo_documento_id" name="tipo_documento_id" class="select2 @error('tipo_documento_id') is-invalid @enderror">
                                <option value="}}"></option>
                            </select>
                        </div>

                        <div class="col-md-4 input__box">
                            <label for="tipo_documento_id">Especialidad</label>
                            <select id="tipo_documento_id" name="tipo_documento_id" class="select2 @error('tipo_documento_id') is-invalid @enderror">
                                <option value="}}"></option>
                            </select>
                        </div>
                    </div>

                    <div class="containt_main_table mb-3 mt-4 px-xl-5">
                        <table class="table table-striped">
                            <thead class="thead_green">
                                <tr>
                                    <th scope="col">Nombre profesional</th>
                                    <th scope="col">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Sebastian Alejandro Sandoval Gutierrez</td>
                                    <td>
                                        <button class="border-0 bg-transparent tool top" type="button">
                                            <i data-feather="x-circle" class="green_bold"></i> <span class="tiptext">Eliminar filtro</span>
                                        </button>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Sebastian Alejandro Sandoval Gutierrez</td>
                                    <td>
                                        <button class="border-0 bg-transparent tool top" type="button">
                                            <i data-feather="x-circle" class="green_bold"></i> <span class="tiptext">Eliminar filtro</span>
                                        </button>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Sebastian Alejandro Sandoval Gutierrez</td>
                                    <td>
                                        <button class="border-0 bg-transparent tool top" type="button">
                                            <i data-feather="x-circle" class="green_bold"></i> <span class="tiptext">Eliminar filtro</span>
                                        </button>
                                    </td>
                                </tr>
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
<script>
            $('.select2').select2({
            theme: 'bootstrap4'
        });
</script>
@endsection
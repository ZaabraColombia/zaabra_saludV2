@section('styles')
@endsection

@extends('instituciones.admin.layouts.layout')

@section('contenido')
    <div class="container-fluid p-0 pr-lg-4">
        <div class="containt_agendaProf">
            <div class="my-4 my-xl-5">
                <h1 class="title__xl green_bold">Usuarios</h1>
            </div>
        

            <div class="containt_main_table mb-3">
                <form action="" method="post" id="" enctype="">
                    <div class="d-block d-md-flex justify-content-between py-3">
                        <h2 class="subtitle__lg green_bold mb-4">Nuevo usuario</h2>
                        <!-- Check box interactivo y personalizado -->
                        <div class="checkbox">
                            <input type="checkbox" name="checkbox" id="conv_check">
                            <label class="label_check" for="conv_check"> 
                                <b class="txt1">Usuario inactivo</b>
                                <b class="txt2">Usuario activo</b>
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 input__box">
                            <label for="primer_nombre">Primer nombre</label>
                            <input type="text" id="primer_nombre" name="primer_nombre" value="{{ old('primer_nombre') }}"
                                   class="@error('primer_nombre') is-invalid @enderror" required/>
                        </div>

                        <div class="col-md-3 input__box">
                            <label for="segundo_nombre">Segundo nombre</label>
                            <input type="text" id="segundo_nombre" name="segundo_nombre" value="{{ old('segundo_nombre') }}"
                                   class="@error('segundo_nombre') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-3 input__box">
                            <label for="primer_apellido">Primer apellido</label>
                            <input type="text" id="primer_apellido" name="primer_apellido" value="{{ old('primer_apellido') }}"
                                   class="@error('primer_apellido') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-3 input__box">
                            <label for="segundo_apellido">Segundo apellido</label>
                            <input type="text" id="segundo_apellido" name="segundo_apellido" value="{{ old('segundo_apellido') }}"
                                   class="@error('segundo_apellido') is-invalid @enderror" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 input__box">
                            <label for="tipo_documento_id">Tipo de identificación</label>
                            <select class="@error('tipo_documento_id') is-invalid @enderror" id="tipo_documento_id"
                                    name="tipo_documento_id" value="{{ old('tipo_documento_id') }}">
                                <option value=""></option>
                                <option value="Tipo de identificación 1">Tipo de identificación 1</option>
                                <option value="Tipo de identificación 2">Tipo de identificación 2</option>
                                <option value="Tipo de identificación 3">Tipo de identificación 3</option>
                            </select>
                        </div>

                        <div class="col-md-6 input__box">
                            <label for="numero_documento">Número de identificación</label>
                            <input type="text" id="numero_documento" name="numero_documento" value="{{ old('numero_documento') }}"
                                class="@error('numero_documento') is-invalid @enderror"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 input__box">
                            <label for="fech_nacimiento">Fecha de nacimiento</label>
                            <input type="date" id="fech_nacimiento" name="fech_nacimiento" value="{{ old('fech_nacimiento') }}"
                                class="@error('fech_nacimiento') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-4 input__box">
                            <label for="direccion">Dirección</label>
                            <input type="text" id="direccion" name="direccion" value="{{ old('direccion') }}"
                                class="@error('direccion') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-4 input__box">
                            <label for="telefono">Teléfono</label>
                            <input type="text" id="telefono" name="telefono" value="{{ old('telefono') }}"
                                class="@error('telefono') is-invalid @enderror"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 input__box">
                            <label for="movil">Móvil</label>
                            <input type="text" id="movil" name="movil" value="{{ old('movil') }}"
                                class="@error('movil') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-4 input__box">
                            <label for="ciudad">Ciudad</label>
                            <input type="text" id="ciudad" name="ciudad" value="{{ old('ciudad') }}"
                                class="@error('ciudad') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-4 input__box">
                            <label for="email">E-mail</label>
                            <input type="mail" id="email" name="email" value="{{ old('email') }}"
                                class="@error('email') is-invalid @enderror"/>
                        </div>
                    </div>

                    <!-- Linea división de elementos -->
                    <div class="dropdown-divider my-4"></div>

                    <!-- Contraseña del usuario -->
                    <h2 class="subtitle__lg green_bold mb-4">Contraseña</h2>

                    <div class="row">
                        <div class="col-md-6 input__box">
                            <label for="password">Contraseña</label>
                            <input type="password" id="password" name="password" value="{{ old('password') }}"
                                class="@error('password') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-6 input__box">
                            <label for="confirm_password">Confirmar contraseña</label>
                            <input type="password" id="confirm_password" name="confirm_password" value="{{ old('confirm_password') }}"
                                class="@error('confirm_password') is-invalid @enderror"/>
                        </div>
                    </div>

                    <!-- Linea división de elementos -->
                    <div class="dropdown-divider my-4"></div>

                    <!-- Acceso de usuario -->
                    <h2 class="subtitle__lg green_bold mb-4">Acceso de usuario</h2>

                    <div class="row list__form">
                        <div class="col-6 col-md-4 check__box_green">
                            <input type="checkbox" value="1" id="semana-1" name="semana[]">
                            <label class="label_check_green" for="semana-1">Acceso 1</label>
                        </div>

                        <div class="col-6 col-md-4 check__box_green">
                            <input type="checkbox" value="2" id="semana-2" name="semana[]">
                            <label class="label_check_green" for="semana-2">Acceso 2</label>
                        </div>

                        <div class="col-6 col-md-4 check__box_green">
                            <input type="checkbox" value="3" id="semana-3" name="semana[]">
                            <label class="label_check_green" for="semana-3">Acceso 3</label>
                        </div>

                        <div class="col-6 col-md-4 check__box_green">
                            <input type="checkbox" value="3" id="semana-3" name="semana[]">
                            <label class="label_check_green" for="semana-3">Acceso 4</label>
                        </div>

                        <div class="col-6 col-md-4 check__box_green">
                            <input type="checkbox" value="3" id="semana-3" name="semana[]">
                            <label class="label_check_green" for="semana-3">Acceso 5</label>
                        </div>

                        <div class="col-6 col-md-4 check__box_green">
                            <input type="checkbox" value="3" id="semana-3" name="semana[]">
                            <label class="label_check_green" for="semana-3">Acceso 6</label>
                        </div>

                        <div class="col-6 col-md-4 check__box_green">
                            <input type="checkbox" value="3" id="semana-3" name="semana[]">
                            <label class="label_check_green" for="semana-3">Acceso 7</label>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="row m-0 mt-3 content_btn_right">
                        <a href="" class="button_transparent mr-2" style="color: #434343">Cancelar</a>
                        <button type="submit" class="button_green">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // función para mostrar y ocultar la tabla de vincular convenios
        $(document).ready(function(){
            $("#checkon").click(function(){
                $("#table_servicio").removeClass('d-none');
                $("#table_servicio").addClass('d-block');
            });

            $("#checkoff").click(function(){
                $("#table_servicio").addClass('d-none');
                $("#table_servicio").removeClass('d-block');
            });
        });
    </script>
@endsection
@section('styles')
@endsection

@extends('instituciones.admin.layouts.layout')

@section('contenido')
    <div class="container-fluid p-0 pr-lg-4">
        <div class="containt_agendaProf">
            <div class="my-4 my-xl-5">
                <h1 class="title__xl green_bold">Nuevo Convenio</h1>
            </div>

            <div class="containt_main_table mb-3">
                <form action="" method="post" id="" enctype="">
                    <!-- Información básica -->
                    <div class="d-block d-md-flex justify-content-between py-3">
                        <h2 class="subtitle__lg green_bold mb-4">Información básica</h2>
                        <!-- Check box interactivo y personalizado -->
                        <div class="checkbox">
                            <input type="checkbox" name="checkbox" id="conv_check">
                            <label class="label_check" for="conv_check"> 
                                <b class="txt1">Convenio inactivo</b>
                                <b class="txt2">Convenio activo</b>
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 input__box">
                            <label for="pr_nombre">Primer nombre / Razón social</label>
                            <input type="text" id="pr_nombre" name="pr_nombre" value="{{ old('pr_nombre') }}"
                                class="@error('pr_nombre') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-3 input__box">
                            <label for="sg_nombre">Segundo nombre</label>
                            <input type="text" id="sg_nombre" name="sg_nombre" value="{{ old('sg_nombre') }}"
                                class="@error('sg_nombre') @enderror"/>
                        </div>

                        <div class="col-md-3 input__box">
                            <label for="pr_apellido">Primer apellido</label>
                            <input type="text" id="pr_apellido" name="pr_apellido" value="{{ old('pr_apellido') }}"
                                class="@error('pr_apellido') @enderror"/>
                        </div>
                        
                        <div class="col-md-3 input__box">
                            <label for="sg_apellido">Segundo apellido</label>
                            <input type="text" id="sg_apellido" name="sg_apellido" value="{{ old('sg_apellido') }}"
                                class="@error('sg_apellido') @enderror"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 input__box">
                            <label for="tp_identificacion">Tipo de identificación</label>
                            <select class="@error('tp_identificacion') is-invalid @enderror" id="tp_identificacion"
                                    name="tp_identificacion" value="{{ old('tp_identificacion') }}">
                                <option value=""></option>
                                <option value="Cédula de ciudadanía">Cédula de ciudadanía</option>
                                <option value="Cédula estranjera">Cédula estranjera</option>
                                <option value="Pasaporte">Pasaporte</option>
                            </select>
                        </div>

                        <div class="col-md-6 input__box">
                            <label for="num_identificacion">Número de identificación</label>
                            <div class="row m-0">
                                <input class="col-md-8 m-0 no_brad_right" type="text" id="num_identificacion" name="num_identificacion" value="{{ old('num_identificacion') }}"
                                    class="@error('num_identificacion') is-invalid @enderror"/>

                                <input class="col-md-4 m-0 no_brad_left" type="text" id="cod_identificacion" name="cod_identificacion" value="{{ old('cod_identificacion') }}"
                                class="@error('cod_identificacion') is-invalid @enderror" placeholder="Cod."/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 input__box">
                            <label for="dg_verificacion">Digito de verificación (DV)</label>
                            <input type="text" id="dg_verificacion" name="dg_verificacion" value="{{ old('dg_verificacion') }}"
                                class="@error('dg_verificacion') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-4 input__box">
                            <label for="cod_prest_ser">Código del prestador del servicio</label>
                            <input type="text" id="cod_prest_ser" name="cod_prest_ser" value="{{ old('cod_prest_ser') }}"
                                class="@error('cod_prest_ser') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-4 input__box">
                            <label for="cod_convenio">Código del convenio</label>
                            <input type="text" id="cod_convenio" name="cod_convenio" value="{{ old('cod_convenio') }}"
                                class="@error('cod_convenio') is-invalid @enderror"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 input__box">
                            <label for="tp_contribuyente">Tipo de contribuyente</label>
                            <select class="@error('tp_contribuyente') is-invalid @enderror" id="tp_contribuyente" 
                                    name="tp_contribuyente" value="{{ old('tp_contribuyente') }}">
                                <option value=""></option>
                                <option value="contribuyente 1">contribuyente 1</option>
                                <option value="contribuyente 2">contribuyente 2</option>
                                <option value="contribuyente 3">contribuyente 3</option>
                            </select>
                        </div>

                        <div class="col-md-4 input__box">
                            <label for="act_economica">Actividad económica</label>
                            <input type="text" id="act_economica" name="act_economica" value="{{ old('act_economica') }}"
                                class="@error('act_economica') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-4 input__box">
                            <label for="fma_pago">Forma de pago</label>
                            <input type="text" id="fma_pago" name="fma_pago" value="{{ old('fma_pago') }}"
                                class="@error('fma_pago') is-invalid @enderror"/>
                        </div>
                    </div>

                    <!-- Linea división de elementos -->
                    <div class="dropdown-divider my-4"></div>

                    <!-- Información de contacto -->
                    <h2 class="subtitle__lg green_bold mb-4">Información de contacto</h2>

                    <div class="row">
                        <div class="col-md-4 input__box">
                            <label for="tp_establecimiento">Tipo de establecimiento</label>
                            <select class="@error('') is-invalid @enderror" id="tp_establecimiento"
                                    name="tp_establecimiento" value="{{ old('tp_establecimiento') }}">
                                <option value=""></option>    
                                <option value="Establecimiento 1">Establecimiento 1</option>
                                <option value="Establecimiento 2">Establecimiento 2</option>
                                <option value="Establecimiento 3">Establecimiento 3</option>
                            </select>
                        </div>

                        <div class="col-md-4 input__box">
                            <label for="direccion">Dirección</label>
                            <input type="text" id="direccion" name="direccion" value="{{ old('direccion') }}"
                                class="@error('direccion') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-4 input__box">
                            <label for="cod_postal">Código postal</label>
                            <input type="text" id="cod_postal" name="cod_postal" value="{{ old('cod_postal') }}"
                                class="@error('cod_postal') is-invalid @enderror"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 input__box">
                            <label for="ciudad">Ciudad</label>
                            <select class="@error('ciudad') is-invalid @enderror" id="ciudad"
                                    name="ciudad" value="{{ old('ciudad') }}">
                                <option value=""></option>
                                <option value="ciudad 1">ciudad 1</option>
                                <option value="ciudad 2">ciudad 2</option>
                                <option value="ciudad 3">ciudad 3</option>
                            </select>
                        </div>

                        <div class="col-md-4 input__box">
                            <label for="deparmento">Departamento</label>
                            <select class="@error('deparmento') is-invalid @enderror" id="deparmento"
                                    name="deparmento" value="{{ old('deparmento') }}">
                                <option value=""></option>
                                <option value="deparmento 1">deparmento 1</option>
                                <option value="deparmento 2">deparmento 2</option>
                                <option value="deparmento 3">deparmento 3</option>
                            </select>
                        </div>

                        <div class="col-md-4 input__box">
                            <label for="pais">País</label>
                            <select class="@error('pais') is-invalid @enderror" id="pais"
                                    name="pais" value="{{ old('pais') }}">
                                <option value=""></option>
                                <option value="pais 1">pais 1</option>
                                <option value="pais 2">pais 2</option>
                                <option value="pais 3">pais 3</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 input__box">
                            <label for="telefono">Teléfono</label>
                            <input type="text" id="telefono" name="telefono" value="{{ old('telefono') }}"
                                class="@error('telefono') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-6 input__box">
                            <label for="tel_adicional">Teléfono adicional</label>
                            <input type="text" id="tel_adicional" name="tel_adicional" value="{{ old('tel_adicional') }}"
                                class="@error('tel_adicional') @enderror"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 input__box">
                            <label for="movil">Móvil</label>
                            <input type="text" id="movil" name="movil" value="{{ old('movil') }}"
                                class="@error('movil') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-6 input__box">
                            <label for="mov_adicional">Móvil adicional</label>
                            <input type="text" id="mov_adicional" name="mov_adicional" value="{{ old('mov_adicional') }}"
                                class="@error('mov_adicional') @enderror"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 input__box">
                            <label for="correo">Correo</label>
                            <input type="mail" id="correo" name="correo" value="{{ old('correo') }}"
                                class="@error('correo') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-6 input__box">
                            <label for="cor_adicional">Correo adicional</label>
                            <input type="mail" id="cor_adicional" name="cor_adicional" value="{{ old('cor_adicional') }}"
                                class="@error('cor_adicional') @enderror"/>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="row m-0 mt-2 content_btn_right">
                        <a href="" class="button_transparent mr-2" style="color: #434343">Cancelar</a>
                        <button type="submit" class="button_green">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection

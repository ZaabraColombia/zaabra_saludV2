@extends('panelAdministrativo.panelAdministrativo')
@section('Panel')
        <section class="section">
            <div class="row" id="basic-table">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Mis pagos</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <p class="card-text">Encuentre aquí los pagos realizados por cada una de las citas de sus especialistas.</p>
                                <!-- Table with outer spacing -->
                                <div class="table-responsive">
                                    <table class="table table-lg">
                                        <thead>
                                            <tr>
                                                <th>Fecha</th>
                                                <th>Tipo de cita</th>
                                                <th>Paciente</th>
                                                <th>Especialidad</th>
                                                <th>Valor</th>
                                                <th>V</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-bold-500">25/05/2021</td>
                                                <td>Presencial</td>
                                                <td>Laura León</td>
                                                <td class="text-bold-500">Traumatología</td>
                                                <td class="text-bold-500">$50.000</td>
                                                <td class="text-bold-500"><button type="button" class="btn btn-primary">Primary</button></td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold-500">25/05/2021</td>
                                                <td>Presencial</td>
                                                <td>Laura León</td>
                                                <td class="text-bold-500">Traumatología</td>
                                                <td class="text-bold-500">$50.000</td>
                                                <td class="text-bold-500"><button type="button" class="btn btn-primary">Primary</button></td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold-500">25/05/2021</td>
                                                <td>Presencial</td>
                                                <td>Laura León</td>
                                                <td class="text-bold-500">Traumatología</td>
                                                <td class="text-bold-500">$50.000</td>
                                                <td class="text-bold-500"><button type="button" class="btn btn-primary">Primary</button></td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold-500">25/05/2021</td>
                                                <td>Presencial</td>
                                                <td>Laura León</td>
                                                <td class="text-bold-500">Traumatología</td>
                                                <td class="text-bold-500">$50.000</td>
                                                <td class="text-bold-500"><button type="button" class="btn btn-primary">Primary</button></td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold-500">25/05/2021</td>
                                                <td>Presencial</td>
                                                <td>Laura León</td>
                                                <td class="text-bold-500">Traumatología</td>
                                                <td class="text-bold-500">$50.000</td>
                                                <td class="text-bold-500"><button type="button" class="btn btn-primary">Primary</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
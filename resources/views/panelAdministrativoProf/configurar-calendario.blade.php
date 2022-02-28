@extends('panelAdministrativoProf.panelAdministrativoProfesional')

@section('PanelProf')
    <section class="section">
        <div class="row w-100">
            <form action="{{ route('profesional.configurar-calendario') }}" method="post" id="form-config-date">
                @csrf
                <div class="col-12">
                    <h2 class="col-12 title_section_form">Configuración de la cita</h2>
                </div>

                <div class="row col-12">
                    <div class="col-md-6 form-group">
                        <label for="duracion">Duración de la cita.</label>
                        <input type="number" class="form-control" id="duracion"
                               name="duracion" value="{{ old('duracion', $config->duracion) }}">
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="descanso">Duración después de la cita.</label>
                        <input type="number" class="form-control" id="descanso"
                               name="descanso" value="{{ old('descanso', $config->descanso) }}">
                    </div>
                </div>

                <div class="col-12 d-flex justify-content-end"> <!-- Buttons -->
                    <button type="submit" class="button_primary">
                        Guardar
                        <i class="fas fa-save pl-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('js/search.js') }}"></script>
@endsection

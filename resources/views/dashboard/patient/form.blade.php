@extends('layouts.vertical', ['title' => 'Pacientes', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
@include('layouts.shared/page-title', ['sub_title' => 'Paciente', 'page_title' =>  \Config::get('layout.titulo')   ])

    <div class="row">

        <div class="card">
            <div class="card-body">
                @if (isset($data))
                {!! Form::model($data, ['method' => 'put', 'autocomplete' => false, 'route' => ['dashboard.patient.update', $data->id, http_build_query(Request::input())], 'class' => $errors->any() ? 'was-validated' : '', 'novalidate', "files" => true]) !!}
                @else
                {!! Form::open(['method' => 'post', 'autocomplete' => false, 'route' => ['dashboard.patient.create', http_build_query(Request::input())], 'class' => $errors->any() ? 'was-validated' : '', 'novalidate', "files" => true]) !!}
                @endif
                <ul class="nav nav-tabs nav-justified nav-bordered mb-3">
                    <li class="nav-item">
                        <a href="#data-patient" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                           Paciente
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#data-entrance-exit" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                            Entradas/Saídas
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane show active" id="data-patient">
                        @include('dashboard.patient.inc.tab-patient')
                    </div>
                    <div class="tab-pane" id="data-entrance-exit">
                        @include('dashboard.patient.inc.tab-entrance-exit')
                    </div>
                </div>
               <div class="row">
                <div class="col-12 text-end pt-3">
                <a href="{!! route('dashboard.patient.index') !!}" class="btn btn-secondary rounded-0">Voltar</a>
                <button type="submit" class="btn btn-primary rounded-0"> Salvar</button>
            </div></div>
                {!! Form::close() !!}
            </div>
        </div>

    </div>


@endsection

@include('dashboard.patient.inc.modal-add-entrance-exit')
@include('dashboard.patient.inc.modal-edt-entrance-exit')
@section('script')

@vite(['resources/js/pages/form-advanced.init.js'])

<script>
    document.querySelectorAll(".bnt-add").forEach(function(button) {
        button.addEventListener("click", function(e) {
            e.preventDefault();
            var patient_id = this.getAttribute('data-patient-id');

            document.getElementById('patient_id').value = ''
            document.getElementById('patient_id').value = patient_id
            var entranceExitAddModalModal = new bootstrap.Modal(document.getElementById('entranceExitAddModal'));
            entranceExitAddModalModal.show();
            });
    });
    document.querySelectorAll(".btn-edit").forEach(function(button) {
        button.addEventListener("click", function(e) {
            e.preventDefault();
            var card_id = this.getAttribute('data-id');
            var url = this.getAttribute('data-url');

        fetchData(card_id)
            .then(data => {
                /* console.log('Dados recebidos:', data); */
                // Abrir o modal após carregar os dados

                    const patient_id_edt = document.getElementById('patient_id_edt')

                    const card_id_edt = document.getElementById('card_id_edt')

                    const date_initial_edt = document.getElementById('date_initial_edt')
                    const date_finish_edt = document.getElementById('date_finish_edt')

                    patient_id_edt.value = data.patient_id
                    card_id_edt.value = data.id
                    date_initial_edt.value = data.date_initial

                    const dataAtual = new Date();
                    const ano = dataAtual.getFullYear();
                    const mes = ('0' + (dataAtual.getMonth() + 1)).slice(-2); // +1 porque os meses são indexados de 0 a 11
                    const dia = ('0' + dataAtual.getDate()).slice(-2);
                    const dataFormatada = ano + '-' + mes + '-' + dia;

                    if(data.date_final != ''){
                        data_final = data.date_finish
                    }else{
                        data_final = dataFormatada
                    }
                /*  console.log(data_final) */
                    date_finish_edt.value = ''
                    date_finish_edt.value = data.date_finish

                    var form = document.getElementById('form');
                    var action = new URL(form.getAttribute('action'));
                    form.setAttribute('action', url);

                    var entranceExitEdtModal = new bootstrap.Modal(document.getElementById('entranceExitEdtModal'));
                    entranceExitEdtModal.show();
            })
            .catch(error => {
                console.error('Erro ao buscar dados:', error.message);
                // Trate o erro adequadamente
        });
    });
});

// Função para consumir a API
async function fetchData(id) {
    try {
        const response = await fetch(`/dashboard/api/v2/entrada-saida/visualizar/${id}`);
        const data = await response.json();

        if (!response.ok) {
            throw new Error(data.error || 'Erro ao processar a solicitação');
        }
        return data;
    } catch (error) {
        console.error('Erro ao buscar dados:', error.message);
        throw error;
    }
}

// Exemplo de utilização da função fetchData

</script>
@endsection

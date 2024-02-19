<div class="row">
    @if (isset($data))
    <div class="col-12 text-end py-2">
        <button class="btn bnt-add btn-primary" data-patient-id="{!! $data->id !!}">Adicionar Registro</button>
    </div>
    <table class="table table-striped">
        <thead class="table-dark text-uppercase">
            <tr>
                <th><strong>id</strong></th>
                <th><strong>Data de Entrada</strong></th>
                <th><strong>Data de Saída</strong></th>
                <th><strong>Descrição</strong></th>
                <th><strong>Cadastrante</strong></th>
                <th colspan="1" width="2%" class="text-center">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($data->cards()->get() as $item)
            <tr>
                <td>{!! $item->id !!}</td>
                <td>{!! date('d/m/Y',strtotime($item->date_initial)) !!}</td>
                <td>{!! $item->date_finish ? date('d/m/Y', strtotime($item->date_finish)) : '' !!}</td>
                <td>{!! $item->description !!}</td>
                <td>{!! $item->user->name !!}</td>
                <td><button class="btn btn-info btn-edit" data-url={!! route('dashboard.card.update',$item->id) !!} data-id="{!! $item->id !!}" data-patient-id="{!! $item->patient_id !!}" data-date-finish="{!! $item->date_finish !!}" data-date-initial="{!! $item->date_initial !!}"><i class="ri-window-line" ></i></button></td>
            </tr>
        @empty

        @endforelse
        <tbody>
        </table>
    @endif
</div>

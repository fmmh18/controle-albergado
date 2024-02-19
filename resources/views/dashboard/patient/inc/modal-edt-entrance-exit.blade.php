
<div class="modal fade" id="entranceExitEdtModal" tabindex="-1" aria-labelledby="entranceExitEdtModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="entranceExitEdtModal">Editar Entrada/Saída do Albergado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="form" action="{!! route('dashboard.card.update',1) !!}" >
                @method('PUT')
                @csrf
            <div class="modal-body">
                <input type="hidden" name="patient_id" id="patient_id_edt">
                <input type="hidden" name="card_id" id="card_id_edt">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="col-12">{!! Form::label('date_initial', 'Data de Entrada',['class' => 'col-form-label font-weight-bold']) !!}</div>
                            <div class="col-12">{{ Form::date('date_initial', null, ['class' => 'form-control' , 'id' => "date_initial_edt"]) }}</div>
                            @if (!empty($errors->first('date_initial')))
                            <label class="invalid-feedback d-block">{!!$errors->first('date_initial')!!}</label>
                            @endif
                        </div>
                        <div class="col">
                            <div class="col-12">{!! Form::label('date_finish', 'Data de Saída',['class' => 'col-form-label font-weight-bold']) !!}</div>
                            <div class="col-12">{{ Form::date('date_finish', null, ['class' => 'form-control' , 'id' => "date_finish_edt"]) }}</div>
                            @if (!empty($errors->first('date_finish')))
                            <label class="invalid-feedback d-block">{!!$errors->first('date_finish')!!}</label>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="co-12">
                            <div class="col-12">{!! Form::label('description', 'Observação',['class' => 'col-form-label font-weight-bold', 'for' => 'snow-editor']) !!}</div>
                        </div>
                        <div class="col-12">
                            <textarea name="description"   class="form-control" id="description_edt" style="height: 300px;"></textarea>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
        </div>
    </div>
</div>

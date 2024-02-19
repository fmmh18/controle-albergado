
<div class="modal fade" id="entranceExitAddModal" tabindex="-1" aria-labelledby="entranceExitAddModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="entranceExitAddModal">Adicionar Entrada/Saída do Albergado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{!! route('dashboard.card.store') !!}" >
            <div class="modal-body">
                <input type="hidden" name="user_id" value="{!! Auth::user()->id !!}">
                <input type="hidden" name="patient_id" id="patient_id">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="col-12">{!! Form::label('date_initial', 'Data de Entrada',['class' => 'col-form-label font-weight-bold']) !!}</div>
                            <div class="col-12">{{ Form::date('date_initial', new \DateTime(), ['class' => 'form-control']) }}</div>
                            @if (!empty($errors->first('date_initial')))
                            <label class="invalid-feedback d-block">{!!$errors->first('date_initial')!!}</label>
                            @endif
                        </div>
                        <div class="col">
                            <div class="col-12">{!! Form::label('date_finish', 'Data de Saída',['class' => 'col-form-label font-weight-bold']) !!}</div>
                            <div class="col-12">{{ Form::date('date_finish', null, ['class' => 'form-control']) }}</div>
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
                            <textarea name="description"   class="form-control" id="snow-editor" style="height: 300px;"></textarea>
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

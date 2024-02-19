
<div class="row">
    <div class="col-12">{!! Form::label('name', 'Nome',['class' => 'col-form-label font-weight-bold']) !!}</div>
    <div class="col-12"> {!! Form::text('name',null, ['class' => 'form-control','placeholder' => 'Nome'] ) !!}
        @if (!empty($errors->first('name')))
        <label class="invalid-feedback d-block">{!!$errors->first('name')!!}</label>
        @endif
    </div>
</div>
<div class="row">
    <div class="col-12">{!! Form::label('year', 'Idade',['class' => 'col-form-label font-weight-bold']) !!}</div>
    <div class="col-12"> {!! Form::number('year',isset($data) ? $data->year : 1, ['class' => 'form-control','placeholder' => 'Idade', 'min' => 0 ] ) !!}
        @if (!empty($errors->first('year')))
        <label class="invalid-feedback d-block">{!!$errors->first('year')!!}</label>
        @endif
    </div>
</div>
<div class="row">
    <div class="col-12">{!! Form::label('origin', 'Origem',['class' => 'col-form-label font-weight-bold']) !!}</div>
    <div class="col-12"> {!! Form::text('origin',null, ['class' => 'form-control','placeholder' => 'Origem'] ) !!}
        @if (!empty($errors->first('origin')))
        <label class="invalid-feedback d-block">{!!$errors->first('origin')!!}</label>
        @endif
    </div>
</div>

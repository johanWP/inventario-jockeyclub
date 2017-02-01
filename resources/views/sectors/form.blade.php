<div class="form-group">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('area_id', 'Área:') !!}
    {!! Form::select('area_id', $area, $selectedArea, ['class' => 'form-control', 'placeholder' => 'Seleccione...']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Descripción:') !!}
    {!! Form::text('description', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('fax', 'Fax:') !!}
    {!! Form::text('fax', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    <a href="#" class="btn btn-default" onclick="history.back()"><i class="fa fa-arrow-left"></i> Volver</a>
    {!! Form::submit($buttonText, ['class'=>'btn btn-primary']) !!}
</div>

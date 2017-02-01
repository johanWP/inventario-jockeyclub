
<div class="form-group">
    {!! Form::label('username', 'Nombre de Usuario:') !!}
    {!! Form::text('username', null, ['class'=>'form-control']) !!}
</div>
<div class="row">
    <div class="form-group col-sm-6">
        {!! Form::label('name', 'Nombre:') !!}
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group col-sm-6">
        {!! Form::label('last_name', 'Apellido:') !!}
        {!! Form::text('last_name', null, ['class'=>'form-control']) !!}
    </div>

</div>

<div class="row">
    <div class="form-group col-sm-6">
        {!! Form::label('position', 'Cargo:') !!}
        {!! Form::text('position', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group col-sm-6" >
        {!! Form::label('email', 'Email:') !!}
        {!! Form::email('email', null, ['class'=>'form-control']) !!}
    </div>

</div>
<div class="row">
    <div class="form-group col-sm-6">
        {!! Form::label('area_id', 'Área:') !!}
        {!! Form::select('area_id', $areas, $selectedArea, ['class' => 'form-control', 'placeholder' => 'Seleccione...']) !!}
    </div>
    <div class="form-group col-sm-6">
        {!! Form::label('sector_id', 'Sector:') !!}
        {!! Form::select('sector_id', $sectors, $selectedSector, ['class' => 'form-control', 'placeholder' => 'Seleccione...']) !!}
    </div>
</div>

<div class="row">
    <div class="form-group col-sm-6">
        {!! Form::label('ext', 'Extensión:') !!}
        {!! Form::text('ext', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group col-sm-6">
        {!! Form::label('image', 'Foto:') !!}
        {!! Form::file('image', null) !!}
    </div>

</div>
<div class="form-group text-right">
    <a href="#" class="btn btn-default" onclick="history.back()">Volver</a>
    {!! Form::submit($buttonText, ['class'=>'btn btn-primary']) !!}
</div>
@include('users.formScript')

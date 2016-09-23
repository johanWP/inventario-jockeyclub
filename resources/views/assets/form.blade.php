<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('fechaCompra', 'Fecha De Compra:') !!}
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-calendar"></span></span>
                {!! Form::text('fechaCompra', null, ['class'=>'form-control pull-right']) !!}

            </div>


        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('type_id', 'Tipo:') !!}
            {!! Form::select('type_id', $types, $selectedType, ['class' => 'form-control', 'placeholder' => 'Seleccione...']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('marca', 'Marca:') !!}
            {!! Form::text('marca', null, ['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('modelo', 'Modelo:') !!}
            {!! Form::text('modelo', null, ['class'=>'form-control']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('serial', 'Serial:') !!}
            {!! Form::text('serial', null, ['class'=>'form-control', 'readonly'=>'true']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('precio', 'Precio:') !!}
            {!! Form::text('precio', null, ['class'=>'form-control']) !!}
        </div>
    </div>
</div>
{{--<div class="row">--}}
    {{--<div class="col-sm-6">--}}
        {{--<div class="form-group">--}}
            {{--{!! Form::label('user_id', 'Asignar a:') !!}--}}
            {{--{!! Form::select('user_id', $users, $selectedUser, ['class' => 'form-control', 'placeholder' => 'Seleccione...']) !!}--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-sm-6">--}}
    {{--</div>--}}
{{--</div>--}}
<div class="form-group">
    {!! Form::label('nota', 'Notas:') !!}
    {!! Form::textarea('nota', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    <a href="#" class="btn btn-default" onclick="history.back()">Volver</a>
    {!! Form::submit($buttonText, ['class'=>'btn btn-primary']) !!}
</div>
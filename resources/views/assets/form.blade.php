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
            {!! Form::label('proveedor', 'Proveedor:') !!}
            {!! Form::text('proveedor', null, ['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('orden_compra', 'Orden de Compra:') !!}
            {!! Form::text('orden_compra', null, ['class'=>'form-control']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('marca', 'Marca:') !!}
            {!! Form::text('marca', null, ['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('modelo', 'Modelo:') !!}
            {!! Form::text('modelo', null, ['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('precio', 'Precio:') !!}
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon2"><span class="glyphicon glyphicon-usd"></span></span>
                {!! Form::text('precio', null, ['class'=>'form-control']) !!}
            </div>
        </div>

    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('serial_fabricante', 'Serial del Fabricante:') !!}
            {!! Form::text('serial_fabricante', null, ['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('serial', 'Serial Interno:') !!}
            {!! Form::text('serial', null, ['class'=>'form-control', 'readonly' => 'readonly']) !!}
        </div>

    </div>
</div>

<div class="row" name="pc">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('sistema_operativo', 'Sistema Operativo:') !!}
            {!! Form::select('sistema_operativo', $sistemasOperativos, $selectedSistemaOperativo, ['class' => 'form-control', 'placeholder' => 'Seleccione...']) !!}
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('disco_duro', 'Disco Duro:') !!}
            {!! Form::select('disco_duro', $discosDuros, $selectedDiscoDuro, ['class' => 'form-control', 'placeholder' => 'Seleccione...']) !!}
        </div>
    </div>
</div>
<div class="row" name="pc">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('procesador', 'Procesador:') !!}
            {!! Form::select('procesador', $procesadores, $selectedProcesador, ['class' => 'form-control', 'placeholder' => 'Seleccione...']) !!}
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('motherboard', 'Motherboard:') !!}
            {!! Form::select('motherboard', $motherboards, $selectedMotherboard, ['class' => 'form-control', 'placeholder' => 'Seleccione...']) !!}
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('nota', 'Notas:') !!}
            {!! Form::textarea('nota', null, ['class'=>'form-control', 'rows'=>'2']) !!}
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('destination_id', 'Asignar a:') !!}
            {!! Form::select('destination_id', $users, $selectedUser, ['class' => 'form-control', 'placeholder' => 'Seleccione...']) !!}
        </div>
    </div>
</div>


<div class="form-group">
    <a href="#" class="btn btn-default" onclick="history.back()"><i class="fa fa-arrow-left"></i> Volver</a>
    {!! Form::submit($buttonText, ['class'=>'btn btn-primary']) !!}
</div>
<div class="row">
    <div class="col-sm-5">
        <div class="form-group">
            {!! Form::label('origen', 'Origen:') !!}
            {!! Form::select('origen', $users, $selectedOrigen, ['class' => 'form-control', 'placeholder' => 'Seleccione...']) !!}
        </div>
    </div>
    <div class="col-sm-2" style="padding-top: 2em">
        <p class="text-center">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        </p>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            {!! Form::label('destino', 'Destino:') !!}
            {!! Form::select('destino', $users, $selectedDestino, ['class' => 'form-control', 'placeholder' => 'Seleccione...']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            {!! Form::label('asset_id', 'Serial:') !!}
            {!! Form::select('asset_id[]', $assets, $selectedAsset, ['class' => 'form-control', 'multiple', 'id'=>'asset_id']) !!}
        </div>
    </div>
</div>
<div class="form-group">
    <a href="#" class="btn btn-default" onclick="history.back()">Volver</a>
    {!! Form::submit($buttonText, ['class'=>'btn btn-primary']) !!}
</div>
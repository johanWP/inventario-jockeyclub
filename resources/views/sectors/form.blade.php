<div class="form-group">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Descripción') !!}
    {!! Form::text('description', null, ['class'=>'form-control']) !!}
</div>

{{--<div class="form-group">--}}
    {{--{!! Form::label('user_id', 'Gerente del sector:') !!}--}}
    {{--{!! Form::select('user_id', $users, $selectedUser, ['class' => 'form-control', 'placeholder' => 'Seleccione...']) !!}--}}
{{--</div>--}}

<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group text-right">
    <a href="#" class="btn btn-default" onclick="history.back()">Volver</a>
    {!! Form::submit($buttonText, ['class'=>'btn btn-primary']) !!}
</div>

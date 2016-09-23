@extends('app')

@section('htmlheader_title')
    Home
@endsection
@section('contentheader_title')
	Home
@endsection


@section('main-content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-body">
					<h1>¡Bienvenido!</h1>
					<h3>{{ $cita['frase'] }}</h3>
					<p class="pull-right">{{$cita['autor']}}</p>

				</div>
			</div>
		</div>
	</div>
</div>
	@include('partials.modalDelete')

@endsection

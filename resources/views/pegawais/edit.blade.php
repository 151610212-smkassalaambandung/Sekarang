@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home')}}">Dashboard</a></li>
				<li><a href="{{ url('/admin/pegawais')}}">pegawai</a></li>
				<li class="active">Ubah pegawai</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Ubah pegawai</h2>
				</div>

				<div class="panel-body">
					{!! Form::model($pegawai, ['url'=> route('pegawais.update', $pegawai->id),
					'method'=> 'put', 'class'=>'form-horizontal'])!!}
					@include('pegawais._form')
					{!! Form::close()!!}
				  </div>
				</div>
			  </div>
			</div>
		 </div>
		 @endsection

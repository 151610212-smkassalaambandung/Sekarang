@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home')}}">Dashboard</a></li>
				<li><a href="{{ url('/admin/konsumens')}}">konsumen</a></li>
				<li class="active">Ubah konsumen</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Ubah konsumen</h2>
				</div>

				<div class="panel-body">
					{!! Form::model($konsumen, ['url'=> route('konsumens.update', $konsumen->id),
					'method'=> 'put', 'class'=>'form-horizontal'])!!}
					@include('konsumens._form')
					{!! Form::close()!!}
				  </div>
				</div>
			  </div>
			</div>
		 </div>
		 @endsection

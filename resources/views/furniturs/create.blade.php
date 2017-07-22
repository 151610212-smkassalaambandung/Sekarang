@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home')}}">Dashboard</a></li>
				<li><a href="{{ url('/admin/furniturs')}}">furnitur</a></li>
				<li class="active">tambah furnitur</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Tambah furnitur</h2>
				</div>
				<div class="panel-body">
					{!! Form::open(['url'=> route('furniturs.store'),
					'method'=>'post','class'=>'form-horizontal'])!!}
					@include('furniturs._form')
					{!! Form::close()!!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

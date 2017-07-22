<div class="form-group{{$errors->has('nama_furnitur') ? 'has-error': '' }}">
 {!! Form::label('nama_furnitur','Furnitur',['class'=>'col-md-2 control-label'])!!}
 <div class="col-md-4">
 	{!! Form::text('nama_furnitur', null, ['class'=>'form-control'])!!}
 	{!! $errors->first('nama_furnitur','<p class="help-block">:message</p>')!!}
 </div>
 </div>

<div class="form-group{{$errors->has('furnitur.id') ? 'has-error': '' }}">
 {!! Form::label('konsumen_id','Konsumen',['class'=>'col-md-2 control-label'])!!}
 <div class="col-md-4">
 	{!! Form::select('konsumen_id', [''=>'']+App\Konsumen::pluck ('nama_konsumen','id')->all(), null)!!}
 	{!! $errors->first('konsumen_id','<p class="help-block">:message</p>')!!}
 </div>
 </div>


<div class="form-group{{$errors->has('jumlah_furnitur') ? 'has-error': '' }}">
 {!! Form::label('jumlah_furnitur','Jumlah',['class'=>'col-md-2 control-label'])!!}
 <div class="col-md-4">
 	{!! Form::number('jumlah_furnitur', null, ['class'=>'form-control', 'min'=>1])!!}
 	{!! $errors->first('jumlah_furnitur','<p class="help-block">:message</p>')!!}
 	@if (isset($furnitur))
		<p class="help-block">{{ $furnitur->borrowed }} furnitur sedang dipinjam</p>
	@endif
 </div>
 </div>

 <div class="form-group{{$errors->has('furnitur.id') ? 'has-error': '' }}">
 {!! Form::label('harga_furnitur','Harga Furnitur',['class'=>'col-md-2 control-label'])!!}
 <div class="col-md-4">
 	{!! Form::text('harga_furnitur', null, ['class'=>'form-control'])!!}
 	{!! $errors->first('harga_furnitur','<p class="help-block">:message</p>')!!}
 </div>
 </div>


<div class="form-group{{$errors->has('cover') ? 'has-error': '' }}">
 {!! Form::label('cover','jumlah',['class'=>'col-md-2 control-label'])!!}
 <div class="col-md-4">
 	{!! Form::file('cover')!!}
 	@if (isset($furnitur) && $furnitur->cover)
 	<p>
 		{!! Html::image(asset('img/'.$furnitur->cover),null,['class'=>'img-rounded img-responsive']) !!}
 	</p>
 	@endif
 	{!! $errors->first('cover','<p class="help-block">:message</p>')!!}
 </div>
 </div>


 <div class="form-group">
 	<div class="col-md-4 col-offset-2">
 		{!! Form::submit('Simpan',['class'=>'btn btn-primary'])!!}
 	</div>											
 </div>
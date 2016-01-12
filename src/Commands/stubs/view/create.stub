@extends('admin_template')
@section('content')
	  {!! Form::open(['route'=>$store, 'method'=>'POST','class'=>'form form-ajax']) !!}
		<div class="box box-primary" id="box-ajax">
			<div class="box-header">
				<h3 class="box-title">{!! $documentTitle !!}</h3>
				<div class="box-tools">
					<div class="btn-group">
						<button data-widget="collapse" class="btn btn-success btn-sm " type="button"><i class="fa fa-compress"></i></button>
						<button data-widget="remove" class="btn btn-danger btn-sm close-form " type="button"><i class="fa fa-close"></i></button>
					</div>
				</div>
			</div>
			<div class="box-body">
				  	@include($form)
			</div>
			<div class="box-footer">
				<div class="pull-right">
					<button class="btn btn-flat btn-default" type="reset"><i class="fa fa-refresh"></i> Ulangin</button>
					<button class="btn btn-flat btn-primary" type="submit"><i class="fa fa-download"></i> Simpan</button>
				</div>
			</div>
		</div>
	  {!! Form::close() !!}
@stop
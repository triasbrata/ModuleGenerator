@extends('admin_template')
@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="box box-default">
				<div class="box-header with-border">
					<h3 class="box-title">List Data</h3>
					<div class="box-tools pull-right">
							<a href="{{ route($create) }}" class="btn btn-primary btn-sm ajax-link"><i class="fa fa-plus"></i> Tambah</a>
						<div class="btn-group ">
							<button data-widget="collapse" class="btn btn-success btn-sm" type="button"><i class="fa fa-compress"></i></button>
						</div>
					</div>
				</div>
				<div class="box-body">
					<table class="table table-bordered table-striped no-margin datatable">
						<thead>
							<tr>
								<th class="col-xs-1">No.</th>
								<th>Header text</th>
							</tr>
						</thead>
						<tbody>
							<?php $x=1; ?>
							@foreach ($lists as $list)
								<tr>
									<td>{{$x++}}</td>
									<td>
										<span>list item</span>	
										<div class="pull-right">
											  {!! Form::open(['route'=>[$destroy,$list->id], 'method'=>'DELETE','class'=>'no-margin form-ajax']) !!}
											  		<div class="btn-group">
													  	<a href="{{ route($show,$list->id) }}" class="btn btn-flat btn-warning show-link ajax-link btn-sm"><i class="fa fa-paste"></i> Lihat</a>
													  	<a href="{{ route($edit,$list->id) }}" class="btn btn-flat ajax-link btn-info btn-sm"><i class="fa fa-pencil"></i> Ubah</a>
													  	<button class="btn btn-danger btn-flat btn-sm" type="submit"><i class="fa fa-eraser"></i> Hapus</button>
											  		</div>
											  {!! Form::close() !!}
										</div>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@stop
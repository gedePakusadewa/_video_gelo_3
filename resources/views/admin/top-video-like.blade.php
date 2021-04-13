@extends('admin.layout-admin')

@section('content')
	<h3>TOP VIDEO LIKE</h3>
		<table>
		<tr>
			<th>Code</th>
			<th>Name</th>
			<th>Like Sum</th>
			<th>Dislike Sum</th>
			<th>View Sum</th>
			<th>Duration</th>
			<th>Tag</th>
		</tr>
		@foreach($data as $item)
			<tr>
				<td>{{$item->code}}</td>
				<td>{{$item->name}}</td>
				<td>{{$item->like_sum}}</td>
				<td>{{$item->dislike_sum}}</td>
				<td>{{$item->view_sum}}</td>
				<td>{{$item->duration}}</td>
				<td>{{$item->tag}}</td>
			</tr>
		@endforeach	
@endsection
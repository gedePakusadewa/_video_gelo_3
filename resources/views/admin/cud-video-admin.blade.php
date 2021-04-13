@extends('admin.layout-admin')

@section('content')
	<h3>CUD VIDEO DATA</h3>
	<table>
		<tr>
			<th>Code</th>
			<th>Name</th>
			<th>Like Sum</th>
			<th>Dislike Sum</th>
			<th>View Sum</th>
			<th>Duration</th>
			<th>Tag</th>
			<th>Update</th>
			<th>Delete</th>
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
				<td><a href = "{{route('update_video_page', ['codeVideo' => $item->code])}}"><button>Update Video</button></a></td>
				<td><a href = "{{route('delete_video', ['codeVideo' => $item->code])}}"><button>Delete</button></a></td>
			</tr>
		@endforeach

		<h1>Upload New Video</h1>
		<a href = "{{route('create_new_video_page')}}"><button>New Video</button></a>

	</table>
@endsection
@extends('layout')

@section('content')
	<h2>HISTORY</h2>
	<div style = "background-color:#f9f9f9;" class="flex-column-container">
		@foreach($finalData as $item)
			<div class = "thumbnail-container flex-row-container">
				<div>
					<a href="{{route('play_page', ['videoID' => $item['code']])}}">
						<img src="{{$item['thumbnail_path']}}" class = "div-img-container" alt="tes-tiga" />
					</a>
				</div>
				<div>
					<div id = "title-video" style = "display:flex; width:190px; flex-wrap:wrap;">{{$item['name']}}</div>
					<p>Admin</p>
					<p>{{$item['view_sum']}} views | {{$item['created_at']}}</p>
				</div>
			</div>
		@endforeach
	</div>
@endsection
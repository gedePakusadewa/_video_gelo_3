@extends('layout')

@section('content')
    <div>
        <h1>TRENDING (only based on most views video)</h1>
        @foreach($data as $item)
			<div class = "thumbnail-container">
				<a href="{{route('play_page', ['videoID' => $item -> code])}}"><img src="{{$item->thumbnail_path}}" alt="tes-tiga" width="200"/>
				</a>
				<div>
					<p>{{$item->name}}</p>
					<p>{{$item->view_sum}} views | {{$item->created_at}}</p>
				</div>
			</div>
		@endforeach
    </div>
@endsection
@extends('layout')

@section('content')
	<div class = "container-result">
		@if(!empty($result))
			@foreach($result as $item)
				<div class = "flex-row-container container-each-result" onmouseover = "hoverIn(this)" name = "{{$item['code']}}" onmouseout = "hoverOut(this)">
					<div>
						<div id = "watch-later-{{$item['code']}}" name = "{{$item['code']}}" class = "watch-later-container">
							<div class = "watch-later-icon-position">
								<div><i class="material-icons" style = "">access_time</i></div>
							</div>
						</div>
						<a href="{{route('play_page', ['videoID' => $item['code']])}}">
							<img src="{{$item['thumbnail_path']}}" class = "div-img-container" alt="tes-tiga" />
						</a>
					</div>
					<div class = "container-each-desc">
						<div id = "title-video">{{$item['name']}}</div>
						<p>{{$item['view_sum']}} views | {{$item['created_at']}}</p>
						<p>Admin</p>
						<p>{{$item['simple_description']}}</p>
					</div>
				</div>
			@endforeach
		@else
			<div class = "not-found-container">
				<div class = "error-not-found-message">
					<img src = "icon-youtube/not-found-youtube.png">
					<div style = "text-align:center;"><h3>No results found</h3>
					<p>	Try different keywords</p>
				</div>
				</div>
			</div>
		@endif
	</div>

	<script>
		function hoverIn(data){
			document.getElementById("watch-later-" + data.getAttribute("name")).style.display = "block";
		}

		function hoverOut(data){
			document.getElementById("watch-later-" + data.getAttribute("name")).style.display = "none";
		}		
	</script>
@endsection
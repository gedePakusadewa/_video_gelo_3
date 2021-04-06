@extends('layout')

@section('content')
	<div style = "background-color:#f9f9f9;" class="flex-row-container-wrap">
		@foreach($data as $item)
			<div class = "thumbnail-container" onmouseover = "hoverIn(this)" 
			name = "{{$item->code}}" onmouseout = "hoverOut(this)">
				<div id = "watch-later-{{$item->code}}" name = "{{$item->code}}" style = "position:relative; left:90%; display:none;">
					<div style = "position:absolute;">
						<div id = "tes123" style = "background-color:black;" onclick = "addToWatchLater(this)" name = "{{$item->code}}"><i class="material-icons" style = "color:white;">access_time</i></div>
					</div>
				</div>
				<a href="{{route('play_page', ['videoID' => $item -> code])}}">
					<img src="{{$item->thumbnail_path}}" class = "div-img-container" alt="tes-tiga" />
				</a>
				<div>
					<div id = "title-video" style = "display:flex; width:190px; flex-wrap:wrap;">{{$item->name}}</div>
					<p>Admin</p>
					<p>{{$item->view_sum}} views | {{$item->created_at}}</p>
				</div>
			</div>
		@endforeach
	</div>
	<input id = "tokenAjax" type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />

	//<br /><button style = "height:50px; width:50px;" onclick = "tes1()">sdasd</button>

	<script
		  <!-- src="https://code.jquery.com/jquery-2.2.4.min.js"
		  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
		  crossorigin="anonymous">		  	 -->
	</script>

	<script>
		function hoverIn(data){
			document.getElementById("watch-later-" + data.getAttribute("name")).style.display = "block";
		}

		function hoverOut(data){
			document.getElementById("watch-later-" + data.getAttribute("name")).style.display = "none";
		}	

		function addToWatchLater(data){
			$.ajax({
			    url: '/add-watch-later',
			    type: 'POST',
			    data: { 
			    	_token: '{{ csrf_token() }}',
			    	code : '' + data.getAttribute("name")
			    },

			    success:function(){alert('success!');},
			    error: function(){alert('error');}, 
			});
		}

		// function addToWatchLater(data){
			
		//  	//src : https://www.w3schools.com/js/js_ajax_http_send.asp
		//  	var token = document.getElementById('tokenAjax').value;
		//  	console.log(token);
		// 	var xmlhttp = new XMLHttpRequest();			
		// 	xmlhttp.open("POST", "/add-watch-later", true);
		// 	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		// 	xmlhttp.setRequestHeader("X-CSRFToken", token);


		//     xmlhttp.onreadystatechange = function() {
		//     	if (this.readyState == 4 && this.status == 200) {
		//         	alert("sukses");
		//       	}
		//     };
		//     // xmlhttp.open("GET", "/tes1", false);
		//     // xmlhttp.send();

		// 	xmlhttp.send("code =" + data);

		// }
		

				
	</script>
@endsection

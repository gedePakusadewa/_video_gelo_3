@extends('layout')

@section('content')
    @foreach($data as $item)
        <div style = "border:1px solid black; ">
            <video width="800" height="400" controls style = "border:1px solid green; line-height:0;">
                <source src="../../{{$item->video_path}}" type="video/mp4" />
                Sorry, our video format is too powerfull for your browser
            </video>
            <div style = "border:1px solid black;">
            	<p>{{$item->name}}</p>
            	<p>{{$item->view_sum}} views | {{$item->created_at}}</p>
                <p><a href="{{route('likedVideo', ['videoID' => $item -> code])}}"><button><i class="material-icons">thumb_up</i></button></a>{{$item->like_sum}} likes
                <a href = "{{route('dislikedVideo', ['videoID' => $item -> code])}}"><button><i class="material-icons">thumb_down</i></button></a>{{$item->dislike_sum}} dislikes</p>
                
            </div>
            <div style="border:1px solid black;">
                <p>{{$item->simple_description}}</p>
            </div>
        </div>
    @endforeach
@endsection

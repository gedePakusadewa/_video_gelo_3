<!DOCTYPE html>
<html>
    <head>
        <title>Admin Page</title>
    </head>
    <body>
        <nav>
            <h3><a href="{{route('home_admin')}}">Home</a></h3>
            <h3><a href="{{route('cud_admin')}}">CUD Video Data</a></h3>
            <h3><a href="{{route('top_video_like_admin')}}">Top Video like</a></h3>
            <h3><a href="{{route('top_video_dislike_admin')}}">Top Video Dislike</a></h3>
            <h3><a href="{{route('top_video_watch_admin')}}">Top Video Watch</a></h3>
            <h3><a href="{{route('home')}}">LOG OUT</a></h3>
        </nav>
        <div>
            @yield('content')
        </div>
    </body>
</html>
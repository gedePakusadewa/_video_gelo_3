<!DOCTYPE html>
<html>
	<head>
		<title>Video Gelo : Search Video You Like</title>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/result-page.css" />
		<style>

			*{
				box-sizing: border-box;
		        margin:0;
		        border:0;
			}

			body{
				font-family: Roboto, sans-serif;
			}

			.flex-row-container{
				display:flex;
				flex-direction:row;
				//border:1px solid black;
			}

			.flex-column-container{
				display:flex;
				flex-direction:column;
			}

			.flex-row-container-wrap{
				display:flex;
				flex-direction:row;
				flex-wrap:wrap;
			}

			.width-max{
				width:100%;
			}

			.flex-column-container{
				display:flex;
				flex-direction:column;
			}

			.thumbnail-container{
				margin:5px;
				width:214px;
			}

			.div-img-container{
				width:214px;
				height:150px;
				object-fit:cover;
				border:1px solid black;
			}

			#logo-website-width{
				width:20%;
				font-size:13px;
				line-height:12px;
				padding-top:1%;
			}

			#search-bar-width{
				width:65%;
				text-align:center;
			}		

			.login-section-width{
				width:15%;
				text-align:right;
				margin-right:22px;
			}

			.login-section-width a:link, .login-section-width a:visited, .login-section-width a:hover, .login-section-width a:active {
				color:black;
				text-decoration:none;
			}

			#container-specification-header{
				height:49px;
				//background-color:red;
			}

			#title-video{
				font-weight:bold;
			}

			.inputSearch{
				width:60%;
				height:31px;
				border:1px solid #f0f0f0;
				font-size:17px;
				margin-left:122px;
				padding-left:11px;
				border-radius:3px 0 0 3px;
				float:left;	
			}

			.button-search{
				width:95px;				
				float:left;
				height:31px;
				border-radius:0 3px 3px 0;
			}

			.icon-mic-search-bar{
				float:left;
				font-size:24px;
				margin-left:15px;
				margin-top:3px;
			}	

			.icon-search-bar-color{				
				color:#606060;
			}

			.accountProperty{
				font-size:24px;
				padding-top:11px;
				padding-right:21px;	
			}

			.youtubeLogo{
				color:red;
			}

			#customLogoYoutube{
				font-size:22px;
				font-weight:bold;	
				text-align:left;
				padding-top:1px;
			}

			.side-menu{
				width:15%;
			}

			.main-content{
				width:85%;
			}

			.side-menu a:link, .side-menu a:visited, .side-menu a:hover, .side-menu a:active {
				color:black;
				text-decoration:none;
			}

			.icon{
				vertical-align:middle;
				font-size:22px;
			}

			.formSearch{
				margin-top:8px;
			}	

			.sideLogoIcon{
				margin-left:21px;
				margin-right:21px;
			}

			.icon-side-menu{
				margin: 23px 0 10px 0;
				font-size:18px;
			}

			.icon-float-left{
				float:left;
			}

			.watch-later-container{
				position:relative; 
				left:85%; 
				top:3%;
				display:none;
			}

			.watch-later-icon-position{
				position:absolute;
				background-color:black;
				color:white;
				border-radius:2px;
				padding:3px 1px 0px 3px;
			}

		</style>
	</head>
	<body>
		<nav>
			<div id = "container-specification-header" class="flex-row-container">
				<div id="logo-website-width" class = "flex-row-container ">
					<div class = "sideLogoIcon"><i class="material-icons">menu</i></div>
					<div id = "customLogoYoutube"><i class="fa fa-youtube-play youtubeLogo"></i> Youtube</div>
				</div>
				<div id = "search-bar-width">
					<form method="get" class = "formSearch" action="{{route('search_result_page')}}">
						<input class = "inputSearch" type = "text" name = "searchInput" placeholder="Search" />
						<button type = "submit" class = "button-search" ><i class="material-icons icon">search</i></button>
						<i class="fa fa-microphone icon-mic-search-bar icon-search-bar-color"></i>
					</form>
				</div>
				<div class = "login-section-width">
					<a href = "#"><i class="material-icons accountProperty icon-search-bar-color">video_call</i></a>
					<a href = "#"><i class="material-icons accountProperty icon-search-bar-color" >apps</i></a>
					<a href = "#"><i class="material-icons accountProperty icon-search-bar-color">notifications</i></a>
					<a href = "#"><i class="material-icons accountProperty icon-search-bar-color">account_circle</i></a>
				</div>
			</div>
		</nav>
		<div class="flex-row-container">
			<div class = "side-menu">
				<div class = "icon-side-menu">
					<i class="material-icons sideLogoIcon icon-float-left">home</i>
					<a href="{{route('home')}}">Home</a>
				</div>
				<div class = "icon-side-menu">
					<i class="material-icons sideLogoIcon icon-float-left">explore</i>
					<a href="{{route('trending_page')}}">Trending</a>
				</div>
				<div class = "icon-side-menu">
					<i class="material-icons sideLogoIcon icon-float-left">history</i>
					<a href="{{route('history_page')}}">History</a>
				</div>
				<div class = "icon-side-menu">
					<i class="material-icons sideLogoIcon icon-float-left">access_time</i>
					<a href="{{route('watch_later_page')}}">Watch Later</a>
				</div>
				<div class = "icon-side-menu">
					<i class="material-icons sideLogoIcon icon-float-left">thumb_up</i>
					<a href="{{route('like_video_page')}}">Liked Video</a>
				</div>
				<div class = "icon-side-menu">
					<i class="material-icons sideLogoIcon icon-float-left">settings</i>
					<a href="{{route('settings_page')}}">Settings</a>
				</div>
				<div class = "icon-side-menu">
					<i class="fa fa-address-card-o sideLogoIcon icon-float-left"></i>
					<a href="{{route('about_page')}}">About</a>
				</div>
				<div class = "icon-side-menu">
					<a href="{{route('home_admin')}}" class="sideLogoIcon">ADMIN</a>
				</div>
			</div>
			<div class = "main-content">
				@yield('content')
			</div>
		</div>
	</body>
</html>
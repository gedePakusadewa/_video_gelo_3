@extends('admin.layout-admin')

@section('content')
	<h3>Form Update Video</h3>
	<form name="inputArticleForm" action = "{{route('update_video')}}" method="post" enctype="multipart/form-data">

	    <input type = "hidden" name = "_token" 
	        value = "<?php echo csrf_token(); ?>" />                   

	    <div class="form-group">
	        <label>code article (6 char):</label>
	        <input type='text' value = "{{$data[0]->code}}" disabled/>			
	        <input type='text' name = "codeUpdate" value = "{{$data[0]->code}}" hidden/>
	    </div>  

	    <div class="form-group">
	        <label>Video Title:</label>
	        {{-- <div id="alertTitle" class="alert alert-danger">
	            <strong>Wrong input format!</strong> Please fill it with alphanumeric character.
	        </div> --}}
	        <input type='text' class="form-control" value = "{{$data[0]->name}}" name="title" />
	    </div> 

	    <div class="form-group">
	        <label>Simple Video Description:</label>
	        <textarea class="form-control" name="simpleDesc">{{$data[0]->simple_description}}</textarea>
	    </div>

        <div class="form-group">
	        <label>Total Like:</label>
	        {{-- <div id="alertTitle" class="alert alert-danger">
	            <strong>Wrong input format!</strong> Please fill it with alphanumeric character.
	        </div> --}}
	        <input type='number' class="form-control" value = "{{$data[0]->like_sum}}" name="likeUpdate" />
	    </div> 

        <div class="form-group">
	        <label>Total Dislike:</label>
	        {{-- <div id="alertTitle" class="alert alert-danger">
	            <strong>Wrong input format!</strong> Please fill it with alphanumeric character.
	        </div> --}}
	        <input type='number' class="form-control" value = "{{$data[0]->dislike_sum}}" name="dislikeUpdate" />
	    </div>

         <div class="form-group">
	        <label>Total View:</label>
	        {{-- <div id="alertTitle" class="alert alert-danger">
	            <strong>Wrong input format!</strong> Please fill it with alphanumeric character.
	        </div> --}}
	        <input type='number' class="form-control" value = "{{$data[0]->view_sum}}" name="totalViewUpdate" />
	    </div> 

	    <div class="form-group">
	        <label>Video Tag:</label>
	        <textarea class="form-control" name="videoTagUpdate" >{{$data[0]->tag}}</textarea>
	    </div>

	    <div class="form-group">
	        <label for="">Video Thumbnail:</label>
			<img src = "/{{$data[0]->thumbnail_path}}" /><br />
	        <!-- <div id="alertFileFormat" class="alert alert-danger">
	            <strong>Wrong image format!</strong> Please upload file having extensions .jpeg or .jpg or .png only.
	        </div>
	        <div id="alertFileSize" class="alert alert-danger">
	            <strong>Wrong image Size!</strong> Please upload image size under 1Mb.
	        </div> -->
	        <input type='file' class="form-control" name="thumbnailFileUpdate" />
	    </div>

	    <input type="submit" class="btn btn-primary" value ="Save Article" />

	</form>
@endsection
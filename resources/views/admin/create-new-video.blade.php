@extends('admin.layout-admin')

@section('content')
	<h3>Form New Video</h3>
	<form name="inputArticleForm" action = "{{route('save_video')}}" method="post" enctype="multipart/form-data">

	    <input type = "hidden" name = "_token" 
	        value = "<?php echo csrf_token(); ?>" />                   

	    <div class="form-group">
	        <label>code article (6 char):</label>
	       {{--  <div id="alertCode" class="alert alert-danger">
	            <strong>Wrong input format!</strong> Please fill it with alphanumeric character.
	        </div> --}}
	        <input type='text' name="code" />
	    </div>  

	    <div class="form-group">
	        <label>Video Title:</label>
	        {{-- <div id="alertTitle" class="alert alert-danger">
	            <strong>Wrong input format!</strong> Please fill it with alphanumeric character.
	        </div> --}}
	        <input type='text' class="form-control" name="title" />
	    </div> 

	    <div class="form-group">
	        <label>Simple Video Description:</label>
	        <textarea class="form-control" name="simpleDesc"></textarea>
	    </div>

	    <div class="form-group">
	        <label>Video Duration (in seconds):</label>
	        {{-- <div id="alertTitle" class="alert alert-danger">
	            <strong>Wrong input format!</strong> Please fill it with alphanumeric character.
	        </div> --}}
	        <input type='number' class="form-control" name="videoDuration" />
	    </div> 

	    <div class="form-group">
	        <label>Video Tag:</label>
	        <textarea class="form-control" name="videoTag"></textarea>
	    </div>

	    <div class="form-group">
	        <label for="">Video Thumbnail:</label>
	        <!-- <div id="alertFileFormat" class="alert alert-danger">
	            <strong>Wrong image format!</strong> Please upload file having extensions .jpeg or .jpg or .png only.
	        </div>
	        <div id="alertFileSize" class="alert alert-danger">
	            <strong>Wrong image Size!</strong> Please upload image size under 1Mb.
	        </div> -->
	        <input type='file' class="form-control" name="videoThumbnail" />
	    </div>

		<div class="form-group">
	        <label for="">Video File:</label>
	        <!-- <div id="alertFileFormat" class="alert alert-danger">
	            <strong>Wrong image format!</strong> Please upload file having extensions .jpeg or .jpg or .png only.
	        </div>
	        <div id="alertFileSize" class="alert alert-danger">
	            <strong>Wrong image Size!</strong> Please upload image size under 1Mb.
	        </div> -->
	        <input type='file'  class="form-control" name="videoFile" />
	    </div>

	    <input type="submit" class="btn btn-primary" value ="Save Article" />

	</form>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        	<div class="row">
        		<div class="col-md-2 col-md-offset-1">
        			<h1>{{ $user->name }}</h1>
        		</div>
        		<div class="col-md-8">
        		<h3>Information about me</h3>
        		User created at: {{ $user->created_at }}<br />
        		E-Mail: <a href='mailto:{{ $user->email }}'>{{ $user->email }}</a>
        		</div>
        	</div>
        </div>
        <div class="col-md-10 col-md-offset-1">
        <h3>My Blogposts <small>newest first</small></h3>
        @foreach($posts as $post)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1>{{ $post->title }} <small>by <a href='/profile/{{ $post->creator }}'>{{ $post->creator }} </a></small></h1>
                    </div>
                    <div class="panel-body">
                        <p class="lead">{{ $post->post }}</p>
                    </div>
                    <div class="panel-footer">
                        <i class="fa fa-comments"></i> <a href='/post/{{ $post->id }}'>{{ $post->comments }} Comments</a> | 
                        <span class="glyphicon glyphicon-time"></span> Posted: {{ $post->created_at }}
                </div>
            </div>


        @endforeach
    </div>
</div>
@endsection
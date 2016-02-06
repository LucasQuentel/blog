@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <!--BLOG POSTS-->
            @foreach($posts as $post)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1>{{ $post->title }} <small>by {{ $post->creator }}</small></h1>
                    </div>
                    <div class="panel-body">
                        <p class="lead">{{ $post->post }}</p>
                    </div>
                    <div class="panel-footer">
                        <i class="fa fa-comments"></i> {{ $post->comments }} Comments | 
                        <span class="glyphicon glyphicon-time"></span> Posted: {{ $post->created_at }}
                </div>
            </div>


            @endforeach
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1>{{ $posts->title }} <small>by <a href='/profile/{{ $posts->creator }}'>{{ $posts->creator }}</a> </small></h1>
                    </div>
                    <div class="panel-body">
                        <p class="lead">{{ $posts->post }}</p>
                    </div>
                    <div class="panel-footer">
                        <i class="fa fa-comments"></i> {{ $posts->comments }} Comments | 
                        <span class="glyphicon glyphicon-time"></span> Posted: {{ $posts->created_at }}
                        @if(Auth::user()->name == $posts->creator || in_array(Auth::user()->name, Config::get('global.admins')))
                        | <a href='/post/{{ $post->id }}/delete'>Delete</a>
                        @endif                        
                </div>
            </div

        </div>


        <h1>{{ $posts->comments }} Comments</h1>
            <div class="panel panel-primary">
            <div class="panel-heading">Comment</div>
            <form action="/post/comment/{{ $posts->id}}" method="POST" role="form" class="form-horizontal">
            <div class="panel-body">            
                <div class="form-group">
                    <div class="col-md-12">                     
                        <textarea class="form-control" id="textarea" name="textarea" rows="10" placeholder="Comment"></textarea>
                    </div>
                </div>
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="panel-footer">
                <div class="form-group">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success">Comment</button>
                    </div>
                </div>                  
            </div>
            </form>
            </div>

        @foreach($comments as $comment) 
            <div class="panel panel-default">
                <div class="panel-body">
                    <p class="lead">{{ $comment->comment}}
                </div>
                <div class="panel-footer">
                <i class="fa fa-comments"></i> Posted by <a href='/profile/{{ $comment->creator}}'>{{{ $comment->creator }}}</a> | <span class="glyphicon glyphicon-time"></span> Posted: {{ $comment->created_at }}
                    @if(Auth::user()->name == $comment->creator || in_array(Auth::user()->name, Config::get('global.admins')))
                    | <a href='/comment/{{ $comment->id }}/delete'>Delete</a>
                    @endif                   
                </div>
            </div>  

        @endforeach
    </div>
</div>
@endsection

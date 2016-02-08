@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Publish a blog article</div>

                <div class="panel-body">
            <form action="/home/publish" method="POST" role="form" class="form-horizontal">
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-md-12">                     
                        <input type="text" id="title" name="title" class="form-control" placeholder="Title" />
                    </div>
                </div>          
                <div class="form-group">
                    <div class="col-md-12">                     
                        <textarea class="form-control" id="textarea" name="textarea" rows="10" placeholder="Blogpost"></textarea>
                    </div>
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success">Publish</button>
                    </div>
                </div>                  
            </form>
                </div>
            </div>

            <h1>Latest blogposts    
            <small style="font-size: 50%">
            @if($all)
            <a href="/home/" style="text-decoration: underline">all</a> | <a href="/home/me">only me</a>
            @elseif(!$all)
            <a href="/home/">all</a> | <a href="/home/me" style="text-decoration: underline">only me</a>
            @else
            <a href="/home/">all</a> | <a href="/home/me">only me</a>
            @endif
            </small>
            </h1>
            <!--BLOG POSTS-->
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
</div>
@endsection

@extends('layouts.app')
@section('title', 'postdetail')
    
@section('content')
    <div class="container">
        <div class="row justify-content-center pt20 font-italic font-weight-bold"><h5 class="text-white">{{ $post->title }}</h5></div>
        <div class="row justify-content-center pt20" style="margin: auto;">
           
                    @foreach($images as $image)
                        @if(isset($images))
                       
                            <div class="col-3 mb20">
                                
                                <img class="img-thumbnail img-responsive  d-block w-100 shadow-lg bg-dark rounded" src="{{ Storage::disk('s3')->url('public/images/' . $image->image) }}">
        
                            </div>
                        @else
                            <div class="col-3 mb20">
                               <img src="{{ asset('images/'.'noimageavailable.png') }}" class="img-thumbnail img-responsive d-block w-100 shadow-lg bg-white rounded">
                            </div>
                        @endif
                    @endforeach
                    
                    <div class="col-12">
                    <div class="card border-dark">
                    <div class="card">
                        
                    
                            <div class="card-header">
                              紹介文
                            </div>
                            <div class="card-body">
                                <a href="{{ action('User\PagesController@show', ['id' => $post->user->id] )}}" class="text-secondary">{{ $post->user->name }}</a>
                                 
                            </div>
                    </div>
                   
       
              
                
    
                    <div id="tabMenu" class="row mb20 pt20">
                        <div class="col-9">
                            <div class="card">
                                <ul class="list-group list-group-horizontal">
                                   <li class="col-6 list-group-item text-dark"><a href="#tabBox1"><div class="text-dark"><i class="fas fa-map-marked-alt text-dark"></i>地図</div></a></li>
                                   <li class="col-6 list-group-item text-dark"><a href="#tabBox2"><div class="text-dark">{{$post->user->name}}の最近の投稿</div></a></li>
                                </ul>
                
                                <div class="card-body">
                                    <div id="tabBoxes" >
                                      　<div id="tabBox1"><iframe id="iframe" class="col-12" src="https://maps.google.co.jp/maps?output=embed&q={{ $post->title }}"></iframe></div>
            
                                    　　<div class="overflow-auto"   style= "height:100px;" id="tabBox2">
                                    　　      @foreach($recent_posts as $recent_post)
                                    　　   
                                            
                                            

                                           
                                             
                                              @if(isset($recent_post->firstPhoto()->image))
                                                <p>
                                                    <img class="img-fluid" width="50" height="50" src="{{ Storage::disk('s3')->url('public/images/' . $recent_post->firstPhoto()->image) }}">
                                                    <a href="{{ action('User\TimelineController@show',  $recent_post->id )}}" class="text-dark">{{$recent_post->title}}</a>
                                                    {{$recent_post->created_at}}
                                                   
                                                </p>
                                              @else
                                                <p>
                                                    <img class="img-fluid" width="50" height="50" src="{{ asset('images/'.'noimageavailable.png') }}">
                                                    <a href="{{ action('User\TimelineController@show',  $recent_post->id )}}" class="text-dark">{{$recent_post->title}}</a>
                                                    {{$recent_post->created_at}}
                                                   
                                                </p>
                                              @endif
                                               
                                               
                                               
                                               
                                                
                                              
                                                <!--@if(isset($recent_post->firstPhoto()->image))-->
                                                <!--    <img class="card-img-top" src="{{  asset('storage/images/' .$recent_post->firstPhoto()->image) }}">-->
                                                <!--@else-->
                                                <!--    <img class="card-img-top" src="{{ asset('images/'.'noimageavailable.png') }}">-->
                                                <!--@endif-->
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="btn-group-vertical col-3" role="group" aria-label="Basic example">
    
                       
                            <form action="{{ route('comment') }}" method="POST" class="form-inline my-2 my-md-0" enctype="multipart/form-data">
                                @csrf
                                <a class="nav-link" data-toggle="modal" data-target="#exampleModal3"><i class="fas fa-comments"></i>コメントする</a>
                                <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModal3Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-dark" id="exampleModalLabel">コメント</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <input id="post_id" type="hidden"  name="post_id" value="{{$post->id}}">
                                                <div class="form-group">
                                                   {{ csrf_field() }}
                                                   <textarea class="form-control" style="width: 100%; resize: none;" id="exampleFormControlTextarea1" rows="3" name="comment" placeholder="コメントする"></textarea>
                                                   <!--<input type="text" name="keyword" style="width:100%;" class="form-control" id="title-name"  placeholder="名所の名前を入力してください">-->
                                                </div>
                                                
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                                            <button type="submit" class="btn btn-primary">コメント</button>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            </form>
                            @if(Auth::id() == $post->user->id) 
                           
                                <a href="{{ action('User\TimelineController@edit', ['id' => $post->id] )}}" class="nav-link mt20  text-dark"><i class="fas fa-comments"></i>編集する</a>
                                
                                
                                <form action="{{ route('delete',['id' => $post->id]) }}" method="post">
                                    {{ csrf_field() }}
                                    <input type="submit" value="削除する" class="mt20 ml10 btn btn-danger" onclick='return confirm("投稿を削除しますか？");'>
                                </form>
                            @endif
                        </div>
                       
                        
                        
                        
                        
                    </div>
                   
                   
         
           
                
             
                                
                                
           
           
            
           
             
              
            </div>
           </div>
          </div>
            <div class="row justify-content-center container pt20 pb20" style="margin: auto;">
           
            <button type="button" id="comment" class="justify-content-center col-12 btn-block btn btn-secondary">コメントを表示</button>
                <div class="row justify-content-center" id="comment_content" style="margin: auto;">
                   
                    @foreach($post->comments as $comment)
                    <div class="col-9 p20">
                        <div class="media">
                            <img class="rounded-circle img-fluid" src="{{ asset('images/nonuser.png') }}"  width="50" height="50">
                        <div class="media-body">
                            <h5 class="mt-0 pl20"><a href="{{ action('User\PagesController@show', ['id' => $comment->user->id] )}}" class="text-secondary">{{ $comment->user->name }}</a></h5> {{ $comment->created_at }}
                              <h5 class="pl20 text-white">{{ $comment->comment }}</h5>
                           
                        </div>
                        </div>
                    </div>
                    @endforeach
                
                </div>
            </div>
    <!--</div>-->
    </div>
@endsection

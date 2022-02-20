@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="d-flex justify-content-between">
                            <div class="" style="font-size: 40px;cursor: pointer;" id="prev"><</div>
                            <div class="slider-comments d-flex" id="slider-comments" data-sliders="{{json_encode($comments_slider)}}">

                            </div>
                            <div class="" style="font-size: 40px;cursor: pointer;" id="next"> ></div>

                        </div>

                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                        the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                        of type and scrambled it to make a type specimen book. It has survived not only five centuries,
                        but also the leap into electronic typesetting, remaining essentially unchanged. It was
                        popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                        and more recently with desktop publishing software like Aldus PageMaker including versions of
                        Lorem Ipsum

                        <br>
                        <div class="d-flex m-2">
                            <input type="text" class="w-75" id="login">
                        </div>
                        <div id="users">

                        </div>
                        Comments:
                        <div id="comment-body">
                            @foreach($comments as $comment)
                                <div class="card-body bg-light m-2">
                                    Автор : {{$comment->user->login}} <br> {{$comment->value}}
                                </div>
                            @endforeach
                        </div>
                        <div class="text-center d-flex justify-content-center"><a id="load-more"
                                                                                  style="cursor: pointer;">Загрузить
                                еще</a></div>
                        @auth
                            <div class="d-flex mt-5">
                                <input type="text" class="w-75" id="value">
                                <button id="text-button">Send</button>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{mix('/js/main.js')}}"></script>
@endsection

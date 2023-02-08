@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/dashboard.css') }}">

    <style>
        .chat-log {
            padding: 40px 0 114px;
            height: 480px;
            overflow-y: scroll;
        }

        .chat-log__item {
            background: #fafafa;
            padding: 10px;
            margin: 0 auto 20px;
            max-width: 80%;
            float: left;
            border-radius: 4px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, .1);
            clear: both;
        }

        .chat-log__item.chat-log__item--own {
            float: right;
            background: #DCF8C6;
            text-align: right;
        }

        .chat-form {
            background: #DDDDDD;
            padding: 40px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .chat-log__author {
            margin: 0 auto .5em;
            font-size: 14px;
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="main-body my-4">

            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    @include('frontend.user.sidebar')
                </div>
                <div class="col-md-8">
                    <div class="main">
                        <div class="container ">
                            <h4 class="mb-0">{{ @$queries[0]['title'] }}</h4>
                            <p>{{ @explode(' ', @$queries[0]['created_at'])[0] }}</p>
                            <hr>
                            <div class="chat-log">
                                @foreach ($queries as $query)
                                    @if ($query['created_by'] !== auth()->user()->id)
                                        <div class="chat-log__item">
                                            <h3 class="chat-log__author mb-0">Admin</h3>
                                            <small>{{ @explode(' ', $query->created_at)[0] }}</small>
                                            <div class="chat-log__message">{{ $query['description'] }}
                                            </div>
                                        </div>
                                    @else
                                        <div class="chat-log__item chat-log__item--own me-3">
                                            <h3 class="chat-log__author mb-0">You</h3>
                                            <small>{{ @explode(' ', $query->created_at)[0] }}</small>
                                            <div class="chat-log__message">{{ $query['description'] }}</div>
                                        </div>
                                    @endif
                                @endforeach


                            </div>
                        </div>
                        <div class="container mt-3">
                            <form method="POST"
                                action="{{ route('frontend.user.queries.chat', ['id' => @$queries[0]['id']]) }}">
                                @csrf
                                <div class="container">
                                    <div class="col-12">
                                        <textarea class="form-control" name="description" id="description" rows="5"></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-success btn-block mt-3">Send</button>

                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
@endsection

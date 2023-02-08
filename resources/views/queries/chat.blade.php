@extends('layouts.admin')

@section('styles')
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
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="main mt-5">
            <div class="container ">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        @php
                            $id = @$queries[0]['id'];
                            $title = @$queries[0]['title'];
                            $created_at = @$queries[0]['created_at'];
                        @endphp

                        <h4 class="mb-0">{{ @$title }}</h4>
                        <p>{{ @explode(' ', @$created_at)[0] }}</p>
                    </div>
                    <div>
                        @if (@$queries[0]['answered'])
                            <div class="btn btn-primary">
                                Continuing
                            </div>
                        @else
                            <form method="POST"
                                action="{{ route('admin.user.queries.close', ['id' => @$queries[0]['id']]) }}">
                                @csrf
                                <button type="submit" class="btn btn-success">
                                    Close
                                </button>
                            </form>
                        @endif

                    </div>
                </div>
                <hr>
                <div class="chat-log">
                    @foreach ($queries as $query)
                        @if ($query['created_by'] !== auth()->user()->id)
                            <div class="chat-log__item">
                                <h3 class="chat-log__author mb-0">{{ $user->name }}</h3>
                                <small>{{ @explode(' ', $query->created_at)[0] }}</small>
                                <div class="chat-log__message">{{ $query['description'] }}
                                </div>
                            </div>
                        @else
                            <div class="chat-log__item chat-log__item--own me-3">
                                <h3 class="chat-log__author mb-0">Admin</h3>
                                <small>{{ @explode(' ', $query->created_at)[0] }}</small>
                                <div class="chat-log__message">{{ $query['description'] }}</div>
                            </div>
                        @endif
                    @endforeach


                </div>
            </div>
            <div class="container mt-3 mb-5">
                <form method="POST" action="{{ route('admin.user.queries.chat', ['id' => @$id]) }}">
                    @csrf
                    <div class="container">
                        <div class="col-12">
                            <textarea class="form-control" name="description" id="description" rows="5"></textarea>
                        </div>

                        <button type="submit" class="btn btn-dark btn-block mt-3">Send</button>

                    </div>
                </form>
            </div>
        </div>
        <!-- Content wrapper -->
    </div>
    <!-- / Layout page -->
@endsection

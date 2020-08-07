@extends('layouts.index')

@section('body')
    <div class="container">

        <div class="row mt-5">

            <div class="conversation-wrap col-lg-3">

                @foreach($name_list as $name)
                    @include('chat.name', ['name' => $name])
                @endforeach

            </div>



            <div class="message-wrap col-lg-8">
                <div class="msg-wrap">

                    @foreach($message_list as $message)
                        @include('chat.message', ['message' => $message])
                    @endforeach

                </div>

                <div class="send-wrap ">

                    <textarea class="form-control send-message" rows="3" placeholder="Write a reply..."></textarea>


                </div>
                <div class="btn-panel">

                    <a href="" class=" col-lg-4 text-right btn   send-message-btn pull-right" role="button"><i class="fa fa-plus"></i> Send Message</a>
                </div>
            </div>
        </div>
    </div>
@endsection

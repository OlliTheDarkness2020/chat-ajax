@extends('layouts.index')

@section('body')
    <form class="form-middle" method="POST">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" autocomplete="off">
        </div>
        <button type="submit" class="btn btn-primary">Confirm</button>
        @csrf
    </form>
@endsection

@section('body-params') class="body-100" @endsection

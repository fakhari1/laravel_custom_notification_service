@extends('layouts.layout')

@section('title', 'ارسال ایمیل')

@section('content')
    @include('partials.alerts')
    <div class="card  d-block w-50 mx-auto">
        <div class="card-header">
            فرم ارسال پیام کوتاه
        </div>
        <div class="card-body">
            <form action="{{ route('notifications.send.sms') }}" method="post">
                @csrf
                <div class="form-group px-4 mb-4">
                    <div class="row">
                        <label for="user" class="form-check-label col-12 col-lg-3">کاربران</label>
                        <div class="col-12 col-lg-9">
                            <select name="user" class="form-select form-select-sm" style="direction: ltr;">
                                <option>انتخاب کنید...</option>
                                @forelse($users as $key => $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @empty
                                    <option selected>کاربری برای نمایش وجود ندارد</option>
                                @endforelse
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group px-4 mb-4">
                    <div class="row">
                        <label for="sms" class="form-check-label col-12 col-lg-3">متن پیام کوتاه</label>
                        <div class="col-12 col-lg-9">
                            <textarea name="sms_text" id="sms_text" rows="3" class="form-control"></textarea>
                        </div>
                    </div>
                </div>

                <div class="form-group px-4 mb-4">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary text-white fw-bold btn-sm">ارسال</button>
                    </div>
                </div>
            </form>
            @if($errors->any())
                <div class="form-group px-4 mb-4">
                    <ul class="px-0">
                        @foreach($errors->all() as $key => $error)
                            <li class="text-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>

@endsection

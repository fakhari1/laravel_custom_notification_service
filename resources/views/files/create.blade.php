@extends('layouts.layout')

@section('title', 'آپلود فایل')

@section('content')
    <div class="row justify-content center col-6 d-block mx-auto">
        <div class="">
            @include('partials.alerts')
        </div>
        <div class="card p-0">
            <div class="card-header">
                آپلود فایل
            </div>
            <div class="card-body">
                <form action="{{ route('file.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="custom-file mb-3">
                            <label for="customFile" class="form-check-label mb-3">انتخاب فایل...</label>
                            <input type="file" name="file" id="customFile" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check d-flex ">
                            <input class="form-check-input" type="checkbox" id="is_private" name="is_private">
                            <label class="form-check-label" for="is_private" style="margin-right: 2rem;">
                                به صورت خصوصی آپلود شود
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="text-center">
                            <button class="btn btn-sm btn-primary" type="submit">آپلود</button>
                        </div>
                    </div>
                    @if($errors->any())
                        <div class="form-group">
                            <div class="text-center">
                                @foreach($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.layout')

@section('title', 'لیست فایل ها')

@section('content')
    <div class="row justify-content center col-10 d-block mx-auto">
        <div class="">
            @include('partials.alerts')
        </div>
        <div class="card p-0">
            <div class="card-header">
                لیست فایل ها
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">نام فایل</th>
                        <th scope="col">اندازه</th>
                        <th scope="col">مدت (ویدئو)</th>
                        <th scope="col">نوع</th>
                        <th scope="col">سطح دسترسی</th>
                        <th scope="col">تاریخ آپلود</th>
                        <th scope="col">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($files as $key => $file)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>
                                {{ $file->name }}
                            </td>
                            <td>{{ number_format($file->size / (1024 * 1024), 2) }} مگابایت</td>
                            <td>{{ $file->time ?? '-' }}</td>
                            <td>{{ $file->type }}</td>
                            <td>{{ $file->is_private ? 'خصوصی' : 'عمومی' }}</td>
                            <td>{{ \Carbon\Carbon::parse($file->created_at)->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('file.download', $file->name) }}"
                                   class="btn btn-outline-primary btn-sm">دانلود</a>
                                <a href="{{ route('file.delete', $file->name) }}" class="btn btn-outline-danger btn-sm"
                                   onclick="event.preventDefault(); document.getElementById('delete_file').submit()">حذف</a>
                                <form action="{{ route('file.delete', $file->name) }}" method="post" id="delete_file">
                                    @csrf
                                    @method('delete')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">فایلی وجود ندارد؛ از قسمت آپلود فایل اقدام کنید.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

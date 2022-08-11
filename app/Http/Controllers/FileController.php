<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Models\File;
use App\Services\Uploader\Uploader;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index()
    {
        $files = File::all();
        return view('files.all', compact('files'));
    }

    public function create()
    {
        return view('files.create');
    }

    public function store(FileRequest $request)
    {
        Uploader::upload($request);

        return redirect()->back()->with(['success_msg' => 'فایل با موفقیت آپلود شد.']);
    }

    public function show($file_name)
    {
        $file = File::query()->where('name', '=', $file_name)->firstOrFail();
        return $file->download();
    }

    public function destroy($file_name)
    {
        $file = File::query()->where('name', '=', $file_name)->firstOrFail();

        $file->delete();

        return redirect()->back()->with(['success_msg' => 'فایل مورد نظر حذف شد.']);
    }
}

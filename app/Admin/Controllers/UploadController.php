<?php

namespace App\Admin\Controllers;

use App\Imports\RankImport;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form\Field\ImageField;
use Encore\Admin\Form\Field\UploadField;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\MessageBag;
use Maatwebsite\Excel\Facades\Excel;

class UploadController extends Controller
{
    use ImageField;
    use UploadField;

    public function __construct()
    {
        $this->initStorage();
    }

    public function dragUploader(Request $request)
    {
        $file = $request->file('file');
        $this->uniqueName();
        $this->name = $this->getStoreName($file);
        $this->storage_permission(true);
        $path = $this->upload($file);

        return response()->json([
           "code" => 1,
            "msg" => $this->storage->url($path)
        ]);
    }
}

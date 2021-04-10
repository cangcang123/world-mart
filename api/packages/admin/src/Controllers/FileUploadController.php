<?php

namespace SHOP\Admin\Controllers;

use Excel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use SHOP\Admin\Library\ReadFilter;
use SHOP\CRM\Models\LogImportFile;
use App\Imports\ExcelImportPhoneNumber;

class FileUploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['uploadMobile']]);
    }

    public function upload(Request $request) {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->file('image')->isValid()) {
            $fileExtension = $request->file('image')->getClientOriginalExtension();
            // Create file name
            $fileName = time() . "_" . md5(rand(0,9999999)) . "." . $fileExtension;
            // Upload folder
            $path = 'public/upload' .'/'. date('Y/m/d');
            // Move to folder
            Storage::putFileAs($path, $request->file('image'), $fileName);

            $url = Storage::url($path .'/'. $fileName);

            return [
                'url' => url($url),
            ];
        }
        else return [
            'message' => 'Upload failed!'
        ];
    }

    public function uploadMobile(Request $request) {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->file('image')->isValid()) {
            $fileExtension = $request->file('image')->getClientOriginalExtension();
            // Create file name
            $fileName = time() . "_" . md5(rand(0,9999999)) . "." . $fileExtension;
            // Upload folder
            $path = 'public/upload' .'/'. date('Y/m/d');
            // Move to folder
            Storage::putFileAs($path, $request->file('image'), $fileName);

            $url = Storage::url($path .'/'. $fileName);

            return [
                'url' => url($url),
            ];
        }
        else return [
            'message' => 'Upload failed!'
        ];
    }


    public function uploadMulti(Request $request) {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->file('file')->isValid()) {
            $fileExtension = $request->file('file')->getClientOriginalExtension();
            // Create file name
            $fileName = time() . "_" . md5(rand(0,9999999)) . "." . $fileExtension;
            // Upload folder
            $path = 'public/upload' .'/'. date('Y/m/d');
            // Move to folder
            Storage::putFileAs($path, $request->file('file'), $fileName);

            $url = Storage::url($path .'/'. $fileName);

            return [
                'url' => url($url),
                'name' => $request->file('file')->getClientOriginalName()
            ];
        }
        else return [
            'message' => 'Upload failed!'
        ];
    }

    public static function uploadFile($request, $table_name) {

        $request->validate([
            'file'=>'required|mimes:xlsx,csv,txt'
        ]);

        $extensions     = array("xls","xlsx","csv");
        $file           = $request->file('file');
        $file_extension = $file->getClientOriginalExtension();
        if (in_array($file_extension, $extensions)) {
            $filename       = Str::studly($table_name) . '_' . time();
            $file_path      = 'imports' .'/'. date('Y/m/d');
            $inputFileName  = 'app' .'/'. $file_path .'/'. $filename .'.'. $file_extension;

            $result = LogImportFile::create([
                'name'      => $filename,
                'table'     => $table_name,
                'state'     => 1,
                // 'status'    => 1,
                'deleted'   => 0,
                'extension' => $file_extension
            ]);

            if (isset($result->id)) {
                // Move to folder
                Storage::putFileAs($file_path, $file, $filename.'.'.$file_extension);
                $inputFileType = Str::studly($file_extension);
                // Get sheet info
                $filterSubset  = new ReadFilter();
                $reader        = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
                $reader->setReadFilter($filterSubset);

                $list_columns  = [];
                $worksheetData = $reader->listWorksheetInfo(storage_path($inputFileName));
                $spreadsheet   = $reader->load(storage_path($inputFileName));

                if (!empty($worksheetData[0])) {
                    for ($i = 1; $i <= $worksheetData[0]['totalColumns']; $i++) {
                        $list_columns[] = $spreadsheet->getActiveSheet()->getCellByColumnAndRow($i,1)->getValue();
                    }
                }

                $total_rows = isset($worksheetData[0]['totalRows']) ? $worksheetData[0]['totalRows'] - 1 : 0;

                LogImportFile::updateOrCreate(['id' => $result->id], [
                    'path'       => $inputFileName,
                    'state'      => 2,
                    'total_rows' => $total_rows,
                    'columns'    => implode(", ",$list_columns),
                ]);

                return [
                    'code'      => 200,
                    'url'       => $inputFileName,
                    'extension' => $file_extension,
                    'columns'   => implode(", ",$list_columns),
                    'rows'      => $total_rows,
                    'table_name'=> $table_name,
                    'id'        => $result->id
                ];
            } else {
                return [
                    'code'    => 404,
                    'message' => 'Import failed!'
                ];
            }
        }
        else {
            return [
                'code'    => 404,
                'message' => 'Import failed!'
            ];
        }
    }

    public static function importPhoneNumber(Request $request) {
        $request->validate([
            'file'=>'required|mimes:xlsx,csv,txt'
        ]);

        $extensions = array("xls","xlsx","csv");

        $file = $request->file('file');
        $file_extension = $file->getClientOriginalExtension();
        if (in_array($file_extension, $extensions)) {
            $file_with_ext  = 'User_Status-'  . time() .'.'. $file_extension;
            $filename       = 'User_Status-'  . time();
            $file_path      = 'exports' .'/'. date('Y/m/d');
            $inputFileName  = 'app' .'/'. $file_path .'/'. $file_with_ext;

            // Move to folder
            Storage::putFileAs($file_path, $file, $file_with_ext);
            Excel::import(new ExcelImportPhoneNumber($inputFileName, $filename, $file_extension), storage_path($inputFileName));

            return [
                'code'      => 200,
                'url'       => $inputFileName,
                'extension' => $file_extension,
                'name'      => $filename
            ];
        }
        else {
            return [
                'code'    => 404,
                'message' => 'Import failed!'
            ];
        }
    }
}

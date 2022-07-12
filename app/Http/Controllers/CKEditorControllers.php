<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CKEditorControllers extends Controller
{
    public function upload(Request $request)
    {
        // if(!empty($request->upload)){
        //     $filename = 
        // }
        if($request->hasFile('upload')) {
            //get filename with extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();
       
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
       
            //get file extension
            $extension = $request->file('upload')->extension();
       
            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;
       
            //Upload File
            $request->file('upload')->move(public_path('uploads'), $filenametostore);
  
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('uploads/'.$filenametostore);
            $msg = 'Image successfully uploaded';
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
              
            // Render HTML output
            @header('Content-type: text/html; charset=utf-8');
            echo $re;
        }
    }
}

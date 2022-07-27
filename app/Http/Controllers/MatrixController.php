<?php

namespace App\Http\Controllers;

use App\Models\Matrix;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\MatrixCollection;
use App\Http\Resources\MatrixResource;
use Illuminate\Support\Arr;

class MatrixController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //store file in postman
   
    //check for square matrix 
    public function index(Request $request)
    {
       //This function is solely for when the buttons are clicked from the front end
        //check which button was clicked
        
        if($request->hasFile('uploaded_csvfile')) {
            $filedata_array = $this->getCSV($request);

            switch ($request->input('action')) {
                case 'echomatrix':   
                    $str="";
                    if($filedata_array == 'Non-Numeric present'){
                        return response()->json([
                                    
                            'error9'=>'Input contains non-integers or Input is an empty file'
                        ]);
                    }elseif($filedata_array == 'No file uploaded' || $filedata_array == 'Invalid File extension'
                    || $filedata_array == 'File size exceeds 2MB'|| $filedata_array == 'Input not a square matrix')
                    {
                        return response()->json([
                                    
                            'error'=>$filedata_array
                        ]);
                    }else{
                        //Typecast filedata_array as an array;
                        $filedata_array = (array) $filedata_array;
                        
                        foreach($filedata_array as $key=>$value){
                            $str = $str.implode (", ", $value).nl2br("\r\n");   
                        }
                    }
                    return $str;  
                break;

                case 'invert':                 
                    
                    if($filedata_array == 'Non-Numeric present'){
                        return response()->json([
                                    
                            'error2'=>'Input contains non-integers or Input is an empty file'
                        ]);
                    }elseif($filedata_array == 'No file uploaded' || $filedata_array == 'Invalid File extension'
                            || $filedata_array == 'File size exceeds 2MB'|| $filedata_array == 'Input not a square matrix')
                    {
                        
                        return response()->json([
                                    
                            'error'=>$filedata_array
                        ]);
                    }else{
                        //Typecast filedata_array as an array;
                        $filedata_array = (array) $filedata_array;

                        // Invert Matrix
                        $t=0;
                        $str="";
                        $invert = array();
                    
                        while ($columns = array_column($filedata_array, $t++))
                        {
                            $invert[] = $columns;
                        
                        }
                    
                        foreach($invert as $key=>$value){

                                $str = $str.implode (", ", $value).nl2br("\r\n");   

                        }
                            
                        return $str; 
                    }  
                break;

                case 'flatten':                 
                
                    //Typecast filedata_array as an array;
                    $filedata_array = (array) $filedata_array;
            
                    $flatten = Arr::flatten($filedata_array);
                
                    return implode(", ", $flatten);
            
                break;

                case 'sum':                 
                //  $filedata_array = $this->getCSV($request);
                    //check for non numeric item in file;  
                    if($filedata_array == 'Non-Numeric present'){
                            return response()->json([
                                        
                                'error3'=>'Input contains non-integers or Input is an empty file'
                            ]);
                    }elseif($filedata_array == 'No file uploaded' || $filedata_array == 'Invalid File extension'
                    || $filedata_array == 'File size exceeds 2MB' || $filedata_array == 'Input not a square matrix')
                    {
                        return response()->json([
                                    
                            'error'=>$filedata_array
                        ]);
                    }else{
                    $sum=0;
                    $num = count((array)$filedata_array);
                
                    foreach ($filedata_array as $key=>$value){
                        foreach($value as $item){
                            $sum = (int)$sum + (int)$item; 
                            
                        }        
                    }
                    return $sum;
                    }
                break;

                case 'multiply':                 
                // $filedata_array = $this->getCSV($request);
                    //check for non numeric in file
                    if($filedata_array == 'Non-Numeric present'){
                            return response()->json([
                                        
                                'error4'=>'Input contains non-integers or Input is an empty file'
                            ]);
                    }elseif($filedata_array == 'No file uploaded' || $filedata_array == 'Invalid File extension'
                    || $filedata_array == 'File size exceeds 2MB'|| $filedata_array == 'Input not a square matrix')
                    {
                        return response()->json([
                                    
                            'error'=>$filedata_array
                        ]);
                    }else{
                        $multiply=1;
                        //$num = count($filedata_array);
                            foreach ($filedata_array as $key=>$value){
                                foreach($value as $item){
                                    $multiply = (int)$multiply * (int)$item; 
                                    
                                } 
                            
                            }
                    return json_encode($multiply,JSON_NUMERIC_CHECK | JSON_PARTIAL_OUTPUT_ON_ERROR);
                    }
            break;
            }  
        }else{
            return response()->json([
                    
                'error'=>'No file Selected'
            ]);
        }
    }

    public function echo(Request $request)
    {
        $filedata_array = $this->getCSV($request);

        $str="";
        if($filedata_array == 'Non-Numeric present'){
           // dd($filedata_array);
            return response()->json([
                    
                'error5'=>'Input contains non-integers or Input is an empty file'
            ]);
            
        }elseif($filedata_array == 'No file uploaded' || $filedata_array == 'Invalid File extension'
                || $filedata_array == 'No file uploaded'|| $filedata_array == 'Input not a square matrix')
        {
            return response()->json([
                        
                'error'=>$filedata_array
            ]);
        }else{ 
           //Typecast filedata_array as an array;
            $filedata_array = (array) $filedata_array;
            foreach($filedata_array as $key=>$value){
                $str = $str.implode (", ", $value).nl2br("\r\n");   
            }
        
        return $str;  
        }  
    }

    public function invert(Request $request){

      $filedata_array = $this->getCSV($request);

       if($filedata_array == 'Non-Numeric present'){
            return response()->json([
                        
                'error6'=>'Input contains non-integers or Input is an empty file'
            ]);
        }elseif($filedata_array == 'No file uploaded' || $filedata_array == 'Invalid File extension'
                || $filedata_array == 'No file uploaded'|| $filedata_array == 'Input not a square matrix')
        {
            return response()->json([
                        
                'error'=>$filedata_array
            ]);
        }else{ 
            
            //Typecast filedata_array as an array;
            $filedata_array = (array) $filedata_array;

            // Invert Matrix
            $t=0;
            $str="";
            $invert = array();
        
            while ($columns = array_column($filedata_array, $t++))
            {
                $invert[] = $columns;
            
            }
        
            foreach($invert as $key=>$value){
                $str = $str.implode (", ", $value).nl2br("\r\n");   
            }
                
                return $str;  
        }  
    }

    public function sum(Request $request)
    {     
        $filedata_array = $this->getCSV($request);
        //check for non numeric item in file;  
        if($filedata_array == 'Non-Numeric present'){
                return response()->json([
                            
                    'errorg6'=>'Inputs contains non-integers or Input is an empty file'
                ]);
        }elseif($filedata_array == 'No file uploaded' || $filedata_array == 'Invalid File extension'
                || $filedata_array == 'No file uploaded'|| $filedata_array == 'Input not a square matrix')
        {
            return response()->json([
                        
                'error'=>$filedata_array
            ]);
        }else{ 
            $sum=0;
            $num = count((array)$filedata_array);
            
                foreach ($filedata_array as $key=>$value){
                    foreach($value as $item){
                        $sum = (int)$sum + (int)$item; 
                        
                    }        
                }
            return $sum;
        }
    }

    public function multiply(Request $request)
    { 
        $filedata_array = $this->getCSV($request);
         //check for non numeric in file
        if($filedata_array == 'Non-Numeric present'){
                return response()->json([
                            
                    'error7'=>'Input contains non-integers or Input is an empty file'
                ]);
        }elseif($filedata_array == 'No file uploaded' || $filedata_array == 'Invalid File extension'
                || $filedata_array == 'No file uploaded'|| $filedata_array == 'Input not a square matrix')
        {
            return response()->json([
                        
                'error'=>$filedata_array
            ]);
        }else{ 
            $multiply=1;
            //$num = count($filedata_array);
                foreach ($filedata_array as $key=>$value){
                    foreach($value as $item){
                        $multiply = (int)$multiply * (int)$item; 
                        
                    } 
                
                }
                //JSON_NUMERIC_CHECK | JSON_PARTIAL_OUTPUT_ON_ERROR checks for very large files 
                //or non numerics and returns zero
            return json_encode($multiply,JSON_NUMERIC_CHECK | JSON_PARTIAL_OUTPUT_ON_ERROR);
        }
    }

    public function flatten(Request $request)
    {
        $filedata_array = $this->getCSV($request);
           //check for non numeric in file
        if($filedata_array == 'Non-Numeric present'){
            return response()->json([
                        
                'error8'=>'Input contains non-integers or Input is an empty file'
            ]);
        }elseif($filedata_array == 'No file uploaded' || $filedata_array == 'Invalid File extension'
                || $filedata_array == 'No file uploaded'|| $filedata_array == 'Input not a square matrix')
        {
            return response()->json([
                        
                'error'=>$filedata_array
            ]);
        }else{ 
            $flatten = Arr::flatten($filedata_array);
       
        return implode(", ", $flatten);
        }   
    }

    public function getCSV(Request $request)
    { 
        $maxFileSize = 2097152; // Uploaded file size limit is 2mb

        //check if a file was uploaded
        if($request->hasFile('uploaded_csvfile')) {
        
            $file = $request->file('uploaded_csvfile');

            //get name of uploaded file
            $file_name = $file->getClientOriginalName();
            
            //get file extension of uploaded file
            $file_extension = $file->getClientOriginalExtension();

            //get size (in bytes) of uploaded file 
            $file_size = $file->getSize();

            //get path of file
            $file->move(public_path(), $file_name);
            $file_path = public_path()."/".$file_name;
            
            //validate size and extension

            //$try = $this->checkUploadedFile($file_extension, $file_size);
            
            if($file_extension == 'csv' || $file_extension == 'xlsx' || $file_extension == 'xls'){
                $file = fopen($file_path, "r");
                //array for holding file contents
                $filedata_array = array(); 
                //counter is starting from zero since file has no header
            
                $i = 0; 
                //parse through contents of uploaded file
                while(($file_data = fgetcsv($file, 1000, ",")) !== FALSE){
                    $num = count($file_data);
                    for($k=0; $k<$num; $k++){
                        if (!is_numeric($file_data[$k])) 
                        {
                            $filedata_array = 'Non-Numeric present';
                            return  $filedata_array;
                        }else{
                        $filedata_array[$i][] = intval($file_data[$k]);
                    
                    }
                    
                    }
                    
                    $i++;

                }
                fclose($file); 
                
                if($i == $k){

                return $filedata_array;
                }elseif($i != $k){
                    $filedata_array='Input not a square matrix';
                    return $filedata_array;
                }
                

            }elseif($file_size > $maxFileSize){
                 
                $filedata_array='File size exceeds 2MB';
                   return $filedata_array;
               
            }else{
                $filedata_array='Invalid File extension';
                return $filedata_array;
            }
        }else{
            $filedata_array = 'No file uploaded';
            return  $filedata_array;
        }
    }

  
}

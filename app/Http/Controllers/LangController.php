<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;
use File;
use \stdClass;

class LangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages = config('app.languages');

        $array_data = [];
        $translates = [];
        foreach($languages as $lang) {
            $file =  File::getRequire(base_path().'/resources/lang/'.$lang.'/lang.php');
            foreach($file as $key => $value){
                $array_data[$key][$lang] = $value;
            }
        }

        foreach ($array_data as $key=>$value){
            $obj = new \stdClass();
            $obj->key = $key;
            foreach($value as $val=>$v) {
                $obj->$val = $v;
            }
            array_push($translates, $obj);
        }


        return view('langs.index',['translates' => $translates]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit_translate(Request $request)
    {
        $input = $request->all();
        $languages = config('app.languages');
        foreach($languages as $lang) {
            $file =  File::getRequire(base_path().'/resources/lang/'.$lang.'/lang.php');
            foreach($file as $key => $value){
                if($key == $input['key']) {
                    $array_data[$key][$lang] = $value;
                }  
            }
        }

        foreach ($array_data as $key=>$value){
            $obj = new \stdClass();
            $obj->key = $key;
            foreach($value as $val=>$v) {
                $obj->$val = $v;
            }
        }

        return json_encode($obj);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $input = $request->all();
        
        $languages = config('app.languages');

        foreach($languages as $lang) {
            //insertar en los json
            $data = $this->openJSONFile($lang);
            $data[$input['key']] = $input[$lang];
            $this->saveJSONFile($lang, $data);

            //insertar en los array
            $data = $this->openArrayFile($lang);
            $data[$input['key']] = $input[$lang];
            $this->saveArrayFile($lang, $data);
            
        }
        return redirect()->route('langs.index')->with('success',__('success_update_translate'));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $key
     * @return \Illuminate\Http\Response
     */
    public function destroy($key)
    {
    
        $languages = config('app.languages');

        foreach($languages as $lang){
            //eliminar la key de los .json 
           $file = $this->openJSONFile($lang);
           unset($file[$key]);
           $this->saveJSONFile($lang, $file);
          
           //eliminar la key de los array lang
           $file = $this->openArrayFile($lang);
           unset($file[$key]);
           $this->saveArrayFile($lang, $file);
        }
        return redirect()->route('langs.index')->with('success',__('success_remove_translate'));
    }

    public function translate(Request $request)
    {
        $languages = config('app.languages');

        $input = $request->all();

        $tr = new GoogleTranslate();
        $tr->setSource('es');
        $data = [];

        foreach ($languages as $lang) {
            $tr->setTarget($lang);
            $data[$lang] = $tr->translate($input['word']);
        }

        return $data;
    }

    public function save_translate(Request $request)
    {
        
        $input = $request->all();
        
        $languages = config('app.languages');

        foreach($languages as $lang) {
            //insertar en los json
            $data = $this->openJSONFile($lang);
            if(array_key_exists($input['key'], $data)) {
                return redirect()->route('langs.index')->with('error',__('error_translate'));
             }
            $data[$input['key']] = $input[$lang];
            
            $this->saveJSONFile($lang, $data);

            //insertar en los array
            $data = $this->openArrayFile($lang);
            if(array_key_exists($input['key'], $data)){
                return redirect()->route('langs.index')->with('error',__('error_translate'));
            }
            $data[$input['key']] = $input[$lang];

            $this->saveArrayFile($lang, $data);
            
        }
        return redirect()->route('langs.index')->with('success',__('success_translate'));
    }

    /**
    * Open Translation Array PHP File
    * @return Response
    */
    private function openArrayFile($code){

        if(File::exists(base_path('/resources/lang/'.$code.'/lang.php'))){
            $file =  File::getRequire(base_path().'/resources/lang/'.$code.'/lang.php');
           
        }
        return $file;
    }

    /**
    * Save Array File
    * @return Response
    */
    private function saveArrayFile($code, $data){
        ksort($data);
        $content = "<?php\n\nreturn\n[\n";
        
        foreach ($data as $this->key => $this->value) {
            $content .= "\t\"".$this->key."\" => \"".$this->value."\",\n";
        }
    
        $content .= "];";
    
        file_put_contents(base_path('/resources/lang/'.$code.'/lang.php'), $content);
    }


    /**
    * Open Translation File
    * @return Response
    */
    private function openJSONFile($code){
        $jsonString = [];
        if(File::exists(base_path('resources/lang/'.$code.'.json'))){
            $jsonString = file_get_contents(base_path('resources/lang/'.$code.'.json'));
            $jsonString = json_decode($jsonString, true);
        }
        return $jsonString;
    }

    /**
    * Save JSON File
    * @return Response
    */
    private function saveJSONFile($code, $data){
        ksort($data);
        $jsonData = json_encode($data, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
        file_put_contents(base_path('resources/lang/'.$code.'.json'), stripslashes($jsonData));
    }


    /**
     * Save JSON File
     * @return Response
    */
    public function transUpdate(Request $request){
        $data = $this->openJSONFile($request->code);
        $data[$request->pk] = $request->value;


        $this->saveJSONFile($request->code, $data);
        return response()->json(['success'=>'Done!']);
    }

    public function delete_translate($key)
    {

        $visible = 'visible';
        $message =  '';


        return view('partials.delete_modal', [
            'rute' => 'langs.destroy',
            'id'   => $key,
            'name' => $key,
            'visible' => $visible,
            'message' => $message,
        ]);
        
    }
}

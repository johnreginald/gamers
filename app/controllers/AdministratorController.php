<?php

class AdministratorController extends BaseController {

    public function __construct() {
        View::share('name', 'Steve');
    }

    public function getIndex() {
        return View::make('Administrator.dashboard');
    }

    public function getMedia() {
        $media = MediaModel::All();
        return View::make('Administrator.media', compact('media'));
    }

    public function postMedia() {
        $rules = array(
            'image' => 'mimes:jpeg,png,jpg'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('Administrator/media');
        } else {
            $destinationPath = public_path('upload');
            $filename =  str_random(30) . '.' . Input::file('image')->getClientOriginalExtension();
            Input::file('image')->move($destinationPath, $filename);

            $media  = new MediaModel;
            $media->name = $filename;
            $media->save();
            return Redirect::back()->with('message', Lang::get('message.upload-success'));
        }
    }

    public function getPrepaid() {
        $prepaid = Prepaid::paginate(20);        
        return View::make('Administrator.prepaid', compact('prepaid'));
    }

    public function postPrepaidGenerate() {
        $last_prepaid = Prepaid::orderBy('serial', 'desc')->first();
        if (Prepaid::orderBy('serial', 'desc')->first()) {
            $serial = $last_prepaid->serial + 1;
            $counter = $last_prepaid->serial + 100;
        } else {
            $serial = 1000;
            $counter = 1100;
        }
        while ($serial <= $counter) {
            $data = array(
                'serial' => $serial,
                'code' => strtoupper(sha1(rand())),
                'status' => FALSE
                );
            Prepaid::create($data);
            $serial++;
        }
        return Redirect::to('administrator/prepaid')->with('message', Lang::get('message.prepaid-generate'));
    }

    public function prepaid_search() {
        $prepaid = DB::table('prepaids')
                ->where(function($query){
                    $query->orWhere('serial', 'LIKE', '%' . Input::get('search') . '%')
                    ->orWhere('code', 'LIKE', '%' . Input::get('search') . '%')
                    ->orWhere('used_by', 'LIKE', '%' . Input::get('search') .'%');
                })
                ->get();
        return View::make('Administrator.prepaid', compact('prepaid'));
    }

    public function getOrder() {
        return View::make('Administrator.order');
    }

    public function getSettings() {
        return View::make('Administrator.settings');
    }
}

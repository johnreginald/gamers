<?php

class AdministratorController extends BaseController {

    public function getIndex() {
        return View::make('Administrator.dashboard');
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
                ->where(function($query) {
                    $query->orWhere('serial', 'LIKE', '%' . Input::get('search') . '%')
                    ->orWhere('code', 'LIKE', '%' . Input::get('search') . '%')
                    ->orWhere('used_by', 'LIKE', '%' . Input::get('search') . '%');
                })
                ->get();
        return View::make('Administrator.prepaid', compact('prepaid'));
    }

    // Order Function

    public function getOrder() {

        $order = Order::All();
        return View::make('Administrator.order')->with('order', $order);
    }

    // Slider Function

    public function getSlider() {

        $slider = Slider::All();
        return View::make('Administrator.Slider.index', compact('slider'));
    }

    public function getSliderCreate() {
        return View::make('Administrator.Slider.create');
    }

    public function postSliderCreate() {

        $slider = new Slider;
        $slider->title = Input::get('title');
        $slider->url = Input::get('url');
        $slider->order = Input::get('order');
        $slider->description = Input::get('description');
        $slider->save();
        return Redirect::to('administrator/slider');
    }

    // Sponsor Function

    public function getSponsor() {

        $slider = Slider::All();
        return View::make('Administrator.Sponsor.index', compact('slider'));
    }

    public function getSponsorCreate() {
        return View::make('Administrator.Sponsor.create');
    }

    public function postSponsorCreate() {

        $slider = new Slider;
        $slider->title = Input::get('title');
        $slider->url = Input::get('url');
        $slider->order = Input::get('order');
        $slider->description = Input::get('description');
        $slider->save();
        return Redirect::to('administrator/slider');
    }

    // Website Settings

    public function getSettings() {
        return View::make('Administrator.settings');
    }

    // Upload Function

    public function upload_basic() {
        $files = Input::file('files');
        $assetPath = '/uploads';
        $uploadPath = public_path($assetPath);
        $results = array();
        foreach ($files as $file) {
            $name = strtolower(str_replace(' ', '-', $file->getClientOriginalName()));
            // store our uploaded file in our uploads folder
            $file->move($uploadPath, $name);
            Image::make($uploadPath . '/' . $name)->resize(150, 150)->save($uploadPath . "/150x150_" . $name);
            // set our results to have our asset path
            $results[] = array(
                'name' => $assetPath . '/' . '150x150_' . $name,
                    // 'url' => $assetPath . '/' . $name,
                    // 'thumbnailUrl' => $assetPath . '/' . '150x150_' . $name,
            );
        }
        return Response::json(array('files' => $results));
    }

    public function upload_slider() {
        $files = Input::file('files');
        $assetPath = 'uploads';
        $uploadPath = public_path($assetPath);
        $results = array();
        foreach ($files as $file) {
            $name = strtolower(str_replace(' ', '-', $file->getClientOriginalName()));
            // store our uploaded file in our uploads folder
            $file->move($uploadPath, $name);
            Image::make($uploadPath . '/' . $name)->resize(250, 75)->save($uploadPath . "/250x75_" . $name);
            Image::make($uploadPath . '/' . $name)->resize(1375, 400)->save($uploadPath . "/slider_" . $name);
            // set our results to have our asset path
            $results[] = array(
                'name' => $name,
            );
        }
        return Response::json(array('files' => $results));
    }

//    public function upload_plus() {
//        $files = Input::file('files');
//        $assetPath = '/uploads';
//        $uploadPath = public_path($assetPath);
//        $results = array();
//        foreach ($files as $file) {
//            $name = strtolower(str_replace(' ', '-', $file->getClientOriginalName()));
//            // store our uploaded file in our uploads folder
//            $file->move($uploadPath, $name);
//            Image::make($uploadPath . '/' . $name)->resize(150, 150)->save($uploadPath . "/150x150_" . $name);
//            // set our results to have our asset path
//            $results[] = array(
//                'name' => $name,
//                'url' => $assetPath . '/' . $name,
//                'thumbnailUrl' => $assetPath . '/' . '150x150_' . $name,
//            );
//        }
//        return Response::json(array('files' => $results));
//    }

}

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
                ->where(function($query){
                    $query->orWhere('serial', 'LIKE', '%' . Input::get('search') . '%')
                    ->orWhere('code', 'LIKE', '%' . Input::get('search') . '%')
                    ->orWhere('used_by', 'LIKE', '%' . Input::get('search') .'%');
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
        return View::make('Administrator.slider', compact('slider') );

    }

    public function postSlider() {

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
        return View::make('Administrator.sponsor', compact('slider') );

    }

    public function postSponsor() {

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
}

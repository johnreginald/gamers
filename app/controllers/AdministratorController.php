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

    public function order_accept($id) {
        $order = Order::find($id);
        $order->status = 1;
        $order->save();
        return Redirect::to('administrator/order')->withMessage('Success!')->withStatus('success');
    }

    public function order_cancel($id) {
        Order::destroy($id);
        return Redirect::to('administrator/order')->withMessage('Deleted!')->withStatus('danger');
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

    public function delete_slider($id) {
        Slider::destroy($id);
        return Redirect::to('administrator/slider');
    }

    // Sponsor Function

    public function getSponsor() {
        $sponsor = Sponsor::All();
        return View::make('Administrator.Sponsor.index', compact('sponsor'));
    }

    public function getSponsorCreate() {
        return View::make('Administrator.Sponsor.create');
    }

    public function postSponsorCreate() {
        $slider = new Sponsor;
        $slider->title = Input::get('title');
        $slider->url = Input::get('url');
        $slider->order = Input::get('order');
        $slider->description = Input::get('description');
        $slider->save();
        return Redirect::to('administrator/sponsor');
    }

    public function delete_sponsor($id) {
        Sponsor::destroy($id);
        return Redirect::to('administrator/sponsor');
    }

    // Advertisement Function

    public function getAdvertisement() {
        $advertisement = Advertisement::All();
        return View::make('Administrator.Advertisement.index', compact('advertisement'));
    }

    public function getAdvertisementCreate() {
        return View::make('Administrator.Advertisement.create');
    }

    public function postAdvertisementCreate() {
        $slider = new Advertisement;
        $slider->title = Input::get('title');
        $slider->url = Input::get('url');
        $slider->order = Input::get('order');
        $slider->description = Input::get('description');
        $slider->save();
        return Redirect::to('administrator/advertisement');
    }

    public function delete_advertisement($id) {
        Advertisement::destroy($id);
        return Redirect::to('administrator/advertisement');
    }    

    // Website Settings

    public function getSettings() {
        return View::make('Administrator.settings');
    }

    // Message Box
    public function getMessage() {
        return View::make('Message.index');
    }

    public function postMessage() {
        $message = new Message;
        foreach (Account::All() as $account) {
            $message->message = Input::get('message');
            $message->subject = Input::get('subject');
            $message->sender = Sentry::getUser()->id;
            $message->receiver = $account->id;
            $message->status = 0;
            $message->save();
        }
        return View::make('Message.index')->withMessage('Success')->withStatus('success');
    }

    // Reseller Application Function

    public function getReseller() {
        $resellers = Reseller::All();
        return View::make('Administrator.reseller', compact('resellers'));
    }

    public function reseller_accept($id) {
        $reseller = Reseller::find($id);
        $user = Account::find($reseller->user_id);
        $user->type = 1;
        $user->save();
        Reseller::destroy($id);
        return Redirect::to('administrator/reseller')->withMessage('Success!')->withStatus('success');
    }

    public function reseller_cancel($id) {
        Reseller::destroy($id);
        return Redirect::to('administrator/reseller')->withMessage('Deleted!')->withStatus('danger');
    }

    public function getResellerProduct() {
        $products = Product::where('status', '=', 0)->get();
        return View::make('Administrator.reseller_product', compact('products'));
    }

    public function reseller_product_accept($id) {
        $product = Product::find($id);
        $product->status = 1;
        $product->save();
        return Redirect::to('administrator/reseller/product')->withMessage('Success!')->withStatus('success');
    }

    public function reseller_product_cancel($id) {
        Product::destroy($id);
        return Redirect::to('administrator/reseller/product')->withMessage('Deleted!')->withStatus('danger');
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

<?php

class PostsController extends \BaseController {

    /**
     * Display a listing of posts
     *
     * @return Response
     */
    public function index() {
        $posts = array(
            'published' => Post::onlyPublish(),
            'trashed' => Post::onlyTrashed()->get(),
            'drafted' => Post::onlyDraft(),
            'all' => Post::All(),
        );
        return View::make('Administrator.Post.index', $posts);
    }

    /**
     * Show the form for creating a new content
     *
     * @return Response
     */
    public function create() {
        return View::make('Administrator.Post.create');
    }

    /**
     * Store a newly created content in storage.
     *
     * @return Response
     */
    public function store() {
        $data = array(
            'title' => Input::get('title'),
            'author' => Sentry::getUser()->username,
            'content' => Input::get('content'),
            'status' => Input::get('status')
        );
        $validator = Validator::make($data, Post::$rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $content = Post::create($data);

        return Redirect::action('PostsController@edit', ['content' => $content->id])->with('content', Post::find($content->id));
    }

    public function view($id) {
        $content = Post::findOrFail($id);

        return View::make('Administrator.Post.show', compact('content'));
    }

    /**
     * Show the form for editing the specified content.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $content = Post::find($id);

        // if ($content->status == 'trash') {
        // 	return Redirect::action('PostsController@index')->with('message', Lang::get('message.trash-edit'));
        // } else {
        return View::make('Administrator.Post.edit', compact('content'));
        // }
    }

    /**
     * Update the specified content in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $content = Post::findOrFail($id);

        $validator = Validator::make($data = Input::all(), Post::$rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $post = Post::find($id);
        $content->update($data);

        if (Request::ajax()) {
            return Response::json('success', 200);
        } else {
            return Redirect::action('PostsController@edit', ['content' => $id])->withContent($post)->withMessage(Lang::get('message.post-update'))->withStatus('info');
        }
    }

    /**
     * Remove the specified content from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        Post::destroy($id);
        return Redirect::action('PostsController@index')->withMessage(Lang::get('message.post-trash'))->withStatus('info');
    }

    public function restore() {
        Post::where('id', '=', Input::get('id'))->restore(); 
       return Redirect::action('PostsController@index')->withMessage(Lang::get('message.post-restore'))->withStatus('info');
    }
    
    public function search() {
        $posts = array(
            'published' => Post::onlyPublish(),
            'trashed' => Post::onlyTrashed()->get(),
            'drafted' => Post::onlyDraft(),
            'all' => Post::search(Input::get('search')),
        );
        return View::make('Administrator.Post.index', $posts);
    }

    public function trash() {
        Post::onlyTrashed()->forceDelete();
        return Redirect::action('PostsController@index')->withMessage(Lang::get('message.trash-empty'))->withStatus('info');
    }
    
    public function preview($id) {
        $posts = Post::findOrFail($id);
        return View::make('User.single')->withPost($posts);
    }

    /* ===  Media Manager Functions === */
    public function load_images() {
        $dir = 'uploads/';
        $FILES = array();
        if(file_exists($dir)) {
            foreach (glob($dir . "{*.gif,*.jpeg,*.jpg,*.pjpeg,*.png}", GLOB_BRACE) as $files) {
                $FILES[] = URL::to('/') . '/' . $files;
            }
            return Response::json($FILES);   
        } else {
            return Response::json(array('error' => "Images folder does not exist!"));
        }        
    }

    public function delete_images() {
        $src = str_replace(URL::to('/') . "/", '', Input::get('src'));
        if (file_exists($src)) {
            unlink($src);
        }
    }

    public function upload_images() {
        $file = Input::file('file');
        $assetPath = '/uploads';
        $uploadPath = public_path($assetPath);
        $name = strtolower(str_replace(' ', '-', $file->getClientOriginalName()));
        // Save Images
        $file->move($uploadPath, $name);
        $response = $assetPath . '/' . $name;
        return Response::json(array('response' => $response));
    }

}

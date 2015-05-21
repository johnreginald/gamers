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
        $category = PostCategory::All();
        return View::make('Administrator.Post.create', compact('category'));
    }

    /**
     * Store a newly created content in storage.
     *
     * @return Response
     */
    public function store() {
        $data = array(
            'title' => strip_tags(Purifier::clean(Input::get('title'))),
            'content' => Purifier::clean(Input::get('content')),
            'author' => Sentry::getUser()->username,
        );
        $validator = Validator::make($data, Post::$rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $content = Post::create($data);
        // Category Update
        if (gettype(Input::get('category')) == 'NULL') {
            $content->categories()->detach();
        } else {
            $content->categories()->sync(Input::get('category'));
        }

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
        $data = array(
            'content' => Post::find($id),
            'category' => PostCategory::All(),
            );
        return View::make('Administrator.Post.edit', $data);
    }

    /**
     * Update the specified content in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $content = Post::findOrFail($id);
        $data = array(
            'title' => strip_tags(Purifier::clean(Input::get('title'))),
            'content' => Purifier::clean(Input::get('content')),
            'author' => Sentry::getUser()->username,
        );
        $validator = Validator::make($data, Post::$rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
    
        // Post Update
        $content->update($data);

        $post = Post::find($id);
        // Category Update
        if (gettype(Input::get('category')) == 'NULL') {
            $post->categories()->detach();
        } else {
            $post->categories()->sync(Input::get('category'));
        }

        return Redirect::action('PostsController@edit', ['content' => $id])->withContent($post)->withMessage(Lang::get('message.post-update'))->withStatus('info');
    }

    public function status_update($id) {
        $post = Post::find($id);
        $post->status = Input::get('status');
        $post->save();
        // Request Return
        if (Request::ajax()) {
            // Post Status Json Response
            return Response::json('success', 200);
        } else {
            return Redirect::back();
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
        $path = public_path('uploads');
        if (File::exists($path)) {
            $files = str_replace(public_path(), URL::to('/'), File::files($path));
            return Response::json($files);
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
        // SAVE Image
        $file = Input::file('file');
        $uploadPath = public_path('uploads');
        $name = strtolower(str_replace(' ', '-', $file->getClientOriginalName()));
        $file->move($uploadPath, $name);

        // Response File Name
        $link = URL::to('uploads') . '/' . $name;
        return Response::json(array('link' => $link ));
    }

}

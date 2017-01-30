<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Auth;

class CommentsController extends Controller
{

    public function __construct()
    {
      $this->middleware('comment-permission',['except' => ['store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $this->_validate($request);
        $data = $request->all();
        $data_to_update = [
          'user_id' => Auth::id(),
          'content' => $data['post_'.$data['post_id'].'_comment_content'],
          'post_id' => $data['post_id']
        ];
        Comment::create($data_to_update);
        return back();
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        $template_data = compact('comment');
        return view('comments.edit',$template_data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
          'comment_content' => 'required'
        ]);

        Comment::findOrFail($id)->update([
          'content' => $request->input('comment_content')
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Comment::findOrFail($id)->delete();
      return back();
    }

    private function _validate($request){
      $this->validate($request,[
        'post_'.$request->input('post_id').'_comment_content' => 'required'
      ]);
    }
}

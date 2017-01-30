<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Image;
use App\Comment;
use App\Post;
use Auth;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission',['except' => ['show']]);
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
        $user = User::findOrFail($id);
        $posts = Post::with('comments.user')->where('user_id',$id)->orderBy('created_at','desc')->paginate(20);
        $template_data = compact('user','posts');
        return view('users.show',$template_data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $template_data = compact('user');
        return view('users.edit',$template_data);
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
        $data = $request->all();

        $this->_validate($request);

        $avatar_file = $this->saveAvatar($request,$id);

        if($avatar_file){
          $data['avatar'] = $avatar_file->getClientOriginalName();
        }

        $user = User::findOrFail($id);
        $user->update($data);

        return back();
    }


    private function _validate(Request $request)
    {
      return $this->validate($request,[
        'firstName' => 'required',
        'lastName' => 'required',
        'avatar_file' => 'file|image'
      ]);
    }

    private function saveAvatar($request,$id)
    {
      if($request->hasFile('avatar_file')){
        $avatar_file = $request->file('avatar_file');
        $path = $avatar_file->storeAs($this->getUploadPath($id),$avatar_file->getClientOriginalName());
        //TODO:Zaprogramować obróbkę zdjęć
        return $avatar_file;
      }
      return false;
    }

    private function getUploadPath($id)
    {
      if(empty($id)){
        throw new Exception("id is required");
      }
      return 'public/users/'.$id.'/avatars';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

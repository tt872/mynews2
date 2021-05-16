<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\News;
use App\Profile;

class ProfileController extends Controller
{ 
  public function add()
  {
    return view('admin.profile.create');
  }
  //
  public function create(Request $request)
  {
    
    
    $this->validate($request, Profile::$rules);
    $news = new Profile;
    $form = $request->all();
    
    
     
      
      
      unset($form['_token']);
      // フォームから送信されてきたimageを削除する
      unset($form['image']);
      $news->fill($form);
      $news->save();
      
      
    return redirect('admin/profile/create');
  }
  
  public function edit(Request $request)
  
   {
      // News Modelからデータを取得する
      $profile = Profile::find($request->id);
      if (empty($profile)) {
        abort(404);    
      }
      return view('admin.profile.edit', ['profile_form' => $profile]);
  }

  public function update(Request $request)
  {
     $this->validate($request, Profile::$rules);
      // News Modelからデータを取得する
      $profile = Profile::find($request->id);
      // 送信されてきたフォームデータを格納する
      $form = $request->all();
      
    
      unset($form['remove']);
      unset($form['_token']);
      // 該当するデータを上書きして保存する
      $profile->fill($form)->save();
    return redirect()->back();
    
  }

  // 以下を追記
  public function index(Request $request)
  {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
          // 検索されたら検索結果を取得する
          $posts = News::where('title', $cond_title)->get();
      } else {
          // それ以外はすべてのニュースを取得する
          $posts = News::all();
      }
      return view('admin.profile.index', ['posts' => $posts, 'cond_title' => $cond_title]);
  }

}
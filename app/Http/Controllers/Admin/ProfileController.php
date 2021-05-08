<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\News;

class ProfileController extends Controller
{ 
  public function add()
  {
    return view('admin.profile.create');
  }
  //
  public function create(Request $request)
  {
    
    
    $this->validate($request, News::$rules);
    $news = new News;
    $form = $request->all();
    
    
      if (isset($form['image'])) {
        $path = $request->file('image')->store('public/image');
        $news->image_path = basename($path);
      } else {
          $news->image_path = null;
      }
      
      
      unset($form['_token']);
      // フォームから送信されてきたimageを削除する
      unset($form['image']);
      $news->fill($form);
      $news->save();
      
      
    return redirect('admin/profile/create');
  }
  
  public function edit(Request $request)
  {
    return view('admin.profile.edit');
  }

  public function update(Request $request)
  {
    return redirect('admin/profile/create');
    
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
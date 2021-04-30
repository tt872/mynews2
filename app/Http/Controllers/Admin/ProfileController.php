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

}
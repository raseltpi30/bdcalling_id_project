<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        $this->data['pages'] = Page::all();
        return view('admin.setting.page.index',$this->data);
        return $this->data;
    }
    public function create(){
        return view('admin.setting.page.create');
    }
    public function store(Request $request){
        $formData = $request->all();
        $formData['page_slug'] = Str::slug($request->page_name);
        Page::create($formData);
        $notification = array('message' => 'Pages Created Successfully!','alert-type' => 'success');
        return redirect()->route('page.index')->with($notification);
    }
    public function edit($page_id){
        $this->data['page'] = Page::findOrFail($page_id);
        return view('admin.setting.page.create',$this->data);
    }
    public function update(Request $request, $page_id){
        $data = $request->all();
        $page = Page::findOrFail($page_id);
        $page['page_position'] = $request->page_position;
        $page['page_name'] = $request->page_name;
        $page['page_slug'] = Str::slug($request->page_name);
        $page['page_title'] = $request->page_title;
        $page['page_description'] = $request->page_description;
        $page->save();
        $notification = array('message' => 'Pages Updated Successfully!','alert-type' => 'success');
        return redirect()->route('page.index')->with($notification);
    }
    public function destroy($page_id){
        $page = Page::findOrFail($page_id);
        $page->delete();
        $notification = array('message' => 'Pages Deleted Successfully!','alert-type' => 'success');
        return redirect()->route('page.index')->with($notification);
    }
}

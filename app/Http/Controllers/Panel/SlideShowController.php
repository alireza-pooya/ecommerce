<?php

namespace App\Http\Controllers\Panel;

use App\Classes\custom;
use App\SlideShow;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SlideShowController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $all = SlideShow::orderBy('id','desc');

        if($request->search){
            $all = $all->where('title','LIKE','%'.$request->search .'%')
                       ->orWhere('body','LIKE','%'.$request->search .'%');
        }

        $slideshows = $all->paginate(10)->appends($request->query());

        return view('panel.slideshow.index',compact('slideshows'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'       => 'required','unique:slideshows',
            'body'        => 'required',
            'link'        => 'required',
            'image'       => 'required | mimes:png,jpeg,jpg,bmp',
            'start_show'  => 'required',
            'end_show'    => 'required',
        ]);

        $file= null;
        if ($request['image']) {
            $file = Custom::uploader($request['image'], "upload/slideshow/{$request['title']}/");
        }

        SlideShow::create([
            'title' => $request['title'],
            'body' => $request['body'],
            'link' => $request['link'],
            'start_show' => $request['start_show'],
            'end_show' => $request['end_show'],
            'image' => $file,
        ]);

        $message = "your slide show created successfully";
        return redirect()->back()->with('message',$message);
    }

    /**
     * @param SlideShow $slideshow
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Slideshow $slideshow)
    {
        return view('panel.slideshow.edit',compact('slideshow'));
    }

    /**
     * @param Request $request
     * @param SlideShow $slideShow
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, SlideShow $slideshow)
    {
        $this->validate($request,[
            'title'       => 'required','unique:slideshows',
            'body'        => 'required',
            'link'        => 'required',
            'image'       => 'mimes:png,jpeg,jpg,bmp',
            'start_show'  => 'required',
            'end_show'    => 'required',
        ]);

        $image= $slideshow->image;
        if($request['image']){
                $image = Custom::uploader($request['image'], "upload/slideshow/{$request['image']}/");
        }
        $slideshow->update([
            'title'         => $request['title'],
            'body'          => $request['body'],
            'link'          => $request['link'],
            'start_show'    => $request['start_show'],
            'end_show'      => $request['end_show'],
            'image'         => $image,
        ]);

        $message = "your slide show updated successfully";
        return redirect(route('slideshow.index'))->with('message',$message);
    }

    /**
     * @param Request $request
     * @param SlideShow $slideShow
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, SlideShow $slideShow)
    {
        if($request->selected){
            SlideShow::destroy($request->selected);
            $message = "your slide show deleted successfully";
            return redirect()->back()->with('message',$message);
        }
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $sliders = Slider::orderBy('created_at', 'DESC')->get();

        return view('slider.index')->with('sliders', $sliders);
    }

    public function slidersTrashed()
    {
        if (Auth::user()->is_admin == 1) {
            $sliders = Slider::onlyTrashed()->get();
        }
        return view('slider.trashed')->with('sliders', $sliders);
    }
    public function create()
    {
        return view('slider.create');
    }

    public function slug($string, $separator = '-')
    {
        if (is_null($string)) {
            return "";
        }

        $string = trim($string);

        $string = mb_strtolower($string, "UTF-8");;

        $string = preg_replace("/[^a-z0-9_\sءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]#u/", "", $string);

        $string = preg_replace("/[\s-]+/", " ", $string);

        $string = preg_replace("/[\s_]/", $separator, $string);

        return $string;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' =>  'required',
            'sub_title' =>  'required',
            'content' =>  'required',
            'background' =>  'required',
            'more_btn' =>  'required',
            'more_link' =>  'required',
        ]);

        $photo = $request->photo;
        if ($request->hasFile('photo')) {

            $newPhoto = $photo->getClientOriginalName();
            $photo->move('uploads/sliders/photos', $newPhoto);
            $photo = 'uploads/sliders/photos/' . $newPhoto;
        }
        $background = $request->background;
        $newBackground = $background->getClientOriginalName();
        $background->move('uploads/sliders/backgrounds', $newBackground);

        $slider = Slider::create([
            'title' =>  $request->title,
            'sub_title' =>  $request->sub_title,
            'content' =>   $request->content,
            'photo' =>  $photo,
            'background' =>  'uploads/sliders/backgrounds/' . $newBackground,
            'slug' => $this->slug($request->title),
            'more_btn' =>  $request->more_btn,
            'more_link' =>  $request->more_link,
        ]);

        // dd($blog);
        return redirect()->back();
    }

    public function edit($slug)
    {
        if (Auth::user()->is_admin == 1) {
            $slider = Slider::where('slug', $slug)->first();
        }
        if ($slider === null) {
            return redirect()->back();
        }
        return view('slider.edit')->with('slider', $slider);
    }

    public function update(Request $request,  $slug)
    {
        if (Auth::user()->is_admin == 1) {
            $slider = Slider::where('slug', $slug)->first();
        }
        if ($slider === null) {
            return redirect()->back();
        }


        $this->validate($request, [
            'title' =>  'required',
            'sub_title' =>  'required',
            'content' =>  'required',
            'more_btn' =>  'required',
            'more_link' =>  'required',
        ]);

        //   dd($request->all());

        if ($request->has('photo')) {

            $photo = $request->photo;
            $newPhoto = $photo->getClientOriginalName();
            $photo->move('uploads/sliders/photos', $newPhoto);
            $slider->photo = 'uploads/sliders/photos/' . $newPhoto;
        }

        if ($request->has('background')) {

            $background = $request->background;
            $newBackground = $background->getClientOriginalName();
            $background->move('uploads/sliders/backgrounds', $newBackground);
            $slider->background = 'uploads/sliders/backgrounds/' . $newBackground;
        }

        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->slug = $this->slug($request->title);
        $slider->content = $request->content;
        $slider->more_btn = $request->more_btn;
        $slider->more_link = $request->more_link;
        $slider->save();
        return redirect()->back();
    }

    public function destroy($id)
    {
        if (Auth::user()->is_admin == 1) {
            $slider = Slider::find($id);
        }
        if ($slider === null) {
            return redirect()->back();
        }

        $slider->delete($id);
        return redirect()->back();
    }


    public function hdelete($id)
    {
        if (Auth::user()->is_admin == 1) {
            $slider = Slider::withTrashed()->where('id',  $id)->first();
        }
        if ($slider === null) {
            return redirect()->back();
        }
        $slider->forceDelete();
        return redirect()->back();
    }

    public function restore($id)
    {
        if (Auth::user()->is_admin == 1) {
            $slider = Slider::withTrashed()->where('id',  $id)->first();
        }
        if ($slider === null) {
            return redirect()->back();
        }
        $slider->restore();
        return redirect()->back();
    }
}

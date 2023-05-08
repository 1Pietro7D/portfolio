<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Helper\Utils;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // is for now one element
        // get first and only section of myPortfolio
        $section = Utils::getByPortfolio(Section::class)->first();
        // return section.index view vith first and only section
        return view('admin.sections.index', compact('section'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //DISABLE
    {
            //return only index for now ---> TODO : add future correct manegment
            // return view('admin.sections.index'); //DISABLE
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation
        $this->validateSection($request);
        // get request-form
        $form_data = $request->all();
        // create New Section
        $section = New Section();
        // set FK portfolio
        $section->portfolio_id = Utils::getMyPortfolio()->id;
        // generate slug
        $slug = Utils::generateSlug(Section::class , $form_data['title']);
        $section->slug = $slug;
        // store img_section
        if(isset($form_data['img_path']))
            $form_data['img_path']=Utils::itemStorage($section->img_path, $form_data, 'img_path', 'section_img');
        // fill form_data in section
        $section->fill($form_data);
        // save to db
        $section->save();
        // return redirect()
        return redirect()->route('admin.sections.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show($slug) // for now is equal to index() except for slug
    {
        // find skill By Slug
        // $section = Utils::getBySlug(Section::class, $slug);
        // return view section.show with sectionBySlug
        // return view('admin.sections.show', compact('section')); //DISABLE
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit($slug) //DISABLE
    {
        // get section with this slug
        // $section = Utils::getBySlug(Section::class, $slug);
        // return view with form for edit section
        // return view('admin.sections.edit', compact('section')); //DISABLE
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        // validation
        $this->validateSection($request);
        // get section with this slug
        $section = Utils::getBySlug(Section::class, $slug);
        // get request-form
        $form_data = $request->all();
        // store img_section
        if(isset($form_data['img_path']))
            $form_data['img_path']=Utils::itemStorage($section->img_path, $form_data, 'img_path', 'section_img');
        // generate slug
        $slug = Utils::generateSlug(Section::class , $section->title);
        $section->slug = $slug;
        // update to db
        $section->update($form_data);
        // return redirect()
        return redirect()->route('admin.sections.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  slug of section
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        // get section with this slug
        $section = Utils::getBySlug(Section::class, $slug);
        // delete section in db
        $section->delete();
        // delete img_path
        Utils::deleteItemStorage($section->img_path);
        // redirect to index
        return redirect()->route('admin.sections.index');
    }
    // Validation
    private function validateSection(Request $request)
    {
        $request->validate([]);
    }
}

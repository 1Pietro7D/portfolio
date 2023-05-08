<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Icon;
use Illuminate\Http\Request;
use App\Helper\Utils;

class IconController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all icon
        $icons = Icon::all();
        // return icon.index with all icon
        return view('admin.icons.index', compact('icons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() // DISABLE
    {
        // return only view for form-create
        // return view('admin.icons.create'); // DISABLE
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
        $this->validateIcon($request);
        //set request-form
        $form_data = $request->all();
        // create New Icon
        $icon = New Icon();
        // fill form_data in icon
        $icon->fill($form_data);
        // generate slug
        $slug = Utils::generateSlug(Icon::class , $icon->name);
        $icon->slug = $slug;
        // save to db
        $icon->save();
        // return redirect()
        return redirect()->route('admin.icons.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Icon  $Icon
     * @return \Illuminate\Http\Response
     */
    public function show($slug) // DISABLE
    {
        // find icon By Slug
        // $icon = Utils::getBySlug(Icon::class, $slug);
        // return view icon.show with iconBySlug
        // return view('admin.icons.show', compact('icon')); // DISABLE
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Icon  $Icon
     * @return \Illuminate\Http\Response
     */
    public function edit($slug) // DISABLE
    {
        // get icon with this slug
        // $icon = Utils::getBySlug(Icon::class, $slug);
        // return view with form for edit icon and all skills for check-box
        // return view('admin.icons.edit', compact('icon'));  // DISABLE
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Icon  $Icon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        // validation
        $this->validateIcon($request);
        // get icon with this slug
        $icon = Utils::getBySlug(Icon::class, $slug);
        //set request-form
        $form_data = $request->all();
        // generate slug
        $slug = Utils::generateSlug(Icon::class , $icon->name);
        $icon->slug = $slug;
        // update to db
        $icon->update($form_data);
        // return redirect()
        return redirect()->route('admin.icons.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Icon  $Icon
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        // get icon with this slug
        $icon = Utils::getBySlug(Icon::class, $slug);
        // delete icon in db
        $icon->delete();
        // redirect to index
        return redirect()->route('admin.icons.index');
    }

    // Validation
    private function validateIcon(Request $request)
    {
        $request->validate([]);
    }
}

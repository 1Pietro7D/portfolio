<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;
use App\Helper\Utils;
class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all skills of myPortfolio
        $skills = Utils::getByPortfolio(Skill::class);
        // return skill.index view vith all skills of myPortfolio
        return view('admin.skills.index', compact('skills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() // DISABLE
    {
        // return only view for form-create
        // return view('admin.skills.create'); DISABLE
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
        $this->validateSkill($request);
        // get request-form
        $form_data = $request->all();
        // create New Skill
        $skill = New Skill();
        // set FK portfolio
        $skill->portfolio_id = Utils::getMyPortfolio()->id;
        // generate slug
        $slug = Utils::generateSlug(Skill::class , $form_data['name']);
        $skill->slug = $slug;
        // fill form_data in skill
        $skill->fill($form_data);
        // save to db
        $skill->save();
        // return redirect()
        return redirect()->route('admin.skills.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function show($slug) // DISABLE
    {
        // find skill By Slug
        // $skill = Utils::getBySlug(Skill::class, $slug);
        // return view skill.show with skillBySlug
        // return view('admin.skills.show', compact('skill')); DISABLE
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function edit($slug) // DISABLE
    {
         // get skill with this slug
         // $skill = Utils::getBySlug(Skill::class, $slug);
         // return view with form for edit skill
         // return view('admin.project.edit', compact('skill')); DISABLE
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        // validation
        $this->validateSkill($request);
        // get skill with this slug
        $skill = Utils::getBySlug(Skill::class, $slug);
        // get request-form
        $form_data = $request->all();
        // generate slug
        $slug = Utils::generateSlug(Skill::class , $form_data['name']);
        $skill->slug = $slug;
        // update to db
        $skill->update($form_data);
        // return redirect()
        return redirect()->route('admin.skills.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        // get skill with this slug
        $skill = Utils::getBySlug(Skill::class, $slug);
        // delete all referer of skill in tablePivot project_skill
        $skill->projects()->sync([]);
        // delete skill in db
        $skill->delete();
        // redirect to index of skills
        return redirect()->route('admin.skills.index');
    }

    // Validation
    private function validateSkill(Request $request)
    {
        $request->validate([]);
    }
}

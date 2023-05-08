<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;
use App\Helper\Utils;
class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all projects by myPortfolio
        $projects = Utils::getByPortfolio(Project::class);
        // return project.index view vith all projects with out methods
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // get all skills of myPortfolio
        $skills = Utils::getByPortfolio(Skill::class);
        // return view for form-create with all skills
        return view('admin.projects.create', compact('skills'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //// validation
        $this->validateProject($request);
        // get request-form
        $form_data = $request->all();
        // create New Project
        $project = New Project();
        // set FK portfolio
        $project->portfolio_id = Utils::getMyPortfolio()->id;
        // generate slug
        $slug = Utils::generateSlug(Project::class , $form_data['title']);
        $project->slug = $slug;
        // store_img
        if(isset($form_data['img_path']))
            $form_data['img_path'] = Utils::itemStorage($project->img_path, $form_data, 'img_path', 'project_img');
        // store_video
        if(isset($form_data['video_path']))
            $form_data['video_path'] = Utils::itemStorage($project->video_path, $form_data, 'video_path', 'project_video');
        // fill form_data in project
        $project->fill($form_data);
        // save to db
        $project->save();
        // syncronize after the project exist in db with skills
        Utils::syncronize($project, 'skills', $form_data);
        // return redirect to project show by slug
        return redirect()->route('admin.projects.show', $slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  slug of $project
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        // find project By Slug
        $project = Utils::getBySlug(Project::class, $slug);
        // return view project.show with projectBySlug
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  slug of $project
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        // get project with this slug
        $project = Utils::getBySlug(Project::class, $slug);
        // get all skills of myPortfolio
        $skills = Utils::getByPortfolio(Skill::class);
        // return view with form for edit project and all skills for check-box
        return view('admin.projects.edit', compact(['project','skills']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  slug of $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        // validation
        $this->validateProject($request);
        // get project with this slug
        $project = Utils::getBySlug(Project::class, $slug);
        // get request-form
        $form_data = $request->all();
        // store_img
        if(isset($form_data['img_path']))
            $form_data['img_path'] = Utils::itemStorage($project->img_path, $form_data, 'img_path', 'project_img');
        // store_video
        if(isset($form_data['video_path']))
            $form_data['video_path'] = Utils::itemStorage($project->video_path, $form_data, 'video_path', 'project_video');
        // generate slug
        $slug = Utils::generateSlug(Project::class , $form_data['title']);
        $project->slug = $slug;
        // syncronize the already existing project in db with skills
        Utils::syncronize($project, 'skills', $form_data);
        // update to db
        $project->update($form_data);
        // return redirect()
        return redirect()->route('admin.projects.show', $slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  slug of $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        // get project with this slug
        $project = Utils::getBySlug(Project::class, $slug);
        // delete all referer of project in tablePivot project_skill
        $project->skills()->sync([]);
        // delete project in db
        $project->delete();
        // delete img_path
        Utils::deleteItemStorage($project->img_path);
        // delete video_path
        Utils::deleteItemStorage($project->video_path);
        // redirect to index of projects
        return redirect()->route('admin.projects.index');
    }

    // Validation
    private function validateProject(Request $request)
    {
        $request->validate([]);
    }
}

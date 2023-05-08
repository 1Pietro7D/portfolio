<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use App\Helper\Utils;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get only Portfolio for user
        $portfolio = Utils::getMyPortfolio();
        // return view index with compact         -- use [] for remember
        return view('admin.portfolios.index', compact(['portfolio']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return only view for form-create
        return view('admin.portfolios.create');
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
        $this->validatePortfolio($request);
        //set request-form
        $form_data = $request->all();
        // create New Porfolio
        $portfolio = New Portfolio();
        // store Cv
        if(isset($form_data['curriculum_vitae_pdf']))
            $form_data['curriculum_vitae_pdf'] = Utils::
                itemStorage( // my function of Utils
                $portfolio->curriculum_vitae_pdf, // item
                $form_data, // form content
                'curriculum_vitae_pdf', // attribute name
                'CV_pdf' // folder path destination
            );
        // fill form_data in portfolio
        $portfolio->fill($form_data);
        // set FK user
        $portfolio->user_id = Utils::getUser()->id;
        // save to db
        $portfolio->save();
        // return redirect()
        return redirect()->route('admin.portfolios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function show(Portfolio $portfolio)
    {
        // SHOW DISABLE -- for now index return the only portfolio
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  id of Porfolio
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // get only Portfolio for user
        $portfolio = Portfolio::where('id', $id)->first();
        // return view edit with compact
        return view('admin.portfolios.edit', compact('portfolio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  id of Porfolio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validation
        $this->validatePortfolio($request);
        // get only Portfolio for user
        $portfolio = Portfolio::where('id', $id)->first();
        //set request-form
        $form_data = $request->all();
        // store Cv
        if(isset($form_data['curriculum_vitae_pdf'])){
            $form_data['curriculum_vitae_pdf'] = Utils::
                itemStorage( // my function of Utils
                $portfolio->curriculum_vitae_pdf, // item
                $form_data, // form content
                'curriculum_vitae_pdf', // attribute name
                'CV_pdf' // folder path destination
            );}
        // update to db
        $portfolio->update($form_data);
        // return redirect()
        return redirect()->route('admin.portfolios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param id of Porfolio
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get my Portfolio By ID
        $portfolio = Portfolio::where('id', $id)->first();
        // delete Cv
        Utils::deleteItemStorage($portfolio->curriculum_vitae_pdf);
        // onDelete cascade for projects, sections, contacts and skills
        // ... but MUST managment project_skill sync !
        $projects = $portfolio->projects()->get();
        foreach ($projects as $project) {
            $project->skills()->sync([]);
        }
        $portfolio->delete();
        // return redirect()
        return redirect()->route('admin.portfolios.index');
    }

    // Validation
    private function validatePortfolio(Request $request){
        $request->validate([
            'name' => [
                'required',
                'min:2',
                'max:255'
            ],
        ], [
            'name.required' => 'Devi inserire un nome',
        ]);
    }

}

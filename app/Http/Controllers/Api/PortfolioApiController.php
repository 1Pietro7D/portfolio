<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Utils;
use Error;

class PortfolioApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        try{
            $portfolio = Utils::getMyPortfolio();
            $portfolio->skills;
            $portfolio->projects;
            $portfolio->contacts;
            $portfolio->section;

            $data = [
                'results' => $portfolio,
                'success' => true
            ];
        }catch(Error $e){
            $data = [
                'error' => $e->getMessage(),
                'success' => false
            ];
    }
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        // find project By Slug
        $project = Utils::getBySlug(Project::class, $slug);

        $data=[
            'result' => $project,
            'success' => isset($project)
        ];
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

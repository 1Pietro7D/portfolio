<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Helper\Utils;
use App\Models\Icon;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all contacts by myPortfolio
        $contacts = Utils::getByPortfolio(Contact::class);
        // return contact.index view vith all contacts
        return view('admin.contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // get all icons
        $icons = Icon::all();
        // return view for form-create with all icon
        return view('admin.contacts.create', compact('icons'));
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
        $this->validateContact($request);
        //set request-form
        $form_data = $request->all();
        // create New Contact
        $contact = New Contact();
        // set FK portfolio
        $contact->portfolio_id = Utils::getMyPortfolio()->id;
        // generate slug
        $slug = Utils::generateSlug(Contact::class , $form_data['name']);
        $contact->slug = $slug;
        // fill form_data in contact
        $contact->fill($form_data);
        // save to db
        $contact->save();
        // return redirect show by slug
        return redirect()->route('admin.contacts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show($slug)  // DISABLE
    {
        // find contact By Slug
        // $contact = Utils::getBySlug(Contact::class, $slug);
        // return view contact.show with contactBySlug
        // return view('admin.contacts.show', compact('contact')); // DISABLE
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        // get contact with this slug
        $contact = Utils::getBySlug(Contact::class, $slug);
        // get all icons
        $icons = Icon::all();
        // return view with form for edit contact and all icons for check-box
        return view('admin.contacts.edit', compact(['contact','icons']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        // validation
        $this->validateContact($request);
        // get contact with this slug
        $contact = Utils::getBySlug(Contact::class, $slug);
        //set request-form
        $form_data = $request->all();
        // generate slug
        $slug = Utils::generateSlug(Contact::class , $form_data['name']);
        $contact->slug = $slug;
        // update to db
        $contact->update($form_data);
        // return redirect show by slug
        return redirect()->route('admin.contacts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        // get contact with this slug
        $contact = Utils::getBySlug(Contact::class, $slug);
        // delete contact in db
        $contact->delete();
        // return redirect index
        return redirect()->route('admin.contacts.index');
    }

    // Validation
    private function validateContact(Request $request)
    {
        $request->validate([]);
    }
}

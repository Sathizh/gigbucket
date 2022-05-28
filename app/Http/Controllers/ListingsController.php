<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(request('tag'));
        return view('listings.index', [
            'listings'=> Listing::latest()->filter(request(['tag','search']))->paginate(4),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('listings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->file('logo')->store('logos'));
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'company' => ['required', Rule::unique('listings', 'company')],
            'description' => 'required|max:255',
            'email' => 'required|email|max:255',
            'website' => 'required|url|max:255',
            'location' => 'required|max:255',
            'tags' => 'required|max:255',
        ]);
        if($request->hasFile('logo')){
            $validatedData['logo'] = $request->file('logo')->store('logos', 'public');
        }
        $validatedData['user_id'] = auth()->id();
        Listing::create($validatedData);
        return redirect('/')->with('success', 'Listing created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Listing $listing)
    {
        return view ('listings.show', ['listing' => $listing]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('listings.edit', ['listing' => Listing::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Listing $listing)
    {

        // make sure the user is the owner of the listing
        if(auth()->id() !== $listing->user_id){
            return redirect('/')->with('success', 'Unauthorized access!');
        }
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'company' => ['required'],
            'description' => 'required|max:255',
            'email' => 'required|email|max:255',
            'website' => 'required|url|max:255',
            'location' => 'required|max:255',
            'tags' => 'required|max:255',
        ]);
        if($request->hasFile('logo')){
            $validatedData['logo'] = $request->file('logo')->store('logos', 'public');
        }
        $listing->update($validatedData);
        return back()->with('success', 'Listing updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Listing::findOrFail($id)->delete();
        return redirect('/')->with('success', 'Listing deleted successfully!');
    }

    public function manage(Request $request)
    {
        return view('listings.manage', [
            'listings'=> auth()->user()->listings()->get(),
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Auth;
use App\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $visitors = Visitor::orderBy('created_at', 'desc')->where('user_id', Auth::id())->paginate(5);
        return view('visitors.index')->with('visitors', $visitors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('visitors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50|string', 
            'email' => 'required|email|unique:visitors,email'
        ]);

        Visitor::create([
            'name' => $request->name,
            'email' => $request->email,
            'details' => $request->details,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('visitor.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $visitor = Visitor::find($id);
        return view('visitors.show')->with('visitor', $visitor);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $visitor = Visitor::find($id)->where('user_id', Auth::id())->first();
        return view('visitors.edit')->with('visitor', $visitor);
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
        $visitor = Visitor::find($id);
        $user_id = Auth::id();

        $this->validate($request, [
            'name' => 'required|max:50|string', 
            'email' => 'required|email|unique:visitors,email,'.$id,
        ]);

        $visitor->name = $request->name;
        $visitor->email = $request->email;
        $visitor->details = $request->details;
        $visitor->save();

        return redirect()->route('visitor.show', ['id' => $visitor->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $visitor = Visitor::find($id);
        $visitor->delete();

        return redirect()->route('visitor.index');
    }
}

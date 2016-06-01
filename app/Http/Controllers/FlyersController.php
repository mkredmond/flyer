<?php

namespace App\Http\Controllers;

use App\Flyer;
use App\Photo;
use App\Http\Requests\FlyerRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FlyersController extends Controller
{
    function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);

        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('flyers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FlyerRequest $request)
    {
        if (Flyer::create($request->all())) {
            flash()->success('Success!', 'Your flyer was created.');
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($zip, $street)
    {
        $flyer = Flyer::locatedAt($zip, $street);

        return view('flyers.show', compact('flyer'));
    }

    /**
     * [addPhoto description]
     * @param [type]  $zip     [description]
     * @param [type]  $street  [description]
     * @param Request $request [description]
     */
    public function addPhoto($zip, $street, Request $request)
    {
        $this->validate($request, [
            'photo' => 'required:mimes:jpg,jpeg,png,bmp'
        ]);

        $flyer = Flyer::locatedAt($zip, $street);

        if(! $flyer->ownedBy($this->user)){
           return $this->unauthorized($request);
        }

        $photo = $this->makePhoto($request->file('photo'));
        $flyer->addPhoto($photo);
    }

    /**
     * [unauthorized description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    protected function unauthorized(Request $request)
    {
        if($request->ajax()){
            return response(['message' => 'No Way.'], 403);
        }

        flash()->error('Denied', 'No way!');

        return redirect('/');
    }

    public function makePhoto(UploadedFile $file)
    {
        return Photo::named($file->getClientOriginalName())
                ->move($file);
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

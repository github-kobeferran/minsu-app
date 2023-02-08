<?php

namespace App\Http\Controllers;

use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\StoreSocialMediaRequest;

use function GuzzleHttp\Promise\all;

class SocialMediaController extends Controller
{

    public function index()
    {
        abort_if(!auth()->user()->can('store socialmedia'), Response::HTTP_FORBIDDEN, 'Unauthorized');
        return view('socialmedia.index');
    }

    public function show(SocialMedia $socialmedia)
    {
        
        abort_if(!auth()->user()->can('store socialmedia'), Response::HTTP_FORBIDDEN, 'Unauthorized');
        return view('socialmedia.index',['socialmedia' => $socialmedia,]);
    }

    public function store(StoreSocialMediaRequest $request)
    {
        abort_if(!auth()->user()->can('store socialmedia'), Response::HTTP_FORBIDDEN, 'Unauthorized');
        $socialmedia = SocialMedia::create($request->validated());

        if ($request->has('photo')) {
            $socialmedia->addMediaFromRequest('photo')->toMediaCollection('photo');
        }

        $socialmedia = SocialMedia::paginate(10);

        session()->flash('success', 'Posted');

        return redirect()->route('socialmedia.index')->with([
            'socialmedia' => $socialmedia,
        ]);
    }
}

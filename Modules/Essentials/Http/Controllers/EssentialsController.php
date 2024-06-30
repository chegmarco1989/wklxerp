<?php

namespace Modules\Essentials\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

class EssentialsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('essentials::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('essentials::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): Response
    {
    }

    /**
     * Show the specified resource.
     */
    public function show(): View
    {
        return view('essentials::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(): View
    {
        return view('essentials::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request): Response
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(): Response
    {
    }
}

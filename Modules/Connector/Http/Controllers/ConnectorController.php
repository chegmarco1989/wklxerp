<?php

namespace Modules\Connector\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class ConnectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('connector::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('connector::create');
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
        return view('connector::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(): View
    {
        return view('connector::edit');
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

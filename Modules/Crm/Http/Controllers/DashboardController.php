<?php

namespace Modules\Crm\Http\Controllers;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Utils\ContactUtil;
use App\Utils\ModuleUtil;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $contactUtil;

    protected $moduleUtil;

    /**
     * Constructor
     *
     * @param  Util  $commonUtil
     * @return void
     */
    public function __construct(ContactUtil $contactUtil, ModuleUtil $moduleUtil)
    {
        $this->contactUtil = $contactUtil;
        $this->moduleUtil = $moduleUtil;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $business_id = request()->session()->get('user.business_id');
        if (! (auth()->user()->can('superadmin') || $this->moduleUtil->hasThePermissionInSubscription($business_id, 'crm_module'))) {
            abort(403, 'Unauthorized action.');
        }

        $crm_contact_id = auth()->user()->crm_contact_id;

        $contact = $this->contactUtil->getContactInfo($business_id, $crm_contact_id);

        return view('crm::dashboard.index')
            ->with(compact('contact'));
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        //
    }
}

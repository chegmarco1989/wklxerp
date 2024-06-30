<?php

namespace Modules\Accounting\Http\Controllers;

use App\Business;
use App\BusinessLocation;
use App\ExpenseCategory;
use App\Utils\ModuleUtil;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Modules\Accounting\Entities\AccountingAccount;
use Modules\Accounting\Entities\AccountingAccountsTransaction;
use Modules\Accounting\Entities\AccountingAccountType;
use Modules\Accounting\Entities\AccountingAccTransMapping;
use Modules\Accounting\Entities\AccountingBudget;
use Modules\Accounting\Utils\AccountingUtil;

class SettingsController extends Controller
{
    protected $accountingUtil;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct(AccountingUtil $accountingUtil, ModuleUtil $moduleUtil)
    {
        $this->moduleUtil = $moduleUtil;
        $this->accountingUtil = $accountingUtil;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $business_id = request()->session()->get('user.business_id');

        if (! (auth()->user()->can('superadmin') ||
            $this->moduleUtil->hasThePermissionInSubscription($business_id, 'accounting_module'))) {
            abort(403, 'Unauthorized action.');
        }

        $account_sub_types = AccountingAccountType::where('account_type', 'sub_type')
            ->where(function ($q) use ($business_id) {
                $q->whereNull('business_id')
                    ->orWhere('business_id', $business_id);
            })
            ->get();

        $account_types = AccountingAccountType::accounting_primary_type();

        $accounting_settings = $this->accountingUtil->getAccountingSettings($business_id);

        $business_locations = BusinessLocation::where('business_id', $business_id)->get();

        $expence_categories = ExpenseCategory::where('business_id', $business_id)->get();

        return view('accounting::settings.index')->with(compact('account_sub_types', 'account_types', 'accounting_settings', 'business_locations', 'expence_categories'));
    }

    public function resetData()
    {
        $business_id = request()->session()->get('user.business_id');

        if (! (auth()->user()->can('superadmin') ||
            $this->moduleUtil->hasThePermissionInSubscription($business_id, 'accounting_module'))) {
            abort(403, 'Unauthorized action.');
        }

        //check for admin
        if (! $this->accountingUtil->is_admin(auth()->user())) {
            abort(403, 'Unauthorized action.');
        }

        //reset logic
        AccountingBudget::join('accounting_accounts', 'accounting_budgets.accounting_account_id', '=', 'accounting_accounts.id')
            ->where('accounting_accounts.business_id', $business_id)
            ->delete();

        AccountingAccountType::where('business_id', $business_id)
            ->delete();

        AccountingAccTransMapping::where('business_id', $business_id)->delete();

        AccountingAccountsTransaction::join('accounting_accounts', 'accounting_accounts_transactions.accounting_account_id', '=', 'accounting_accounts.id')
            ->where('business_id', $business_id)->delete();

        AccountingAccount::where('business_id', $business_id)->delete();

        return back();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('accounting::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function saveSettings(Request $request): RedirectResponse
    {
        $business_id = request()->session()->get('user.business_id');

        if (! (auth()->user()->can('superadmin') || ($this->moduleUtil->hasThePermissionInSubscription($business_id,
            'accounting_module')))) {
            abort(403, 'Unauthorized action.');
        }

        try {
            $accounting_settings = $request->only(['journal_entry_prefix', 'transfer_prefix', 'accounting_default_map']);

            Business::where('id', $business_id)
                ->update(['accounting_settings' => json_encode($accounting_settings)]);

            //Update accounting_default_map for each locations
            $accounting_default_map = $request->get('accounting_default_map');
            foreach ($accounting_default_map as $location_id => $details) {
                BusinessLocation::where('id', $location_id)
                    ->update(['accounting_default_map' => json_encode($details)]);
            }

            $output = ['success' => true,
                'msg' => __('lang_v1.updated_success'),
            ];
        } catch (\Exception $e) {
            \Log::emergency('File:'.$e->getFile().'Line:'.$e->getLine().'Message:'.$e->getMessage());

            $output = ['success' => false,
                'msg' => __('messages.something_went_wrong'),
            ];
        }

        return redirect()->back()->with(['status' => $output]);
    }

    /**
     * Show the specified resource.
     */
    public function show(int $id): View
    {
        return view('accounting::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): View
    {
        return view('accounting::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id): Response
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): Response
    {
        //
    }
}

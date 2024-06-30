<?php

namespace Modules\Superadmin\Http\Controllers;

use App\Utils\ModuleUtil;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Modules\Superadmin\Entities\SuperadminFrontendPage;

class PageController extends Controller
{
    /**
     * All Utils instance.
     */
    protected $moduleUtil;

    /**
     * Constructor
     *
     * @param  ProductUtils  $product
     * @return void
     */
    public function __construct(ModuleUtil $moduleUtil)
    {
        $this->moduleUtil = $moduleUtil;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        if (! auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }

        $pages = SuperadminFrontendPage::orderBy('menu_order', 'asc')->get();

        return view('superadmin::pages.index')
            ->with(compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('superadmin::pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        if (! auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }

        try {
            $input = $request->only(['title', 'slug', 'content', 'menu_order']);

            $input['slug'] = Str::slug($input['slug']);
            $input['is_shown'] = empty($request->input('is_shown')) ? 0 : 1;
            $input['menu_order'] = empty($input['menu_order']) ? 0 : $input['menu_order'];

            $is_slug_exists = SuperadminFrontendPage::where('slug', $input['slug'])->exists();
            if (! $is_slug_exists) {
                SuperadminFrontendPage::create($input);
                $output = ['success' => 1, 'msg' => __('lang_v1.success')];
            } else {
                $output = ['success' => 0, 'msg' => __('superadmin::lang.slug_already_exists')];
            }
        } catch (\Exception $e) {
            \Log::emergency('File:'.$e->getFile().'Line:'.$e->getLine().'Message:'.$e->getMessage());

            $output = ['success' => 0,
                'msg' => __('messages.something_went_wrong'),
            ];
        }

        return redirect()
            ->action([\Modules\Superadmin\Http\Controllers\PageController::class, 'index'])
            ->with('status', $output);
    }

    /**
     * Show the specified resource.
     */
    public function showPage($slug): View
    {
        $page = SuperadminFrontendPage::where('slug', $slug)->first();

        if (! empty($page)) {
            return view('superadmin::pages.show')->with(compact('page'));
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $page = SuperadminFrontendPage::findOrFail($id);

        return view('superadmin::pages.edit')->with(compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        if (! auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }

        try {
            $input = $request->only(['title', 'slug', 'content', 'menu_order']);

            $input['slug'] = Str::slug($input['slug']);
            $input['is_shown'] = empty($request->input('is_shown')) ? 0 : 1;

            $input['menu_order'] = empty($input['menu_order']) ? 0 : $input['menu_order'];
            $is_slug_exists = SuperadminFrontendPage::where('id', '!=', $id)
                ->where('slug', $input['slug'])
                ->exists();

            if (! $is_slug_exists) {
                SuperadminFrontendPage::where('id', $id)->update($input);
                $output = ['success' => 1, 'msg' => __('lang_v1.success')];
            } else {
                $output = ['success' => 0, 'msg' => __('superadmin::lang.slug_already_exists')];
            }
        } catch (\Exception $e) {
            \Log::emergency('File:'.$e->getFile().'Line:'.$e->getLine().'Message:'.$e->getMessage());

            $output = ['success' => 0,
                'msg' => __('messages.something_went_wrong'),
            ];
        }

        return redirect()
            ->action([\Modules\Superadmin\Http\Controllers\PageController::class, 'index'])
            ->with('status', $output);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): Response
    {
        if (! auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }

        try {
            SuperadminFrontendPage::where('id', $id)
                ->delete();

            $output = ['success' => 1, 'msg' => __('lang_v1.success')];
        } catch (\Exception $e) {
            \Log::emergency('File:'.$e->getFile().'Line:'.$e->getLine().'Message:'.$e->getMessage());

            $output = ['success' => 0,
                'msg' => __('messages.something_went_wrong'),
            ];
        }

        return $output;
    }
}

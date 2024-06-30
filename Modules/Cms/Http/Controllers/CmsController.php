<?php

namespace Modules\Cms\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Cms\Entities\CmsPage;
use Modules\Cms\Entities\CmsSiteDetail;
use Modules\Cms\Notifications\NewLeadGeneratedNotification;
use Modules\Cms\Utils\CmsUtil;
use Notification;

class CmsController extends Controller
{
    /**
     * All Utils instance.
     */
    protected $cmsUtil;

    /**
     * Constructor
     *
     * @param  ProductUtils  $product
     * @return void
     */
    public function __construct(CmsUtil $cmsUtil)
    {
        $this->cmsUtil = $cmsUtil;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $testimonials = $this->cmsUtil->getPageByType('testimonial');
        $page = $this->cmsUtil->getPageByLayout('home');
        $faqs = CmsSiteDetail::getValue('faqs');
        $statistics = CmsSiteDetail::getValue('statistics');

        return view('cms::frontend.pages.home')
            ->with(compact('testimonials', 'faqs', 'statistics', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('cms::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): Response
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show(int $id): View
    {
        return view('cms::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): View
    {
        return view('cms::edit');
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

    public function getBlogList(): View
    {
        $blogs = CmsPage::where('type', 'blog')
            ->orderBy('priority', 'asc')
            ->where('is_enabled', 1)
            ->get();

        return view('cms::frontend.blogs.index')
            ->with(compact('blogs'));
    }

    public function viewBlog(Request $request): View
    {
        $id = $this->cmsUtil->findIdFromGivenUrl($request->url());

        $blog = CmsPage::where('type', 'blog')
            ->where('is_enabled', 1)
            ->findOrFail($id);

        return view('cms::frontend.blogs.show')
            ->with(compact('blog'));
    }

    public function contactUs(Request $request): View
    {
        $page = $this->cmsUtil->getPageByLayout('contact');

        return view('cms::frontend.pages.contact_us')
            ->with(compact('page'));
    }

    public function postContactForm(Request $request)
    {
        //check if app is in demo & disable action
        $notAllowedInDemo = $this->cmsUtil->notAllowedInDemo();
        if (! empty($notAllowedInDemo)) {
            return $notAllowedInDemo;
        }

        if ($request->ajax()) {
            try {
                $lead_details = $request->only(['name', 'mobile', 'email', 'message']);

                $recipient = CmsSiteDetail::getValue('notifiable_email');

                if (! empty($recipient) && ! empty($lead_details['message'])) {
                    Notification::route('mail', $recipient)
                        ->notify(new NewLeadGeneratedNotification($lead_details));
                }

                $output = [
                    'success' => true,
                    'msg' => __('cms::lang.we_will_contact_soon'),
                ];
            } catch (Exception $e) {
                \Log::emergency('File:'.$e->getFile().'Line:'.$e->getLine().'Message:'.$e->getMessage());
                $output = [
                    'success' => false,
                    'msg' => __('messages.something_went_wrong'),
                ];
            }

            return $output;
        }
    }
}

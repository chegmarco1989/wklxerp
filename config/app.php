<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [

    'providers' => ServiceProvider::defaultProviders()->merge([
        Unicodeveloper\Paystack\PaystackServiceProvider::class,
        /*
         * Package Service Providers...
         */
        Laravel\Tinker\TinkerServiceProvider::class,

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\MessengerServiceProvider::class,
        App\Providers\RouteServiceProvider::class,

        Collective\Html\HtmlServiceProvider::class,
        //Yajra\Datatables\DatatablesServiceProvider::class,
        // Spatie\Permission\PermissionServiceProvider::class,
        Milon\Barcode\BarcodeServiceProvider::class,
        ConsoleTVs\Charts\ChartsServiceProvider::class,
        Nwidart\Menus\MenusServiceProvider::class,
        Knox\Pesapal\PesapalServiceProvider::class,
        Jenssegers\Agent\AgentServiceProvider::class,
    ])->toArray(),

    'aliases' => Facade::defaultAliases()->merge([
        'Carbon' => 'Carbon\Carbon',
        'Charts' => ConsoleTVs\Charts\Facades\Charts::class,
        'DNS1D' => Milon\Barcode\Facades\DNS1DFacade::class,
        'DNS2D' => Milon\Barcode\Facades\DNS2DFacade::class,
        'Datatables' => Yajra\DataTables\Facades\DataTables::class,
        'Form' => Collective\Html\FormFacade::class,
        'Html' => Collective\Html\HtmlFacade::class,
        'Paystack' => Unicodeveloper\Paystack\Facades\Paystack::class,
        'Redis' => Illuminate\Support\Facades\Redis::class,
        'Menu' => Nwidart\Menus\Facades\Menu::class,
        'Pesapal' => Knox\Pesapal\Facades\Pesapal::class,
        'GoogleTranslate' => Stichoza\GoogleTranslate\GoogleTranslate::class,
        'Agent' => Jenssegers\Agent\Facades\Agent::class,
    ])->toArray(),

];

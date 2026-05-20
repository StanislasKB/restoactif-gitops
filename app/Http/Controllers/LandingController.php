<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Menu;
use App\Models\Offer;
use App\Models\Profil;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function home_view()
    {
        $profils = Profil::all();
        $events = Event::all()->reverse()->take(15);
        $offers = Offer::all()->reverse(); // Inverser l'ordre pour obtenir les dernières offres en premier
        $left_offers = $offers->take(3); // Les trois dernières offres
        $right_offers = $offers->skip(3)->take(3);
        return view('landing.pages.accueil.index', [
            'profils' => $profils,
            'events' => $events,
            'left_offers' => $left_offers,
            'right_offers' => $right_offers,
        ]);
    }
    public function about_view()
    {
        return view('landing.pages.about.index');
    }
    public function contact_view()
    {
        return view('landing.pages.contact.index');
    }
    public function faq_view()
    {
        return view('landing.pages.faq.index');
    }
    public function events_view()
    {
        $events = Event::paginate(12);
        return view('landing.pages.events.index',[
            'events' => $events,
        ]);
    }

    public function event_view_sort(Request $request)
    {
        $sort_by = $request->get('sort_by', 'popularity'); // Default sorting by popularity
        $events = Event::query();
        $search = $request->get('search', ''); // Get search query

        if ($search) {
            $events = $events->where('title', 'LIKE', "%{$search}%")
                             ->orWhere('description', 'LIKE', "%{$search}%")
                             ->orWhere('address', 'LIKE', "%{$search}%");
        }


        switch ($sort_by) {
            case 'en_cours':
                $events = $events->where('start_date', '<=', now())
                    ->where('end_date', '>=', now())
                    ->orderBy('start_date', 'asc');
                break;

            case 'venir':
                $events = $events->where('start_date', '>', now())
                    ->orderBy('start_date', 'asc');
                break;

            case 'ferme':
                $events = $events->where('end_date', '<', now())
                    ->orderBy('end_date', 'desc');
                break;

            case 'concert':
                $events = $events->where('type', 'Concert')
                    ->orderBy('start_date', 'asc');
                break;
            case 'festival':
                $events = $events->where('type', 'Festival')
                    ->orderBy('start_date', 'asc');
                break;
            case 'autre':
                $events = $events->where('type', 'Autre')
                    ->orderBy('start_date', 'asc');
                break;

            default:
                $events = $events->orderBy('created_at', 'desc'); // Sort by most recent
                break;
        }

        $events = $events->paginate(10); // Paginate with 10 items per page

        return view('landing.pages.events.index', compact('events'));
    }
    public function event_detail_view($id)
    {
        $event=Event::findOrFail($id);
        return view('landing.pages.events.details',[
            'event' => $event
        ]);
    }

    public function offers_view()
    {
        $offers=Offer::paginate(12);
        return view('landing.pages.offers.index',[
            'offers' => $offers
        ]);
    }
    public function offers_view_sort(Request $request)
    {
        $sort_by = $request->get('sort_by', 'popularity'); // Default sorting by popularity
        $offers = Offer::query();

        $search = $request->get('search', ''); // Get search query

        if ($search) {
            $offers = $offers->where('title', 'LIKE', "%{$search}%")
                             ->orWhere('description', 'LIKE', "%{$search}%");
        }

        switch ($sort_by) {
            case 'en_cours':
                $offers = $offers->where('start_date', '<=', now())
                    ->where('end_date', '>=', now())
                    ->orderBy('start_date', 'asc');
                break;

            case 'venir':
                $offers = $offers->where('start_date', '>', now())
                    ->orderBy('start_date', 'asc');
                break;

            case 'ferme':
                $offers = $offers->where('end_date', '<', now())
                    ->orderBy('end_date', 'desc');
                break;

            default:
                $offers = $offers->orderBy('created_at', 'desc'); // Sort by most recent
                break;
        }

        $offers = $offers->paginate(10); // Paginate with 10 items per page

        return view('landing.pages.offers.index', compact('offers'));
    }
    public function offer_detail_view($id)
    {
        $offer=Offer::findOrFail($id);
        return view('landing.pages.offers.detail',[
            'offer' => $offer
        ]);
    }

    public function menu_view()
    {
        $menus=Menu::paginate(12);
        return view('landing.pages.menu.index',[
            'menus' => $menus
        ]);
    }

    public function menu_view_sort(Request $request)
    {
        $sort_by = $request->get('sort_by', 'popularity'); // Default sorting by popularity
        $menus = Menu::query();
        $search = $request->get('search', ''); // Get search query

        if ($search) {
            $menus = $menus->where('name', 'LIKE', "%{$search}%")
                             ->orWhere('description', 'LIKE', "%{$search}%");
        }

        switch ($sort_by) {
            case 'en_cours':
                $menus = $menus->where('start_date', '<=', now())
                    ->where('end_date', '>=', now())
                    ->orderBy('start_date', 'asc');
                break;

            case 'venir':
                $menus = $menus->where('start_date', '>', now())
                    ->orderBy('start_date', 'asc');
                break;

            case 'ferme':
                $menus = $menus->where('end_date', '<', now())
                    ->orderBy('end_date', 'desc');
                break;

            case 'plus_chers':
                // Assuming you have a 'price' field in your events table
                $menus = $menus->orderBy('price', 'desc');
                break;

            case 'moins_chere':
                // Assuming you have a 'price' field in your events table
                $menus = $menus->orderBy('price', 'asc');
                break;

            default:
                $menus = $menus->orderBy('created_at', 'desc'); // Sort by most recent
                break;
        }

        $menus = $menus->paginate(10); // Paginate with 10 items per page

        return view('landing.pages.menu.index', compact('menus'));
    }

    public function menu_detail_view($id)
    {
        $menu=Menu::findOrFail($id);
        return view('landing.pages.menu.detail',[
            'menu' => $menu
        ]);
    }

    public function restaurants_view(Request $request)
    {
        $sort_by = $request->get('sort_by', 'popularity'); // Default sorting by popularity
        $profils = Profil::query();
        $search = $request->get('search', ''); // Get search query

        if ($search) {
            $profils = $profils->where('name', 'LIKE', "%{$search}%")
                             ->orWhere('description', 'LIKE', "%{$search}%")
                             ->orWhere('type', 'LIKE', "%{$search}%")
                             ->orWhere('address', 'LIKE', "%{$search}%");
        }

        switch ($sort_by) {
            case 'bar':
                $profils = $profils->where('type', '=', 'Bar');
                break;

            case 'restaurant':
                $profils = $profils->where('type', '=', 'Restaurant');
                break;

            default:
                $profils = $profils->orderBy('created_at', 'desc'); // Sort by most recent
                break;
        }

        $profils = $profils->paginate(10);
        return view('landing.pages.restaurants.index',[
            'profils' => $profils,

        ]);
    }

    public function restaurant_detail($id)
    {
        $profil=Profil::findOrFail($id);
        $offers=$profil->user->offers()->get();
        $events=$profil->user->events()->get();
        $menus=$profil->user->menus()->get();
        return view('landing.pages.restaurant.index',[
            'profil' => $profil,
            'offers' => $offers,
            'events' => $events,
            'menus' => $menus,
        ]);
    }

    public function privacy_view(){

        return view('landing.pages.privacy.index');
    }
    public function review_view($slug,$id){

        if($slug=='event')
        {
            $event=Event::findOrFail($id);
            return view('landing.pages.review.index',compact('event'));
        }else if($slug=='menu')
        {
            $menu=Menu::findOrFail($id);
            return view('landing.pages.review.index',compact('menu'));
        }
        else{
            abort(404);
        }
        return view('landing.pages.review.index');
    }

}

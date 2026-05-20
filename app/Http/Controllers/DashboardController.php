<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Menu;
use App\Models\Offer;
use App\Models\Profil;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard_view()
    {

        $data = $this->getMonthlyData(auth()->user());
        $jsonData = json_encode($data);
        return view('dashboard.pages.dashboard.index',['data'=>$jsonData]);
    }
    public function calendar_view()
    {
        return view('dashboard.pages.calendar.index');
    }

    public function offers_view()
    {
        $offres=Offer::where('user_id',auth()->user()->id)->get();

        return view('dashboard.pages.offers.index',['offres'=>$offres]);
    }
    public function new_offers_view()
    {
        return view('dashboard.pages.offers.create');
    }
    public function update_offers_view($id)
    {
        $offre=Offer::findOrFail($id);
        if($offre->user_id!=auth()->user()->id)
        {
            abort(403);
        }
        return view('dashboard.pages.offers.update',['offre'=>$offre]);
    }

    public function profil_view()
    {
        $profil=Profil::where('user_id',auth()->user()->id)->first();
        return view('dashboard.pages.profil.index',compact('profil'));
    }




    public function event_view()
    {
        $events=Event::where('user_id',auth()->user()->id)->get();
        return view('dashboard.pages.events.index',['events'=>$events]);
    }
    public function new_event_view()
    {
        return view('dashboard.pages.events.create');
    }

    public function update_event_view($id){
        $event=Event::findOrFail($id);
        if($event->user_id!=auth()->user()->id){
            abort(403);
        }
        return view('dashboard.pages.events.update',['event'=>$event]);
    }


    public function menu_view()
    {
        $menus=Menu::where('user_id',auth()->user()->id)->get();
        return view('dashboard.pages.menu.index',['menus'=>$menus]);
    }
    public function new_menu_view()
    {
        return view('dashboard.pages.menu.create');
    }

    public function update_menu_view($id){
        $menu=Menu::findOrFail($id);
        if($menu->user_id!=auth()->user()->id){
            abort(403);
        }
        return view('dashboard.pages.menu.update',['menu'=>$menu]);
    }


    public function settings_view()
    {
        return view('dashboard.pages.settings.index');
    }





    private function getMonthlyData($user)
    {
        $data = [
            'Offres' => $this->getCountsByMonth(Offer::class,$user),
            'Evenements' => $this->getCountsByMonth(Event::class,$user),
            'Menus' => $this->getCountsByMonth(Menu::class,$user),
        ];

        $formattedData = [];
        foreach ($data as $key => $values) {
            $formattedData[] = [
                'name' => $key,
                'data' => $values
            ];
        }

        return $formattedData;
    }

    private function getCountsByMonth($model,$user)
    {
        $counts = [];
        for ($i = 11; $i >= 0; $i--) {
            $start = Carbon::now()->subMonths($i)->startOfMonth();
            $end = Carbon::now()->subMonths($i)->endOfMonth();
            $counts[] = $model::where('user_id',$user->id)->whereBetween('created_at', [$start, $end])->count();
        }
        return $counts;
    }


}

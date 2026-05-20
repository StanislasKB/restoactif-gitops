<?php

namespace App\Http\Controllers;

use App\Models\CommunityMember;
use App\Models\Event;
use App\Models\Menu;
use App\Models\Offer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard_view()
    {
        $data = $this->getMonthlyData();
        $jsonData = json_encode($data);
        return view('admin.pages.dashboard.index', ['data' => $jsonData]);
    }
    public function users_view()
    {
        $users = User::where('role', 1)->paginate(12);

        return view('admin.pages.users.index', [
            'users' => $users
        ]);
    }
    public function community_view()
    {
        $users = CommunityMember::paginate(12);
        return view('admin.pages.community.index', [
            'users' => $users
        ]);
    }
    public function settings_view()
    {
        return view('admin.pages.settings.index');
    }
    public function calendar_view()
    {
        return view('admin.pages.calendar.index');
    }

    public function change_account_status(Request $request,$id)
    {
        $user=User::findorFail($id);

        if($user->status==1)
        {
            $user->update([
                'status'=>false
            ]);
        }
        elseif($user->status==0)
        {

            $user->update([
                'status'=>true
            ]);
        }
        return redirect()->back()->with('success', 'Bienvenue dans la communauté Restoactif');

    }


    private function getMonthlyData()
    {
        $data = [
            'Offres' => $this->getCountsByMonth(Offer::class),
            'Evenements' => $this->getCountsByMonth(Event::class),
            'Menus' => $this->getCountsByMonth(Menu::class),
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

    private function getCountsByMonth($model)
    {
        $counts = [];
        for ($i = 11; $i >= 0; $i--) {
            $start = Carbon::now()->subMonths($i)->startOfMonth();
            $end = Carbon::now()->subMonths($i)->endOfMonth();
            $counts[] = $model::all()->whereBetween('created_at', [$start, $end])->count();
        }
        return $counts;
    }



}

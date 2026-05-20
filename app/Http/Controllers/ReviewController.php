<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventReview;
use App\Models\ImageEventReview;
use App\Models\MenuReview;
use App\Models\ImageMenuReview;

class ReviewController extends Controller
{
    public function create(Request $request, $slug, $id)
    {
        if($slug=='event')
        {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'review' => 'required|string',
                'rating' => 'required|string',
            ],[
                'title.required' => 'Le champ titre est requis.',
                'last_name.required' => 'Le champ nom est requis.',
                'first_name.required' => 'Le champ prénom est requis.',
                'review.required' => 'Le champ Votre avis est requis est requis.',
                'rating.required' => 'Le champ note est requis est requis.',
            ]);
            $eventReview = EventReview::create([
                'last_name' => $request->last_name,
                'first_name' => $request->first_name,
                'review_title' => $request->title,
                'review' => $request->review,
                'rating' => $request->rating,
                'event_id' => $id,
            ]);

            if ($request->hasFile('images')) {
                $files = $request->file('images');
                foreach ($files as $file) {
                    $path = $file->store('public/event_review_images');
                    $event_image = ImageEventReview::create(
                        [
                            'event_review_id' => $eventReview->id,
                            'file_url' => $path,
                        ]
                    );

                }
            }
return redirect()->back()->with('success', 'Avis ajouté avec succès');

        }else if($slug=='menu')
        {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'review' => 'required|string',
                'rating' => 'required|string',
            ],[
                'title.required' => 'Le champ titre est requis.',
                'last_name.required' => 'Le champ nom est requis.',
                'first_name.required' => 'Le champ prénom est requis.',
                'review.required' => 'Le champ Votre avis est requis est requis.',
                'rating.required' => 'Le champ note est requis est requis.',
            ]);
            $menuReview = MenuReview::create([
                'last_name' => $request->last_name,
                'first_name' => $request->first_name,
                'review_title' => $request->title,
                'review' => $request->review,
                'rating' => $request->rating,
                'menu_id' => $id,
            ]);

            if ($request->hasFile('images')) {
                $files = $request->file('images');
                foreach ($files as $file) {
                    $path = $file->store('public/menu_review_images');
                    $event_image = ImageMenuReview::create(
                        [
                            'menu_review_id' => $menuReview->id,
                            'file_url' => $path,
                        ]
                    );

                }
            }
return redirect()->back()->with('success', 'Avis ajouté avec succès');


        }

    }
}

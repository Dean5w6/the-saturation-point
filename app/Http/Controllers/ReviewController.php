<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ReviewController extends Controller
{
    private function maskProfanity($text)
{
    if (!$text) return null;
        $badWords = [ 
            'fuck', 'shit', 'bitch', 'asshole', 'crap', 'bastard', 'cunt', 'dick', 'pussy', 'slut', 'whore', 
            'motherfucker', 'cock', 'twat', 'wanker', 'prick', 'bullshit', 'dickhead', 'dumbass', 'douchebag',
             
            'nigger', 'nigga', 'faggot', 'fag', 'retard', 'dyke', 'tranny', 'chink', 'spic',
             
            'putangina', 'puta', 'gago', 'gaga', 'tarantado', 'tanga', 'bobo', 'bwisit', 'pucha', 'punyeta', 
            'hayop', 'inamo', 'ulol', 'kupal', 'pakyu', 'pokpok', 'malandi', 'hinayupak', 'lintik', 'hudas',
             
            'kantot', 'jakol', 'tite', 'pekpek', 'puke', 'bayag', 'hindot', 'supot', 'iyot'
        ]; 
         
        usort($badWords, function($a, $b) {
            return strlen($b) - strlen($a);
        });

        foreach ($badWords as $word) {
            $replacement = str_repeat('*', strlen($word)); 
            $text = preg_replace("/\b" . preg_quote($word, '/') . "\b/i", $replacement, $text);
        }
        
        return $text;
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $hasPurchased = Order::where('user_id', Auth::id())
            ->where('status', 'completed')
            ->whereHas('items', function ($query) use ($request) {
                $query->where('product_id', $request->product_id);
            })->exists();

        if (!$hasPurchased) {
            return back()->with('error', 'You can only review products from completed orders.');
        }

        Review::updateOrCreate(
            ['user_id' => Auth::id(), 'product_id' => $request->product_id],
            [
                'rating' => $request->rating, 
                'comment' => $this->maskProfanity($request->comment)
            ]
        );

        return back()->with('success', 'Review submitted.');
    }

    public function update(Request $request, $id)
    {
        $review = Review::where('user_id', Auth::id())->findOrFail($id);
        
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $review->update([
            'rating' => $request->rating,
            'comment' => $this->maskProfanity($request->comment)
        ]);

        return back()->with('success', 'Review updated.');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $reviews = Review::with(['user', 'product'])->select('reviews.*');
            return DataTables::of($reviews)
                ->addColumn('action', function ($row) {
                    return '<form action="'.route('admin.reviews.destroy', $row->id).'" method="POST">
                                '.csrf_field().method_field('DELETE').'
                                <button type="submit" class="btn btn-danger btn-sm" style="border-radius:2px">DELETE</button>
                             </form>';
                })->make(true);
        }
        return view('admin.reviews.index');
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        if (request()->ajax()) {
            return response()->json([
                'success' => true, 
                'message' => 'Review deleted successfully.'
            ]);
        }
        
        return back()->with('success', 'Review deleted.');
    }
}
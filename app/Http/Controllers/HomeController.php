<?php

namespace App\Http\Controllers;
use App\Post;
use App\User;
use App\Evidence;
use App\Casefile;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $lastWeek = date('Y-m-d', strtotime('-1 week'));
        $lastMonth = date('Y-m-d', strtotime('-1 months'));
        $lastYear = date('Y-m-d', strtotime('-1 year'));

        $posts = Post::all(); //Post::with('evidences')->get();
        $postsCount = $posts->count();
        $postSinceLastWeek = $this->calculatePercentage(Post::whereDate('created_at','<', $lastWeek)->count(), $postsCount);
        
        $casefileCount = Casefile::count();
        $casefileSinceLastWeek = $this->calculatePercentage(Casefile::whereDate('created_at','<', $lastWeek)->count(), $casefileCount);

        $verdictCount = Casefile::where('status', 'justified')->count();
        $verdictSinceLastMonth = $this->calculatePercentage(Casefile::where('status','justified')->whereDate('created_at','<', $lastMonth)->count(), $verdictCount);

        $userCount = User::count();
        $userSinceLastYear = $this->calculatePercentage(User::whereDate('created_at','<', $lastYear)->count(), $userCount);
    
        $evidencesCount = Evidence::select('post_id',\DB::raw('count(*) as total'))->groupBy('post_id')->get();

        return view('dashboard')->with([
            'posts' => $posts,
            'evidencesCount' => $evidencesCount,
            'postCount' => $postsCount,
            'postRatio' => $postSinceLastWeek,
            'verificationCount' => $casefileCount,
            'verificationRatio' => $casefileSinceLastWeek,
            'verdictCount' => $verdictCount,
            'verdictRatio' => $verdictSinceLastMonth,
            'communityCount' => $userCount,
            'communityRatio' => $userSinceLastYear
        ]);
    }

    private function calculatePercentage($numerator, $denominator)
    {
        if ($denominator === 0)
            return 0;
        return $numerator / $denominator * 100;
    }
}

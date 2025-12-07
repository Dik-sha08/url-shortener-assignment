<?php
namespace App\Http\Controllers;

use App\Models\ShortUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;         
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; 
class ShortUrlController extends Controller
{
    use AuthorizesRequests; 
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'SuperAdmin') {
            // SuperAdmin cannot see list of all short urls
            $shortUrls = collect();   // empty collection
        } elseif ($user->role === 'Admin') {
            // Admin -> only urls NOT in their own company
            $shortUrls = ShortUrl::with('user')
                ->where('company_id', '!=', $user->company_id)
                ->get();
        } elseif ($user->role === 'Member') {
            // Member -> urls NOT created by themselves
            $shortUrls = ShortUrl::with('user')
                ->where('user_id', '!=', $user->id)
                ->get();
        } else {
            // Sales / Manager -> urls of their own company
            $shortUrls = ShortUrl::with('user')
                ->where('company_id', $user->company_id)
                ->get();
        }

        return view('short_urls.index', compact('shortUrls'));
    }

    public function store(Request $request)
    {
         $user = $request->user();
    if (! in_array($user->role, ['Sales', 'Manager'])) {
        abort(403);
    }

    // Validate input
    $validated = $request->validate([
        'original_url' => ['required', 'url'],
    ]);

    // Short URL create karo
    ShortUrl::create([
        'original_url' => $request->original_url,
        'short_code'   => Str::random(8),
        'company_id'   => $user->company_id,
        'user_id'      => $user->id,
    ]);
    return redirect()
        ->route('short-urls.index')
        ->with('status', 'Short URL created.');
    }

    public function resolve(string $code)
    {
        $short = \App\Models\ShortUrl::where('short_code', $code)->firstOrFail();

        return redirect()->away($short->original_url);
    }
}

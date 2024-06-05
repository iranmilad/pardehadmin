<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $type = $request->get('type');

        if ($type === 'user') {
            $query = $request->get('query');
            $users = User::where('first_name', 'like', "%{$query}%")
                         ->orWhere('last_name', 'like', "%{$query}%")
                         ->orWhere('email', 'like', "%{$query}%")
                         ->limit(10)
                         ->get();

            $results = $users->map(function ($user) {
                return [
                    'id' => $user->id,
                    'text' => "{$user->first_name} {$user->last_name} ({$user->email})",
                ];
            });

            $data = [
                'search' => $query,
                'results' => $results,
            ];

            return response()->json($data);
        }

        return response()->json([
            'search' => $request->get('query'),
            'results' => [],
        ]);
    }
}

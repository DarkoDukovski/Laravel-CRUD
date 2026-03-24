<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Universities;
use Illuminate\Pagination\Paginator;

class ApiController extends Controller
{
    private $apiUrl = "http://universities.hipolabs.com/search";

    public function index(Request $request)
    {
        try {
            // Only fetch what's already in the database for the view to render instantly
            $universitiesNames = Universities::pluck('name');
            $showGetApiButton = true;

            return view('api.universities', compact('universitiesNames', 'showGetApiButton'));

        } catch (\Exception $e) {
            return back()->with('error', 'Error opening: ' . $e->getMessage());
        }
    }

    public function fetchUniversities(Request $request)
    {
        $page = $request->input('page', 1);

        try {
            $response = Http::withoutVerifying()->timeout(30)->get($this->apiUrl, [
                'country' => 'North Macedonia'
            ]);

            if ($response->failed()) {
                return response()->json(['error' => 'API is currently unavailable.'], 500);
            }

            $universities = $response->json();
            
            // Save to database avoiding duplicates
            foreach ($universities as $university) {
                Universities::updateOrCreate(
                    ['name' => $university['name']], // Check by name
                    [
                        'country' => $university['country'] ?? null,
                        'alpha_two_code' => $university['alpha_two_code'] ?? null,
                        'domain' => $university['domains'][0] ?? null,
                        'web_page' => $university['web_pages'][0] ?? null,
                    ]
                );
            }

            return response()->json($universities);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        try {
            $response = Http::withoutVerifying()->timeout(30)->get($this->apiUrl, [
                'country' => 'North Macedonia',
                'name' => $search
            ]);

            if ($response->failed()) {
                return back()->with('error', 'API is currently unavailable.');
            }

            $universities = $response->json();

            $universities = array_map(function($university) {
                return [
                    'Name' => $university['name'],
                    'Country' => $university['country'],
                    'Code' => $university['alpha_two_code'],
                    'Domain' => $university['domains'][0] ?? '',
                    'Web Page' => $university['web_pages'][0] ?? ''
                ];
            }, $universities);

            $universities = $this->paginateUniversities($universities, 30);

            $showGetApiButton = false;

            return view('api.universities', compact('universities', 'showGetApiButton'));

        } catch (\Exception $e) {
            return back()->with('error', 'Error searching: ' . $e->getMessage());
        }
    }

    private function paginateUniversities($universities, $perPage)
    {
        $currentPage = Paginator::resolveCurrentPage('page');
        $currentItems = array_slice($universities, ($currentPage - 1) * $perPage, $perPage);

        $paginatedUniversities = new \Illuminate\Pagination\LengthAwarePaginator(
            $currentItems,
            count($universities),
            $perPage
        );

        $paginatedUniversities->setPath(request()->url());

        return $paginatedUniversities;
    }
}

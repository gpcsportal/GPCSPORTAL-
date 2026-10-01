<?php

namespace App\Http\Controllers;

use App\Services\PortalSettingsService;
use Illuminate\Http\Response;

class CollegeController extends Controller
{
    public function page(string $page)
    {
        $pages = config('college.pages');
        abort_unless(isset($pages[$page]), 404);

        return view('college.page', ['page' => $page, ...$pages[$page]]);
    }

    public function programme(PortalSettingsService $settings, string $programme)
    {
        $item = config('college.programmes.'.$programme);
        abort_unless(is_array($item) && in_array($item['code'], $settings->branches(), true), 404);

        return view('college.page', [
            'page' => 'programme',
            'title' => $item['name'],
            'description' => $item['intro'],
            'programme' => $item,
        ]);
    }

    public function sitemap(PortalSettingsService $settings): Response
    {
        $paths = array_merge(['/'], array_map(static fn ($page) => '/'.$page, array_keys(config('college.pages'))));
        foreach (config('college.programmes') as $slug => $programme) {
            if (in_array($programme['code'], $settings->branches(), true)) {
                $paths[] = '/programmes/'.$slug;
            }
        }

        return response()->view('college.sitemap', compact('paths'))->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}

<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers;

use Blumilk\Meetup\Core\Http\Requests\StoreNewsRequest;
use Blumilk\Meetup\Core\Models\News;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Mews\Purifier\Facades\Purifier;

class NewsController extends Controller
{
    public function index(): View
    {
        $news = News::query()->orderBy("date")->paginate(20);

        return view("news.index")
            ->with("news", $news);
    }

    public function create(): View
    {
        return view("news.create");
    }

    public function store(StoreNewsRequest $request): RedirectResponse
    {
        $input = $request->validated();
        $input["content"] = Purifier::clean($input["content"]);
        $input["slug"] = Str::slug($input["title"]);

        $request->user()->news()->create($input);

        return redirect()->route("news");
    }

    public function edit(News $news): View
    {
        return view("news.edit")
            ->with("news", $news);
    }

    public function update(StoreNewsRequest $request, News $news): RedirectResponse
    {
        $news->update($request->validated());

        return redirect()->route("news");
    }

    public function destroy(News $news): RedirectResponse
    {
        $news->delete();

        return back();
    }
}

<?php

namespace App\Observers;

use App\Models\Page;
use Illuminate\Support\Str;

class PageObserver
{
    public function creating(Page $page)
    {
        $page = $this->slug($page);
    }

    public function updating(Page $page)
    {
        $page = $this->slug($page);
    }

    private function slug(Page $page): Page
    {
        $page->slug = Str::slug($page->name);
        return $page;
    }
}

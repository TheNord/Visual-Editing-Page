<?php

namespace App\Http\ViewComposers;

use App\Entity\Menu;
use Illuminate\View\View;

class MenuPagesComposer
{
    public function compose(View $view): void
    {
        // to the variable $topMenuPages find all menu item, sorting by Left and get their models
        $view->with('topMenuPages', Menu::where('title', '!=', null)->defaultOrder()->getModels());
    }
}
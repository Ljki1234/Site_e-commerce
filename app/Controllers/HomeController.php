<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\ServicePack;
use App\Models\PortfolioItem;

class HomeController extends Controller
{
    public function index(): void
    {
        $packs = ServicePack::all(true);
        $portfolio = PortfolioItem::all(true);
        $this->view('home', [
            'pageTitle' => 'Home',
            'navbar' => true,
            'footer' => true,
            'packs' => array_slice($packs, 0, 3),
            'portfolio' => array_slice($portfolio, 0, 3),
        ]);
    }
}

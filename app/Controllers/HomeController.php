<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\ServicePack;
use App\Models\PortfolioItem;
use App\Models\Message;

class HomeController extends Controller
{
    public function index(): void
    {
        $packs = ServicePack::all(true);
        $portfolio = PortfolioItem::all(true);
        $messages = Message::all();
        $testimonials = [];
        foreach (array_slice($messages, 0, 5) as $m) {
            $testimonials[] = [
                'name' => $m['name'] ?? 'Client',
                'role' => $m['subject'] ?? 'Client',
                'text' => $m['body'] ?? '',
            ];
        }
        $this->view('home', [
            'pageTitle' => 'Home',
            'navbar' => true,
            'footer' => true,
            'packs' => array_slice($packs, 0, 3),
            'portfolio' => array_slice($portfolio, 0, 3),
            'testimonials' => $testimonials,
        ]);
    }
}

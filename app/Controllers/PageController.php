<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Models\ServicePack;
use App\Models\PortfolioItem;
use App\Models\Message;

class PageController extends Controller
{
    public function services(): void
    {
        $this->view('pages.services', [
            'pageTitle' => 'Services',
            'navbar' => true,
            'footer' => true,
        ]);
    }

    public function packs(): void
    {
        $packs = ServicePack::all(true);
        $this->view('pages.packs', [
            'pageTitle' => 'Website Packs & Pricing',
            'navbar' => true,
            'footer' => true,
            'packs' => $packs,
        ]);
    }

    public function portfolio(): void
    {
        $items = PortfolioItem::all(true);
        $this->view('pages.portfolio', [
            'pageTitle' => 'Portfolio',
            'navbar' => true,
            'footer' => true,
            'items' => $items,
        ]);
    }

    public function contact(): void
    {
        $this->view('pages.contact', [
            'pageTitle' => 'Contact',
            'navbar' => true,
            'footer' => true,
        ]);
    }

    public function submitContact(Request $request): void
    {
        $name = trim((string) $request->input('name'));
        $email = trim((string) $request->input('email'));
        $subject = trim((string) $request->input('subject'));
        $body = trim((string) $request->input('message'));
        $errors = [];

        if ($name === '') {
            $errors['name'] = 'Name is required.';
        }
        if ($email === '') {
            $errors['email'] = 'Email is required.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Invalid email.';
        }
        if ($subject === '') {
            $errors['subject'] = 'Subject is required.';
        }
        if ($body === '') {
            $errors['message'] = 'Message is required.';
        }

        if (!empty($errors)) {
            $this->view('pages.contact', [
                'pageTitle' => 'Contact',
                'navbar' => true,
                'footer' => true,
                'errors' => $errors,
                'old' => $request->all(),
            ]);
            return;
        }

        Message::create([
            'name' => $name,
            'email' => $email,
            'subject' => $subject,
            'body' => $body,
            'user_id' => $_SESSION['user_id'] ?? null,
        ]);

        $this->redirect(base_url('contact?sent=1'));
    }
}

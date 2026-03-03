<?php
declare(strict_types=1);

// Demo data seeder for webdev_agency

$config = require __DIR__ . '/../config/app.php';
$db = $config['database'] ?? $config;

try {
    $dsn = sprintf(
        'mysql:host=%s;dbname=%s;charset=%s',
        $db['host'] ?? 'localhost',
        $db['dbname'] ?? 'webdev_agency',
        $db['charset'] ?? 'utf8mb4'
    );
    $pdo = new PDO(
        $dsn,
        $db['user'] ?? '',
        $db['password'] ?? '',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (PDOException $e) {
    fwrite(STDERR, 'Failed to connect to database: ' . $e->getMessage() . PHP_EOL);
    exit(1);
}

$pdo->beginTransaction();

try {
    // Ensure admin exists (seed_admin.php should have done this, but we are defensive)
    $adminEmail = 'admin@webdevagency.com';
    $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
    $stmt->execute([$adminEmail]);
    $adminId = $stmt->fetchColumn();
    if (!$adminId) {
        $hash = password_hash('admin123', PASSWORD_DEFAULT);
        $pdo->prepare('INSERT INTO users (email, password, full_name, role, status) VALUES (?, ?, ?, ?, ?)')
            ->execute([$adminEmail, $hash, 'Admin', 'admin', 'active']);
        $adminId = (int)$pdo->lastInsertId();
    }

    // Demo client users
    $clients = [
        ['email' => 'client1@example.com', 'name' => 'Alice Client', 'company' => 'Alice Studio', 'phone' => '+1 555 000 1111'],
        ['email' => 'client2@example.com', 'name' => 'Bob Client', 'company' => 'Bob Consulting', 'phone' => '+1 555 000 2222'],
        ['email' => 'client3@example.com', 'name' => 'Charlie Client', 'company' => 'Charlie Ventures', 'phone' => '+1 555 000 3333'],
    ];

    $clientIds = [];
    foreach ($clients as $c) {
        $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        $stmt->execute([$c['email']]);
        $id = $stmt->fetchColumn();
        if (!$id) {
            $hash = password_hash('password123', PASSWORD_DEFAULT);
            $pdo->prepare('INSERT INTO users (email, password, full_name, company, phone, role, status) VALUES (?, ?, ?, ?, ?, ?, ?)')
                ->execute([
                    $c['email'],
                    $hash,
                    $c['name'],
                    $c['company'],
                    $c['phone'],
                    'client',
                    'active',
                ]);
            $id = (int)$pdo->lastInsertId();
        }
        $clientIds[$c['email']] = (int)$id;
    }

    // Demo service packs (pricing)
    $packs = [
        [
            'name' => 'Landing Page Starter',
            'slug' => 'landing-page-starter',
            'description' => 'Single-page website ideal for small campaigns and simple presentations.',
            'price' => 499,
            'features' => [
                '1 Page Design',
                'Responsive Layout',
                '1 Month Support',
            ],
            'sort_order' => 1,
        ],
        [
            'name' => 'Business Website',
            'slug' => 'business-website',
            'description' => 'Multi-page website for small and medium businesses with blog and contact.',
            'price' => 1499,
            'features' => [
                'Up to 8 Pages',
                'Blog & Contact Forms',
                '3 Months Support',
            ],
            'sort_order' => 2,
        ],
        [
            'name' => 'E-commerce Pro',
            'slug' => 'ecommerce-pro',
            'description' => 'Full-featured online store with product management and checkout.',
            'price' => 2999,
            'features' => [
                'Product Catalog',
                'Checkout Integration',
                '6 Months Support',
            ],
            'sort_order' => 3,
        ],
    ];

    $packIds = [];
    foreach ($packs as $p) {
        $stmt = $pdo->prepare('SELECT id FROM service_packs WHERE slug = ?');
        $stmt->execute([$p['slug']]);
        $id = $stmt->fetchColumn();
        if (!$id) {
            $featuresJson = json_encode($p['features'], JSON_UNESCAPED_UNICODE);
            $pdo->prepare('INSERT INTO service_packs (name, slug, description, price, features, is_active, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?)')
                ->execute([
                    $p['name'],
                    $p['slug'],
                    $p['description'],
                    $p['price'],
                    $featuresJson,
                    1,
                    $p['sort_order'],
                ]);
            $id = (int)$pdo->lastInsertId();
        }
        $packIds[$p['slug']] = (int)$id;
    }

    // Demo orders + invoices
    $ordersData = [
        [
            'email' => 'client1@example.com',
            'pack_slug' => 'landing-page-starter',
            'amount' => 499,
            'status' => 'completed',
        ],
        [
            'email' => 'client2@example.com',
            'pack_slug' => 'business-website',
            'amount' => 1499,
            'status' => 'in_progress',
        ],
        [
            'email' => 'client3@example.com',
            'pack_slug' => 'ecommerce-pro',
            'amount' => 2999,
            'status' => 'pending',
        ],
    ];

    foreach ($ordersData as $o) {
        $userId = $clientIds[$o['email']] ?? null;
        $packId = $packIds[$o['pack_slug']] ?? null;
        if (!$userId || !$packId) {
            continue;
        }

        $pdo->prepare('INSERT INTO orders (user_id, pack_id, total_amount, status) VALUES (?, ?, ?, ?)')
            ->execute([$userId, $packId, $o['amount'], $o['status']]);
        $orderId = (int)$pdo->lastInsertId();

        $invoiceNumber = sprintf('INV-%s-%04d', date('Ymd'), $orderId);
        $dueDate = date('Y-m-d', strtotime('+14 days'));
        $pdo->prepare('INSERT INTO invoices (order_id, invoice_number, amount, status, due_date) VALUES (?, ?, ?, ?, ?)')
            ->execute([$orderId, $invoiceNumber, $o['amount'], 'sent', $dueDate]);
    }

    // Demo portfolio items
    $portfolio = [
        [
            'title' => 'Modern Ecommerce Platform',
            'description' => 'Full-featured online store with responsive UI.',
            'image_url' => 'assets/image9.jfif',
            'project_url' => 'https://example.com/ecommerce',
            'sort_order' => 1,
            'category' => 'web',
        ],
        [
            'title' => 'Creative Mobile App',
            'description' => 'iOS and Android app for on-the-go services.',
            'image_url' => 'assets/image11.jfif',
            'project_url' => 'https://example.com/app',
            'sort_order' => 2,
            'category' => 'app',
        ],
        [
            'title' => 'Brand Identity & Brochure',
            'description' => 'Branding and print materials for a tech startup.',
            'image_url' => 'assets/image12.jfif',
            'project_url' => 'https://example.com/branding',
            'sort_order' => 3,
            'category' => 'branding',
        ],
    ];

    foreach ($portfolio as $item) {
        $stmt = $pdo->prepare('SELECT id FROM portfolio_items WHERE title = ?');
        $stmt->execute([$item['title']]);
        $id = $stmt->fetchColumn();
        if ($id) {
            continue;
        }
        $pdo->prepare('INSERT INTO portfolio_items (title, description, image_url, project_url, sort_order, category, is_active) VALUES (?, ?, ?, ?, ?, ?, ?)')
            ->execute([
                $item['title'],
                $item['description'],
                $item['image_url'],
                $item['project_url'],
                $item['sort_order'],
                $item['category'],
                1,
            ]);
    }

    // Demo contact messages
    $pdo->prepare('INSERT INTO messages (user_id, name, email, subject, body) VALUES (?, ?, ?, ?, ?)')
        ->execute([
            $clientIds['client1@example.com'] ?? null,
            'Alice Client',
            'client1@example.com',
            'Project inquiry',
            'Hi, I would like to discuss a new website project.',
        ]);

    $pdo->prepare('INSERT INTO messages (user_id, name, email, subject, body) VALUES (?, ?, ?, ?, ?)')
        ->execute([
            null,
            'Unauthenticated Visitor',
            'visitor@example.com',
            'Question about pricing',
            'Hello, could you send me more details about your pricing packs?',
        ]);

    // Demo admin note
    $anyClientId = reset($clientIds) ?: null;
    if ($anyClientId && $adminId) {
        $pdo->prepare('INSERT INTO admin_notes (user_id, author_id, note) VALUES (?, ?, ?)')
            ->execute([
                $anyClientId,
                $adminId,
                'Client seems interested in upgrading to the Business Website pack.',
            ]);
    }

    $pdo->commit();
    echo "Demo data seeded successfully.\n";
} catch (Throwable $e) {
    $pdo->rollBack();
    fwrite(STDERR, 'Failed to seed demo data: ' . $e->getMessage() . PHP_EOL);
    exit(1);
}


<?php
// Run once: php database/seed_faqs.php
// Seeds the faqs table for the AtlasTech chatbot.
declare(strict_types=1);

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
        $db['password'] ?? ''
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::MYSQL_ATTR_MULTI_STATEMENTS, false);
} catch (PDOException $e) {
    fwrite(STDERR, 'Failed to connect to database: ' . $e->getMessage() . PHP_EOL);
    exit(1);
}

// Basic seed data tailored to the AtlasTech site.
$rows = [
    [
        'question' => 'services',
        'answer' => "AtlasTech propose des services de développement web sur mesure (sites vitrines, e‑commerce, dashboards), du design UI/UX et de l'accompagnement digital pour les entreprises."
    ],
    [
        'question' => 'que proposez-vous comme services',
        'answer' => "Nous concevons et développons des sites web modernes, responsives et optimisés pour la performance, ainsi que des interfaces dashboards pour vos clients."
    ],
    [
        'question' => 'packs',
        'answer' => "Nous avons plusieurs packs de sites web (Starter, Business, Premium). Chaque pack inclut un périmètre clair, un prix fixe et des délais de livraison précis. Vous pouvez voir le détail sur la page Pricing / Packs."
    ],
    [
        'question' => 'prix',
        'answer' => "Les prix dépendent du pack choisi et des fonctionnalités. Un site vitrine simple commence autour de quelques centaines d'euros. Pour un devis précis, passez par la page Contact ou la page Pricing."
    ],
    [
        'question' => 'comment vous contacter',
        'answer' => "Vous pouvez nous contacter via le formulaire sur la page Contact du site, ou en créant un compte client et en passant une commande depuis votre dashboard."
    ],
    [
        'question' => 'contact',
        'answer' => "Pour toute question, utilisez la page Contact de notre site AtlasTech. Nous répondons généralement sous 24 heures ouvrées."
    ],
    [
        'question' => 'informations sur l’entreprise',
        'answer' => "AtlasTech est une agence web spécialisée dans la création de sites modernes, rapides et orientés business pour PME et entrepreneurs."
    ],
    [
        'question' => 'dashboard client',
        'answer' => "Le dashboard client vous permet de suivre vos commandes, télécharger vos livrables et mettre à jour votre profil."
    ],
    [
        'question' => 'compte',
        'answer' => "Pour créer un compte, cliquez sur Login puis Register. Une fois connecté, vous aurez accès à votre dashboard et à l'historique de vos projets."
    ],
];

$stmt = $pdo->prepare('INSERT INTO faqs (question, answer, created_at, updated_at) VALUES (:q, :a, NOW(), NOW())');
$inserted = 0;

foreach ($rows as $row) {
    $stmt->execute([
        'q' => $row['question'],
        'a' => $row['answer'],
    ]);
    $inserted++;
}

echo "Inserted {$inserted} FAQ rows into faqs table." . PHP_EOL;


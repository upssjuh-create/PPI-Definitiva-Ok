<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== VERIFICAR INSCRIÇÕES ===\n\n";

// Pedir o email do usuário
echo "Digite seu email: ";
$email = trim(fgets(STDIN));

// Buscar usuário
$user = DB::table('users')->where('email', $email)->first();

if (!$user) {
    echo "Usuário não encontrado!\n";
    exit;
}

echo "\n✓ Usuário encontrado: {$user->name} (ID: {$user->id})\n";
echo "Email: {$user->email}\n";
echo "Tipo: {$user->user_type}\n\n";

// Buscar inscrições ativas
echo "=== INSCRIÇÕES ATIVAS ===\n";
$registrations = DB::table('registrations as r')
    ->join('events as e', 'r.event_id', '=', 'e.id')
    ->where('r.user_id', $user->id)
    ->where('r.status', '!=', 'cancelled')
    ->select(
        'r.id as inscricao_id',
        'r.status',
        'r.checked_in',
        'e.title',
        'e.date',
        'e.time',
        'e.location',
        'e.price',
        'r.created_at'
    )
    ->orderBy('r.created_at', 'desc')
    ->get();

if ($registrations->isEmpty()) {
    echo "Nenhuma inscrição ativa encontrada.\n\n";
} else {
    foreach ($registrations as $reg) {
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        echo "ID da Inscrição: {$reg->inscricao_id}\n";
        echo "Evento: {$reg->title}\n";
        echo "Data: {$reg->date} às {$reg->time}\n";
        echo "Local: {$reg->location}\n";
        echo "Preço: R$ " . number_format($reg->price, 2, ',', '.') . "\n";
        echo "Status: {$reg->status}\n";
        echo "Check-in: " . ($reg->checked_in ? 'Sim' : 'Não') . "\n";
        echo "Inscrito em: {$reg->created_at}\n";
    }
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "\nTotal: " . $registrations->count() . " inscrição(ões) ativa(s)\n\n";
}

// Buscar cancelamentos
echo "=== CANCELAMENTOS ===\n";
$cancellations = DB::table('cancellations as c')
    ->join('events as e', 'c.event_id', '=', 'e.id')
    ->where('c.user_id', $user->id)
    ->select(
        'c.id',
        'e.title',
        'c.reason',
        'c.status',
        'c.created_at'
    )
    ->orderBy('c.created_at', 'desc')
    ->get();

if ($cancellations->isEmpty()) {
    echo "Nenhum cancelamento encontrado.\n\n";
} else {
    foreach ($cancellations as $cancel) {
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        echo "Evento: {$cancel->title}\n";
        echo "Motivo: " . ($cancel->reason ?: 'Não informado') . "\n";
        echo "Status: {$cancel->status}\n";
        echo "Cancelado em: {$cancel->created_at}\n";
    }
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "\nTotal: " . $cancellations->count() . " cancelamento(s)\n\n";
}

echo "=== FIM ===\n";

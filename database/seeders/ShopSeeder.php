<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\ShopItem;

class ShopSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['type' => 'ram', 'name' => '+1024MB RAM', 'cost' => 100, 'amount' => 1024, 'column_name' => 'max_ram', 'icon_color' => 'vortex-purple'],
            ['type' => 'cpu', 'name' => '+50% CPU', 'cost' => 150, 'amount' => 50, 'column_name' => 'max_cpu', 'icon_color' => 'blue-500'],
            ['type' => 'disk', 'name' => '+5GB Storage', 'cost' => 50, 'amount' => 5120, 'column_name' => 'max_disk', 'icon_color' => 'green-500'],
            ['type' => 'slot', 'name' => '+1 Server Slot', 'cost' => 500, 'amount' => 1, 'column_name' => 'max_servers', 'icon_color' => 'yellow-500'],
        ];

        foreach ($items as $item) {
            ShopItem::updateOrCreate(['type' => $item['type']], $item);
        }
    }
}
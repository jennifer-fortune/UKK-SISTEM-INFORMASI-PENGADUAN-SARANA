<?php

namespace App\Filament\Resources\Pengaduans\Pages;

use App\Filament\Resources\Pengaduans\PengaduanResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePengaduan extends CreateRecord
{
    protected static string $resource = PengaduanResource::class;

    public function mount(): void
    {
        abort_unless(auth()->user()?->role === 'siswa', 403);

        parent::mount();
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        $data['status'] = 'Menunggu';
        $data['feedback'] = null;

        return $data;
    }
}
<?php

namespace App\Filament\Resources\Pengaduans\Tables;

use App\Models\Pengaduan;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PengaduansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Nama Siswa')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('user.nis')
                    ->label('NIS')
                    ->searchable(),

                TextColumn::make('category.nama')
                    ->label('Kategori')
                    ->sortable(),

                TextColumn::make('lokasi')
                    ->label('Lokasi')
                    ->searchable()
                    ->limit(30),

                TextColumn::make('deskripsi')
                    ->label('Deskripsi')
                    ->limit(40)
                    ->wrap(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Menunggu' => 'warning',
                        'Diproses' => 'info',
                        'Selesai' => 'success',
                        'Ditolak' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('feedback')
                    ->label('Tanggapan Admin')
                    ->placeholder('Belum ada tanggapan')
                    ->limit(40)
                    ->wrap(),

                TextColumn::make('created_at')
                    ->label('Tanggal Pengaduan')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])

            ->filters([
                SelectFilter::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'nama'),

                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'Menunggu' => 'Menunggu',
                        'Diproses' => 'Diproses',
                        'Selesai' => 'Selesai',
                        'Ditolak' => 'Ditolak',
                    ]),

                Filter::make('tanggal')
                    ->label('Tanggal Pengaduan')
                    ->schema([
                        DatePicker::make('tanggal')
                            ->label('Pilih Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['tanggal'] ?? null,
                            fn (Builder $query, $tanggal) =>
                                $query->whereDate('created_at', $tanggal)
                        );
                    }),

                SelectFilter::make('bulan')
                    ->label('Bulan')
                    ->options([
                        '1' => 'Januari',
                        '2' => 'Februari',
                        '3' => 'Maret',
                        '4' => 'April',
                        '5' => 'Mei',
                        '6' => 'Juni',
                        '7' => 'Juli',
                        '8' => 'Agustus',
                        '9' => 'September',
                        '10' => 'Oktober',
                        '11' => 'November',
                        '12' => 'Desember',
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['value'] ?? null,
                            fn (Builder $query, $bulan) =>
                                $query->whereMonth('created_at', $bulan)
                        );
                    }),

                Filter::make('nis')
                    ->label('NIS Siswa')
                    ->schema([
                        TextInput::make('nis')
                            ->label('Masukkan NIS'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['nis'] ?? null,
                            fn (Builder $query, $nis) =>
                                $query->whereHas(
                                    'user',
                                    fn (Builder $userQuery) =>
                                        $userQuery->where('nis', 'like', "%{$nis}%")
                                )
                        );
                    }),
            ])

            ->recordActions([
                Action::make('tanggapi')
                    ->label('Tanggapi')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->color('success')
                    ->visible(fn (): bool => auth()->user()?->role === 'admin')

                    ->schema([
                        Select::make('status')
                            ->label('Status Pengaduan')
                            ->options([
                                'Menunggu' => 'Menunggu',
                                'Diproses' => 'Diproses',
                                'Selesai' => 'Selesai',
                                'Ditolak' => 'Ditolak',
                            ])
                            ->required(),

                        Textarea::make('feedback')
                            ->label('Tanggapan Admin')
                            ->rows(4)
                            ->required(),
                    ])

                    ->fillForm(fn (Pengaduan $record): array => [
                        'status' => $record->status,
                        'feedback' => $record->feedback,
                    ])

                    ->action(function (Pengaduan $record, array $data): void {
                        abort_unless(
                            auth()->user()?->role === 'admin',
                            403
                        );

                        $record->update([
                            'status' => $data['status'],
                            'feedback' => $data['feedback'],
                        ]);

                        Notification::make()
                            ->title('Tanggapan berhasil disimpan')
                            ->success()
                            ->send();
                    }),
            ])

            ->toolbarActions([]);
    }
}

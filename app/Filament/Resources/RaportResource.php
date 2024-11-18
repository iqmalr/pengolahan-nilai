<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RaportResource\Pages;
use App\Filament\Resources\RaportResource\RelationManagers;
use App\Models\Raport;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RaportResource extends Resource
{
    protected static ?string $model = Raport::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Raport';
    protected static ?int $navigationSort = 6;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('siswa_id')
                    ->relationship('siswa', 'nama')
                    ->required(),
                Forms\Components\Select::make('kelas_id')
                    ->relationship('kelas', 'nama_kelas')
                    ->required(),
                Forms\Components\TextInput::make('semester')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('tahun_ajaran')
                    ->required(),
                Forms\Components\DatePicker::make('tanggal_raport')
                    ->required(),
                Forms\Components\TextInput::make('nilai_akhir')
                    ->disabled() // Disabled to make it read-only, as it’s auto-calculated
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('siswa.nama')->label('Siswa')->sortable(),
                Tables\Columns\TextColumn::make('kelas.nama_kelas')->label('Kelas')->sortable(),
                Tables\Columns\TextColumn::make('semester')->sortable(),
                Tables\Columns\TextColumn::make('tahun_ajaran')->sortable(),
                Tables\Columns\TextColumn::make('tanggal_raport')->date()->sortable(),
                Tables\Columns\TextColumn::make('nilai_akhir')->sortable(),
            ])
            ->filters([]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRaports::route('/'),
            'create' => Pages\CreateRaport::route('/create'),
            'edit' => Pages\EditRaport::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenilaianResource\Pages;
use App\Filament\Resources\PenilaianResource\RelationManagers;
use App\Models\Penilaian;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PenilaianResource extends Resource
{
    protected static ?string $model = Penilaian::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Penilaian';
    protected static ?int $navigationSort = 5;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('siswa_id')
                    ->relationship('siswa', 'nama')
                    ->required(),
                Forms\Components\Select::make('mapel_id')
                    ->relationship('mataPelajaran', 'nama_mapel')
                    ->required(),
                Forms\Components\TextInput::make('nilai')->numeric()->required(),
                Forms\Components\DatePicker::make('tanggal_penilaian')->required(),
                Forms\Components\Select::make('jenis_penilaian')
                    ->options([
                        'Ujian' => 'Ujian',
                        'Tugas' => 'Tugas',
                        'Ulangan Harian' => 'Ulangan Harian',
                        'UTS' => 'UTS',
                        'UAS' => 'UAS',
                    ])->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('siswa.nama')->label('Siswa')->sortable(),
                Tables\Columns\TextColumn::make('mataPelajaran.nama_mapel')->label('Mata Pelajaran')->sortable(),
                Tables\Columns\TextColumn::make('nilai')->sortable(),
                Tables\Columns\TextColumn::make('jenis_penilaian')->sortable(),
                Tables\Columns\TextColumn::make('tanggal_penilaian')->date()->sortable(),
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
            'index' => Pages\ListPenilaians::route('/'),
            'create' => Pages\CreatePenilaian::route('/create'),
            'edit' => Pages\EditPenilaian::route('/{record}/edit'),
        ];
    }
}

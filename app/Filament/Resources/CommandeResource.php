<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Commande;
use Filament\Forms\Form;
use Illuminate\View\View;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CommandeResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CommandeResource\RelationManagers;

class CommandeResource extends Resource
{
    protected static ?string $model = Commande::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('serveur_id')
                    ->required()
                    ->numeric(),
                Forms\Components\Toggle::make('etat')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('numero_table')
                    ->default(function(Commande $commande) {
                        return $commande->panier->table;
                    }),
                Tables\Columns\TextColumn::make('serveur_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('etat')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('Produits')
                ->icon('heroicon-m-magnifying-glass')
                ->action(fn (Model $record) => $record->advance())
                ->modalContent(fn(Model $record): View => view('view_product', ['record' => $record]))
                ->modalSubmitAction(false)
                ->modalCancelAction(false)
                ->modalWidth()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListCommandes::route('/'),
            'create' => Pages\CreateCommande::route('/create'),
            'edit' => Pages\EditCommande::route('/{record}/edit'),
        ];
    }
}

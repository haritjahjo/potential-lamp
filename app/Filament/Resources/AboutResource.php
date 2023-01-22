<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\About;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\FormsComponent;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\AboutResource\Pages;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AboutResource\RelationManagers;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class AboutResource extends Resource
{
    protected static ?string $model = About::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(columns:12)
            ->schema([
                Forms\Components\TextInput::make(name:'title')
                    ->columnSpan(span:12)
                    ->required(condition:true)
                    ->maxLength(length: 255) ,
                Forms\Components\RichEditor::make(name:'content')
                    ->columnSpan(span:12)
                    ->required()
                    ->maxLength(length:65535),
                SpatieMediaLibraryFileUpload::make('about')
                    ->image()
                    ->multiple()
                    ->enableReordering()
                    ->collection('abouts')
                    ->columnSpan(span:12),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make(name: 'title')->searchable(condition:true)->sortable(condition:true)
                    ->limit(length:30)
                    ->tooltip(tooltip:'title')->tooltip(fn (Model $record): string => "{$record->title}"),
                TextColumn::make(name: 'content')
                    ->limit(length:50)
                    ->tooltip(tooltip:'content'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListAbouts::route('/'),
            'create' => Pages\CreateAbout::route('/create'),
            'edit' => Pages\EditAbout::route('/{record}/edit'),
        ];
    }    
}

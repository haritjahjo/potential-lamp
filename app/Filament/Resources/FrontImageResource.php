<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\FrontImage;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Livewire\TemporaryUploadedFile;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\FrontImageResource\Pages;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Filament\Resources\FrontImageResource\RelationManagers;

class FrontImageResource extends Resource
{
    protected static ?string $model = FrontImage::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(columns:12)
            ->schema([
                TextInput::make(name:'title')
                    ->columnSpan(span:12)
                    ->required(condition:true)
                    ->maxLength(length: 255),
                SpatieMediaLibraryFileUpload::make('Front_Image')
                    ->image()
                    ->collection('front-images')
                    ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file): string {
                            return (string) str($file->getClientOriginalName())->prepend('front-image-');})
                    ->columnSpan(span:12),                    
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make(name:'title')->searchable()->sortable(),
                SpatieMediaLibraryImageColumn::make(name: 'file_name')->label(label:'Front Image')
                    ->collection(collection:'front-images')
                    ->conversion(conversion:'thumb-front')
                    ->width(width: 140)
                    ->height(height:80),  
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
            'index' => Pages\ListFrontImages::route('/'),
            'create' => Pages\CreateFrontImage::route('/create'),
            'edit' => Pages\EditFrontImage::route('/{record}/edit'),
        ];
    }    
}

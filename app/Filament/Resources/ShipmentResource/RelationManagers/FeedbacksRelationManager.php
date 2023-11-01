<?php

namespace App\Filament\Resources\ShipmentResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class FeedbacksRelationManager extends RelationManager
{
    protected static string $relationship = 'feedback';

    protected static ?string $recordTitleAttribute = 'remark';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('date')
                    ->required(),

                Forms\Components\MarkdownEditor::make('remark')
                    ->required()
                    ->label('Feedback'),
            ])
            ->columns(1);
    }

    // public function infolist(Infolist $infolist): Infolist
    // {
    //     return $infolist
    //         ->columns(1)
    //         ->schema([
    //             TextEntry::make('title'),
    //             TextEntry::make('customer.name'),
    //             IconEntry::make('is_visible')
    //                 ->label('Visibility')
    //                 ->boolean(),
    //             TextEntry::make('content')
    //                 ->markdown(),
    //         ]);
    // }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->label('Date')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('remark')
                    ->label('Remark')
                    ->searchable()
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->groupedBulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShipmentResource\Pages;
use App\Filament\Resources\ShipmentResource\RelationManagers;
use App\Models\Shipment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section as InfolistSection;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\ImageEntry;


class ShipmentResource extends Resource
{
    protected static ?string $model = Shipment::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Section::make([
                    DatePicker::make('date')->required(),
                    Select::make('customer_id')->relationship(name: 'customer',titleAttribute:'name')->required(),
                    Select::make('sample_id')->relationship(name: 'sample',titleAttribute:'name')->required(),
                    TextInput::make('courier')->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('customer.name'),
                TextColumn::make('sample.name')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                InfolistSection::make([
                    TextEntry::make('date')->date()->label('Date Ship')
                ]),
                InfolistSection::make([

                    Group::make([
                        TextEntry::make('customer.name')->label('Customer Name'),
                        TextEntry::make('customer.company')->label('Customer Company'),
                        TextEntry::make('customer.phone_number')
                    ])->columns(2),
                    ])->label('Customer Details'),
                InfolistSection::make([
                        Group::make([
                            TextEntry::make('sample.name')->label('Sample Name'),
                            TextEntry::make('sample.type.name')->label('Type Sample'),
                            ImageEntry::make('sample.image')->label('Sample Image')
                        ])->columns(2),
                        ])->label('Sample Details'),

            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
            RelationManagers\FeedbacksRelationManager::class,
        ];
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListShipments::route('/'),
            'create' => Pages\CreateShipment::route('/create'),
            'edit' => Pages\EditShipment::route('/{record}/edit'),
            'view' => Pages\ViewShipment::route('/{record}'),
        ];
    }
}

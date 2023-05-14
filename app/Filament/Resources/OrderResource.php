<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Order;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\OrderResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\OrderResource\RelationManagers;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('status')
                ->options([
                    'pending' => 'Pending',
                    'processing' => 'Processing',
                    'completed' => 'Completed',
                    'canceled' => 'Canceled',
                ])
                ->required(),
                Forms\Components\Fieldset::make('user_id')
                ->label('Customer')
                ->relationship('user')
                ->schema([
                   Forms\Components\TextInput::make('name')->disabled(),
                   Forms\Components\TextInput::make('email')->disabled(),
                   Forms\Components\TextInput::make('billingDetails.phone')->disabled(),
                   Forms\Components\TextInput::make('billingDetails.billing_address')->disabled(),
                   Forms\Components\TextInput::make('billingDetails.city')->disabled(),
                   Forms\Components\TextInput::make('billingDetails.country')->disabled(),
                   Forms\Components\TextInput::make('billingDetails.state')->disabled(),
                   Forms\Components\TextInput::make('billingDetails.zipcode')->disabled(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->searchable()->label('Customer name'),
                Tables\Columns\TextColumn::make('user.email')->searchable()->label('Customer Email')->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                ->label('Order status')
                ->enum([
                    'pending' => 'Pending',
                    'processing' => 'Processing',
                    'completed' => 'Completed',
                    'canceled' => 'Canceled',
                ])
                ->colors([
                    'secondary' => 'pending',
                    'warning' => 'processing',
                    'success' => 'completed',
                    'danger' => 'canceled',
                ])
                ->sortable(),
                Tables\Columns\TextColumn::make('total')->prefix('$')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->sortable()->date('M d H:i'),
                Tables\Columns\TextColumn::make('updated_at')->sortable()->date('M d H:i'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}

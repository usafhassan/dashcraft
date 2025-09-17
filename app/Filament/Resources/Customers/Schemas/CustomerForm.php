<?php

namespace App\Filament\Resources\Customers\Schemas;

use App\Models\Persona;
use App\Models\Tag;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\KeyValue;
use Filament\Schemas\Schema;

class CustomerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic Information')
                    ->description('Customer contact details and basic information')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        TextInput::make('mobile')
                            ->tel()
                            ->maxLength(20),

                        Select::make('classification')
                            ->options([
                                'existing' => 'Existing Customer',
                                'potential' => 'Potential Customer',
                                'conquest' => 'Conquest Target',
                            ])
                            ->required()
                            ->default('potential')
                            ->native(false),

                        Toggle::make('is_active')
                            ->default(true)
                            ->label('Active Customer'),
                    ])
                    ->columns(2),

                Section::make('Address Information')
                    ->schema([
                        Textarea::make('address')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),

                Section::make('Personas')
                    ->description('Assign customer personas with confidence scores')
                    ->schema([
                        Select::make('personas')
                            ->relationship('personas', 'name')
                            ->multiple()
                            ->preload()
                            ->searchable()
                            ->columnSpanFull()
                            ->helperText('Select personas that best describe this customer'),
                    ])
                    ->collapsible(),

                Section::make('Tags')
                    ->description('Apply tags for segmentation and opportunities')
                    ->schema([
                        Select::make('tags')
                            ->relationship('tags', 'name')
                            ->multiple()
                            ->preload()
                            ->searchable()
                            ->columnSpanFull()
                            ->helperText('Apply relevant tags for customer segmentation'),
                    ])
                    ->collapsible(),

                Section::make('Additional Data')
                    ->description('Flexible metadata storage')
                    ->schema([
                        KeyValue::make('metadata')
                            ->keyLabel('Field')
                            ->valueLabel('Value')
                            ->columnSpanFull()
                            ->helperText('Store additional customer information as key-value pairs'),
                    ])
                    ->collapsible(),
            ]);
    }
}
<?php

namespace App\Filament\Resources\Tags\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\TextInput\Input;
use Filament\Schemas\Schema;

class TagForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic Information')
                    ->description('Tag name, description, and type')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->rows(3)
                            ->columnSpanFull(),

                        Select::make('type')
                            ->options([
                                'opportunity' => 'Opportunity',
                                'activation' => 'Activation',
                                'behavioral' => 'Behavioral',
                                'demographic' => 'Demographic',
                            ])
                            ->required()
                            ->default('opportunity')
                            ->native(false),

                        ColorPicker::make('color')
                            ->default('#10B981')
                            ->helperText('Color for badges and UI elements'),

                        TextInput::make('priority')
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->maxValue(100)
                            ->helperText('Higher numbers = higher priority'),

                        Toggle::make('is_active')
                            ->default(true)
                            ->label('Active Tag'),

                        Toggle::make('auto_apply')
                            ->default(false)
                            ->label('Auto Apply')
                            ->helperText('Automatically apply this tag based on activation rules'),
                    ])
                    ->columns(2),

                Section::make('Activation Rules')
                    ->description('Define rules for automatic tag application')
                    ->schema([
                        KeyValue::make('activation_rules')
                            ->keyLabel('Rule Name')
                            ->valueLabel('Rule Configuration')
                            ->columnSpanFull()
                            ->helperText('Define JSON rules for automatic tagging. Example: {"field": "classification", "operator": "equals", "value": "existing"}'),
                    ])
                    ->collapsible()
                    ->visible(fn ($get) => $get('auto_apply')),
            ]);
    }
}
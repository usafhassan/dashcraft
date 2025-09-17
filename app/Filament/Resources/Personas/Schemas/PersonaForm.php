<?php

namespace App\Filament\Resources\Personas\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\ColorPicker;
use Filament\Schemas\Schema;

class PersonaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic Information')
                    ->description('Persona name and description')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->rows(3)
                            ->columnSpanFull(),

                        ColorPicker::make('color')
                            ->default('#3B82F6')
                            ->helperText('Color for badges and UI elements'),

                        Toggle::make('is_active')
                            ->default(true)
                            ->label('Active Persona'),
                    ])
                    ->columns(2),

                Section::make('Family Information')
                    ->description('Family demographics and characteristics')
                    ->schema([
                        KeyValue::make('family_info')
                            ->keyLabel('Family Attribute')
                            ->valueLabel('Value')
                            ->columnSpanFull()
                            ->helperText('e.g., family_size: "4", children_ages: "8,12", marital_status: "married"'),
                    ])
                    ->collapsible(),

                Section::make('Occupation Information')
                    ->description('Professional and career details')
                    ->schema([
                        KeyValue::make('occupation_info')
                            ->keyLabel('Occupation Attribute')
                            ->valueLabel('Value')
                            ->columnSpanFull()
                            ->helperText('e.g., industry: "Technology", job_title: "Software Engineer", income_range: "$80k-120k"'),
                    ])
                    ->collapsible(),

                Section::make('Recreation & Hobbies')
                    ->description('Leisure activities and interests')
                    ->schema([
                        KeyValue::make('recreation_info')
                            ->keyLabel('Recreation Attribute')
                            ->valueLabel('Value')
                            ->columnSpanFull()
                            ->helperText('e.g., hobbies: "Photography, Hiking", sports: "Tennis", entertainment: "Movies, Books"'),
                    ])
                    ->collapsible(),

                Section::make('Motivation & Goals')
                    ->description('What drives this persona')
                    ->schema([
                        KeyValue::make('motivation_info')
                            ->keyLabel('Motivation Attribute')
                            ->valueLabel('Value')
                            ->columnSpanFull()
                            ->helperText('e.g., primary_goals: "Career Growth", values: "Work-Life Balance", pain_points: "Time Management"'),
                    ])
                    ->collapsible(),

                Section::make('Animals & Pets')
                    ->description('Pet preferences and animal interests')
                    ->schema([
                        KeyValue::make('animals_info')
                            ->keyLabel('Animal Attribute')
                            ->valueLabel('Value')
                            ->columnSpanFull()
                            ->helperText('e.g., pets: "Dog", pet_preferences: "Large Breeds", animal_interests: "Wildlife Conservation"'),
                    ])
                    ->collapsible(),

                Section::make('Favorite Teams')
                    ->description('Sports teams and affiliations')
                    ->schema([
                        KeyValue::make('favorite_teams')
                            ->keyLabel('Sport/League')
                            ->valueLabel('Team')
                            ->columnSpanFull()
                            ->helperText('e.g., football: "Manchester United", basketball: "Lakers", baseball: "Yankees"'),
                    ])
                    ->collapsible(),
            ]);
    }
}
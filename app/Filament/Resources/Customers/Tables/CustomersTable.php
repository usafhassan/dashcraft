<?php

namespace App\Filament\Resources\Customers\Tables;

use App\Models\Customer;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CustomersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('Email copied')
                    ->copyMessageDuration(1500),

                TextColumn::make('mobile')
                    ->searchable()
                    ->placeholder('Not provided')
                    ->width('120px'),

                BadgeColumn::make('classification')
                    ->colors([
                        'success' => 'existing',
                        'warning' => 'potential',
                        'danger' => 'conquest',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'existing' => 'Existing',
                        'potential' => 'Potential',
                        'conquest' => 'Conquest',
                        default => ucfirst($state),
                    })
                    ->width('120px'),

                TextColumn::make('personas.name')
                    ->badge()
                    ->separator(',')
                    ->limit(5)
                    ->placeholder('No personas')
                    ->wrap()
                    ->width('90px'),

                TextColumn::make('tags.name')
                    ->badge()
                    ->separator(',')
                    ->limit(8)
                    ->placeholder('No tags')
                    ->wrap()
                    ->width('90px'),

                IconColumn::make('is_active')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->width('80px'),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('classification')
                    ->options([
                        'existing' => 'Existing Customer',
                        'potential' => 'Potential Customer',
                        'conquest' => 'Conquest Target',
                    ])
                    ->multiple(),

                SelectFilter::make('is_active')
                    ->options([
                        true => 'Active',
                        false => 'Inactive',
                    ]),

                Filter::make('has_personas')
                    ->query(fn (Builder $query): Builder => $query->whereHas('personas'))
                    ->toggle(),

                Filter::make('has_tags')
                    ->query(fn (Builder $query): Builder => $query->whereHas('tags'))
                    ->toggle(),

                Filter::make('high_value')
                    ->query(fn (Builder $query): Builder => $query->where('classification', 'existing'))
                    ->toggle(),

                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->paginated([10, 25, 50, 100]);
    }
}
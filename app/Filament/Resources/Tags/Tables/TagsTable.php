<?php

namespace App\Filament\Resources\Tags\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TagsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('description')
                    ->limit(50)
                    ->placeholder('No description')
                    ->searchable(),

                BadgeColumn::make('type')
                    ->colors([
                        'success' => 'opportunity',
                        'primary' => 'activation',
                        'warning' => 'behavioral',
                        'secondary' => 'demographic',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'opportunity' => 'Opportunity',
                        'activation' => 'Activation',
                        'behavioral' => 'Behavioral',
                        'demographic' => 'Demographic',
                        default => ucfirst($state),
                    }),

                ColorColumn::make('color')
                    ->label('Color'),

                TextColumn::make('priority')
                    ->sortable()
                    ->alignCenter(),

                TextColumn::make('customers_count')
                    ->label('Customers')
                    ->counts('customers')
                    ->sortable(),

                TextColumn::make('customer_percentage')
                    ->label('Coverage')
                    ->getStateUsing(function ($record) {
                        return $record->getCustomerPercentage() . '%';
                    })
                    ->sortable(),

                IconColumn::make('auto_apply')
                    ->boolean()
                    ->trueIcon('heroicon-o-cog-6-tooth')
                    ->falseIcon('heroicon-o-hand-raised')
                    ->trueColor('warning')
                    ->falseColor('gray'),

                IconColumn::make('is_active')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

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
                SelectFilter::make('type')
                    ->options([
                        'opportunity' => 'Opportunity',
                        'activation' => 'Activation',
                        'behavioral' => 'Behavioral',
                        'demographic' => 'Demographic',
                    ])
                    ->multiple(),

                Filter::make('auto_apply')
                    ->query(fn (Builder $query): Builder => $query->where('auto_apply', true))
                    ->toggle(),

                Filter::make('high_priority')
                    ->query(fn (Builder $query): Builder => $query->where('priority', '>=', 50))
                    ->toggle(),

                Filter::make('has_customers')
                    ->query(fn (Builder $query): Builder => $query->whereHas('customers'))
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
            ->defaultSort('priority', 'desc')
            ->striped()
            ->paginated([10, 25, 50]);
    }
}
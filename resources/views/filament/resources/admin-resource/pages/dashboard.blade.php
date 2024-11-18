{{-- <x-filament-panels::page>

</x-filament-panels::page> --}}
@extends('filament::page')

@section('content')
    <x-filament::widgets :widgets="$this->getWidgets()" />
@endsection

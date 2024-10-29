@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Search Results for "{{ $query }}"</h1>

        @if (count($results) > 0)
            <ul>
                @foreach ($results as $result)
                    <li>
                        <a href="{{ $result['url'] }}">{{ $result['filename'] }}</a>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No results found for your query.</p>
        @endif
    </div>
@endsection

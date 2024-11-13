@extends('layouts.app')

@section('content')
<div class="container search-results">
    <h2>Search Results for "{{ $query }}"</h2>

    @if (empty($results))
    <p>No results found for "{{ $query }}". Please try another search.</p>
    @else
    <ul class="results-list">
        @foreach ($results as $result)
        <li class="result-item" title="{{ $result['preview'] }}">
            <a href="{{ $result['url'] }}" class="result-link">
                <i class="fa fa-file-code-o"></i> {{ $result['friendly_name'] }}
            </a>
        </li>
        @endforeach
    </ul>
    @endif
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container article">
    <h1>Gutenberg Random Book - Karaoke Style</h1>
    <p>This page fetches a random public domain text from Project Gutenberg (via the backend) and displays it word by word.</p>

    <div id="bookInfo">Loading a random Gutenberg book...</div>
    <div id="controlPanel" style="margin:10px 0;">
        <label for="speed">Speed (WPM):</label>
        <input type="range" id="speed" min="60" max="600" value="200" />

        <label for="chapterSelect">Chapter:</label>
        <select id="chapterSelect"></select>

        <button id="jumpBackBtn">Jump Back 50 Words</button>
    </div>
    <div id="displayArea"
        style="
             padding:20px; 
             height:300px; 
             overflow:auto; 
             display:flex; 
             align-items:center; 
             justify-content:center; 
             font-size:5em; 
             text-align:center;">
    </div>
    <div id="error" style="color:red;"></div>
</div>
@endsection
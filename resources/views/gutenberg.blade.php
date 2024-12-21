@extends('layouts.app')

@section('content')
<div id="gutenberg-page" class="container article">
    <h1>Gutenberg Random Book - Karaoke Style</h1>
    <p>This page fetches a random public domain text from Project Gutenberg and displays it word by word.</p>

    <div id="bookInfo">Loading a random Gutenberg book...</div>
    <div id="controlPanel" style="margin:10px 0;">
        <label for="speed" id="speedLabel">Speed 200 WPM:</label>
        <input type="range" id="speed" min="60" max="600" value="200" />
        <button id="stopBtn">Stop</button>
        <button id="startBtn">Start</button>
    </div>

    <div id="displayArea"></div>

    <div id="error" style="color:red;"></div>
</div>
@endsection
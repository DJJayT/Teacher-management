@extends('layouts.sidebar')
@section('extra-css')
    <link rel="stylesheet" href="/public/css/SickDaysOverview.css">
@endsection
@section('title')
    {{ __('Sick Days') }}
@endsection

@section('extra-content')
    <h1>Übersicht Krankheit</h1>

    <div class="container">
        <div class="btn-element">
            1.1.2023
            Test
        </div>
        <button class="btn-element">
            <div class="btn-content">
                <p>2.1.2023</p>
                <p>Test</p>
            </div>
        </button>
        <button class="btn-element">
            <div class="btn-content">
                <p>3.1.2023</p>
                <p>Test</p>
            </div>
        </button>
        <button class="btn-element">
            <div class="btn-content">
                <p>4.1.2023</p>
                <p>Test</p>
            </div>
        </button>
        <button class="btn-element">
            <div class="btn-content">
                <p>5.1.2023</p>
                <p>Test</p>
            </div>
        </button>
        <button class="btn-element">
            <div class="btn-content">
                <p>6.1.2023</p>
                <p>Test</p>
            </div>
        </button>
        <button class="btn-element">
            <div class="btn-content">
                <p>7.1.2023</p>
                <p>Test</p>
            </div>
        </button>
    </div>

    <!-- <table class="table">
        <thead>
        <tr>
            <th scope="col">Vom</th>
            <th scope="col">Bis</th>
            <th scope="col">Unterrichtstage</th>
            <th scope="col">Gesamttage</th>
            <th scope="col">Grund</th>
            <th scope="col">Bescheinigung liegt vor</th>
            <th scope="col">Bescheinigung ab</th>
            <th scope="col">Krankenhaus</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
            <td>@mdo</td>
            <td>@mdo</td>
            <td>@mdo</td>
            <td>@mdo</td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
            <td>@mdo</td>
            <td>@mdo</td>
            <td>@mdo</td>
            <td>@mdo</td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
            <td>@mdo</td>
            <td>@mdo</td>
            <td>@mdo</td>
            <td>@mdo</td>
        </tr>
        </tbody>
    </table>
    -->

@endsection

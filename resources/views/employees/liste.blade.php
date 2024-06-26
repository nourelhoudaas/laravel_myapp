@extends('base')

@section('title', 'Employees')

@section('content')

<body>
    <div class="container2">
         <!-- start section aside -->
         @include('./navbar.sidebar')
            <!-- end section aside -->

            <!-- main section start -->
            <main>
            <div class="recent_order">
                    <h1>List Employees</h1>
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>First Name</th>
                                <th>Job</th>
                                <th>Direction</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td><a href="#">Mini USB</a></td>
                                <td>456</td>
                                <td>due</td>
                                <td>Personnel</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </main>
    </div>
</body>
@endsection

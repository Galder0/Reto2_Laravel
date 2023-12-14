<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin menu</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            height: 100vh;
            overflow: hidden;
        }

        #wrapper {
            display: flex;
            height: 100vh;
        }

        #sidebar {
            width: 250px;
            background-color: #343a40;
            color: #fff;
            padding: 20px;
            height: 100%;
            box-sizing: border-box;
        }

        #content {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            box-sizing: border-box;
        }

        /* Add your own styles as needed */

        #content ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        #content li {
            margin-bottom: 10px;
        }

        #content a {
            color: #007bff;
            text-decoration: none;
        }

        #content a:hover {
            text-decoration: underline;
        }

        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            justify-content: center;
        }

        .btn {
            display: block;
            padding: .5rem .75rem;
            line-height: 1.25;
            color: #007bff;
            background-color: #fff;
            border: 1px solid #dee2e6;
            margin: 0 5px;
            text-align: center;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .btn:hover {
            z-index: 2;
            color: #0056b3;
            text-decoration: none;
            background-color: #e9ecef;
            border-color: #dee2e6;
        }

        .btn.active {
            z-index: 3;
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }

        .disabled.btn {
            cursor: not-allowed;
            color: #6c757d;
            background-color: #fff;
            border: 1px solid #dee2e6;
        }
    </style>
</head>

<body>
    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar">
            <h2>Admin</h2>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="#">Option 1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Option 2</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Option 3</a>
                </li>
            </ul>
        </div>

        <!-- Page Content -->
        
        <div id="content">
            <h2>Users</h2>
            <div>
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="pagination">
                    @if ($users->onFirstPage())
                        <span class="disabled btn">First</span>
                        <span class="disabled btn">Previous</span>
                    @else
                        <a href="{{ $users->url(1) }}" class="btn">First</a>
                        <a href="{{ $users->previousPageUrl() }}" rel="prev" class="btn">Previous</a>
                    @endif

                    @php
                        $lastPage = $users->lastPage();
                        $currentPage = $users->currentPage();
                        $visiblePages = min(5, $lastPage);
                        $startPage = max(1, min($currentPage, $lastPage - $visiblePages + 1));
                        $endPage = min($startPage + $visiblePages - 1, $lastPage);
                    @endphp

                    @for ($page = $startPage; $page <= $endPage; $page++)
                        <a href="{{ $users->url($page) }}" class="btn{{ ($currentPage == $page) ? ' active' : '' }}">{{ $page }}</a>
                    @endfor

                    @if ($users->hasMorePages())
                        <a href="{{ $users->nextPageUrl() }}" rel="next" class="btn">Next</a>
                        <a href="{{ $users->url($lastPage) }}" class="btn">Last</a>
                    @else
                        <span class="disabled btn">Next</span>
                        <span class="disabled btn">Last</span>
                    @endif
                </div>

            </div>
        </div>
    </div>
</body>

</html>

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel-body">
                    <table class="table table-striped task-table">
                        <thead>
                        <th>Title</th>
                        <th>Author</th>
                        <th>ISBN</th>
                        <th>Genre</th>
                        <th>Available</th>
                        </thead>
                        <tbody>
                        @foreach ($books as $book)
                            <tr class='clickable-row' data-href='/book/{{ $book->id }}' role="button">
                                <td class="table-text"><div>{{ $book->title }}</div></td>
                                <td class="table-text"><div>{{ $book->author }}</div></td>
                                <td class="table-text"><div>{{ $book->isbn }}</div></td>
                                <td class="table-text"><div>{{ $book->genre }}</div></td>
                                @if ($book->inStockCopies())
                                    <td><span class="label label-success">Yes</span></td>
                                @else
                                    <td><span class="label label-danger">No</span></td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">{!! $books->links() !!}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- make the rows clickable -->
    <script>
        jQuery(document).ready(function($) {
            $(".clickable-row").click(function() {
                window.document.location = $(this).data("href");
            });
        });
    </script>
@endsection


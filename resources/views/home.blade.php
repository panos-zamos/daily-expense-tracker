@extends('adminlte::page')

@section('title', 'Expenses')

@section('content_header')
    <h1>{{ $user->defaultBudget->name }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <ul class="list-unstyled">
                        @foreach ($user->defaultBudget->latestExpenses as $expense)
                            <li>{{$expense->note}}:@if ($expense->gain) +@else -@endif{{ $expense->amount }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">

                    <form role="form" action="/add_expense" method="post">
                        @csrf
                        <div class="">
                            <div class="input-group">
                                <span class="input-group-addon">amount =</span>
                                <input name="amount" type="text" class="form-control" autofocus>
                            </div>

                            <div class="form-group">
                                <textarea name="note" class="form-control" rows="3" placeholder="Note ..." spellcheck="false"></textarea>
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="">
                            <button type="submit" class="btn btn-danger">Add expense</button>
                            <button type="submit" formaction="/add_gain" class="btn btn-success pull-right">Add gain</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

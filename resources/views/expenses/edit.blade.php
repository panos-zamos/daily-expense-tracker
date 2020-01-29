@extends('adminlte::page')

@section('title', 'Expenses')

@section('content_header')

@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{ $user->defaultBudget->name }}</h3>
                    @php
                        $fmt = numfmt_create( 'sr_SR', NumberFormatter::CURRENCY );
                    @endphp
                    <span class="text-small"> (balance: {{ numfmt_format_currency($fmt, $user->defaultBudget->getBalance()->balance, 'din') }})</span>
                </div>
                <div class="box-body">

                    <table class="table table-striped">
                        <tbody class="tool-list">

                        @foreach ($user->defaultBudget->latestExpenses as $expense)
                            <tr>
                                <td><span class="badge ">{{$expense->user->initials()}}</span></td>
                                <td><a href="/expenses/{{$expense->id}}/edit" class="js-text-link text-decoration-none">{{$expense->note}}</a></td>
                                <td>{{ $expense->created_at->diffForHumans(['parts' => 1,]) }}</td>
                                <td class="@if ($expense->gain) bg-green @else bg-red @endif"><strong class="pull-right">{{ $expense->amount }}</strong></td>
                                <td> <div class="tools"><a href="/expenses/{{$expense->id}}/edit" class="text-decoration-none"><i class="fa fa-edit"></i></a></div></td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Edit expense/gain</h3>
                </div>
                <div class="box-body">

                    <form role="form" action="/expenses/{{$editExpense->id}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="">
                            <div class="form-group">
                                <textarea name="note" class="form-control" rows="3" placeholder="Note ..." spellcheck="false" autofocus>{{$editExpense->note}}</textarea>
                            </div>
                            <div class="input-group form-group">
                                <span class="input-group-addon">amount =</span>
                                <input name="amount" type="text" class="form-control" value="{{$editExpense->amount}}">
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="javascript:history.back()" class="btn btn-default pull-right">Go Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop


@section('css')
    <style type="text/css">
        .tool-list>tr .tools {
            visibility: hidden;
            float: right;
            color: #DD4B39;
        }
        .tool-list>tr:hover .tools {
            visibility: visible;
        }

        .js-text-link {
            text-decoration: none !important;
            cursor: default;
            color: inherit;
        }
        .js-text-link:hover {
            text-decoration: none !important;
            cursor: default;
            color: inherit;
        }
    </style>
@stop

@section('js')
    <script>
        jQuery(function($) {
            $('.js-text-link').click(function() {
                return false;
            }).dblclick(function() {
                window.location = this.href;
                return false;
            });
        });
    </script>
@endsection

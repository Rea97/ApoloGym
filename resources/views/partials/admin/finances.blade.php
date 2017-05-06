<div class="row">
    <!--<div id="incomes-expenses-last-month" style="height: 250px;"></div>-->
    <div class="col-sm-12">
        <!--  Reporte Mensual Panel  -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <i class="fa fa-bar-chart" aria-hidden="true"></i> Reporte Mensual
                    <small>
                        {{ ucfirst($months[$input->get('month', $carbon->now()->month)]) }}
                        {{ $input->get('year', $carbon->now()->year) }}
                    </small>
                </h4>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
                        <form action="" method="get" class="form-inline">
                            <div class="form-group">

                                <select class="form-control" name="month" id="month">
                                    @foreach($months as $number => $month)
                                        <option value="{{ $number }}" {{ \Carbon\Carbon::now()->month === $number ? 'selected' : '' }}>
                                            {{ ucfirst($month) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">

                                <select class="form-control" name="year" id="year">
                                    <option value="2017">2017</option>
                                    <option value="2016">2016</option>
                                    <option value="2015">2015</option>
                                    <option value="2014">2014</option>
                                    <option value="2013">2013</option>
                                    <option value="2012">2012</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" id="search"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Ingresos</th>
                                <td>$ {{ $stats['incomes'] }}</td>
                            </tr>
                            <tr>
                                <th>Gastos</th>
                                <td>$ {{ $stats['expenses'] }}</td>
                            </tr>
                            <tr>
                                <th>Ganancias</th>
                                <td class="{{ $stats['profit'] < 0 ? 'danger' : 'success' }}">$ {{ $stats['profit'] }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Ingresos por categoría</th>
                                <td>$ {{ $stats['incomes'] }}</td>
                            </tr>
                            @forelse($incomesByCategory as $category => $total)
                                <tr>
                                    <th>{{ $category }}</th>
                                    <td>$ {{ $total }}</td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center text-muted">No hay ingresos en esta fecha</td>
                                    </tr>
                            @endforelse
                        </table>
                    </div>
                    <div class="col-md-4">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Gastos por categoría</th>
                                <td>$ {{ $stats['expenses'] }}</td>
                            </tr>
                            @forelse($expensesByCategory as $category => $total)
                                <tr>
                                    <th>{{ $category }}</th>
                                    <td>$ {{ $total }}</td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center text-muted">No hay gastos en esta fecha</td>
                                    </tr>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
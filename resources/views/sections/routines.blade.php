@extends('layouts.dashboard')

@section('title', 'Rutinas')
@section('content')
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a style="text-decoration: none"
                       role="button"
                       data-toggle="collapse"
                       data-parent="#accordion"
                       href="#collapseOne"
                       aria-expanded="true"
                       aria-controls="collapseOne">
                        Lunes <small><i class="fa fa-calendar"></i> 20-03-17</small>
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <!--<div class="panel-body"></div>-->
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Ejercicio</th>
                            <th>Músculo ejercitado</th>
                            <th>Series</th>
                            <th>Repeticiones</th>
                            <th>Peso</th>
                            <th>Hecho</th>
                        </tr>
                        <tr>
                            <td>Press de banca</td>
                            <td>Pectorales</td>
                            <td>3</td>
                            <td>8</td>
                            <td>60 lbs.</td>
                            <td><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td>Press militar</td>
                            <td>Deltoides</td>
                            <td>3</td>
                            <td>6</td>
                            <td>45 lbs.</td>
                            <td><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td>Press francés</td>
                            <td>triceps</td>
                            <td>3</td>
                            <td>10</td>
                            <td>30 lbs.</td>
                            <td><input type="checkbox"></td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title">
                    <a style="text-decoration: none"
                       class="collapsed"
                       role="button"
                       data-toggle="collapse"
                       data-parent="#accordion"
                       href="#collapseTwo"
                       aria-expanded="false"
                       aria-controls="collapseTwo">
                        Martes <small><i class="fa fa-calendar"></i> 21-03-17</small>
                    </a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                    <h2>
                        <small><i class="fa fa-smile-o"></i></small> ¡Libre! <small><i class="fa fa-smile-o"></i></small>
                    </h2>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingThree">
                <h4 class="panel-title">
                    <a style="text-decoration: none"
                       class="collapsed"
                       role="button"
                       data-toggle="collapse"
                       data-parent="#accordion"
                       href="#collapseThree"
                       aria-expanded="false"
                       aria-controls="collapseThree">
                        Miercoles <small><i class="fa fa-calendar"></i> 22-03-17</small>
                    </a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                <!--<div class="panel-body"></div>-->
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Ejercicio</th>
                            <th>Músculo ejercitado</th>
                            <th>Series</th>
                            <th>Repeticiones</th>
                            <th>Peso</th>
                            <th>Hecho</th>
                        </tr>
                        <tr>
                            <td>Sentadillas con barra olímpica</td>
                            <td>pierna</td>
                            <td>3</td>
                            <td>6</td>
                            <td>60 lbs.</td>
                            <td><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td>curl de biceps con barra</td>
                            <td>Biceps braquial</td>
                            <td>3</td>
                            <td>10</td>
                            <td>20 lbs.</td>
                            <td><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td>Remo horizontal con mancuerna</td>
                            <td>Dorsal ancho</td>
                            <td>4</td>
                            <td>8</td>
                            <td>30 lbs.</td>
                            <td><input type="checkbox"></td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingFour">
                <h4 class="panel-title">
                    <a style="text-decoration: none"
                       class="collapsed"
                       role="button"
                       data-toggle="collapse"
                       data-parent="#accordion"
                       href="#collapseFour"
                       aria-expanded="false"
                       aria-controls="collapseFive">
                        Jueves <small><i class="fa fa-calendar"></i> 23-03-17</small>
                    </a>
                </h4>
            </div>
            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                <div class="panel-body">
                    <h2>
                        <small><i class="fa fa-smile-o"></i></small> ¡Libre! <small><i class="fa fa-smile-o"></i></small>
                    </h2>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingFive">
                <h4 class="panel-title">
                    <a style="text-decoration: none"
                       class="collapsed"
                       role="button"
                       data-toggle="collapse"
                       data-parent="#accordion"
                       href="#collapseFive"
                       aria-expanded="false"
                       aria-controls="collapseFive">
                        Viernes <small><i class="fa fa-calendar"></i> 24-03-17</small>
                    </a>
                </h4>
            </div>
            <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                <!--<div class="panel-body"></div>-->
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Ejercicio</th>
                            <th>Músculo ejercitado</th>
                            <th>Series</th>
                            <th>Repeticiones</th>
                            <th>Peso</th>
                            <th>Hecho</th>
                        </tr>
                        <tr>
                            <td>Press de banca</td>
                            <td>Pectorales</td>
                            <td>3</td>
                            <td>8</td>
                            <td>60 lbs.</td>
                            <td><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td>Press militar</td>
                            <td>Deltoides</td>
                            <td>3</td>
                            <td>6</td>
                            <td>45 lbs.</td>
                            <td><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td>Press francés</td>
                            <td>triceps</td>
                            <td>3</td>
                            <td>10</td>
                            <td>30 lbs.</td>
                            <td><input type="checkbox"></td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingSix">
                <h4 class="panel-title">
                    <a style="text-decoration: none"
                       class="collapsed"
                       role="button"
                       data-toggle="collapse"
                       data-parent="#accordion"
                       href="#collapseSix"
                       aria-expanded="false"
                       aria-controls="collapseSix">
                        Sabado <small><i class="fa fa-calendar"></i> 25-03-17</small>
                    </a>
                </h4>
            </div>
            <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
                <div class="panel-body">
                    <h2>
                        <small><i class="fa fa-smile-o"></i></small> ¡Libre! <small><i class="fa fa-smile-o"></i></small>
                    </h2>
                </div>
            </div>
        </div>
    </div>

@endsection
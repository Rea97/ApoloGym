<template>
    <div id="instructor-component">
        <div class="row">
            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-user"></i> {{ instructor.name }}
                    </div>
                    <div class="panel-body">
                        <div class="text-center">
                            <img class="img img-responsive img-thumbnail" :src="getProfilePictureUrl" :alt="instructor.name">
                        </div>
                        <div class="divider"></div>
                        <!--<h4>
                            <i class="fa fa-history" aria-hidden="true"></i> Resumen
                        </h4>-->
                        <div class="list-group">
                            <div class="list-group-item">
                                <div class="list-group-heading">
                                    <h4><i class="fa fa-book" aria-hidden="true"></i> Biografía</h4>
                                </div>
                                <div class="list-group-item-text">
                                    <p v-if="instructor.about_me" class="text-justify">{{ instructor.about_me }}</p>
                                    <p v-else><i>No tiene.</i></p>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="list-group-heading">
                                    <h4><i class="fa fa-users" aria-hidden="true"></i> Clientes que instruye</h4>
                                </div>
                                <div class="list-group-item-text">
                                    <div v-if="clients.length > 0">
                                        <ul>
                                            <li v-for="client in clients">
                                                <a :href="'/dashboard/clientes/'+client.id">
                                                    {{ client.name }} {{ client.first_surname }}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div v-else>
                                        <p><i>No hay clientes asignados.</i></p>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="list-group-item-heading">
                                    <h4><i class="fa fa-calendar" aria-hidden="true"></i> Instructor desde</h4>
                                </div>
                                <div class="list-group-item-text">{{ instructorSince }}</div>

                            </div>
                        </div>
                        <div class="divider"></div>
                        <div id="options">
                            <div v-if="isAdmin && !onEdit">
                                <button @click="editMode" class="btn btn-block btn-info" id="edit-data">
                                    <i class="fa fa-edit" aria-hidden="true"></i> Editar Información
                                </button>
                                <button @click="deleteData" class="btn btn-block btn-danger" id="delete-data">
                                    <i class="fa fa-trash" aria-hidden="true"></i> Eliminar Instructor
                                </button>
                            </div>
                            <div v-else>
                                <button @click="updateData" class="btn btn-block btn-success">
                                    <!-- Al ser presionado activará la función que envía una petición put ajax para
                                     guardar los cambios realizados en el modelo client-->
                                    <span v-if="saving"><i class="fa fa-pulse fa-spinner" aria-hidden="true"></i> Guardando...</span>
                                    <span v-else><i class="fa fa-save" aria-hidden="true"></i> Guardar</span>

                                </button>

                                <!-- Hacer que solo aparezca cuando algun campo del modelo cambie, usar watchers -->
                                <button @click="resetData" class="btn btn-block btn-warning">
                                    <!-- Al ser presionado activará la función que envía una petición ajax para obtener
                                     el cliente en cuestion-->
                                    <i class="fa fa-times-circle" aria-hidden="true"></i> Cancelar
                                </button>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-book"></i> Datos personales
                            </div>
                            <div class="panel-body">
                                <h4><i class="fa fa-user-circle" aria-hidden="true"></i> Nombre(s)</h4>
                                <!--<div class="input-group">
                                    <input class="form-control" type="text" :value="client.name">
                                    <span class="input-group-btn">
                                    <button class="btn btn-success"><i class="fa fa-check-circle" aria-hidden="true"></i></button>
                                </span>
                                </div>-->
                                <input v-if="onEdit" v-model="instructor.name" type="text" class="form-control">
                                <div v-else>
                                    <p>{{ instructor.name }}</p>
                                    <div class="divider"></div>
                                </div>
                                <h4><i class="fa fa-users" aria-hidden="true"></i> Apellido paterno</h4>
                                <input v-if="onEdit" v-model="instructor.first_surname" type="text" class="form-control">
                                <div v-else>
                                    <p>{{ instructor.first_surname }}</p>
                                    <div class="divider"></div>
                                </div>
                                <h4><i class="fa fa-users" aria-hidden="true"></i> Apellido materno</h4>
                                <input v-if="onEdit" v-model="instructor.second_surname" type="text" class="form-control">
                                <div v-else>
                                    <p v-if="instructor.second_surname">{{ instructor.second_surname }}</p>
                                    <p v-else><i>No tiene</i></p>
                                    <div class="divider"></div>
                                </div>
                                <h4>
                                    <i class="fa"
                                       :class="getGenderIcon"
                                       aria-hidden="true"></i>
                                    Género
                                </h4>
                                <select v-if="onEdit" v-model="instructor.gender" type="text" class="form-control">
                                    <option value="m">Masculino</option>
                                    <option value="f">Femenino</option>
                                </select>
                                <div v-else>
                                    <p>{{ getGender }}</p>
                                    <div class="divider"></div>
                                </div>
                                <h4><i class="fa fa-calendar" aria-hidden="true"></i> Fecha de nacimiento</h4>
                                <input v-if="onEdit" v-model="instructor.birth_date" type="date" class="form-control">
                                <div v-else>
                                    <p>{{ instructor.birth_date }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="sol-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-credit-card"></i> Datos financieros
                                </div>
                                <div class="panel-body">
                                    <h4><i class="fa fa-money" aria-hidden="true"></i> Salario <small>semanal</small></h4>
                                    <input v-if="onEdit" v-model="instructor.salary" type="text" class="form-control">
                                    <div v-else>
                                        <p v-if="instructor.salary">$ {{ instructor.salary }}</p>
                                        <p v-else><i>No tiene</i></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sol-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-address-book"></i> Datos de contácto
                                </div>
                                <div class="panel-body">
                                    <h4><i class="fa fa-map-marker" aria-hidden="true"></i> Dirección</h4>
                                    <input v-if="onEdit" v-model="instructor.address" type="text" class="form-control">
                                    <div v-else>
                                        <p>{{ instructor.address }}</p>
                                        <div class="divider"></div>
                                    </div>
                                    <h4><i class="fa fa-phone" aria-hidden="true"></i> Teléfono</h4>
                                    <input v-if="onEdit" v-model="instructor.phone_number" type="text" class="form-control">
                                    <div v-else>
                                        <p>{{ instructor.phone_number }}</p>
                                        <div class="divider"></div>
                                    </div>
                                    <h4><i class="fa fa-at" aria-hidden="true"></i> E-mail</h4>
                                    <input v-if="onEdit" v-model="instructor.email" type="text" class="form-control">
                                    <div v-else>
                                        <p>{{ instructor.email }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-clock-o"></i> Horario
                            </div>
                            <div v-if="onEdit" class="panel-body">
                                <!--<div class="form-inline">
                                    <div class="form-group">
                                        <label for="monday-from">Lunes </label>
                                        <input :value="formatTime(schedule.monday.from)" type="time" class="form-control" id="monday-from" name="monday-from">
                                        -
                                        <input type="time" class="form-control" id="monday-to" name="monday-to">
                                    </div>
                                </div>-->

                                <div class="form-horizontal">
                                    <!-- Monday -->
                                    <div class="form-group">
                                        <label for="monday-from" class="col-xs-12 col-sm-2 control-label">Lunes</label>
                                        <div class="col-xs-6 col-sm-4">
                                            <input v-model="schedule.monday.from" :value="formatTime(schedule.monday.from)" type="time" class="form-control" id="monday-from" name="monday-from">
                                        </div>
                                        <div class="hidden-xs col-sm-1"><sub>-</sub></div>
                                        <div class="col-xs-6 col-sm-4">
                                            <input v-model="schedule.monday.to" :value="formatTime(schedule.monday.to)" type="time" class="form-control" id="monday-to" name="monday-to">
                                        </div>
                                        <div class="hidden-xs col-lg-offset-1"></div>
                                    </div>
                                    <!-- Tuesday -->
                                    <div class="form-group">
                                        <label for="monday-from" class="col-xs-12 col-sm-2 control-label">Martes</label>
                                        <div class="col-xs-6 col-sm-4">
                                            <input v-model="schedule.tuesday.from" :value="formatTime(schedule.tuesday.from)" type="time" class="form-control" id="tuesday-from" name="tuesday-from">
                                        </div>
                                        <div class="hidden-xs col-sm-1"><sub>-</sub></div>
                                        <div class="col-xs-6 col-sm-4">
                                            <input v-model="schedule.tuesday.to" :value="formatTime(schedule.tuesday.to)" type="time" class="form-control" id="tuesday-to" name="tuesday-to">
                                        </div>
                                        <div class="hidden-xs col-lg-offset-1"></div>
                                    </div>
                                    <!-- Wednesday -->
                                    <div class="form-group">
                                        <label for="monday-from" class="col-xs-12 col-sm-2 control-label">Miercoles</label>
                                        <div class="col-xs-6 col-sm-4">
                                            <input v-model="schedule.wednesday.from" :value="formatTime(schedule.wednesday.from)" type="time" class="form-control" id="wednesday-from" name="wednesday-from">
                                        </div>
                                        <div class="hidden-xs col-sm-1"><sub>-</sub></div>
                                        <div class="col-xs-6 col-sm-4">
                                            <input v-model="schedule.wednesday.to" :value="formatTime(schedule.wednesday.to)" type="time" class="form-control" id="wednesday-to" name="wednesday-to">
                                        </div>
                                        <div class="hidden-xs col-lg-offset-1"></div>
                                    </div>
                                    <!-- Thursday -->
                                    <div class="form-group">
                                        <label for="monday-from" class="col-xs-12 col-sm-2 control-label">Jueves</label>
                                        <div class="col-xs-6 col-sm-4">
                                            <input v-model="schedule.thursday.from" :value="formatTime(schedule.thursday.from)" type="time" class="form-control" id="thursday-from" name="thursday-from">
                                        </div>
                                        <div class="hidden-xs col-sm-1"><sub>-</sub></div>
                                        <div class="col-xs-6 col-sm-4">
                                            <input v-model="schedule.thursday.to" :value="formatTime(schedule.thursday.to)" type="time" class="form-control" id="thursday-to" name="thursday-to">
                                        </div>
                                        <div class="hidden-xs col-lg-offset-1"></div>
                                    </div>
                                    <!-- Friday -->
                                    <div class="form-group">
                                        <label for="monday-from" class="col-xs-12 col-sm-2 control-label">Viernes</label>
                                        <div class="col-xs-6 col-sm-4">
                                            <input v-model="schedule.friday.from" :value="formatTime(schedule.friday.from)" type="time" class="form-control" id="friday-from" name="friday-from">
                                        </div>
                                        <div class="hidden-xs col-sm-1"><sub>-</sub></div>
                                        <div class="col-xs-6 col-sm-4">
                                            <input v-model="schedule.friday.to" :value="formatTime(schedule.friday.to)" type="time" class="form-control" id="friday-to" name="friday-to">
                                        </div>
                                        <div class="hidden-xs col-lg-offset-1"></div>
                                    </div>
                                    <!-- Saturday -->
                                    <div class="form-group">
                                        <label for="monday-from" class="col-xs-12 col-sm-2 control-label">Sábado</label>
                                        <div class="col-xs-6 col-sm-4">
                                            <input v-model="schedule.saturday.from" :value="formatTime(schedule.saturday.from)" type="time" class="form-control" id="saturday-from" name="saturday-from">
                                        </div>
                                        <div class="hidden-xs col-sm-1"><sub>-</sub></div>
                                        <div class="col-xs-6 col-sm-4">
                                            <input v-model="schedule.saturday.to" :value="formatTime(schedule.saturday.to)" type="time" class="form-control" id="saturday-to" name="saturday-to">
                                        </div>
                                        <div class="hidden-xs col-lg-offset-1"></div>
                                    </div>
                                    <!-- Sunday -->
                                    <div class="form-group">
                                        <label for="monday-from" class="col-xs-12 col-sm-2 control-label">Domingo</label>
                                        <div class="col-xs-6 col-sm-4">
                                            <input v-model="schedule.sunday.from" :value="formatTime(schedule.sunday.from)" type="time" class="form-control" id="sunday-from" name="sunday-from">
                                        </div>
                                        <div class="hidden-xs col-sm-1"><sub>-</sub></div>
                                        <div class="col-xs-6 col-sm-4">
                                            <input v-model="schedule.sunday.to" :value="formatTime(schedule.sunday.to)" type="time" class="form-control" id="sunday-to" name="sunday-to">
                                        </div>
                                        <div class="hidden-xs col-lg-offset-1"></div>
                                    </div>
                                    <span class="help-block">Dejar en blanco ambos campos de un día para asignarlo como descanso.</span>
                                </div>





                            </div>
                            <ul v-else class="list-group">
                                <li v-if="schedule.monday.from || schedule.monday.to" class="list-group-item">
                                    <strong>Lunes:</strong> {{ formatTime(schedule.monday.from) }} - {{ formatTime(schedule.monday.to) }}
                                    <span class="badge">{{ schedule.monday.hours }} horas.</span>
                                </li>
                                <li v-else class="list-group">
                                    <i>No tiene actividad.</i>
                                </li>
                                <li v-if="schedule.tuesday.from || schedule.tuesday.to" class="list-group-item">
                                    <strong>Martes:</strong> {{ formatTime(schedule.tuesday.from) }} - {{ formatTime(schedule.tuesday.to) }}
                                    <span class="badge">{{ schedule.tuesday.hours }} horas.</span>
                                </li>
                                <li v-else class="list-group">
                                    <i>No tiene actividad.</i>
                                </li>
                                <li v-if="schedule.wednesday.from || schedule.wednesday.to" class="list-group-item">
                                    <strong>Miercoles:</strong> {{ formatTime(schedule.wednesday.from) }} - {{ formatTime(schedule.wednesday.to) }}
                                    <span class="badge">{{ schedule.wednesday.hours }} horas.</span>
                                </li>
                                <li v-else class="list-group">
                                    <i>No tiene actividad.</i>
                                </li>
                                <li v-if="schedule.thursday.from || schedule.thursday.to" class="list-group-item">
                                    <strong>Jueves:</strong> {{ formatTime(schedule.thursday.from) }} - {{ formatTime(schedule.thursday.to) }}
                                    <span class="badge">{{ schedule.thursday.hours }} horas.</span>
                                </li>
                                <li v-else class="list-group">
                                    <i>No tiene actividad.</i>
                                </li>
                                <li v-if="schedule.friday.from || schedule.friday.to" class="list-group-item">
                                    <strong>Viernes:</strong> {{ formatTime(schedule.friday.from) }} - {{ formatTime(schedule.friday.to) }}
                                    <span class="badge">{{ schedule.friday.hours }} horas.</span>
                                </li>
                                <li v-else class="list-group">
                                    <i>No tiene actividad.</i>
                                </li>
                                <li v-if="schedule.saturday.from || schedule.saturday.to" class="list-group-item">
                                    <strong>Sábado:</strong> {{ formatTime(schedule.saturday.from) }} - {{ formatTime(schedule.saturday.to) }}
                                    <span class="badge">{{ schedule.saturday.hours }} horas.</span>
                                </li>
                                <li v-else class="list-group">
                                    <i>No tiene actividad.</i>
                                </li>
                                <li v-if="schedule.sunday.from || schedule.sunday.to" class="list-group-item">
                                    <strong>Domingo:</strong> {{ formatTime(schedule.sunday.from) }} - {{ formatTime(schedule.sunday.to) }}
                                    <span class="badge">{{ schedule.sunday.hours }} horas.</span>
                                </li>
                                <li v-else class="list-group">
                                    <i>No tiene actividad.</i>
                                </li>
                                <li class="list-group-item">
                                    <strong>Total Trabajado:</strong>
                                    <span class="badge">{{ totalWork }} horas.</span>
                                </li>
                            </ul>
                            <!--
                            <div class="panel-body">
                                <div v-if="onEdit">
                                    Lunes
                                    <input type="time" :value="formatTime(schedule.monday.from)">
                                    a
                                    <input type="time" :value="schedule.monday.to">
                                    <input type="time">

                                </div>
                                <div v-else>
                                    <ul>
                                        <li>Lunes
                                            <ul>
                                                <li v-if="schedule.monday.from || schedule.monday.to">
                                                    {{ formatTime(schedule.monday.from) }} - {{ formatTime(schedule.monday.to) }}
                                                </li>
                                                <li v-else>
                                                    <i>Descansa</i>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>Martes
                                            <ul>
                                                <li>{{ formatTime(schedule.tuesday.from) }} - {{ formatTime(schedule.tuesday.to) }}</li>
                                            </ul>
                                        </li>
                                        <li>Miercoles
                                            <ul>
                                                <li>{{ formatTime(schedule.wednesday.from) }} - {{ formatTime(schedule.wednesday.to) }}</li>
                                            </ul>
                                        </li>
                                        <li>Jueves
                                            <ul>
                                                <li>{{ formatTime(schedule.thursday.from) }} - {{ formatTime(schedule.thursday.to) }}</li>
                                            </ul>
                                        </li>
                                        <li>Viernes
                                            <ul>
                                                <li>{{ formatTime(schedule.friday.from) }} - {{ formatTime(schedule.friday.to) }}</li>
                                            </ul>
                                        </li>
                                        <li>Sabado
                                            <ul>
                                                <li>{{ formatTime(schedule.saturday.from) }} - {{ formatTime(schedule.saturday.to) }}</li>
                                            </ul>
                                        </li>
                                        <li>Domingo
                                            <ul>
                                                <li>{{ formatTime(schedule.sunday.from) }} - {{ formatTime(schedule.sunday.to) }}</li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>


                            </div>
                            -->
                            <!--
                            <div class="table responsive">
                                <table class="table table-hover">
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>email</th>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>oziel</td>
                                        <td>oz@gmail.com</td>
                                    </tr>
                                </table>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <tr class="text-center">
                                        <th>&nbsp;</th>
                                        <th>Lunes</th>
                                        <th>Martes</th>
                                        <th>Miercoles</th>
                                        <th>Jueves</th>
                                        <th>Viernes</th>
                                        <th>Sábado</th>
                                        <th>Domingo</th>
                                    </tr>
                                    <tr>
                                        <th>De</th>
                                        <td>{{ formatTime(schedule.monday.from) }}</td>
                                        <td>{{ formatTime(schedule.tuesday.from) }}</td>
                                        <td>{{ formatTime(schedule.wednesday.from) }}</td>
                                        <td>{{ formatTime(schedule.thursday.from) }}</td>
                                        <td>{{ formatTime(schedule.friday.from) }}</td>
                                        <td>{{ formatTime(schedule.saturday.from) }}</td>
                                        <td>{{ formatTime(schedule.sunday.from) }}</td>
                                    </tr>
                                    <tr>
                                        <th>A</th>
                                        <td>{{ formatTime(schedule.monday.to) }}</td>
                                        <td>{{ formatTime(schedule.tuesday.to) }}</td>
                                        <td>{{ formatTime(schedule.wednesday.to) }}</td>
                                        <td>{{ formatTime(schedule.thursday.to) }}</td>
                                        <td>{{ formatTime(schedule.friday.to) }}</td>
                                        <td>{{ formatTime(schedule.saturday.to) }}</td>
                                        <td>{{ formatTime(schedule.sunday.to) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Horas</th>
                                        <td>{{ schedule.monday.hours }}</td>
                                        <td>{{ schedule.tuesday.hours }}</td>
                                        <td>{{ schedule.wednesday.hours }}</td>
                                        <td>{{ schedule.thursday.hours }}</td>
                                        <td>{{ schedule.friday.hours }}</td>
                                        <td>{{ schedule.saturday.hours }}</td>
                                        <td>{{ schedule.sunday.hours }}</td>
                                    </tr>
                                </table>
                            </div>
                            -->
                        </div>
                    </div>
                </div>
            </div>
        </div>





    </div>
</template>
<script>
    export default {
        props: ['isAdmin', 'deleteInstructor', 'showErrorAlert'],
        mounted() {
            console.log('Componente Instructor montado');
            this.fetchInstructor();
            this.fetchClientsInstructedBy();
        },
        data() {
            return {
                instructor: {},
                schedule: [],
                clients: [],
                onEdit: false,
                saving: false,
                displayResetButton: false
            }
        },
        methods: {
            editMode() {
                this.onEdit = !this.onEdit;
                this.formatTimeInSchedule();
            },
            formatTime(time) {
                let timeArr = time.split(':');
                timeArr.pop();
                return timeArr.join(':');
            },
            getDayByNumber(number) {
                switch (number) {
                    case 1: return 'Lunes';
                    case 2: return 'Martes';
                    case 3: return 'Miercoles';
                    case 4: return 'Jueves';
                    case 5: return 'Viernes';
                    case 6: return 'Sabado';
                    case 7: return 'Domingo';
                }
            },
            getLastElementInUrl() {
                let url = window.location.pathname;
                let arr = url.split('/');
                if (arr[arr.length -1] != '') {
                    return arr[arr.length - 1];
                }
                return arr[arr.length - 2];
            },
            fetchInstructor() {
                let id = this.getLastElementInUrl();
                let _this = this;
                axios.get(`/api/instructors/${id}`)
                    .then((response) => {
                        console.log(response);
                        _this.instructor = response.data.data.instructor;
                        _this.schedule = response.data.data.schedule;
                    })
                    .catch((error) => {
                        console.log('Error en fetchInstructor() '+error);
                    })
            },
            fetchClientsInstructedBy() {
                let id = this.getLastElementInUrl();
                let _this = this;
                axios.get(`/api/instructors/${id}/clients`)
                    .then((response) => {
                        console.log(response);
                        _this.clients = response.data.data.clients;
                    })
                    .catch((error) => {
                        console.log('Error en fetchClientsInstructedBy() '+error);
                    })
            },
            formatTimeInSchedule() {
                console.log('sdfghjk');
                let days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                for (let i = 0; i < 7; i++) {
                    if (this.schedule[days[i]]) {
                        this.schedule[days[i]].from = this.formatTime(this.schedule[days[i]].from);
                        this.schedule[days[i]].to =this.formatTime(this.schedule[days[i]].to);
                    }

                }
            },
            updateData() {
                this.saving = true;
                this.updateSchedule();
                this.updateInstructor();
                this.saving = false;
            },
            deleteData() {
                let id = this.getLastElementInUrl();
                let _this = this;
                swal({
                        title: "Peligro",
                        text: "¿Estás seguro?, se eliminará el registro del instructor.",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Sí, deseo eliminarlo",
                        cancelButtonText: "No",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(isConfirm){
                        if (isConfirm) {
                            axios.delete(`/api/instructors/${id}`)
                                .then((response) => {
                                    console.log('eliminando...');
                                    console.log(response);
                                    if (response.data.error) {
                                        swal("Error", response.data.error, "error");
                                        return;
                                    }
                                    swal("Eliminado", "Se ha eliminado el registro satisfactoriamente.", "success");
                                    setTimeout(function () {
                                     window.location = '/dashboard/instructores';
                                     }, 1000);
                                })
                                .catch((error) => {
                                    console.log('error eliminando '+error);
                                    _this.showErrorAlert();
                                });
                        } else {
                            swal("Cancelado", "Has cancelado la acción, tú instructor sigue registrado.", "error");
                        }
                    }
                );
            },
            resetData() {
                this.fetchInstructor();
                this.onEdit = false;
            },
            updateSchedule() {
                axios.put(`/api/instructors/${this.instructor.id}/schedule`, {
                    'monday-from': this.schedule.monday.from || null,
                    'monday-to': this.schedule.monday.to || null,
                    'tuesday-from': this.schedule.tuesday.from || null,
                    'tuesday-to': this.schedule.tuesday.to || null,
                    'wednesday-from': this.schedule.wednesday.from || null,
                    'wednesday-to': this.schedule.wednesday.to || null,
                    'thursday-from': this.schedule.thursday.from || null,
                    'thursday-to': this.schedule.thursday.to || null,
                    'friday-from': this.schedule.friday.from || null,
                    'friday-to': this.schedule.friday.to || null,
                    'saturday-from': this.schedule.saturday.from || null,
                    'saturday-to': this.schedule.saturday.to || null,
                    'sunday-from': this.schedule.sunday.from || null,
                    'sunday-to': this.schedule.sunday.to || null,
                })
                    .then((response)=>{console.log(response)})
                    .catch((error)=>{console.log(error)});
            },
            updateInstructor() {
                axios.put(`/api/instructors/${this.instructor.id}`, this.instructor)
                    .then((response)=>{console.log(response)})
                    .catch((error)=>{console.log(error)});
            }
        },
        computed: {
            getGenderIcon: function() {
                if (this.instructor.gender == 'm') {
                    return 'fa-mars';
                }
                return 'fa-venus';
            },
            getGender: function () {
                return this.instructor.gender == 'm' ? 'Masculino' : 'Femenino';
            },
            getProfilePictureUrl() {
                return this.instructor.profile_picture
                    ? this.instructor.profile_picture
                    : '/imgs/profile_pic/default.jpg';
            },
            instructorSince() {
                return this.instructor.created_at.split(" ")[0] || '';
            },
            totalWork() {
                let total = 0;
                let days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                for (let i = 0; i < days.length; i++) {
                    if (this.schedule[days[i]].hours) {
                        total += this.schedule[days[i]].hours;
                    }
                }
                return total;
            }
        }
    }
</script>
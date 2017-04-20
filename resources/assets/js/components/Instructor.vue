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
                            <a class="list-group-item" href="">Facturas <span class="badge">2</span></a>
                            <div class="list-group-item">
                                <div class="list-group-item-heading"><h4>Fecha de próximo pago</h4></div>
                                <div class="list-group-item-text">Null</div>
                            </div>
                            <div class="list-group-item">
                                <div class="list-group-item-heading"><h4>Instructor desde</h4></div>
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
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-money"></i> Datos de facturación
                            </div>
                            <div class="panel-body">
                                <h4><i class="fa fa-id-card" aria-hidden="true"></i> Rfc</h4>
                                <input v-if="onEdit" v-model="instructor.rfc" type="text" class="form-control">
                                <div v-else>
                                    <p v-if="instructor.rfc">{{ instructor.rfc }}</p>
                                    <p v-else><i>No tiene</i></p>
                                    <div class="divider"></div>
                                </div>
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
                                    <div class="divider"></div>
                                </div>
                                <!-- Campo En revisión -->
                                <h4><i class="fa fa-calendar" aria-hidden="true"></i> Fecha de último pago</h4>
                                <input v-if="onEdit" type="date" class="form-control">
                                <div v-else>
                                    <p>{{ instructor.birth_date }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-heartbeat"></i> Datos de gimnasio
                            </div>
                            <div class="panel-body">
                                <h4><i class="fa fa-male" aria-hidden="true"></i> Altura</h4>
                                <input v-if="onEdit" v-model="instructor.height" type="number" class="form-control">
                                <div v-else>
                                    <p>{{ instructor.height }} cm.</p>
                                    <div class="divider"></div>
                                </div>
                                <h4><i class="fa fa-street-view" aria-hidden="true"></i> Peso</h4>
                                <input v-if="onEdit" v-model="instructor.weight" type="number" class="form-control">
                                <div v-else>
                                    <p>{{ instructor.weight }} kg.</p>
                                    <div class="divider"></div>
                                </div>
                                <h4><i class="fa fa-user" aria-hidden="true"></i> Instructor</h4>
                                <select v-if="onEdit"
                                        v-model="instructor.instructor_id"
                                        name="instructor_id"
                                        id="instructor_id"
                                        class="form-control">
                                    <!--<select v-if="onEdit.gymData" name="instructor_id" id="instructor_id">-->
                                    <option v-for="otherInstructor in instructors"
                                            :value="otherInstructor.id">
                                        <!--:selected="otherInstructor.id === client.instructor_id">-->
                                        {{ otherInstructor.name }} {{ otherInstructor.first_name }}
                                    </option>
                                </select>
                                <div v-else>
                                    <p>
                                        <a :href="makeInstructorUrl">
                                            {{ instructor.name }}
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>





    </div>
</template>
<script>
    export default {
        props: ['isAdmin', 'updateInstructor', 'deleteInstructor', 'clients'],
        mounted() {
            console.log('Componente Instructor montado');
            this.fetchInstructor();
        },
        data() {
            return {
                onEdit: false,
                saving: false,
                displayResetButton: false
            }
        },
        methods: {
            getLastElementInUrl() {
                let url = window.location.pathname;
                let arr = url.split('/');
                if (arr[arr.length -1] != '') {
                    return arr[arr.length - 1];
                }
                return arr[arr.length - 2];
            },
            editModeOnClick() {
                this.toggleEdit();
                this.fetchClientsInstructedBy();
            },
            fetchInstructor() {
                let id = this.getLastElementInUrl();
                let _this = this;
                axios.get(`/api/instructors/${id}`)
                    .then((response) => {
                        _this.instructor = response.data.data.instructor;
                    })
                    .catch((error) => {
                        console.log('Error en fetchInstructor() '+error);
                    })
            },
            fetchClientsInstructedBy() {
                let _this = this;
                axios.get(`/api/instructors/${this.instructor.id}/clients`)
                    .then((response) => {
                        _this.clients = response.data.data.clients;
                    })
                    .catch((error) => {
                        console.log('Error en fetchClientsInstructedBy() '+error);
                    })
            },
            updateData() {},
            deleteData() {},
            deleteData() {}
        },
        computed: {
            getProfilePictureUrl() {
                return this.instructor.profile_picture
                    ? this.instructor.profile_picture
                    : '/imgs/profile_pic/default.jpg';
            },
            instructorSince() {
                return this.instructor.created_at.split(" ")[0] || '';
            }
        }
    }
</script>
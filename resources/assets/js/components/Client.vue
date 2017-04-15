<template>
    <div id="client-component">
        <div class="row">
            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-user"></i> {{ client.name }}
                    </div>
                    <div class="panel-body text-center">
                        <img class="img img-responsive img-thumbnail" :src="getProfilePictureUrl" :alt="client.name">
                        <div class="divider"></div>
                        <div v-if="isAnyDataOnEdit" id="reset-data">
                            <!-- Hacer que solo aparezca cuando algun campo del modelo cambie, usar watchers -->
                            <button @click="resetData" class="btn btn-block btn-warning">
                                <!-- Al ser presionado activará la función que envía una petición ajax para obtener
                                 el cliente en cuestion-->
                                <i class="fa fa-times-circle" aria-hidden="true"></i> Cancelar cambios
                            </button>
                            <button @click="saveData" class="btn btn-block btn-success">
                                <!-- Al ser presionado activará la función que envía una petición put ajax para
                                 guardar los cambios realizados en el modelo client-->
                                <i class="fa fa-save" aria-hidden="true"></i> Guardar cambios
                            </button>
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
                                <div class="pull-right">
                                    <button v-if="onEdit.personalData" @click="toggleEdit('personal')" class="btn btn-xs btn-success">
                                        <i class="fa fa-save" aria-hidden="true"></i> Guardar
                                    </button>
                                    <button v-else @click="toggleEdit('personal')" class="btn btn-xs btn-info">
                                        <i class="fa fa-edit" aria-hidden="true"></i> Editar
                                    </button>
                                </div>
                            </div>
                            <div class="panel-body">
                                <h4><i class="fa fa-user-circle" aria-hidden="true"></i> Nombre(s)</h4>
                                <!--<div class="input-group">
                                    <input class="form-control" type="text" :value="client.name">
                                    <span class="input-group-btn">
                                    <button class="btn btn-success"><i class="fa fa-check-circle" aria-hidden="true"></i></button>
                                </span>
                                </div>-->
                                <input v-if="onEdit.personalData" v-model="client.name" type="text" class="form-control">
                                <div v-else>
                                    <p>{{ client.name }}</p>
                                    <div class="divider"></div>
                                </div>
                                <h4><i class="fa fa-users" aria-hidden="true"></i> Apellido paterno</h4>
                                <input v-if="onEdit.personalData" v-model="client.first_surname" type="text" class="form-control">
                                <div v-else>
                                    <p>{{ client.first_surname }}</p>
                                    <div class="divider"></div>
                                </div>
                                <h4><i class="fa fa-users" aria-hidden="true"></i> Apellido materno</h4>
                                <input v-if="onEdit.personalData" v-model="client.second_surname" type="text" class="form-control">
                                <div v-else>
                                    <p>{{ client.second_surname }}</p>
                                    <div class="divider"></div>
                                </div>
                                <h4>
                                    <i class="fa"
                                       :class="getGenderIcon"
                                       aria-hidden="true"></i>
                                    Género
                                </h4>
                                <select v-if="onEdit.personalData" v-model="client.gender" type="text" class="form-control">
                                    <option value="m">Masculino</option>
                                    <option value="f">Femenino</option>
                                </select>
                                <div v-else>
                                    <p>{{ getGender }}</p>
                                    <div class="divider"></div>
                                </div>
                                <h4><i class="fa fa-calendar" aria-hidden="true"></i> Fecha de nacimiento</h4>
                                <input v-if="onEdit.personalData" v-model="client.birth_date" type="date" class="form-control">
                                <div v-else>
                                    <p>{{ client.birth_date }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-money"></i> Datos de facturación
                                <div class="pull-right">
                                    <button v-if="onEdit.invoiceData" @click="toggleEdit('invoice')" class="btn btn-xs btn-success">
                                        <i class="fa fa-save" aria-hidden="true"></i> Guardar
                                    </button>
                                    <button v-else @click="toggleEdit('invoice')" class="btn btn-xs btn-info">
                                        <i class="fa fa-edit" aria-hidden="true"></i> Editar
                                    </button>
                                </div>
                            </div>
                            <div class="panel-body">
                                <h4><i class="fa fa-id-card" aria-hidden="true"></i> Rfc</h4>
                                <input v-if="onEdit.invoiceData" v-model="client.rfc" type="text" class="form-control">
                                <div v-else>
                                    <p>{{ client.rfc }}</p>
                                    <div class="divider"></div>
                                </div>
                                <h4><i class="fa fa-map-marker" aria-hidden="true"></i> Dirección</h4>
                                <input v-if="onEdit.invoiceData" v-model="client.address" type="text" class="form-control">
                                <div v-else>
                                    <p>{{ client.address }}</p>
                                    <div class="divider"></div>
                                </div>
                                <h4><i class="fa fa-phone" aria-hidden="true"></i> Teléfono</h4>
                                <input v-if="onEdit.invoiceData" v-model="client.phone_number" type="text" class="form-control">
                                <div v-else>
                                    <p>{{ client.phone_number }}</p>
                                    <div class="divider"></div>
                                </div>
                                <h4><i class="fa fa-calendar" aria-hidden="true"></i> Fecha de último pago</h4>
                                <input v-if="onEdit.invoiceData" type="date" class="form-control">
                                <div v-else>
                                    <p>{{ client.birth_date }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-offset-4">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-heartbeat"></i> Datos de gimnasio
                            <div class="pull-right">
                                <button v-if="onEdit.gymData" @click="toggleEdit('gym')" class="btn btn-xs btn-success">
                                    <i class="fa fa-save" aria-hidden="true"></i> Guardar
                                </button>
                                <!--<button v-else @click="toggleEdit('gym')" @click="fetchInstructorsEvent()" class="btn btn-xs btn-info">-->
                                <button v-else @click="dataGymOnClick" class="btn btn-xs btn-info">
                                    <i class="fa fa-edit" aria-hidden="true"></i> Editar
                                </button>
                            </div>
                        </div>
                        <div class="panel-body">
                            <h4><i class="fa fa-male" aria-hidden="true"></i> Altura</h4>
                            <input v-if="onEdit.gymData" v-model="client.height" type="number" class="form-control">
                            <div v-else>
                                <p>{{ client.height }} cm.</p>
                                <div class="divider"></div>
                            </div>
                            <h4><i class="fa fa-street-view" aria-hidden="true"></i> Peso</h4>
                            <input v-if="onEdit.gymData" v-model="client.weight" type="number" class="form-control">
                            <div v-else>
                                <p>{{ client.weight }} kg.</p>
                                <div class="divider"></div>
                            </div>
                            <h4><i class="fa fa-user" aria-hidden="true"></i> Instructor</h4>
                            <select v-if="onEdit.gymData" v-model="client.instructor_id" name="instructor_id" id="instructor_id">
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
</template>
<script>
    export default {
        props: {
            fetchClient:{},
            fetchInstructors:{},
            client:{},
            instructor:{},
            instructors:{}
        },
        mounted: function() {
            console.log('Componente Cliente montado');
            this.$once('fetchInstructorsEvent', function () {
                this.fetchInstructors(false);
            });
            this.fetchClient();
        },
        data: function() {
            return {
                onEdit: {
                    personalData: false,
                    invoiceData: false,
                    gymData: false,
                },
                displayResetButton: false
            }
        },
        methods: {
            //Ejecuta las funciones necesarias al hacer click en botón editar de dataGym
            dataGymOnClick() {
                this.toggleEdit('gym');
                this.fetchInstructorsEvent();
            },
            /**
             * Dispara un evento para indicar que se requiere obtener todos los instructores
             */
            fetchInstructorsEvent() {
                this.$emit('fetchInstructorsEvent');
            },
            toggleEdit(typeOfData) {
                switch (typeOfData) {
                    case 'personal':
                        this.onEdit.personalData = !this.onEdit.personalData;
                        break;
                    case 'invoice':
                        this.onEdit.invoiceData = !this.onEdit.invoiceData;
                        break;
                    case 'gym':
                        this.onEdit.gymData = !this.onEdit.gymData;
                        break;
                }
            },
            resetData() {
                this.fetchClient();
                this.onEdit.personalData = false;
                this.onEdit.invoiceData = false;
                this.onEdit.gymData = false;
            }
        },
        computed: {
            getGenderIcon: function() {
                if (this.client.gender == 'm') {
                    return 'fa-mars';
                }
                return 'fa-venus';
            },
            getProfilePictureUrl: function () {
                return this.client.profile_picture
                    ? this.client.profile_picture
                    : '/imgs/profile_pic/default.jpg';
            },
            getGender: function () {
                return this.client.gender == 'm' ? 'Masculino' : 'Femenino';
            },
            makeInstructorUrl: function () {
                return `/dashboard/instructores/${this.instructor.id}`;
            },
            isAnyDataOnEdit() {
                return this.onEdit.personalData || this.onEdit.invoiceData || this.onEdit.gymData;
            }
        }
    }
</script>

<style scoped>
    #reset-data {
        margin-top: 4px;
    }
</style>
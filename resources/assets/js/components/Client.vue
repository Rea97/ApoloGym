<template>
    <div id="client-component">
        <div class="row">
            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-user"></i> {{ client.name }}
                    </div>
                    <div class="panel-body">
                        <div class="text-center">
                            <img class="img img-responsive img-thumbnail" :src="getProfilePictureUrl" :alt="client.name">
                        </div>
                        <div class="divider"></div>
                        <!--<h4>
                            <i class="fa fa-history" aria-hidden="true"></i> Resumen
                        </h4>-->
                        <div class="list-group">
                            <a class="list-group-item" href="">Facturas <span class="badge">2</span></a>
                            <div class="list-group-item">
                                <div class="list-group-item-heading"><h4>Fecha de próximo pago</h4></div>
                                <div class="list-group-item-text">{{ memberSince }}</div>
                            </div>
                            <div class="list-group-item">
                                <div class="list-group-item-heading"><h4>Miembro desde</h4></div>
                                <div class="list-group-item-text">{{ memberSince }}</div>

                            </div>
                        </div>
                        <div class="divider"></div>
                        <div id="options">
                            <div v-if="isAdmin && !onEdit">
                                <!-- Redirigirá a una página sin contenido vue js en la que mediante las variables get
                                 se obtendrá la información de facturación necesaria del cliente en cuestión-->
                                <a :href="'/dashboard/facturas/crear?client_id=' + client.id"
                                   class="btn btn-block btn-success">
                                    <i class="fa fa-money" aria-hidden="true"></i> Crear Factura
                                </a>
                                <button @click="editModeOnClick" class="btn btn-block btn-info" id="edit-data">
                                    <i class="fa fa-edit" aria-hidden="true"></i> Editar Información
                                </button>
                                <button @click="deleteData" class="btn btn-block btn-danger" id="delete-data">
                                    <i class="fa fa-trash" aria-hidden="true"></i> Eliminar Usuario
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
                                <div v-if="onEdit" class="form-group" :class="{'has-error': errors.has('name')}">
                                    <input v-model="client.name" v-validate="'required|alpha_spaces'" type="text" class="form-control" name="name" data-vv-as="Nombre">
                                    <span v-show="errors.has('name')" class="help-block">{{ errors.first('name') }}</span>
                                </div>
                                <div v-else>
                                    <p>{{ client.name }}</p>
                                    <div class="divider"></div>
                                </div>
                                <h4><i class="fa fa-users" aria-hidden="true"></i> Apellido paterno</h4>
                                <div v-if="onEdit" class="form-group" :class="{'has-error': errors.has('first_surname')}">
                                    <input v-model="client.first_surname" v-validate="'required|alpha'" type="text" class="form-control" name="first_surname" data-vv-as="Apellido paterno">
                                    <span v-show="errors.has('first_surname')" class="help-block">{{ errors.first('first_surname') }}</span>
                                </div>
                                <div v-else>
                                    <p>{{ client.first_surname }}</p>
                                    <div class="divider"></div>
                                </div>
                                <h4><i class="fa fa-users" aria-hidden="true"></i> Apellido materno</h4>
                                <div v-if="onEdit" class="form-group" :class="{'has-error': errors.has('second_surname')}">
                                    <input v-model="client.second_surname" v-validate="'alpha'" type="text" class="form-control" name="second_surname" data-vv-as="Apellido materno">
                                    <span v-show="errors.has('second_surname')" class="help-block">{{ errors.first('second_surname') }}</span>
                                </div>
                                <div v-else>
                                    <p v-if="client.second_surname">{{ client.second_surname }}</p>
                                    <p v-else><i>No tiene</i></p>
                                    <div class="divider"></div>
                                </div>
                                <h4>
                                    <i class="fa"
                                       :class="getGenderIcon"
                                       aria-hidden="true"></i>
                                    Género
                                </h4>
                                <select v-if="onEdit" v-model="client.gender" v-validate="'in:m,f'" class="form-control" name="gender" data-vv-as="Género">
                                    <option value="m">Masculino</option>
                                    <option value="f">Femenino</option>
                                </select>
                                <div v-else>
                                    <p>{{ getGender }}</p>
                                    <div class="divider"></div>
                                </div>
                                <h4><i class="fa fa-calendar" aria-hidden="true"></i> Fecha de nacimiento</h4>
                                <div v-if="onEdit" class="form-group" :class="{'has-error': errors.has('birth_date')}">
                                    <input v-model="client.birth_date" v-validate="'required|date_format:YYYY-MM-DD'" type="date" class="form-control" name="birth_date" data-vv-as="Fecha de nacimiento">
                                    <span v-show="errors.has('birth_date')" class="help-block">{{ errors.first('birth_date') }}</span>
                                </div>
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
                        </div>
                        <div class="panel-body">
                            <h4><i class="fa fa-id-card" aria-hidden="true"></i> Rfc</h4>
                            <div v-if="onEdit" class="form-group" :class="{'has-error': errors.has('rfc')}">
                                <input v-model="client.rfc" v-validate="'alpha_num'" type="text" class="form-control" name="rfc" data-vv-as="Rfc">
                                <span v-show="errors.has('rfc')" class="help-block">{{ errors.first('rfc') }}</span>
                            </div>
                            <div v-else>
                                <p v-if="client.rfc">{{ client.rfc }}</p>
                                <p v-else><i>No tiene</i></p>
                                <div class="divider"></div>
                            </div>
                            <h4><i class="fa fa-map-marker" aria-hidden="true"></i> Dirección</h4>
                            <div v-if="onEdit" class="form-group" :class="{'has-error': errors.has('address')}">
                                <input v-model="client.address" v-validate="'required'" type="text" class="form-control" name="address" data-vv-as="Dirección">
                                <span v-show="errors.has('address')" class="help-block">{{ errors.first('address') }}</span>
                            </div>
                            <div v-else>
                                <p>{{ client.address }}</p>
                                <div class="divider"></div>
                            </div>
                            <h4><i class="fa fa-phone" aria-hidden="true"></i> Teléfono</h4>
                            <div v-if="onEdit" class="form-group" :class="{'has-error': errors.has('phone_number')}">
                                <input v-model="client.phone_number" v-validate="'required'" type="text" class="form-control" name="phone_number" data-vv-as="Teléfono">
                                <span v-show="errors.has('phone_number')" class="help-block">{{ errors.first('phone_number') }}</span>
                            </div>
                            <div v-else>
                                <p>{{ client.phone_number }}</p>
                                <div class="divider"></div>
                            </div>
                            <h4><i class="fa fa-at" aria-hidden="true"></i> E-mail</h4>
                            <div v-if="onEdit" class="form-group" :class="{'has-error': errors.has('email')}">
                                <input v-model="client.email" v-validate="'required|email'" type="email" class="form-control" name="email" data-vv-as="E-mail">
                                <span v-show="errors.has('email')" class="help-block">{{ errors.first('email') }}</span>
                            </div>
                            <div v-else>
                                <p>{{ client.email }}</p>
                                <div class="divider"></div>
                            </div>
                            <!-- Campo En revisión -->
                            <h4><i class="fa fa-calendar" aria-hidden="true"></i> Fecha de último pago</h4>
                            <input v-if="onEdit" type="date" class="form-control">
                            <div v-else>
                                <p>{{ client.birth_date }}</p>
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
                                <div v-if="onEdit" class="form-group" :class="{'has-error': errors.has('height')}">
                                    <input v-model="client.height" v-validate="'required|numeric'" type="number" class="form-control" name="height" data-vv-as="Altura">
                                    <span v-show="errors.has('height')" class="help-block">{{ errors.first('height') }}</span>
                                </div>
                                <div v-else>
                                    <p>{{ client.height }} cm.</p>
                                    <div class="divider"></div>
                                </div>
                                <h4><i class="fa fa-street-view" aria-hidden="true"></i> Peso</h4>
                                <div v-if="onEdit" class="form-group" :class="{'has-error': errors.has('weight')}">
                                    <input v-model="client.weight" v-validate="'required|numeric'" type="number" class="form-control" name="weight" data-vv-as="Peso" min="0" value="0.00" step="0.01">
                                    <span v-show="errors.has('weight')" class="help-block">{{ errors.first('weight') }}</span>
                                </div>
                                <div v-else>
                                    <p>{{ client.weight }} kg.</p>
                                    <div class="divider"></div>
                                </div>
                                <h4><i class="fa fa-user" aria-hidden="true"></i> Instructor</h4>
                                <div v-if="onEdit" class="form-group" :class="{'has-error': errors.has('instructor_id')}">
                                    <select v-model="client.instructor_id"
                                            name="instructor_id"
                                            id="instructor_id"
                                            class="form-control"
                                            v-validate="'required|numeric'"
                                            data-vv-as="Instructor">
                                        <!--<select v-if="onEdit.gymData" name="instructor_id" id="instructor_id">-->
                                        <option v-for="otherInstructor in instructors"
                                                :value="otherInstructor.id">
                                            <!--:selected="otherInstructor.id === client.instructor_id">-->
                                            {{ otherInstructor.name }} {{ otherInstructor.first_name }}
                                        </option>
                                    </select>
                                    <span v-show="errors.has('instructor_id')" class="help-block">{{ errors.first('instructor_id') }}</span>
                                </div>
                                <div v-else>
                                    <p>
                                        <a v-if="instructor" :href="makeInstructorUrl">
                                            {{ instructor.name }} {{ instructor.first_surname }}
                                        </a>
                                        <i v-else>Sin instructor asignado.</i>
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
        props: [
            'isAdmin',
            'fetchClient',
            'fetchInstructors',
            'client',
            'deleteClient',
            'updateClient',
            'instructor',
            'instructors',
            'showErrorAlert'
        ]
            /*{
            isAdmin: {},
            fetchClient:{},
            fetchInstructors:{},
            client:{},
            deleteClient: {},
            updateClient: {},
            instructor:{},
            instructors:{},
            showAlert
        }*/,
        mounted: function() {
            console.log('Componente Cliente montado');
            this.$once('fetchInstructorsEvent', function () {
                this.fetchInstructors(false);
            });
            this.fetchClient();
        },
        data: function() {
            return {
                onEdit: false,
                saving: false,
                displayResetButton: false
            }
        },
        methods: {
            //Ejecuta las funciones necesarias al hacer click en botón editar de dataGym
            editModeOnClick() {
                this.toggleEdit('gym');
                this.fetchInstructorsEvent();
            },
            /**
             * Dispara un evento para indicar que se requiere obtener todos los instructores
             */
            fetchInstructorsEvent() {
                this.$emit('fetchInstructorsEvent');
            },
            toggleEdit() {
                this.onEdit = !this.onEdit;
            },
            resetData() {
                this.fetchClient();
                this.onEdit = false;
            },
            deleteData() {
                this.deleteClient();
            },
            updateData() {
                this.saving = true;
                if (this.formHasErrors()) {
                    this.saving = false;
                    return;
                }
                this.updateClient();
                //this.onEdit = false;
                //this.fetchClient();
            },
            formHasErrors() {
                if (this.errors.errors.length > 0) {
                    this.showErrorAlert("Verifica los errores en el formulario.");
                    return true;
                }
                return false;
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
            memberSince: function () {
                //return this.created_at;
                return this.client.created_at.split(" ")[0] || '';
            }
        }
    }
</script>

<style scoped>
    .list-group {
        margin-bottom: 0;
    }

</style>
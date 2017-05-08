<template>
    <div class="row">
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-user"></i> {{ user.name }}
                </div>
                <div class="panel-body">
                    <div class="text-center">
                        <img v-show="!onEdit" class="img img-responsive img-thumbnail" :src="getProfilePictureUrl" :alt="user.name">
                        <div v-show="onEdit">
                            <file-upload></file-upload>
                            <button v-on:click="deletePP" class="btn btn-block btn-danger btn-sm"><i class="fa fa-picture-o" aria-hidden="true"></i> Eliminar foto de perfil</button>
                            <!--<h6>Cambiar foto de perfil</h6>
                            <form id="profile-picture-form" action="/api/profile_picture" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
                                <input name="_token" type="hidden" :value="csrfToken">
                                <input name="_method" type="hidden" value="PUT">
                                <div class="form-group" :class="{'has-error': errors.has('profile_picture')}">
                                    <input v-validate="'image|size:2024'" data-vv-as="Foto de perfil" type="file" class="form-control" name="profile_picture" >
                                    <span v-show="errors.has('profile_picture')" class="text-muted">{{ errors.first('profile_picture') }}</span>
                                    <button v-on:click="uploadPicture" class="btn btn-success">Guardar Foto</button>
                                </div>
                            </form>-->
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="list-group">
                        <div class="list-group-item">
                            Registrado el: {{ user.created_at }}
                        </div>
                        <div class="list-group-item">
                            Actualizado el: {{ user.updated_at }}
                        </div>
                    </div>
                    <div id="options">
                        <div v-show="!onEdit">
                            <button @click="editMode" class="btn btn-block btn-info" id="edit-data">
                                <i class="fa fa-edit" aria-hidden="true"></i> Editar Información
                            </button>
                            <!--
                            <button @click="deleteData" class="btn btn-block btn-danger" id="delete-data">
                                <i class="fa fa-trash" aria-hidden="true"></i> Eliminar Perfil
                            </button>
                            -->
                        </div>
                        <div v-show="onEdit">
                            <button @click="updateData" class="btn btn-block btn-success">
                                <span v-if="saving"><i class="fa fa-pulse fa-spinner" aria-hidden="true"></i> Guardando...</span>
                                <span v-else><i class="fa fa-save" aria-hidden="true"></i> Guardar</span>
                            </button>
                            <button @click="resetData" class="btn btn-block btn-warning">
                                <i class="fa fa-times-circle" aria-hidden="true"></i> Cancelar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="col-sm-6">
                <!--  Info Panel  -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <i class="fa fa-book" aria-hidden="true"></i>
                            Datos personales
                        </h4>
                    </div>
                    <div class="panel-body">
                        <h4><i class="fa fa-user-circle" aria-hidden="true"></i> Nombre(s)</h4>
                        <div v-if="onEdit" class="form-group" :class="{'has-error': errors.has('name')}">
                            <input v-model="user.name" v-validate="'required|max:40'" type="text" class="form-control" name="name" data-vv-as="Nombre">
                            <span v-show="errors.has('name')" class="help-block">{{ errors.first('name') }}</span>
                        </div>
                        <div v-else>
                            <p>{{ user.name }}</p>
                            <div class="divider"></div>
                        </div>
                        <h4><i class="fa fa-users" aria-hidden="true"></i> Apellido paterno</h4>
                        <div v-if="onEdit" class="form-group" :class="{'has-error': errors.has('first_surname')}">
                            <input v-model="user.first_surname" v-validate="'required|max:40'" type="text" class="form-control" name="first_surname" data-vv-as="Apellido paterno">
                            <span v-show="errors.has('first_surname')" class="help-block">{{ errors.first('first_surname') }}</span>
                        </div>
                        <div v-else>
                            <p>{{ user.first_surname }}</p>
                            <div class="divider"></div>
                        </div>
                        <h4><i class="fa fa-users" aria-hidden="true"></i> Apellido materno</h4>
                        <div v-if="onEdit" class="form-group" :class="{'has-error': errors.has('second_surname')}">
                            <input v-model="user.second_surname" v-validate="'max:40'" type="text" class="form-control" name="second_surname" data-vv-as="Apellido materno">
                            <span v-show="errors.has('second_surname')" class="help-block">{{ errors.first('second_surname') }}</span>
                        </div>
                        <div v-else>
                            <p v-if="user.second_surname">{{ user.second_surname }}</p>
                            <p v-else><i>No tiene.</i></p>
                            <div class="divider"></div>
                        </div>
                        <h4><i class="fa fa-id-card" aria-hidden="true"></i> Rfc</h4>
                        <div v-if="onEdit" class="form-group" :class="{'has-error': errors.has('rfc')}">
                            <input v-model="user.rfc" v-validate="'alpha_num'" type="text" class="form-control" name="rfc" data-vv-as="Rfc">
                            <span v-show="errors.has('rfc')" class="help-block">{{ errors.first('rfc') }}</span>
                        </div>
                        <div v-else>
                            <p v-if="user.rfc">{{ user.rfc }}</p>
                            <p v-else><i>No tiene.</i></p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-user-circle fa-fw"></i> Datos de la cuenta
                    </div>
                    <div class="panel-body">
                        <h4><i class="fa fa-map-marker" aria-hidden="true"></i> Dirección</h4>
                        <div v-if="onEdit" class="form-group" :class="{'has-error': errors.has('address')}">
                            <input v-model="user.address" v-validate="'required'" type="text" class="form-control" name="address" data-vv-as="Dirección">
                            <span v-show="errors.has('address')" class="help-block">{{ errors.first('address') }}</span>
                        </div>
                        <div v-else>
                            <p>{{ user.address }}</p>
                            <div class="divider"></div>
                        </div>
                        <h4><i class="fa fa-phone" aria-hidden="true"></i> Teléfono</h4>
                        <div v-if="onEdit" class="form-group" :class="{'has-error': errors.has('phone_number')}">
                            <input v-model="user.phone_number" v-validate="'required|alpha_dash|max:50'" type="text" class="form-control" name="phone_number" data-vv-as="Teléfono">
                            <span v-show="errors.has('phone_number')" class="help-block">{{ errors.first('phone_number') }}</span>
                        </div>
                        <div v-else>
                            <p>{{ user.phone_number }}</p>
                            <div class="divider"></div>
                        </div>
                        <h4><i class="fa fa-at" aria-hidden="true"></i> E-mail</h4>
                        <div v-if="onEdit" class="form-group" :class="{'has-error': errors.has('email')}">
                            <input disabled v-model="user.email" v-validate="'required|email'" type="text" class="form-control" name="email" data-vv-as="E-mail">
                            <span v-show="errors.has('email')" class="help-block">{{ errors.first('email') }}</span>
                        </div>
                        <div v-else>
                            <p>{{ user.email }}</p>
                            <div class="divider"></div>
                        </div>
                        <h4><i class="fa fa-lock" aria-hidden="true"></i> Contraseña</h4>
                        <div v-if="onEdit" class="form-group" :class="{'has-error': errors.has('password')}">
                            <input v-model="user.password" v-validate="'required|min:6'" type="password" class="form-control" name="password" data-vv-as="Contraseña">
                            <span v-show="errors.has('password')" class="help-block">{{ errors.first('password') }}</span>
                        </div>
                        <div v-else>
                            <p>*************</p>
                        </div>
                        <template v-if="onEdit">
                            <h4><i class="fa fa-lock" aria-hidden="true"></i> Confirmación de contraseña</h4>
                            <div class="form-group" :class="{'has-error': errors.has('password_confirmation')}">
                                <input v-model="user.password_confirmation" v-validate="'required|confirmed:password'" type="password" class="form-control" name="password_confirmation" data-vv-as="Confirmación de contraseña">
                                <span v-show="errors.has('password_confirmation')" class="help-block">{{ errors.first('password_confirmation') }}</span>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-bell fa-fw"></i> Notificaciones
                    </div>
                    <div class="panel-body">
                        <div class="list-group">
                            <a v-if="notifications.length > 0" v-for="notification in notifications" :href="notification.data.action" class="list-group-item">
                                <i class="fa fa-fw" :class="notification.data.icon"></i> {{ notification.data.message }}
                                <span class="pull-right text-muted small"><em>{{ humanTime(notification.created_at) }}</em></span>
                            </a>
                            <p v-show="notifications.length == 0" href="#" class="text-center text-muted">
                                No hay notificaciones...
                            </p>
                        </div>
                        <button v-show="notifications.length > 0" v-on:click="deleteAllNotifications" class="btn btn-primary btn-block">
                            <i class="fa fa-archive" aria-hidden="true"></i>
                            Vaciar Notificaciones
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>
<script>
    import FileUpload from './FileUpload.vue';
    //var FileUpload = require('vue-upload-component');
    export default {
        components: {
            FileUpload : FileUpload
        },
        props: ['client', 'showErrorAlert', 'alertConfirm'],
        mounted() {
            this.user.id = this.client.id;
            //this.setUser();
            this.fetchUser();
            this.fetchNotifications();
        },
        data() {
            return {
                saving: false,
                onEdit: false,
                notifications: [],
                user: {
                    id: 0,
                    name: '',
                    first_surname: '',
                    second_surname: '',
                    email: '',
                    phone_number: '',
                    profile_picture: '',
                    created_at: '',
                    updated_at: '',
                    password: '',
                    password_confirmation: ''
                },
            }
        },
        methods: {
            fetchNotifications() {
                let _this = this;
                axios.get(`/api/notifications/all`)
                    .then((response)=>{
                    console.log(response);
                    _this.notifications = response.data.notifications;
                })
            },
            fetchUser() {
                let _this = this;
                axios.get(`/api/clients/${this.user.id}`)
                    .then((response)=>{
                        _this.user = response.data.data.client;
                    })
                    .catch((error)=>{console.log(error)});
            },
            setUser() {
                this.user.id = this.client.id;
                this.user.name = this.client.name;
                this.user.first_surname = this.client.first_surname;
                this.user.second_surname = this.client.second_surname;
                this.user.email = this.client.email;
                this.user.phone_number = this.client.phone_number;
                this.user.profile_picture = this.client.profile_picture;
                this.user.created_at = this.client.created_at;
                this.user.updated_at = this.client.updated_at;
            },
            editMode() {
                this.onEdit = true;
            },
            resetData() {
                this.onEdit = false;
                this.setUser();
            },
            deleteData() {
                let _this = this;
                swal({
                        title: "Peligro",
                        text: "¿Estás seguro?, Se eliminará permanentemente tú perfil.",
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
                            axios.delete(`/api/clients/${_this.user.id}`)
                                .then((response)=>{
                                    console.log(response);
                                    if (response.data.error) {
                                        swal("Error", response.data.error, "error");
                                        return;
                                    }
                                    swal("Eliminado", "Se ha eliminado el registro satisfactoriamente.", "success");
                                    setTimeout(function () {
                                        document.getElementById('logout-form').submit();
                                    }, 1000);
                                })
                                .catch((error)=>{console.log(error)});
                        } else {
                            swal("Cancelado", "Has cancelado la acción.", "error");
                        }
                    }
                );
            },
            updateData() {
                this.saving = true;
                if (this.formHasErrors()) {
                    this.saving = false;
                    return;
                }
                this.updateProfile();
                window.location = '/dashboard/perfil';
            },
            updateProfile() {
                axios.put(`/api/profile/clients/${this.user.id}`, this.user)
                    .then((response)=>{console.log(response)})
                    .catch((error)=>{console.log(error)})
            },
            uploadPicture() {
                if (this.formHasErrors()) {
                    this.saving = false;
                    return;
                }
                document.getElementById('profile-picture-form').submit();
            },
            deletePP() {
                axios.delete(`/api/profile_picture`)
                    .then(response => {
                        if (response.data.type === 'error') {
                            swal('Error', response.data.message, response.data.type);
                            return;
                        }
                        swal('Correcto', response.data.message, 'success');
                        window.location = '/dashboard/perfil';
                    })
                    .catch(error => {
                        console.log(error);
                        swal('Error', 'Ha ourrido un error en  el servidor.', 'error');
                    });
            },
            deleteAllNotifications() {
                let _this = this;
                let callback = function() {
                    axios.delete('/api/notifications/all')
                        .then(response => {
                            swal('Correcto', response.data.message, 'success');
                            window.location = '/dashboard/perfil';
                        })
                        .catch(error => {
                            _this.showErrorAlert();
                        })
                };
                this.alertConfirm(
                    '¿Estás seguro?, se borrarán todas las notificaciones.',
                    'Sí, deseo eliminarlas.',
                    callback
                );
            },
            formHasErrors() {
                if (this.errors.errors.length > 0) {
                    this.showErrorAlert("Verifica los errores en el formulario.");
                    return true;
                }
                return false;
            },
            humanTime(date) {
                //return date;
                return Moment(date, "YYYY-MM-DD HH:mm:ss").fromNow();
            },
        },
        computed: {
            getProfilePictureUrl() {
                return this.client.profile_picture
                    ? '/storage/'+this.client.profile_picture
                    : '/imgs/profile_pic/default.jpg';
            },
            csrfToken() {
                return window.Laravel.csrfToken;
            }
        },
    }
</script>
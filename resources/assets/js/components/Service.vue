<template>
    <div id="service-component">
        <div class="row">
            <div class="col-sm-8">
                <!--  Details Panel  -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <i class="fa fa-list" aria-hidden="true"></i>
                            Detalles
                        </h4>
                    </div>
                    <div class="panel-body">
                        <h4>
                            <i class="fa fa-cube" aria-hidden="true"></i>
                            Nombre
                        </h4>
                        <div v-if="!onEdit">
                            <p>{{ service.name }}</p>
                            <div class="divider"></div>
                        </div>
                        <div v-else class="form-group" :class="{'has-error': errors.has('name')}">
                            <input v-model="service.name"
                                   v-validate="'required|max:200'"
                                   data-vv-as="Nombre"
                                   name="name"
                                   class="form-control"
                                   type="text">
                            <span v-show="errors.has('name')" class="help-block">{{ errors.first('name') }}</span>
                        </div>

                        <h4>
                            <i class="fa fa-money" aria-hidden="true"></i>
                            Precio
                        </h4>
                        <div v-if="!onEdit">
                            <p>$ {{ service.price }}</p>
                            <div class="divider"></div>
                        </div>
                        <div v-else class="form-group" :class="{'has-error': errors.has('price')}">
                            <input v-model="service.price"
                                   v-validate="'required|decimal:2'"
                                   data-vv-as="Precio"
                                   name="price"
                                   class="form-control"
                                   type="number"
                                   value="0.00"
                                   step="0.01">
                            <span v-show="errors.has('price')" class="help-block">{{ errors.first('price') }}</span>
                        </div>

                        <h4>
                            <i class="fa fa-book" aria-hidden="true"></i>
                            Descripción
                        </h4>
                        <div v-if="!onEdit">
                            <p>{{ service.description }}</p>
                        </div>
                        <div v-else class="form-group" :class="{'has-error': errors.has('description')}">
                            <textarea v-model="service.description"
                                      v-validate="'required'"
                                      data-vv-as="Descripción"
                                      name="description"
                                      class="form-control"
                                      cols="30"
                                      rows="10"

                            ></textarea>
                            <span v-show="errors.has('description')" class="help-block">{{ errors.first('description') }}</span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-sm-4">
                <!--  Service Panel  -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <i class="fa fa-cube" aria-hidden="true"></i>
                            {{ service.name }}
                        </h4>
                    </div>
                    <div class="panel-body">
                        <div id="options">
                            <h4>
                                <i class="fa fa-clock-o" aria-hidden="true"></i>
                                Fecha de creación
                            </h4>
                            <p>{{ service.created_at }}</p>
                            <div class="divider"></div>
                            <h4>
                                <i class="fa fa-clock-o" aria-hidden="true"></i>
                                Fecha de actualización
                            </h4>
                            <p>{{ service.updated_at }}</p>
                            <div class="divider"></div>
                            <div v-if="!onEdit">
                                <button @click="editMode" class="btn btn-block btn-info" id="edit-data">
                                    <i class="fa fa-edit" aria-hidden="true"></i> Editar Información
                                </button>
                                <button @click="deleteData" class="btn btn-block btn-danger" id="delete-data">
                                    <i class="fa fa-trash" aria-hidden="true"></i> Eliminar Servicio
                                </button>
                            </div>
                            <div v-else>
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
        </div>
    </div>
</template>
<script>
    export default {
        props: ['showErrorAlert', 'getIdOfResourceInUrl'],
        mounted() {
            this.fetchService();
        },
        data() {
            return {
                service: {},
                onEdit: false,
                saving: false,
                displayResetButton: false
            }
        },
        methods: {
            fetchService() {
                let id = this.getIdOfResourceInUrl();
                let _this = this;
                axios.get(`/api/services/${id}`)
                    .then((response) => {
                        console.log(response);
                        _this.service = response.data.service;
                    })
                    .catch((error) => {
                        console.log(error);
                        this.showErrorAlert();
                    })
            },
            editMode() {
                this.onEdit = true;
            },
            deleteData() {
                let _this = this;
                swal({
                        title: "Peligro",
                        text: "¿Estás seguro?, se eliminará el registro del servicio.",
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
                            axios.delete(`/api/services/${this.service.id}`)
                                .then((response) => {
                                    console.log(response);
                                    swal("Eliminado", "Se ha eliminado el registro satisfactoriamente.", "success");
                                    setTimeout(function () {
                                        window.location = '/dashboard/servicios';
                                    }, 1000);
                                })
                                .catch((error) => {
                                    console.log(error);
                                    _this.showErrorAlert();
                                });
                        } else {
                            swal("Cancelado", "Has cancelado la acción, tú instructor sigue registrado.", "error");
                        }
                    }
                );
                this.onEdit = false;
            },
            updateData() {
                this.saving = true;
                if (this.formHasErrors()) {
                    this.saving = false;
                    return;
                }
                axios.put(`/api/services/${this.service.id}`, this.service)
                    .then((response) => {
                        console.log(response);
                    })
                    .catch((error) => {
                        console.log(error);
                    });
                //this.onEdit = false;
                window.location = `/dashboard/servicios/${this.service.id}`;
                //swal("Correcto", "Se ha actualizado el registro satisfactoriamente.", "success");
                //this.fetchService();
            },
            resetData() {
                this.fetchService();
                this.onEdit = false;
            },
            formHasErrors() {
                if (this.errors.errors.length > 0) {
                    this.showErrorAlert("Verifica los errores en el formulario.");
                    return true;
                }
                return false;
            },
        },
        computed: {},
    }
</script>
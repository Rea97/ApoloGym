<template>
    <div id="invoice-component">
        <div class="row">
            <div class="col-sm-12">
                <!--  Invoice Panel  -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <i class="fa fa-file" aria-hidden="true"></i>
                            Factura <b>#{{ invoice.id }}</b>
                        </h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-7">
                                <div :class="alertType" class="alert">
                                    <h5>
                                        <i :class="iconType" class="fa" aria-hidden="true"></i>
                                        <b>{{ invoice.status.capitalize() }}</b>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div v-show="!onEdit" class="btn-group">
                                    <div class="btn-group">
                                        <button :disabled="shouldBeDisabled" type="button" class="btn btn-primary dropdown-toggle"
                                                data-toggle="dropdown">
                                            Marcar como
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li v-if="invoice.status != 'pagada'">
                                                <a v-on:click.prevent="markAs('pagada')" href="#">
                                                    <i :class="icons.paid" class="fa" aria-hidden="true"></i>
                                                    Pagada
                                                </a>
                                            </li>
                                            <li v-if="invoice.status != 'parcialmente pagada'">
                                                <a v-on:click.prevent="markAs('parcialmente pagada')" href="#">
                                                    <i :class="icons.partiallyPaid" class="fa" aria-hidden="true"></i>
                                                    Parcialmente pagada
                                                </a>
                                            </li>
                                            <li v-if="invoice.status != 'sin pagar'">
                                                <a v-on:click.prevent="markAs('sin pagar')" href="#">
                                                    <i :class="icons.unpaid" class="fa" aria-hidden="true"></i>
                                                    Sin pagar
                                                </a>
                                            </li>
                                            <li v-if="invoice.status != 'cancelada'">
                                                <a v-on:click.prevent="markAs('cancelada')" href="#">
                                                    <i :class="icons.cancelled" class="fa" aria-hidden="true"></i>
                                                    Cancelada
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <button :disabled="shouldBeDisabled" v-on:click="editMode" type="button" class="btn btn-info">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                        Editar
                                    </button>
                                    <a target="_blank" :href="'/dashboard/facturas/'+invoice.id+'/pdf'" class="btn btn-warning">
                                        <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                        Ver PDF
                                    </a>
                                </div>
                                <div v-show="onEdit" class="btn-group">
                                    <button v-on:click="updateData" type="button" class="btn btn-success">
                                        <span v-if="saving"><i class="fa fa-pulse fa-spinner" aria-hidden="true"></i> Guardando...</span>
                                        <span v-else><i class="fa fa-save" aria-hidden="true"></i> Guardar</span>
                                    </button>
                                    <button v-on:click="resetData" type="button" class="btn btn-warning">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                        Cancelar
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="divider"></div>

                        <div v-show="!onEdit" class="row">
                            <div class="col-sm-12">
                                <h3><i class="fa fa-list" aria-hidden="true"></i> Detalles</h3>
                            </div>
                            <div class="col-sm-6">
                                <p><strong>Facturado a:</strong></p>
                                <p>{{ client.first_surname }} {{ client.second_surname || '' }}, {{ client.name }}</p>
                                <p>{{ client.address }}</p>
                                <p v-if="client.rfc"><b>Rfc:</b> {{ client.rfc }}</p>
                                <p><strong>Teléfono:</strong> {{ client.phone_number }}</p>
                                <p><strong>E-mail:</strong> {{ client.email }}</p>
                            </div>
                            <div class="col-sm-6">
                                <p><strong>Creada el:</strong> {{ invoice.created_at }}</p>
                                <p><strong>Vencimiento:</strong> {{ invoice.due_date }}</p>
                                <h4><strong>Total:</strong> $ {{ total }}</h4>
                            </div>
                            <div class="col-sm-12">
                                <h3><i class="fa fa-th-list" aria-hidden="true"></i> Términos</h3>
                                <p>{{ invoice.terms || 'Esta factura no tiene términos adicionales.' }}</p>
                            </div>
                            <div class="col-sm-12">
                                <h3><i class="fa fa-money" aria-hidden="true"></i> Cargos</h3>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="col-sm-1">Id</th>
                                                <th class="col-sm-2">Nombre</th>
                                                <th class="col-sm-7">Descripción</th>
                                                <th class="col-sm-2">Precio</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="service in invoice.services">
                                                <td><a :href="'/servicios/'+service.id">{{ service.id }}</a></td>
                                                <td>{{ service.name }}</td>
                                                <td>{{ service.description }}</td>
                                                <td>$ {{ service.price }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div v-show="onEdit" class="row">
                            <div class="col-sm-12">
                                <h4><i class="fa fa-list" aria-hidden="true"></i> Detalles</h4>
                            </div>
                            <!--  client_id Form Field  -->
                            <div class="form-group col-sm-6" :class="{'has-error': errors.has('client_id')}">
                                <label for="client_id">Cliente</label>
                                <select v-model="invoice.client_id"
                                        v-validate="'required|numeric'"
                                        data-vv-as="Cliente"
                                        name="client_id" id="client_id" class="form-control">
                                    <option v-for="client in clients" :value="client.id" :selected="client.id == invoice.client_id">
                                        {{ client.name }} {{ client.first_surname }}
                                    </option>
                                </select>
                                <span v-show="errors.has('client_id')" class="help-block">{{ errors.first('client_id') }}</span>
                            </div>
                            <!--  due_date Form Field  -->
                            <div class="form-group col-sm-6" :class="{'has-error': errors.has('due_date')}">
                                <label for="due_date">Vencimiento</label>
                                <input v-model="invoice.due_date"
                                       v-validate="'required|date_format:YYYY-MM-DD'"
                                       data-vv-as="Vencimiento"
                                       id="due_date"
                                       name="due_date"
                                       type="date"
                                       class="form-control">
                                <span v-show="errors.has('due_date')" class="help-block">{{ errors.first('due_date') }}</span>
                            </div>
                            <div class="form-group col-sm-12" :class="{'has-error': errors.has('terms')}">
                                <label for="due_date">Términos adicionales</label>
                                <textarea v-model="invoice.terms"
                                       id="terms"
                                       name="terms"
                                       class="form-control"></textarea>
                            </div>
                            <div class="col-sm-12">
                                <span v-show="errors.has('services')" class="help-block">{{ errors.first('services') }}</span>
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th class="col-sm-1">Id</th>
                                                <th class="col-sm-2">Nombre</th>
                                                <th class="col-sm-6">Descripción</th>
                                                <th class="col-sm-2">Precio</th>
                                                <th class="col-sm-1">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="service in services">
                                                <td>{{ service.id }}</td>
                                                <td>{{ service.name }}</td>
                                                <td>{{ service.description }}</td>
                                                <td>$ {{ service.price }}</td>
                                                <td>
                                                    <input v-validate="'required'"
                                                           type="checkbox"
                                                           v-on:click="toggleService(service.id)"
                                                           :checked="markServiceAsChecked(service.id)"
                                                           :value="service.id"
                                                           name="services[]">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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
        props: ['showErrorAlert', 'getIdOfResourceInUrl'],
        mounted() {
            this.fetchInvoice();
        },
        data() {
            return {
                saving: false,
                onEdit: false,
                icons: {
                    paid: 'fa-check-circle',
                    partiallyPaid: 'fa-ellipsis-h',
                    unpaid: 'fa-exclamation-circle',
                    cancelled: 'fa-times-circle',
                },
                invoice: {},
                client: {},
                clients: [],
                services: [],
            }
        },
        methods: {
            editMode() {
                if (this.shoudBeDisabled) {
                    return;
                }
                this.onEdit = true;
                this.fetchServices();
                this.fetchClients();
            },
            fetchServices() {
                let _this = this;
                axios.get('/api/services')
                    .then((response) => {
                        _this.services = response.data.services;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            fetchClients() {
                let _this = this;
                axios.get('/api/clients')
                    .then((response) => {
                        _this.clients = response.data.clients;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            fetchInvoice() {
                let id = this.getIdOfResourceInUrl();
                let _this = this;
                axios.get(`/api/invoices/${id}`)
                    .then((response) => {
                        console.log(response);
                        _this.invoice = response.data.invoice;
                        _this.client = response.data.client;
                        //_this.invoiceServices = response.data.services;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            markAs(status) {
                console.log(status);
                if (this.invoice.status === 'pagada') {
                    return;
                }
                let id = this.getIdOfResourceInUrl();
                let _this = this;
                axios.put(`/api/invoices/${id}`, {'status': status})
                    .then((response) => {
                        _this.invoice.status = status;
                        swal('Correcto', response.data.message, 'success');
                    })
                    .catch(() => {});
            },
            updateInvoice() {
                let id = this.getIdOfResourceInUrl();
                let _this = this;
                let idsArr = [];
                this.invoice.services.forEach(function(element) {
                    idsArr.push(element.id);
                });
                console.log(idsArr);
                axios.put(`/api/invoices/${id}`, {
                    'client_id': this.invoice.client_id,
                    'due_date': this.invoice.due_date,
                    'terms': this.invoice.terms,
                    'services': idsArr
                })
                    .then((response) => {
                        console.log(response);
                    })
                    .catch((error) => {console.log(error)});
            },
            resetData() {
                this.fetchInvoice();
                this.onEdit = false;
            },
            updateData() {
                let id = this.getIdOfResourceInUrl();
                this.saving = true;
                if (this.formHasErrors()) {
                    this.saving = false;
                    return;
                }
                this.updateInvoice();
                window.location = '/dashboard/facturas/'+id;

            },
            markServiceAsChecked(id) {
                for (let i = 0; i < this.invoice.services.length; i++) {
                    if (this.invoice.services[i].id == id) {
                        return true;
                    }
                }
                return false;
            },
            toggleService(serviceId) {
                let isEqual = function(element) {
                    return element.id === serviceId;
                };
                for (let i = 0; i < this.services.length; i++) {
                    if (this.services[i].id == serviceId) {
                        console.log('primer if');
                        if (typeof this.invoice.services.find(isEqual) === 'undefined') {
                            console.log('Agregando servicio');
                            this.invoice.services.push(this.services[i]);
                        } else {
                            console.log('eliminando servicio');
                            let index = this.invoice.services.indexOf(this.services[i]);
                            console.log(index);
                            if (index > -1) {
                                this.invoice.services.splice(index, 1);
                            }

                        }
                        return;
                    }
                }
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
            alertType() {
                switch (this.invoice.status) {
                    case 'pagada':
                        return 'alert-success';
                    case 'parcialmente pagada':
                        return 'alert-info';
                    case 'sin pagar':
                        return 'alert-danger';
                    case 'cancelada':
                        return 'alert-default';
                }
            },
            iconType() {
                switch (this.invoice.status) {
                    case 'pagada':
                        return this.icons.paid;
                    case 'parcialmente pagada':
                        return this.icons.partiallyPaid;
                    case 'sin pagar':
                        return this.icons.unpaid;
                    case 'cancelada':
                        return this.icons.cancelled;
                }
            },
            total() {
                let total = 0.00;
                for (let i = 0; i < this.invoice.services.length; i++) {
                    total += parseFloat(this.invoice.services[i].price);
                }
                return total.toFixed(2);
            },
            today() {
                return window.Moment().format('DD-MM-YYYY');
            },
            shouldBeDisabled() {
                return this.invoice.status === 'pagada';
            }
        },
    }
</script>

<style>
    .alert-default {
        background-color: #95A5A6;
        color: white;
    }
</style>
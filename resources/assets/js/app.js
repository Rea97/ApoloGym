
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding partials to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));
Vue.component('pagination', require('./components/Pagination.vue'));
Vue.component('client-details', require('./components/Client.vue'));

const app = new Vue({
    el: '#app',
    data: {
        loaded: false,
        search: '',
        client: {},
        clients: [],
        instructor: {},
        instructors: [],
        counter: 0,
        pagination: {
            total: 0,
            per_page: 10,
            from: 1,
            to: 0,
            current_page: 1
        },
        offset: 4,
    },
    methods: {
        getIdOfResourceInUrl() {
            let url = window.location.pathname;
            let arr = url.split('/');
            return arr[arr.length - 1];
        },
        showErrorAlert() {
            let message = `Ha ocurrido un error en el servidor,
                        favor de intentar de nuevo más tarde. Si lo deseas, puedes
                        <a href="/dashboard/bugs">reportar este error.</a>`;
            swal({
                title: 'Error',
                text: message,
                type: 'error',
                html: true
            });
        },
        fetchClients(pagination = false, page) {
            this.loaded = false;
            var _this = this;
            let url = pagination ?
                `/api/clients?page=${page}&quantity=${_this.pagination.per_page}` :
                '/api/clients';
            axios.get(url)
                .then((response) => {
                    //console.log(response.data);
                    _this.clients = response.data.data.data;

                    //FIXME:Se está asignando al objeto de paginación un arreglo con todos los clientes
                    //_this.pagination = response.data.data.pagination;//Posible solucion
                    _this.pagination = pagination ? response.data.data : null;
                    _this.loaded = true;
                })
                .catch((error) => {
                    this.showErrorAlert();
                    _this.loaded = true;
                    //console.log(error);
                });
        },
        fetchClient() {
            let _this = this;
            let id = this.getIdOfResourceInUrl();
            axios.get(`/api/clients/${id}`)
                .then((response) => {
                    //Only for debug
                    //console.log(response.data.data);
                    //console.log(response.data.data.client);
                    //console.log(response.data.data.requested_instructor);
                    _this.client = response.data.data.client;
                    _this.instructor = response.data.data.requested_instructor;
                })
                .catch((error) => {
                    this.showErrorAlert();
                    //console.log(error);
                });
        },
        deleteClient() {
            let _this = this;
            let id = this.getIdOfResourceInUrl();
            swal({
                    title: "Peligro",
                    text: "¿Estás seguro?, se eliminará el registro del cliente.",
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
                        axios.delete(`/api/clients/${id}`)
                            .then((response) => {
                                swal("Eliminado", "Se ha eliminado el registro satisfactoriamente.", "success");
                                setTimeout(function () {
                                    window.location = '/dashboard/clientes';
                                }, 1000);
                            })
                            .catch((error) => {
                                _this.showErrorAlert();
                            });
                    } else {
                        swal("Cancelado", "Has cancelado la acción, tú cliente sigue registrado.", "error");
                    }
                }
            );

        },
        updateClient() {
            let _this = this;
            //let id = this.getIdOfResourceInUrl();
            let id = this.client.id;
            axios.put(`/api/clients/${id}`, this.client)
                .then((response) => {
                    console.log(response);
                    //swal("Correcto", "Se han guardado los cambios del registro", "success");
                    /**
                     * Solución temporal al problema de que no se actualice el modelo client despues
                     * de guardar los cambios realizados, esto solo pasa cada segunda vez
                     * que se hacen cambios.
                     */
                    window.location = '/dashboard/clientes/'+id;
                })
                .catch((error) => {
                    console.log(error);
                    _this.showErrorAlert();
                });
        },
        fetchInstructors(pagination = false, page) {
            this.loaded = false;
            let _this = this;
            if (this.search != '') {
                //Correción temporal a bug que hacía que cuando la página actual sea
                //diferente de uno, no obtuviera resultados de la busqueda
                page = 1;
            }
            let url = pagination ?
                `/api/instructors?page=${page}&quantity=${_this.pagination.per_page}&search=${this.search}` :
                '/api/instructors';
            console.log('Realizando petición ajax desde fetchInstructors');
            axios.get(url)
                .then((response) => {
                console.log(response);
                    _this.instructors = pagination ?  response.data.data.data : response.data.data;
                    _this.pagination = pagination ? response.data.data : null;
                    _this.loaded = true;
                })
                .catch((error) => {
                    this.showErrorAlert();
                    _this.loaded = true;
                });
        }
    }
});
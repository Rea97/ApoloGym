
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
Vue.component('instructor-details', require('./components/Instructor.vue'));

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
    mounted() {
        this.$on('currentPageDesbord' , function (pageDesborded) {
            //console.log('Pagina desbordada '+ pageDesborded);
            //console.log('reseteando pagina actual en 1');
            //console.log(this.pagination);
            this.pagination.current_page = 1;
            //console.log('ejecutando fetchClients()');
            console.log("url actual: " + window.location.pathname);
            console.log("ultimo elemento en url: " + this.getIdOfResourceInUrl());
            if (this.getIdOfResourceInUrl() == 'clientes') {
                this.fetchClients(true, 1);
            } else if (this.getIdOfResourceInUrl() == 'instructores') {
                this.fetchInstructors(true, 1);
            }

        });
    },
    /*watch: {
        'pagination.current_page': function (newPage) {
            console.log('deccqq', newPage);
            if ((newPage > this.pagination.last_page)) {
                this.pagination.current_page = 1;
                console.log('Cambiando a pagina 1');
            }
        }
    },*/
    methods: {
        getIdOfResourceInUrl() { //Cambiar nombre de método a getLastElementInUrl()
            let url = window.location.pathname;
            let arr = url.split('/');
            if (arr[arr.length -1] != '') {
                return arr[arr.length - 1];
            }
            return arr[arr.length - 2];
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
                `/api/clients?page=${page}&quantity=${_this.pagination.per_page}&search=${this.search}` :
                '/api/clients';
            axios.get(url)
                .then((response) => {
                    //console.log(response.data);
                    _this.clients = pagination ?  response.data.data.data : response.data.data;
                    //_this.clients = response.data.data.data;

                    //FIXME:Se está asignando al objeto de paginación un arreglo con todos los clientes
                    //_this.pagination = response.data.data.pagination;//Posible solucion
                    _this.pagination = pagination ? response.data.data : null;
                    _this.loaded = true;
                    if ((_this.pagination.current_page > this.pagination.last_page && _this.pagination.last_page != 0)) {
                        //_this.pagination.current_page = 1;
                        //console.log('Cambiando a pagina 1');
                        //console.log('Emitiendo evento de desborde de pagina actual');
                        _this.$emit('currentPageDesbord', _this.pagination.current_page);
                    }

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
        fetchInstructors(pagination = false, page = 1) {
            this.loaded = false;
            let _this = this;
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
                    if (_this.pagination) {
                        if (_this.pagination.current_page > this.pagination.last_page && _this.pagination.last_page != 0) {
                            _this.$emit('currentPageDesbord', _this.pagination.current_page);
                        }
                    }
                })
                .catch((error) => {
                    this.showErrorAlert();
                    console.log(error);
                    _this.loaded = true;
                });
        }
    }
});
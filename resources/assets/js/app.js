
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
                })
                .catch((error) => {
                    this.showErrorAlert();
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
                })
        },
        fetchInstructors(pagination = false, page) {
            let _this = this;
            let url = pagination ?
                `/api/instructors?page=${page}&quantity=${_this.pagination.per_page}` :
                '/api/instructors';
            console.log('Realizando petición ajax desde fetchInstructors');
            axios.get(url)
                .then((response) => {
                console.log(response);
                    _this.instructors = pagination ?  response.data.data.data : response.data.data;
                    _this.pagination = pagination ? response.data.data : null;
                })
                .catch((error) => {
                    this.showErrorAlert();
                });

        }
    }
});
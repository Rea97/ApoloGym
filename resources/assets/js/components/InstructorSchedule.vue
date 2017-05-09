<template>
    <div id="instructor-schedule-component">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-clock-o"></i> Horario
                    </div>
                    <ul class="list-group">
                        <li v-if="schedule.monday.from || schedule.monday.to" class="list-group-item">
                            <strong>Lunes:</strong> {{ formatTime(schedule.monday.from) }} - {{ formatTime(schedule.monday.to) }}
                            <span class="badge">{{ schedule.monday.hours }} horas.</span>
                        </li>
                        <li v-else class="list-group-item">
                            <strong>Lunes: </strong><i>Tienes día libre.</i>
                        </li>
                        <li v-if="schedule.tuesday.from || schedule.tuesday.to" class="list-group-item">
                            <strong>Martes:</strong> {{ formatTime(schedule.tuesday.from) }} - {{ formatTime(schedule.tuesday.to) }}
                            <span class="badge">{{ schedule.tuesday.hours }} horas.</span>
                        </li>
                        <li v-else class="list-group-item">
                            <strong>Martes: </strong><i>Tienes día libre.</i>
                        </li>
                        <li v-if="schedule.wednesday.from || schedule.wednesday.to" class="list-group-item">
                            <strong>Miercoles:</strong> {{ formatTime(schedule.wednesday.from) }} - {{ formatTime(schedule.wednesday.to) }}
                            <span class="badge">{{ schedule.wednesday.hours }} horas.</span>
                        </li>
                        <li v-else class="list-group-item">
                            <strong>Miercoles: </strong><i>Tienes día libre.</i>
                        </li>
                        <li v-if="schedule.thursday.from || schedule.thursday.to" class="list-group-item">
                            <strong>Jueves:</strong> {{ formatTime(schedule.thursday.from) }} - {{ formatTime(schedule.thursday.to) }}
                            <span class="badge">{{ schedule.thursday.hours }} horas.</span>
                        </li>
                        <li v-else class="list-group-item">
                            <strong>Jueves: </strong><i>Tienes día libre.</i>
                        </li>
                        <li v-if="schedule.friday.from || schedule.friday.to" class="list-group-item">
                            <strong>Viernes:</strong> {{ formatTime(schedule.friday.from) }} - {{ formatTime(schedule.friday.to) }}
                            <span class="badge">{{ schedule.friday.hours }} horas.</span>
                        </li>
                        <li v-else class="list-group-item">
                            <strong>Viernes: </strong><i>Tienes día libre.</i>
                        </li>
                        <li v-if="schedule.saturday.from || schedule.saturday.to" class="list-group-item">
                            <strong>Sábado:</strong> {{ formatTime(schedule.saturday.from) }} - {{ formatTime(schedule.saturday.to) }}
                            <span class="badge">{{ schedule.saturday.hours }} horas.</span>
                        </li>
                        <li v-else class="list-group-item">
                            <strong>Sábado: </strong><i>Tienes día libre.</i>
                        </li>
                        <li v-if="schedule.sunday.from || schedule.sunday.to" class="list-group-item">
                            <strong>Domingo:</strong> {{ formatTime(schedule.sunday.from) }} - {{ formatTime(schedule.sunday.to) }}
                            <span class="badge">{{ schedule.sunday.hours }} horas.</span>
                        </li>
                        <li v-else class="list-group-item">
                            <strong>Domingo: </strong><i>Tienes día libre.</i>
                        </li>
                        <li class="list-group-item">
                            <strong>Total Horas:</strong>
                            <span class="badge">{{ totalWork }} horas.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['currentUser'],
        mounted() {
            this.instructor.id = this.currentUser;
            this.fetchInstructor();
        },
        data() {
            return {
                instructor: {},
                schedule: [],
            }
        },
        methods: {
            formatTime(time) {
                if (time) {
                    let timeArr = time.split(':');
                    timeArr.pop();
                    return timeArr.join(':');
                }
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
            fetchInstructor() {
                let _this = this;
                axios.get(`/api/instructors/${this.instructor.id}`)
                    .then((response) => {
                        console.log(response);
                        _this.instructor = response.data.data.instructor;
                        _this.schedule = response.data.data.schedule;
                    })
                    .catch((error) => {
                        console.log('Error en fetchInstructor() '+error);
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

        },
        computed: {
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
        },
    }
</script>
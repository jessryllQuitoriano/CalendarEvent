<template>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Set EVENT
                </div>
                <div class="card-body">
                    <form @submit.prevent="addCalendar">
                        <div class="form-group">
                            <label>Event Name</label>
                            <input class="form-control" name="event_name" v-model="cal_event.event_name" required>
                        </div>
                        <div class="form-group">
                            <label>Start From</label>
                            <input type="date" name="start_from" class="form-control" v-model="cal_event.start_from" required>
                        </div>
                        <div class="form-group">
                            <label>To</label>
                            <input type="date" name="end_from" class="form-control" v-model="cal_event.end_from" required>
                        </div>
                        <div class="form-check" v-for="selected in selection_days" :key="selected.id">
                            <input class="form-check-input" type="checkbox" :id="selected.id"
                                   :value="selected.id"

                                   v-model="cal_event.day_of_week">
                            <label class="form-check-label" :for="selected.id">
                                {{selected.name}}
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <FullCalendar :options="calendarOptions"/>
        </div>
    </div>
</template>

<script>
import FullCalendar from '@fullcalendar/vue'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
export default {
    data() {
        return {
            selection_days: [
                {
                    id: 0,
                    name: "Sunday"
                },
                {
                    id: 1,
                    name: "Monday"
                },
                {
                    id: 2,
                    name: "Tuesday"
                },
                {
                    id: 3,
                    name: "Wednesday"
                },
                {
                    id: 4,
                    name: "Thursday"
                },
                {
                    id: 5,
                    name: "Friday"
                },
                {
                    id: 6,
                    name: "Saturday"
                },
            ],
            cal_event: {
                event_name: "",
                start_from: "",
                end_from: "",
                day_of_week: [],
            },
            calendarOptions: {
                plugins: [ dayGridPlugin, interactionPlugin ],
                initialView: 'dayGridMonth',
                events: []
            }
        }
    },
    mounted() {
        window.axios.get('/calendar-events').then((res) => {
            this.calendarOptions.events = res.data;
        });
    },
    methods: {
        addCalendar() {
            axios.post('/calendar-events/create', this.cal_event).then((res) => {
                var i;
                for(i = 0; i < res.data.length; i++) {
                    this.calendarOptions.events.push(res.data[i]);
                }
                this.cal_event.event_name = "";
                this.cal_event.start_from = "";
                this.cal_event.end_from = "";
                this.cal_event.day_of_week = "";
            })
        }
    },
    components: {
        FullCalendar // make the <FullCalendar> tag available
    },
}
</script>

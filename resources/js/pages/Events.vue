<template>
    <div class="team">
        <v-container
            v-if="auth_user.role === 'admin' || auth_user.role === 'manager'"
        >
            <v-container>
            <v-dialog v-model="new_dialog" persistent max-width="600px">
                <template v-slot:activator="{ on, attrs }">
                    <v-btn
                        color="cyan"
                        text
                        v-bind="attrs"
                        v-on="on"
                        class="pl-0 pr-0"
                    >
                        Add new event
                    </v-btn>
                </template>
                <v-card>
                    <form @submit.prevent="addEvent">
                        <v-card-title>
                            <span class="headline">New Event</span>
                        </v-card-title>
                        <v-card-text>
                            <v-form v-model="add_valid">
                                <v-container>
                                    <v-row>
                                        <v-col cols="12" md="6">
                                            <v-text-field
                                                label="Event name"
                                                v-model="add_event.name"
                                                required
                                                :rules="nameRules"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" md="6">
                                            <v-text-field
                                                label="Goal (km)"
                                                v-model="add_event.goal"
                                                required
                                                :rules="goalRules"
                                                type="number"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" md="6">
                                            <v-menu
                                                v-model="new_start"
                                                :close-on-content-click="false"
                                                :nudge-right="40"
                                                transition="scale-transition"
                                                offset-y
                                                min-width="auto"
                                            >
                                                <template
                                                    v-slot:activator="{
                                                        on,
                                                        attrs
                                                    }"
                                                >
                                                    <v-text-field
                                                        v-model="
                                                            add_event.new_start_date
                                                        "
                                                        label="Starting date"
                                                        prepend-icon="mdi-calendar"
                                                        readonly
                                                        v-bind="attrs"
                                                        v-on="on"
                                                    ></v-text-field>
                                                </template>
                                                <v-date-picker
                                                    v-model="
                                                        add_event.new_start_date
                                                    "
                                                    @input="new_start = false"
                                                ></v-date-picker>
                                            </v-menu>
                                        </v-col>
                                        <v-col cols="12" md="6">
                                            <v-menu
                                                v-model="new_end"
                                                :close-on-content-click="false"
                                                :nudge-right="40"
                                                transition="scale-transition"
                                                offset-y
                                                min-width="auto"
                                            >
                                                <template
                                                    v-slot:activator="{
                                                        on,
                                                        attrs
                                                    }"
                                                >
                                                    <v-text-field
                                                        v-model="
                                                            add_event.new_end_date
                                                        "
                                                        label="End date"
                                                        prepend-icon="mdi-calendar"
                                                        readonly
                                                        v-bind="attrs"
                                                        v-on="on"
                                                    ></v-text-field>
                                                </template>
                                                <v-date-picker
                                                    v-model="
                                                        add_event.new_end_date
                                                    "
                                                    @input="new_end = false"
                                                ></v-date-picker>
                                            </v-menu>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-textarea
                                                v-model="add_event.description"
                                                label="Event description"
                                            ></v-textarea>
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </v-form>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn
                                color="cyan"
                                text
                                @click="new_dialog = false"
                            >
                                Cancel
                            </v-btn>
                            <v-btn
                                type="submit"
                                color="cyan"
                                text
                                @click="new_dialog = false"
                            >
                                Add
                            </v-btn>
                        </v-card-actions>
                    </form>
                </v-card>
            </v-dialog>
            </v-container>
        </v-container>
        <v-container v-if="active_events != null && active_events.length != 0">
            <h1 class="subheading">Active events</h1>

            <v-alert
                v-model="add_alert"
                dismissible
                color="cyan darken-2"
                border="left"
                elevation="2"
                colored-border
                icon="mdi-check"
            >
                New event added
            </v-alert>
            <v-alert
                v-model="delete_alert"
                dismissible
                color="cyan darken-2"
                border="left"
                elevation="2"
                colored-border
                icon="mdi-check"
            >
                Event deleted
            </v-alert>
            <v-layout row wrap>
                <v-flex
                    v-for="(event, i) in active_events"
                    :key="i"
                    class="md12"
                >
                    <activeEvents
                        :event="event"
                        :auth_user="auth_user"
                        :active_event_activities="active_events_activities[i]"
                        :edit_start="edit_start"
                        :edit_start_date="edit_start_date"
                        :edit_end="edit_end"
                        :edit_end_date="edit_end_date"
                        v-on:deleteEvent="eventDeleted()"
                    ></activeEvents>
                </v-flex>
            </v-layout>
        </v-container>
        <v-container v-if="latest_events != null && latest_events.length != 0">
            <h1 class="subheading">Latest events</h1>
            <v-container>
                <v-layout row wrap>
                    <v-flex>
                        <v-carousel hide-delimiters show-arrows-on-hover>
                            <v-carousel-item
                                v-for="(event, e) in latest_events"
                                :key="e"
                            >
                                <v-card class="ma-3">
                                    <v-list-item class="pa-4">
                                        <v-row>
                                            <v-col>
                                                <v-sheet
                                                    class="pa-5 table-head rounded"
                                                    color="cyan darken-1"
                                                    max-width="300"
                                                    min-width="250"
                                                    height="50"
                                                >
                                                    <v-row
                                                        justify="space-between"
                                                    >
                                                        <h2>
                                                            {{ event.name }}
                                                        </h2>
                                                    </v-row>
                                                </v-sheet>
                                            </v-col>
                                        </v-row>
                                    </v-list-item>
                                    <div class="overline ml-5">
                                        End date: {{ event.end_date }}
                                    </div>
                                    <p class="ml-5" v-if="event.description">
                                        Description:
                                        <br />
                                        {{ event.description }}
                                    </p>
                                    <v-simple-table>
                                        <template v-slot:default>
                                            <thead>
                                                <tr>
                                                    <th class="text-left">
                                                        Rank
                                                    </th>
                                                    <th class="text-left">
                                                        Name
                                                    </th>
                                                    <th class="text-left">
                                                        Time
                                                    </th>
                                                    <th class="text-left">
                                                        Distance
                                                    </th>
                                                    <th class="text-left">
                                                        Date
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr
                                                    v-for="(activity,
                                                    a) in latest_events_activities[
                                                        e
                                                    ]"
                                                    :key="a"
                                                >
                                                    <td>{{ a + 1 }}</td>
                                                    <td>
                                                        {{ activity.user_name }}
                                                    </td>
                                                    <td>
                                                        {{
                                                            new Date(
                                                                activity.moving_time *
                                                                    1000
                                                            )
                                                                .toISOString()
                                                                .substr(11, 8)
                                                        }}
                                                    </td>
                                                    <td>
                                                        {{
                                                            (
                                                                activity.distance /
                                                                1000
                                                            ).toFixed(2)
                                                        }}
                                                        km
                                                    </td>
                                                    <td>{{ activity.date }}</td>
                                                </tr>
                                            </tbody>
                                        </template>
                                    </v-simple-table>
                                </v-card>
                            </v-carousel-item>
                        </v-carousel>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-container>
        <v-container>
            <h1 class="subheading">Global ranking</h1>
            <v-container>
                <v-simple-table>
                    <template v-slot:default>
                        <thead>
                            <tr>
                                <th class="text-left">
                                    Rank
                                </th>
                                <th class="text-left">
                                    Name
                                </th>
                                <th class="text-center">
                                    Events won
                                </th>
                                <th class="text-center">
                                    Total points
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(runner, i) in ranking" :key="i">
                                <td>{{ i+1 }}</td>
                                <td>{{ runner.first_name }} {{ runner.last_name }}</td>
                                <td class="text-center">{{ runner.gold_medals }}</td>
                                <td class="text-center">{{ runner.points }}</td>
                            </tr>
                        </tbody>
                    </template>
                </v-simple-table>
            </v-container>
        </v-container>
    </div>
</template>

<script>
import ActiveEvents from "./events/ActiveEvents.vue";

export default {
    components: {
        activeEvents: ActiveEvents
    },
    data() {
        return {
            add_alert: false,
            delete_alert: false,
            auth_user: null,
            active_events: [],
            active_events_activities: [],
            latest_events: [],
            latest_events_activities: [],
            new_dialog: false,
            dialog_delete: false,
            event: null,
            add_valid: false,
            ranking: [],
            edit_start_date: new Date().toISOString().substr(0, 10),
            edit_end_date: new Date().toISOString().substr(0, 10),
            new_start: false,
            new_end: false,
            edit_start: false,
            edit_end: false,
            add_event: {
                name: "",
                goal: "",
                new_start_date: new Date().toISOString().substr(0, 10),
                new_end_date: ""
            },
            nameRules: [v => !!v || "Name is required"],
            goalRules: [v => !!v || "Goal is required"]
        };
    },
    created() {
        const authUser = axios.get("/getAuthUser");
        const activeEvents = axios.get("/getActiveEvents");
        const latestEvents = axios.get("/getLatestEvents");
        const activeEventsActivities = axios.get("/getActiveEventsActivities");
        const latestEventsActivities = axios.get("/getLatestEventsActivities");
        const ranking = axios.get('/loadRanking');

        axios
            .all([
                authUser,
                activeEvents,
                latestEvents,
                activeEventsActivities,
                latestEventsActivities,
                ranking
            ])
            .then(
                axios.spread((...responses) => {
                    this.auth_user = responses[0].data;
                    this.active_events = responses[1].data;
                    this.latest_events = responses[2].data;
                    this.active_events_activities = responses[3].data;
                    this.latest_events_activities = responses[4].data;
                    this.ranking = responses[5].data;
                })
            );
    },
    methods: {
        addEvent() 
        {
            if (
                this.add_event.name.trim() === "" ||
                this.add_event.goal.trim() === ""
            ) {
                alert("Debes completar todos los campos antes de guardar");
                return;
            }
            const add_event = this.add_event;
            this.add_event = {
                name: "",
                goal: "",
                new_start_date: "",
                new_end_date: "",
                description: ""
            };
            axios.post("/addEvent", add_event).then(response => {
                const alertMessage = response.data;
                this.add_event.push(alertMessage);
            });
            this.add_alert = true;

            this.reloadEvents();
        },

        reloadEvents() 
        {
            const activeEvents = axios.get("/getActiveEvents");
            const activeEventsActivities = axios.get(
                "/getActiveEventsActivities"
            );
            this.active_events = [];
            this.active_events_activities = [];

            axios.all([activeEvents, activeEventsActivities]).then(
                axios.spread((...responses) => {
                    this.active_events = responses[0].data;
                    this.active_events_activities = responses[1].data;
                })
            );
        },

        eventDeleted() 
        {
            this.reloadEvents();
            this.delete_alert = true;
        }
    }
};
</script>

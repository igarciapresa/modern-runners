<template v-bind="$attrs">
    <v-container>
        <v-alert
            v-model="alert"
            dismissible
            color="cyan darken-2"
            border="left"
            elevation="2"
            colored-border
            icon="mdi-check"
        >
            Event data updated
        </v-alert>
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
                            <v-row justify="space-between">
                                <h2>{{ event.name }}</h2>
                            </v-row>
                        </v-sheet>
                    </v-col>
                    <v-col
                        v-if="
                            auth_user.role === 'admin' ||
                                auth_user.role === 'manager'
                        "
                        class="justify-self-end"
                    >
                        <v-dialog
                            v-model="edit_dialog"
                            persistent
                            max-width="600px"
                        >
                            <template v-slot:activator="{ on, attrs }">
                                <v-btn
                                    color="cyan"
                                    text
                                    v-bind="attrs"
                                    v-on="on"
                                >
                                    Edit event
                                </v-btn>
                            </template>
                            <v-card>
                                <v-card-title>
                                    <span class="headline">Event Data</span>
                                </v-card-title>
                                <v-card-text>
                                    <v-container>
                                        <v-row>
                                            <v-col cols="12" md="6">
                                                <v-text-field
                                                    v-model="event.name"
                                                    label="Event name"
                                                    required
                                                ></v-text-field>
                                            </v-col>
                                            <v-col cols="12" md="6">
                                                <v-text-field
                                                    v-model="event.goal"
                                                    label="Goal (km)"
                                                    required
                                                    type="number"
                                                ></v-text-field>
                                            </v-col>
                                            <v-col cols="12" md="6">
                                                <v-menu
                                                    v-model="edit_start"
                                                    :close-on-content-click="
                                                        false
                                                    "
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
                                                                event.start_date
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
                                                            event.start_date
                                                        "
                                                        @input="
                                                            edit_start = false
                                                        "
                                                    ></v-date-picker>
                                                </v-menu>
                                            </v-col>
                                            <v-col cols="12" md="6">
                                                <v-menu
                                                    v-model="edit_end"
                                                    :close-on-content-click="
                                                        false
                                                    "
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
                                                                event.end_date
                                                            "
                                                            label="End date"
                                                            prepend-icon="mdi-calendar"
                                                            readonly
                                                            v-bind="attrs"
                                                            v-on="on"
                                                        ></v-text-field>
                                                    </template>
                                                    <v-date-picker
                                                        v-model="event.end_date"
                                                        @input="
                                                            edit_end = false
                                                        "
                                                    ></v-date-picker>
                                                </v-menu>
                                            </v-col>
                                            <v-col cols="12">
                                                <v-textarea
                                                    label="Event description"
                                                    v-model="event.description"
                                                ></v-textarea>
                                            </v-col>
                                        </v-row>
                                    </v-container>
                                </v-card-text>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn
                                        color="cyan"
                                        text
                                        @click="edit_dialog = false"
                                    >
                                        Cancel
                                    </v-btn>
                                    <v-btn
                                        color="cyan"
                                        text
                                        @click="updateEvent(event)"
                                    >
                                        Save
                                    </v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-dialog>
                        <v-dialog
                            v-model="dialog_delete"
                            persistent
                            max-width="390"
                        >
                            <template v-slot:activator="{ on, attrs }">
                                <v-btn
                                    color="red darken-1"
                                    text
                                    v-bind="attrs"
                                    v-on="on"
                                >
                                    Delete event
                                </v-btn>
                            </template>
                            <v-card>
                                <v-card-title class="headline">
                                    Are you sure you want to delete
                                    {{ event.name }}?
                                </v-card-title>
                                <v-card-text
                                    >If you delete this event, all its data will
                                    be deleted from database.</v-card-text
                                >
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn text @click="dialog_delete = false">
                                        Cancel
                                    </v-btn>
                                    <v-btn
                                        color="red darken-1"
                                        text
                                        @click="deleteEvent(event)"
                                    >
                                        Delete
                                    </v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-dialog>
                    </v-col>
                </v-row>
            </v-list-item>
            <div class="overline ml-5">End date: {{ event.end_date }}</div>
            <p class="ml-5" v-if="event.description">
                Description:<br />
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
                            v-for="(activity, a) in active_event_activities"
                            :key="a"
                        >
                            <td>{{ a + 1 }}</td>
                            <td>{{ activity.user_name }}</td>
                            <td>
                                {{
                                    new Date(activity.moving_time * 1000)
                                        .toISOString()
                                        .substr(11, 8)
                                }}
                            </td>
                            <td>
                                {{ (activity.distance / 1000).toFixed(2) }}
                                km
                            </td>
                            <td>{{ activity.date }}</td>
                        </tr>
                    </tbody>
                </template>
            </v-simple-table>
        </v-card>
    </v-container>
</template>
<script>
export default {
    data() {
        return {
            alert: false,
            edit_dialog: false,
            dialog_delete: false,
            event: Object,
            active_event_activities: Object,
            auth_user: Object,
            edit_start: false,
            edit_end: false
        };
    },

    created() {
        this.event = this.$attrs.event;
        this.auth_user = this.$attrs.auth_user;
        this.active_event_activities = this.$attrs.active_event_activities;
    },

    methods: {
        updateEvent(event) {
            this.edit_dialog = false;
            const params = {
                name: event.name,
                goal: event.goal,
                start_date: event.start_date,
                end_date: event.end_date,
                description: event.description
            };
            axios.put(`/updateEvent/${event.id}`, params).then(res => {
                this.event = res.data;
            });
            this.alert = true;
            axios
                .get(`/getEventActivities/${event.id}`)
                .then(
                    response => (this.active_event_activities = response.data)
                );
        },

        deleteEvent(event) {
            axios.delete(`/deleteEvent/${event.id}`);
            this.dialog_delete = false;
            this.$emit("deleteEvent");
        }
    }
};
</script>

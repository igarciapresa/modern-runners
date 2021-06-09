<template>
    <v-container>
        <v-alert
            v-model="update_alert"
            dismissible
            color="cyan darken-2"
            border="left"
            elevation="2"
            colored-border
            icon="mdi-check"
        >
            User data has been updated
        </v-alert>
        <v-card class="pa-5 ma-4">
            <v-row>
                <v-col>
                    <v-sheet
                        class="pa-5 table-head rounded"
                        color="cyan darken-1"
                        min-width="150"
                        height="30"
                    >
                        <v-row justify="space-between">
                            <h3>{{ user.first_name }} {{ user.last_name }}</h3>
                        </v-row>
                    </v-sheet>
                </v-col>
            </v-row>
            <v-row class="mt-2">
                <v-col>{{ user.why_run }}</v-col>
            </v-row>
            <v-row class="mt-2">
                <v-col md="9"
                    ><v-icon class="mr-3">mdi-album</v-icon>Total points:</v-col
                >
                <v-col>{{ user.points }}</v-col>
            </v-row>
            <v-row class="mt-2">
                <v-col md="9"
                    ><v-icon class="mr-3">mdi-podium-gold</v-icon>Gold
                    medals:</v-col
                >
                <v-col>{{ user.gold_medals }}</v-col>
            </v-row>
            <v-row class="mt-2">
                <v-col md="9"
                    ><v-icon class="mr-3">mdi-podium-silver</v-icon>Silver
                    medals:</v-col
                >
                <v-col>{{ user.silver_medals }}</v-col>
            </v-row>
            <v-row class="mt-2">
                <v-col md="9"
                    ><v-icon class="mr-3">mdi-podium-bronze</v-icon>Bronze
                    medals:</v-col
                >
                <v-col>{{ user.bronze_medals }}</v-col>
            </v-row>
            <v-row justify="space-around" class="mt-5">
                <v-dialog
                    v-model="dialog"
                    persistent
                    max-width="600px"
                    v-if="auth_user.role === 'admin'"
                >
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn
                            color="cyan darken-1"
                            dark
                            text
                            v-bind="attrs"
                            v-on="on"
                            class="mb-2"
                        >
                            Edit user
                        </v-btn>
                    </template>
                    <v-card>
                        <v-card-title>
                            <span class="headline">User Data</span>
                        </v-card-title>
                        <v-card-text>
                            <v-container>
                                <v-row>
                                    <v-col cols="12" md="6">
                                        <v-text-field
                                            label="First name"
                                            required
                                            v-model="user.first_name"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12" md="6">
                                        <v-text-field
                                            label="Last name"
                                            required
                                            v-model="user.last_name"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12" md="8">
                                        <v-text-field
                                            label="Email"
                                            required
                                            v-model="user.email"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12" md="4">
                                        <v-select
                                            :items="roles"
                                            label="Role"
                                            v-model="user.role"
                                        ></v-select>
                                    </v-col>
                                    <v-col cols="12">
                                        <v-textarea
                                            label="Why do you run?"
                                            v-model="user.why_run"
                                        ></v-textarea>
                                    </v-col>
                                </v-row>
                            </v-container>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="cyan" text @click="dialog = false">
                                Cancel
                            </v-btn>
                            <v-btn color="cyan" text @click="updateUser(user)">
                                Save
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
                <v-dialog
                    v-model="dialog_delete"
                    persistent
                    max-width="390"
                    v-if="auth_user.role === 'admin'"
                >
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn
                            color="red darken-1"
                            dark
                            text
                            v-bind="attrs"
                            v-on="on"
                        >
                            Delete user
                        </v-btn>
                    </template>
                    <v-card>
                        <v-card-title class="headline">
                            Are you sure you want to delete
                            {{ user.first_name }} {{ user.last_name }}?
                        </v-card-title>
                        <v-card-text
                            >If you delete this user, all his activities and
                            data will be deleted from database.</v-card-text
                        >
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn text @click="dialog_delete = false">
                                Cancel
                            </v-btn>
                            <v-btn
                                color="red darken-1"
                                text
                                @click="deleteUser(user)"
                            >
                                Delete
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-row>
        </v-card>
    </v-container>
</template>

<script>
export default {
    data() {
        return {
            update_alert: false,
            user: Object,
            auth_user: Object,
            dialog: false,
            dialog_delete: false,
            roles: ["manager", "runner"]
        };
    },

    created() {
        this.user = this.$attrs.user;
        this.auth_user = this.$attrs.auth_user;
    },

    methods: {
        updateUser(user) {
            this.update_alert = true;
            this.dialog = false;
            const params = {
                first_name: user.first_name,
                last_name: user.last_name,
                email: user.email,
                role: user.role,
                why_run: user.why_run
            };
            axios.put(`/updateUser/${user.id}`, params).then(res => {
                this.user = res.data;
            });
            this.$emit("updateUser");
        },

        deleteUser(user) {
            axios.delete(`/deleteUser/${user.id}`);
            this.dialog_delete = false;
            this.$emit("deleteUser");
        }
    }
};
</script>

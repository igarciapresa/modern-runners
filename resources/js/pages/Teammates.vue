<template>
    <v-container>
        <v-alert
            v-model="delete_alert"
            dismissible
            color="cyan darken-2"
            border="left"
            elevation="2"
            colored-border
            icon="mdi-check"
        >
            User and all his activities removed from database
        </v-alert>
        <v-flex d-flex>
            <v-layout wrap>
                <v-flex md4 v-for="(user, i) in users" :key="i">
                    <teammate
                        :user="user"
                        :auth_user="auth_user"
                        v-on:deleteUser="reloadUsers()"
                    ></teammate>
                </v-flex>
            </v-layout>
        </v-flex>
    </v-container>
</template>

<script>
import TeammateVue from "./teammates/Teammate.vue";
export default {
    components: {
        teammate: TeammateVue
    },

    data: () => ({
        delete_alert: false,
        dialog: false,
        dialog_delete: false,
        users: [],
        auth_user: 0
    }),

    mounted() {
        const authUser = axios.get("/getAuthUser");
        const teammates = axios.get("/getTeammates");

        axios.all([authUser, teammates]).then(
            axios.spread((...responses) => {
                this.auth_user = responses[0].data;
                this.users = responses[1].data;
            })
        );
    },

    methods: {
        reloadUsers() {
            axios
                .get("getTeammates")
                .then(response => (this.users = response.data));
            this.delete_alert = true;
        }
    }
};
</script>

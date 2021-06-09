<template>
    <v-app id="inspire">
        <v-navigation-drawer v-model="drawer" app>
            <v-list flat>
                <a href="/">
                    <v-img :src="logo_src" class="mt-5 mr-5 ml-3 mb-5"></v-img>
                </a>
                <v-list-item-group v-model="selectedItem" color="cyan">
                    <v-list-item
                        v-for="(route, r) in routes"
                        :key="r"
                        link
                        exact
                        :to="{ name: route.name }"
                    >
                        <template
                            v-if="
                                auth_user.role === 'admin' ||
                                    auth_user.role === 'manager' ||
                                    routes[r].name != 'messages'
                            "
                        >
                            <v-list-item-icon>
                                <v-icon v-text="route.icon"></v-icon>
                            </v-list-item-icon>

                            <v-list-item-content>
                                <v-list-item-title
                                    v-text="route.text"
                                ></v-list-item-title>
                            </v-list-item-content>
                        </template>
                    </v-list-item>
                </v-list-item-group>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar app>
            <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>

            <v-spacer></v-spacer>
            <v-menu offset-y offset-x left v-if="auth_user.email === null">
                <template v-slot:activator="{ on, attrs }">
                    <v-btn text v-bind="attrs" v-on="on" class="pr-0">
                        <v-badge color="pink" dot offset-x="25" offset-y="5">
                            <v-icon class="mr-5">mdi-bell</v-icon>
                        </v-badge>
                    </v-btn>
                </template>
                <v-list offset-md="1" color="cyan darken-2">
                    <v-list-item :to="{ name: 'profile' }">
                        <v-list-item-title
                            > <v-icon>mdi-account</v-icon> Complete your profile</v-list-item-title
                        >
                    </v-list-item>
                </v-list>
            </v-menu>
            <v-icon v-if="auth_user.email != null" class="mr-5"
                >mdi-bell</v-icon
            >
            <v-dialog v-model="dialog_logout" persistent max-width="390">
                <template v-slot:activator="{ on, attrs }">
                    <v-btn text v-bind="attrs" v-on="on">
                        <v-icon>mdi-logout</v-icon>
                    </v-btn>
                </template>
                <v-card>
                    <v-card-title class="headline">
                        Are you sure you want to logut?
                    </v-card-title>
                    <v-card-text
                        >You will be redirected to our landing page and your
                        session will be closed.</v-card-text
                    >
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn text @click="dialog_logout = false">
                            Cancel
                        </v-btn>
                        <v-btn
                            color="red darken-1"
                            text
                            @click="dialog_logout = false"
                            href="logout"
                        >
                            Logout
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-app-bar>

        <v-main>
            <v-container>
                <router-view
                    v-on:userUpdated="updateNotification()"
                ></router-view>
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
export default {
    data: () => ({
        auth_user: 0,
        drawer: null,
        dialog_logout: false,
        logo_src: "resources/images/logo.png",
        selectedItem: 0,
        routes: [
            { text: "Events", icon: "mdi-calendar", name: "events" },
            { text: "Profile", icon: "mdi-account", name: "profile" },
            {
                text: "Teammates",
                icon: "mdi-account-multiple",
                name: "teammates"
            },
            { text: "My Trials", icon: "mdi-run", name: "trials" },
            { text: "Messages recieved", icon: "mdi-email", name: "messages" }
        ]
    }),
    mounted() {
        axios
            .get("/getAuthUser")
            .then(response => (this.auth_user = response.data));
        this.$router.push({ path: "/events" });
    },
    methods: {
        updateNotification() {
            axios
                .get("/getAuthUser")
                .then(response => (this.auth_user = response.data));
        }
    }
};
</script>

<template>
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
            Your profile has been updated
        </v-alert>
        <v-row>
            <v-col md="8">
                <v-card class="pa-4">
                    <v-sheet
                        class="pa-5 table-head rounded"
                        color="cyan darken-1"
                        max-width="300"
                        min-width="250"
                        height="50"
                    >
                        <v-row justify="space-between">
                            <h2>Edit profile</h2>
                        </v-row>
                    </v-sheet>
                    <v-form v-model="valid">
                        <v-container>
                            <v-row>
                                <v-col cols="12" md="6">
                                    <v-text-field
                                        v-model="user.first_name"
                                        :rules="nameRules"
                                        label="First name"
                                        required
                                    ></v-text-field>
                                </v-col>

                                <v-col cols="12" md="6">
                                    <v-text-field
                                        v-model="user.last_name"
                                        :rules="nameRules"
                                        label="Last name"
                                        required
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="12" md="12">
                                    <v-text-field
                                        v-model="user.email"
                                        :rules="emailRules"
                                        label="E-mail"
                                        required
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="12" md="12">
                                    <v-textarea
                                        name="input-7-4"
                                        label="Tell us why you run"
                                        :value="user.why_run"
                                        v-model="user.why_run"
                                    ></v-textarea>
                                </v-col>
                            </v-row>
                            <v-btn
                                :disabled="!valid"
                                color="cyan darken-1"
                                class="mr-4"
                                @click="updateUser(user)"
                            >
                                Update
                            </v-btn>
                        </v-container>
                    </v-form>
                </v-card>
            </v-col>
            <v-col md="4">
                <v-card class="pa-4">
                    <v-sheet
                        class="pa-5 table-head rounded"
                        color="cyan darken-1"
                        width="200"
                        height="50"
                    >
                        <v-row justify="space-between">
                            <h2>My stats</h2>
                        </v-row>
                    </v-sheet>
                    <v-row class="mt-2">
                        <v-col md="10"
                            ><v-icon class="mr-3">mdi-album</v-icon>Total
                            points:</v-col
                        >
                        <v-col>{{ user.points }}</v-col>
                    </v-row>
                    <v-row class="mt-2">
                        <v-col md="10"
                            ><v-icon class="mr-3">mdi-podium-gold</v-icon>Gold
                            medals:</v-col
                        >
                        <v-col>{{ user.gold_medals }}</v-col>
                    </v-row>
                    <v-row class="mt-2">
                        <v-col md="10"
                            ><v-icon class="mr-3">mdi-podium-silver</v-icon
                            >Silver medals:</v-col
                        >
                        <v-col>{{ user.silver_medals }}</v-col>
                    </v-row>
                    <v-row class="mt-2">
                        <v-col md="10"
                            ><v-icon class="mr-3">mdi-podium-bronze</v-icon
                            >Bronze medals:</v-col
                        >
                        <v-col>{{ user.bronze_medals }}</v-col>
                    </v-row>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
export default {
    data: () => ({
        alert: false,
        user: 0,
        valid: false,
        nameRules: [v => !!v || "Name is required"],
        emailRules: [
            v => !!v || "E-mail is required",
            v => /.+@.+/.test(v) || "E-mail must be valid"
        ]
    }),
    mounted() {
        axios.get("/getAuthUser").then(response => (this.user = response.data));
    },
    methods: {
        validate() {
            this.$refs.form.validate();
        },

        updateUser(user) {
            const params = {
                first_name: user.first_name,
                last_name: user.last_name,
                email: user.email,
                role: user.role,
                why_run: user.why_run
            };
            axios.put(`/updateUser/${user.id}`, params).then(res => {
                this.user = res.data;
                this.alert = true;
            });
            this.$emit("userUpdated");
        }
    }
};
</script>

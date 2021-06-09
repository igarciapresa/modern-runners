<template>
    <v-container>
        <v-container class="contact-data">
            <v-container>
                <v-row><h6>ADDRESS</h6></v-row>
                <v-row><p>Calle Primavera, 26, 18008 Granada</p></v-row>
            </v-container>
            <v-container>
                <v-row><h6>PHONE</h6></v-row>
                <v-row
                    ><p>958302010<br />643502038</p></v-row
                >
            </v-container>
            <v-container>
                <v-row><h6>EMAIL</h6></v-row>
                <v-row><p>info@modernrunners.com</p></v-row>
            </v-container>
            <v-container>
                <v-row><h6>OPENING HOURS</h6></v-row>
                <v-row
                    ><p>8:00-20:00 Mon-Fri<br />8:00-14:30 Sat</p></v-row
                >
            </v-container>
        </v-container>

        <v-container>
            <v-form ref="form" v-model="valid">
                <v-text-field
                    v-model="name"
                    :rules="nameRules"
                    label="Name"
                    required
                ></v-text-field>
                <v-text-field
                    v-model="email"
                    :rules="emailRules"
                    label="E-mail"
                    required
                ></v-text-field>
                <v-textarea
                    v-model="message"
                    :rules="messageRules"
                    label="Message"
                    required
                ></v-textarea>
                <v-btn
                    :disabled="!valid"
                    color="cyan"
                    class="mr-4"
                    @click="submit()"
                    >Submit</v-btn
                >
                <v-btn color="secondary" class="mr-4" @click="reset"
                    >Reset</v-btn
                >
            </v-form>
        </v-container>
    </v-container>
</template>

<script>
export default {
    data: () => ({
        valid: true,
        name: "",
        nameRules: [v => !!v || "Name is required"],
        email: "",
        emailRules: [
            v => !!v || "E-mail is required",
            v => /.+@.+\..+/.test(v) || "E-mail must be valid"
        ],
        message: "",
        messageRules: [
            v => !!v || "Message is required",
            v =>
                (v && v.length >= 10) ||
                "Message must be more than 10 characters"
        ]
    }),
    methods: {
        validate() {
            if (this.$refs.form.validate()) {
                return true;
            } else return false;
        },
        submit() {
            if (this.$refs.form.validate()) {
                const params = {
                    name: this.name,
                    email: this.email,
                    message: this.message
                };
                axios
                    .post("/storeMessage/", params)
                    .then(this.$refs.form.reset());
            }
        },
        reset() {
        this.$refs.form.reset();
        }
    }
};
</script>

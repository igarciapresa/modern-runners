<template>
    <v-card class="pa-5 ma-4">
        <v-row>
            <v-col><b>Name:</b> {{ message.name }}</v-col>
        </v-row>
        <v-row>
            <v-col><b>Email:</b> {{ message.email }}</v-col>
        </v-row>
        <v-row>
            <v-col><b>Message:</b> {{ message.message }}.</v-col>
        </v-row>
        <v-row>
            <v-col align="end">
                <v-dialog v-model="dialog" persistent max-width="600px">
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn color="cyan darken-1" v-bind="attrs" v-on="on">
                            Answer message
                        </v-btn>
                    </template>
                    <v-card>
                        <v-card-title>
                            <span class="headline">Answer message</span>
                        </v-card-title>
                        <v-card-text>
                            <v-container>
                                <v-row>
                                    <v-col cols="12">
                                        <v-textarea
                                            label="Your reply"
                                            v-model="answer"
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
                            <v-btn color="cyan" text @click="answerMessage()">
                                Send
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-col>
        </v-row>
    </v-card>
</template>
<script>
export default {
    data: () => ({
        message: Object,
        dialog: false,
        answer: "",
        return: Object
    }),
    created() {
        this.message = this.$attrs.message;
    },
    methods: {
        answerMessage(){
            this.dialog = false;
            this.return = {
                'id': this.message.id,
                'name': this.message.name,
                'email': this.message.email,
                'message': this.message.message,
                'answer': this.answer
            };
            axios.post('/answerMail', this.return).then(response => console.log(response.data));
            this.$emit('messageSent');
        }
    }
};
</script>

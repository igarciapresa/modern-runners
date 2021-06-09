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
            Email sent
        </v-alert>
        <v-flex d-flex>
            <v-layout wrap>
                <v-flex md6 v-for="(message, m) in messages" :key="m">
                    <message :message="message" v-on:messageSent="messageSent()"></message>
                </v-flex>
            </v-layout>
        </v-flex>
    </v-container>
</template>

<script>
import Message from './messages/Message.vue';
export default {
  components: { Message },
    data: () => ({
        messages: [],
        alert: false
    }),
    mounted(){
        axios.get('/getMessages').then(response => (this.messages = response.data));
    },
    methods: {
        messageSent()
        {
            axios.get('/getMessages').then(response => 
                this.messages = response.data,
                this.alert = true
            );
        }
    }
};
</script>
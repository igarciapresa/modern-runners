<template>
    <v-row id="current-event" class="dark" no-gutters>
        <v-col class="aqua mb-10" md="12"><h1>CURRENT EVENT FINISHING IN</h1></v-col>
        <v-row class="justify-space-around align-center hidden-xs-only" no-gutters>
          <v-card class="rounded-circle dark time">
              <h2>{{Math.trunc(days)}}</h2>
              <h6>Days</h6>
          </v-card>
          <h1 class="aqua">:</h1>
          <v-card class="rounded-circle dark time">
            <h2>{{Math.trunc(hours)}}</h2>
            <h6>Hours</h6>
          </v-card>
          <h1 class="aqua">:</h1>
          <v-card class="rounded-circle dark time">
            <h2>{{Math.trunc(minutes)}}</h2>
            <h6>Minutes</h6>
          </v-card>
          <h1 class="aqua">:</h1>
          <v-card class="rounded-circle dark time">
            <h2>{{Math.trunc(seconds)}}</h2>
            <h6>Seconds</h6>
          </v-card>
        </v-row>

        <v-row class="justify-space-around align-center hidden-sm-and-up pb-10" no-gutters>
          <v-card class="rounded-circle dark time">
              <h2>{{Math.trunc(days)}}</h2>
              <h6>Days</h6>
          </v-card>
          <v-card class="rounded-circle dark time">
            <h2>{{Math.trunc(hours)}}</h2>
            <h6>Hours</h6>
          </v-card>
        </v-row>
        <v-row class="justify-space-around align-center hidden-sm-and-up" no-gutters>
          <v-card class="rounded-circle dark time">
            <h2>{{Math.trunc(minutes)}}</h2>
            <h6>Minutes</h6>
          </v-card>
          <v-card class="rounded-circle dark time">
            <h2>{{Math.trunc(seconds)}}</h2>
            <h6>Seconds</h6>
          </v-card>
        </v-row>
    </v-row>
</template>
<script>
export default {
    data() {
        return{
            current_event: 0,
            now: 0,
            count: 0,
        };
    },
    methods: {
        timer_loop() {
            this.count++
            this.now = Math.trunc(new Date().getTime() / 1000)
            this.count < 200 && setTimeout(this.timer_loop, 1000)
        },
    },
    mounted() {
        axios.get('/getCurrentEvent').then(response => (this.current_event = response.data))
        this.timer_loop()
    },
    computed: {
        seconds() {
            return (this.modifiedDate - this.now) % 60
        },
        minutes() {
            return ((this.modifiedDate - this.now) / 60) % 60
        },
        hours() {
            return ((this.modifiedDate - this.now) / 60 / 60) % 24
        },
        days() {
            return ((this.modifiedDate - this.now) / 60 / 60 / 24)
        },
        modifiedDate: function () {
            return Math.trunc(Date.parse(this.current_event) / 1000)
        }
    }
};
</script>
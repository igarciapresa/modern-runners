<template>
    <v-row id="hero">
        <v-img
            :height="'calc(100vh - ' + $vuetify.application.top + 'px)'"
            :src="head_src"
        >
            <v-layout fill-height align-center class="ml-15 hidden-sm-and-down">
                <v-col sm="5">
                    <h1 class="big">Run with us and achieve your goals</h1>
                    <v-btn width="287px" height="62px" class="mt-10 ml-1" href="login"><v-img :src="strava_src" width="300px"></v-img></v-btn>
                </v-col>
            </v-layout>
            <v-layout fill-height align-center class="ml-5 hidden-md-and-up">
                <v-col sm="7">
                    <h1>Run with us and achieve your goals</h1>
                    <v-btn width="287px" height="62px" class="mt-10 ml-1" href="login"><v-img :src="strava_src" width="300px"></v-img></v-btn>
                </v-col>
            </v-layout>
        </v-img>
    </v-row>
</template>

<script>
export default {
    data: () => ({
      head_src: 'resources/images/landscape.jpg',
      strava_src: 'resources/btn_strava_connectwith_orange.svg'
    }),
}
</script>

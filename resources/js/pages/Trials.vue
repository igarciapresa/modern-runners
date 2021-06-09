<template>
    <v-flex d-flex>
        <v-layout wrap>
            <v-flex md6 v-for="(activity, a) in activities" :key="a">
                <v-card class="pa-5 ma-4">
                    <v-row>
                        <v-col>
                            <v-sheet
                                class="pa-5 table-head rounded"
                                color="cyan darken-1"
                                max-width="250"
                                min-width="150"
                                height="30"
                            >
                                <v-row justify="space-between">
                                    <h3>{{ activity.name }}</h3>
                                </v-row>
                            </v-sheet>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col>{{ activity.date }}</v-col>
                    </v-row>
                    <v-row>
                        <v-col
                            >Distance:
                            {{
                                (activity.distance / 1000).toFixed(2)
                            }}
                            km</v-col
                        >
                        <v-col
                            >Time:
                            {{
                                new Date(activity.moving_time * 1000)
                                    .toISOString()
                                    .substr(11, 8)
                            }}</v-col
                        >
                    </v-row>
                </v-card>
            </v-flex>
            <infinite-loading @infinite="getActivities">
                <div slot="no-more"></div>
            </infinite-loading>
        </v-layout>
    </v-flex>
</template>

<script>
import InfiniteLoading from 'vue-infinite-loading';

export default {
    components: {
        InfiniteLoading
    },
    data: () => ({
        activities: [],
        page:1
    }),
    mounted(){
        axios.get(`/getUserActivities/${this.page}`).then(response => {
            if(response.data.data.length){
                this.page++
                this.activities.push(...response.data.data)
            }
        });
    },
    methods: {
        getActivities($state)
        {
            axios.get(`/getUserActivities/${this.page}`).then(response => {
                if(response.data.data.length){
                    this.page++
                    this.activities.push(...response.data.data)
                    $state.loaded()
                }else {
                    $state.complete();
                }
            });
        }
    }
}
</script>

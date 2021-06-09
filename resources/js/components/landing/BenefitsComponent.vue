<template>
    <v-content id="benefits" class="pt-10">
        <v-container class="mb-5">
            <h1 class="aqua">BENEFITS OF OUR CLUB</h1>
        </v-container>
        <div class="block hidden-sm-and-down">
                <v-row>
                    <v-col md="4" align="center">
                        <v-flex xs5>
                            <v-img :src="icons.pr"></v-img>
                            <p>Interact with other users on our dashboard and get notifications</p>
                        </v-flex> 
                    </v-col>
                    <v-col md="4" align="center">
                        <v-flex xs5>
                            <v-img :src="icons.data"></v-img>
                            <p>Analyze your data and check your improvements</p>
                        </v-flex> 
                    </v-col>
                    <v-col md="4" align="center">
                        <v-flex xs5>
                            <v-img :src="icons.achievement"></v-img>
                            <p>Compete with other runners and never stop moving</p>
                        </v-flex> 
                    </v-col>
                </v-row>
                <v-row>
                    <v-col md="4" align="center">
                        <v-flex xs5>
                            <v-img :src="icons.network"></v-img>
                            <p>Upload your trials from any location to your profile</p>
                        </v-flex> 
                    </v-col>
                    <v-col md="4" align="center">
                        <v-flex xs5>
                            <v-img :src="icons.inbox"></v-img>
                            <p>Get an email whenever a new event is set</p>
                        </v-flex> 
                    </v-col>
                    <v-col md="4" align="center">
                        <v-flex xs5>
                            <v-img :src="icons.running"></v-img>
                            <p>Never get bored. Run listening to our custom playlist</p>
                        </v-flex> 
                    </v-col>
                </v-row>
        </div>

        <div class="block hidden-md-and-up">
                <v-row>
                    <v-col md="6" align="center">
                        <v-flex xs5>
                            <v-img :src="icons.pr"></v-img>
                            <p>Interact with other users on our dashboard and get notifications</p>
                        </v-flex> 
                    </v-col>
                    <v-col md="6" align="center">
                        <v-flex xs5>
                            <v-img :src="icons.data"></v-img>
                            <p>Analyze your data and check your improvements</p>
                        </v-flex> 
                    </v-col>
                </v-row>
                <v-row>
                    <v-col md="6" align="center">
                        <v-flex xs5>
                            <v-img :src="icons.achievement"></v-img>
                            <p>Compete with other runners and never stop moving</p>
                        </v-flex> 
                    </v-col>
                    <v-col md="6" align="center">
                        <v-flex xs5>
                            <v-img :src="icons.network"></v-img>
                            <p>Upload your trials from any location to your profile</p>
                        </v-flex> 
                    </v-col>
                </v-row>
                <v-row>
                    <v-col md="6" align="center">
                        <v-flex xs5>
                            <v-img :src="icons.inbox"></v-img>
                            <p>Get an email whenever a new event is set</p>
                        </v-flex> 
                    </v-col>
                    <v-col md="6" align="center">
                        <v-flex xs5>
                            <v-img :src="icons.running"></v-img>
                            <p>Never get bored. Run listening to our custom playlist</p>
                        </v-flex> 
                    </v-col>
                </v-row>
        </div>
    </v-content>
</template>

<script>
export default {
    data: () => ({
        icons: {
            achievement: 'resources/icons/benefits/Achievement _Monochromatic.svg',
            data: 'resources/icons/benefits/Data analyzing _Monochromatic.svg',
            inbox: 'resources/icons/benefits/Full Inbox _Monochromatic.svg',
            network: 'resources/icons/benefits/Network _Monochromatic.svg',
            pr: 'resources/icons/benefits/PR_Monochromatic.svg',
            running: 'resources/icons/benefits/Running_Monochromatic.svg',
        }
    }),
}
</script>
<template>
    <v-content class="pt-10">
        <v-container>
            <h1 class="aqua">WHY SHOULD YOU JOIN US?</h1>
        </v-container>
        <v-row id="join" class="hidden-sm-and-down" no-gutters>
            <v-row no-gutters>
            <img :src="icons.mountain" class="join-element mountain">
            <p class="join-text join-text1">We are not only runners. We also enjoy the mountains and discovering new trails. If you join us, you will get free access to our Telegram channel where we plan our trails</p>
            </v-row>
            <v-row no-gutters justify="end">
            <p class="join-text join-text2">Running alone can make you be unmotivated, which won’t lead you to your goals. Running all together with our events, we will make our goals explode</p>
            <img :src="icons.explosion" class="join-element explosion">
            </v-row>
            <v-row no-gutters justify="center">
            <img :src="icons.lunch" class="join-element lunch">
            <p class="join-text join-text3">And obviously, sport is not everything, so we meet every time we can. You will also be invited to have some meals with your teammates</p>
            </v-row>
        </v-row>
        <v-container class="hidden-md-and-up" justify="center">
            <v-row no-gutters justify="center" class="mb-5">
                <img :src="icons.mountain" class="mountain-responsive">
                <p class="join-text-responsive">We are not only runners. We also enjoy the mountains and discovering new trails. If you join us, you will get free access to our Telegram channel where we plan our trails</p>
            </v-row>
            <v-row no-gutters justify="center" class="mb-5">
                <img :src="icons.explosion" class="join-element-responsive">
                <p class="join-text-responsive">Running alone can make you be unmotivated, which won’t lead you to your goals. Running all together with our events, we will make our goals explode</p>
            </v-row>
            <v-row no-gutters justify="center" class="mb-5">
                <img :src="icons.lunch" class="join-element-responsive">
                <p class="join-text-responsive">And obviously, sport is not everything, so we meet every time we can. You will also be invited to have some meals with your teammates</p>
            </v-row>
        </v-container>
    </v-content>
</template>

<script>
export default {
    data: () => ({
      icons: {
        explosion: 'resources/icons/random/Explosion_Monochromatic.svg',
        lunch: 'resources/icons/random/Lunch_break_Monochromatic.svg',
        mountain: 'resources/icons/random/Mountain_Monochromatic.svg',
      },
    }),
}
</script>